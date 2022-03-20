<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\Debtor;
use App\Models\User;

class DebtorsController extends Controller
{
    public function index() {
        $debtors = Debtor::all();

        return view('debtors', compact('debtors'));
    }

    public function new() {
        return view('debtor-form');
    }

    public function create(Request $request) {
        $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'company_address' => ['required', 'string', 'max:255'],
            'contact_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $user = User::create([
            'name' => $request->contact_name,
            'email' => $request->email,
            'password' => Hash::make('password'),
        ]);

        $user->assignRole(config('role.debtor'));

        $debtor = Debtor::create([
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'user_id' => $user->id,
        ]);

        event(new Registered($user));

        return redirect('creditor/debtors');
    }
}
