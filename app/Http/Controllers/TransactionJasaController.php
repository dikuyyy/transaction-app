<?php

namespace App\Http\Controllers;

use App\Models\ServiceModel;
use Illuminate\Http\Request;

class TransactionJasaController extends Controller
{
    public function index()
    {
        $jasa = ServiceModel::all();
        return view('page.transaction-jasa', [
            'jasa' => $jasa
        ]);
    }
}
