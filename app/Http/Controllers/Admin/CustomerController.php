<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;

use App\Models\User;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('pages.admin.customers.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        try {
            $request->validate();
            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone_number' => $request->input('phone_number'),
                'address' => $request->input('address'),
                'password' => bcrypt($request->input('password')),
            ]);
            return redirect()->route('customer.index')->with('success', 'Data konsumen berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            // Temukan data konsumen berdasarkan ID
            $customer = User::with('order')
                ->whereHas('user', function ($query) use ($id) {
                    $query->where('user_id', $id);
                })->firstOrFail();

            // Tampilkan halaman detail konsumen
            return view('pages.admin.customers.show', ['customer' => $customer]);
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi (misalnya, konsumen tidak ditemukan)
            return redirect()->route('customer.index')->withErrors(['error' => 'Konsumen tidak ditemukan.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            // Temukan data konsumen berdasarkan ID
            $customer = User::findOrFail($id);

            // Tampilkan formulir edit konsumen
            return view('pages.admin.customers.edit', ['customer' => $customer]);
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi (misalnya, konsumen tidak ditemukan)
            return redirect()->route('customer.index')->withErrors(['error' => 'Konsumen tidak ditemukan.']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        try {
            $request->validate();
            $customer = User::findOrFail($id);
            $customer->update($request->validate());
            return redirect()->route('customer.index')->with('success', 'Data konsumen berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $customer = User::findOrFail($id);
            $customer->delete();
            return redirect()->route('customer.index')->with('success', 'Data konsumen berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }
}
