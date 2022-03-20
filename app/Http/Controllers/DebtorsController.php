<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Debtor;

class DebtorsController extends Controller
{
    public function index() {
        $debtors = Debtor::all();

        return view('debtors', compact('debtors'));
    }
}
