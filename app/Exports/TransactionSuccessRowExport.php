<?php

namespace App\Exports;

use App\Models\TransactionHistoryItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionSuccessRowExport implements FromCollection, WithHeadings {
    protected int $transactionHistoryId;

    public function __construct(int $transactionHistoryId) {
        $this->transactionHistoryId = $transactionHistoryId;
    }

    public function collection() {
        return TransactionHistoryItem::query()
            ->where('transaction_history_id', $this->transactionHistoryId)
            ->get()
            ->map(function($item) {
                return [
                    'PC' => $item->pc,
                    'TRX/Ref ID' => $item->trx_ref_id,
                    'Tanggal TRX' => $item->tanggal_trx,
                    'Produk' => $item->produk,
                    'Qty' => $item->qty,
                    'No. Tujuan' => $item->no_tujuan,
                    'Kode Reseller' => $item->kode_reseller,
                    'Reseller' => $item->reseller,
                    'Modul' => $item->modul,
                    'Status' => $item->status,
                    'Tgl Status' => $item->tgl_status,
                    'Nama Supp' => $item->nama_supp,
                    'HB. Stock/Supp' => $item->hb_stock_supp,
                    'H. Beli' => $item->h_beli,
                    'H. Jual' => $item->h_jual,
                    'Komisi' => $item->komisi,
                    'Laba' => $item->laba,
                    'Poin' => $item->poin,
                    'Reply Provider' => $item->reply_provider,
                    'SN' => $item->sn,
                    'Ref_id' => $item->ref_id,
                    'Rate TP' => $item->rate_tp,
                    'Rate' => $item->rate,
                    'Shell' => $item->shell,
                    'HBFIX' => $item->hbfix,
                    'NOTES' => $item->notes,
                    'K.Provider' => $item->k_provider,
                    'Provider' => $item->provider,
                    'K.Produk' => $item->k_produk
                ];
            });
    }

    public function headings(): array
    {
        return [
            'PC', 'TRX/Ref ID', 'Tanggal TRX', 'Produk', 'Qty', 'No. Tujuan', 'Kode Reseller', 'Reseller', 'Modul', 'Status', 'Tgl Status', 'Nama Supp', 'HB. Stock/Supp', 'H. Beli', 'H. Jual', 'Komisi', 'Laba', 'Poin', 'Reply Provider', 'SN', 'Ref_id', 'Rate TP', 'Rate', 'Shell', 'HBFIX', 'NOTES', 'K.Provider', 'Provider', 'K.Produk'
        ];
    }
}
