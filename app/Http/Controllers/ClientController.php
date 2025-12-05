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
            'clients' => Client::with('contacts')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Clients/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'registration_num' => 'nullable|string|max:255',
            'tax_num' => 'nullable|string|max:255',
            'contacts' => 'array',
            'contacts.*.type' => 'required|string|in:email,phone',
            'contacts.*.value' => 'required|string|max:255',
            'contacts.*.comment' => 'nullable|string|max:255',
        ]);

        foreach ($request->contacts ?? [] as $c) {
            if ($c['type'] === 'email' && !filter_var($c['value'], FILTER_VALIDATE_EMAIL)) {
                return back()->withErrors(['contacts' => 'Invalid email address'])->withInput();
            }

            if ($c['type'] === 'phone' && !preg_match('/^[0-9+\-()\s]{5,20}$/', $c['value'])) {
                return back()->withErrors(['contacts' => 'Invalid phone number'])->withInput();
            }
        }

        $client = Client::create($request->only('business_name', 'registration_num', 'tax_num'));

        foreach ($request->contacts ?? [] as $c) {
            $client->contacts()->create($c);
        }

        return redirect()->route('clients')->with('success', 'Client created successfully');
    }

    public function edit(Client $client)
    {
        $client->load('contacts');
        return Inertia::render('Clients/Edit', [
            'client' => $client,
        ]);
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'registration_num' => 'nullable|string|max:255',
            'tax_num' => 'nullable|string|max:255',
            'contacts' => 'array',
            'contacts.*.type' => 'required|string|in:email,phone',
            'contacts.*.value' => 'required|string|max:255',
            'contacts.*.comment' => 'nullable|string|max:255',
        ]);

        foreach ($request->contacts ?? [] as $c) {
            if ($c['type'] === 'email' && !filter_var($c['value'], FILTER_VALIDATE_EMAIL)) {
                return back()->withErrors(['contacts' => 'Invalid email address'])->withInput();
            }

            if ($c['type'] === 'phone' && !preg_match('/^[0-9+\-()\s]{5,20}$/', $c['value'])) {
                return back()->withErrors(['contacts' => 'Invalid phone number'])->withInput();
            }
        }

        $client->update($request->only('business_name', 'registration_num', 'tax_num'));

        $client->contacts()->delete();
        foreach ($request->contacts ?? [] as $c) {
            $client->contacts()->create($c);
        }

        return redirect()->route('clients')->with('success', 'Client updated successfully');
    }

    public function destroy(Client $client)
    {
        $client->contacts()->delete();
        $client->delete();

        return redirect()->route('clients')->with('success', 'Client deleted successfully');
    }
}
