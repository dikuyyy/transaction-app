<?php

namespace App\Http\Controllers;

use App\Models\TagModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class TagController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('page.tags');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        try {
            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first(), 400);
            }

            DB::beginTransaction();
            $tag = new TagModel();
            $tag->name = $request->get('name');
            $tag->save();
            DB::commit();

            return redirect()->route('tag')->with('success', 'Berhasil menambahkan data baru');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withErrors('Terjadi Kesalahan ' . $exception->getMessage());
        }
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        try {
            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first(), 400);
            }
            DB::beginTransaction();
            TagModel::query()->where('id', $id)->update([
                'name' => $request->get('name'),
                'updated_at' => Carbon::now()
            ]);

            DB::commit();
            return redirect()->route('tag')->with('success', 'Berhasil mengubah data');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withErrors('Terjadi Kesalahan ' . $exception->getMessage());
        }
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        try {
            DB::beginTransaction();
            TagModel::query()->where('id', $id)->delete();
            DB::commit();

            return redirect()->route('tag')->with('success', 'Berhasil menghapus data terbaru');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withErrors('Terjadi Kesalahan ' . $exception->getMessage());
        }
    }

    public function datatable()
    {
        $data = TagModel::all();

        return DataTables::of($data)->make();
    }
}
