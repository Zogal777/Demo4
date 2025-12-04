<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientController extends Controller
{
    public function index()
    {
        return Inertia::render('Clients', [
            'clients' => Client::all(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Clients/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'business_name' => 'required',
            'registration_num' => 'nullable',
            'tax_num' => 'nullable',
        ]);

        Client::create($request->only('business_name', 'registration_num', 'tax_num'));

        return redirect()->route('clients');
    }
}
