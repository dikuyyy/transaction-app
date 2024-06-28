<?php

namespace App\Http\Controllers;

use App\Exports\TransactionFailedRowExport;
use App\Exports\TransactionSuccessRowExport;
use App\Imports\TransactionImport;
use App\Models\TransactionHistory;
use App\Models\TransactionHistoryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class UploadTransactionController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('page.transaction');
    }

    public function datatable(): \Illuminate\Http\JsonResponse
    {
        $data = TransactionHistory::withCount(['transactionHistoryItem as success_row', 'failedTransactionHistoryItem as failed_row'])->get();
        return Datatables::of($data)->make();
    }

    public function upload(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validate = Validator::make($request->all(), [
            'file_excel' => 'required'
        ]);

        try {
            if ($validate->fails()) {
                throw new \Exception($validate->errors()->first(), 400);
            }
            $file = $request->file('file_excel');
            $fileName = now()->timestamp . '_' . $file->getClientOriginalName();
            $file->storeAs('imports', $fileName, 'private');
            $transactionImport = new TransactionImport($fileName);
            $import = Excel::import($transactionImport, $file);
            return redirect()->route('transaction')->with('success', 'Berhasil menambahkan data baru');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Terjadi Kesalahan ' . $e->getMessage());
        }
    }

    public function downloadSuccessRow($id): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new TransactionSuccessRowExport($id), 'success_transaction_'.$id.'.csv');
    }

    public function downloadFailedRow($id): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new TransactionFailedRowExport($id), 'failed_transaction_' . $id . '.csv');
    }
}
