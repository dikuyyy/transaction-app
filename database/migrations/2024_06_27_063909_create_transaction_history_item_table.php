<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('transaction_history_items', function (Blueprint $table) {
            $table->id();
            $table->integer('transaction_history_id');
            $table->string('pc')->nullable();
            $table->string('trx_ref_id');
            $table->date('tanggal_trx');
            $table->string('produk');
            $table->integer('qty');
            $table->string('no_tujuan')->nullable();
            $table->string('kode_reseller')->nullable();
            $table->string('reseller')->nullable();
            $table->string('modul')->nullable();
            $table->string('status');
            $table->date('tgl_status')->nullable();
            $table->string('nama_supp')->nullable();
            $table->decimal('hb_stock_supp')->nullable();
            $table->decimal('h_beli')->nullable();
            $table->decimal('h_jual');
            $table->decimal('komisi')->nullable();
            $table->decimal('laba')->nullable();
            $table->integer('poin')->nullable();
            $table->string('reply_provider')->nullable();
            $table->string('sn')->nullable();
            $table->string('ref_id');
            $table->decimal('rate_tp')->nullable();
            $table->decimal('rate')->nullable();
            $table->decimal('shell')->nullable();
            $table->string('hbfix')->nullable();
            $table->text('notes')->nullable();
            $table->string('k_provider')->nullable();
            $table->string('provider')->nullable();
            $table->string('k_produk')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
