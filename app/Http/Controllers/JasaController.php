<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\ProductTagModel;
use App\Models\ServiceModel;
use App\Models\ServiceTagModel;
use App\Models\TagModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;
use Yajra\DataTables\DataTables;

class JasaController extends Controller
{
    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $tags = TagModel::all();
        return view('page.jasa', [
            'tags' => $tags
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'tags' => 'required',
            'base_price' => 'required',
            'selling_price' => 'required',
        ]);

        try {
            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first(), 400);
            }

            DB::beginTransaction();
            $newService = new ServiceModel();
            $newService->name = $request->name;
            $newService->base_price = $request->base_price;
            $newService->selling_price = $request->selling_price;
            $newService->save();

            if (count($request->get('tags')) > 0) {
                foreach ($request->get('tags') as $tag) {
                    $newServiceTag = new ServiceTagModel();
                    $newServiceTag->service_id = $newService->id;
                    $newServiceTag->tag_id = $tag;
                    $newServiceTag->save();
                }
            }
            DB::commit();
            return redirect()->route('jasa')->with('success', 'Berhasil menambahkan data');
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
            'base_price' => 'required',
            'selling_price' => 'required',
        ]);

        try {
            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first(), 400);
            }

            DB::beginTransaction();
            ServiceModel::query()->where('id', $id)->update([
                'name' => $request->name,
                'base_price' => $request->base_price,
                'selling_price' => $request->selling_price
            ]);
            ServiceTagModel::query()->where('service_id', $id)->delete();
            if (count($request->get('tags')) > 0) {
                foreach ($request->get('tags') as $tag) {
                    $newServiceTag = new ServiceTagModel();
                    $newServiceTag->service_id = $id;
                    $newServiceTag->tag_id = $tag;
                    $newServiceTag->save();
                }
            }
            DB::commit();

            return redirect()->route('jasa')->with('success', 'Berhasil menambahkan data');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi Kesalahan ' . $exception->getMessage());
        }
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        try {
            DB::beginTransaction();
            ServiceModel::query()->where('id', $id)->delete();
            ServiceTagModel::query()->where('service_id', $id)->delete();
            DB::commit();

            return redirect()->route('jasa')->with('success', 'Berhasil menghapus data terbaru');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withErrors('Terjadi Kesalahan ' . $exception->getMessage());
        }
    }

    public function datatable()
    {
        $data = ServiceModel::with('service_tags')->get();
        foreach ($data as $item) {
            $tags_id = [];
            $tags = [];
            foreach ($item->service_tags as $itemTags) {
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
}
