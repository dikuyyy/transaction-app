<?php

namespace App\Imports;

use App\Models\TransactionHistory;
use App\Models\TransactionHistoryItem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class TransactionImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public string $fileName = 'transactions.xlsx';

    public function __construct($fileName) {
        $this->fileName = $fileName;
    }

    public function collection(Collection $collection): void
    {
        DB::beginTransaction();
        $start = microtime(true);
        $transaction = TransactionHistory::query()->create([
            'total_row' => $collection->count(),
            'file_name' => $this->fileName,
            'duration' => null
        ]);
        foreach ($collection as $row) {
            try {
                TransactionHistoryItem::query()->create([
                    'transaction_history_id' => $transaction->id,
                    'pc' => $row['pc'],
                    'trx_ref_id' => $row['trxref_id'],
                    'tanggal_trx' => Carbon::createFromFormat('d/m/Y H:i', $row['tanggal_trx'])->format('Y-m-d H:i:s'),
                    'produk' => $row['produk'],
                    'qty' => $row['qty'],
                    'no_tujuan' => $row['no_tujuan'],
                    'kode_reseller' => $row['kode_reseller'],
                    'reseller' => $row['reseller'],
                    'modul' => $row['modul'],
                    'status' => $row['status'],
                    'tgl_status' => Carbon::createFromFormat('d/m/Y H:i', $row['tgl_status'])->format('Y-m-d H:i:s'),
                    'nama_supp' => $row['nama_supp'],
                    'hb_stock_supp' => $row['hb_stocksupp'],
                    'h_beli' => $row['h_beli'],
                    'h_jual' => $row['h_jual'],
                    'komisi' => $row['komisi'],
                    'laba' => $row['laba'],
                    'poin' => $row['poin'],
                    'reply_provider' => $row['reply_provider'],
                    'sn' => $row['sn'],
                    'ref_id' => $row['ref_id'],
                    'rate_tp' => $row['rate_tp'],
                    'rate' => $row['rate'],
                    'shell' => $row['shell'],
                    'hbfix' => $row['hbfix'],
                    'notes' => $row['notes'],
                    'k_provider' => $row['kprovider'],
                    'provider' => $row['provider'],
                    'k_produk' => $row['kproduk'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            } catch (\Exception $e) {
                DB::table('failed_transaction')->insert([
                    'transaction_history_id' => $transaction->id,
                    'row_data' => json_encode($row),
                    'description' => $e->getMessage(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $duration = microtime(true) - $start;
        $transaction->update([
            'duration' => $duration
        ]);
        DB::commit();
    }
}
