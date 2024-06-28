<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\ProductTagModel;
use App\Models\TagModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function index(): Factory|Application|View
    {
        $tags = TagModel::all();
        return view('page.product', [
            'tags' => $tags
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'tags' => 'required',
            'kuantitas' => 'required',
            'harga_jual' => 'required',
            'harga_beli' => 'required'
        ]);

        try {
            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first(), 400);
            }

            DB::beginTransaction();
            $newProduct = new ProductModel();
            $newProduct->name = $request->get('name');
            $newProduct->quantity = $request->get('kuantitas');
            $newProduct->purchasing_price = $request->get('harga_beli');
            $newProduct->selling_price = $request->get('harga_jual');
            $newProduct->save();

            if (count($request->get('tags')) > 0) {
                foreach ($request->get('tags') as $tag) {
                    $newProductTag = new ProductTagModel();
                    $newProductTag->product_id = $newProduct->id;
                    $newProductTag->tag_id = $tag;
                    $newProductTag->save();
                }
            }
            DB::commit();

            return redirect()->route('produk')->with('success', 'Berhasil menambahkan data');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi Kesalahan ' . $exception->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'tags' => 'required',
            'kuantitas' => 'required',
            'harga_jual' => 'required',
            'harga_beli' => 'required'
        ]);

        try {
            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first(), 400);
            }

            DB::beginTransaction();

            ProductModel::query()->where('id', $id)->update([
                'name' => $request->name,
                'quantity' => $request->kuantitas,
                'purchasing_price' => $request->harga_jual,
                'selling_price' => $request->harga_beli,
                'updated_at' => Carbon::now()
            ]);
            ProductTagModel::query()->where('product_id', $id)->delete();
            if (count($request->get('tags')) > 0) {
                foreach ($request->get('tags') as $tag) {
                    $newProductTag = new ProductTagModel();
                    $newProductTag->product_id = $newProduct->id;
                    $newProductTag->tag_id = $tag;
                    $newProductTag->save();
                }
            }
            DB::commit();

            return redirect()->route('produk')->with('success', 'Berhasil menambahkan data');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi Kesalahan ' . $exception->getMessage());
        }
    }

    public function datatable()
    {
        $data = ProductModel::with('product_tags')->get();
        foreach ($data as $item) {
            $tags_id = [];
            $tags = [];
            foreach ($item->product_tags as $itemTags) {
                $tag = TagModel::query()->where('id', $itemTags->tag_id)->first();
                $tags[] = $tag->name;
                $tags_id = $tag->id;
            }
            $item->tags_id = $tags_id;
            $tags = implode(', ', $tags);
            $item->tags = $tags;
        }
        return DataTables::of($data)->make();
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        try {
            DB::beginTransaction();
            ProductModel::query()->where('id', $id)->delete();
            ProductTagModel::query()->where('product_id', $id)->delete();
            DB::commit();

            return redirect()->route('produk')->with('success', 'Berhasil menghapus data terbaru');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withErrors('Terjadi Kesalahan ' . $exception->getMessage());
        }
    }
}
