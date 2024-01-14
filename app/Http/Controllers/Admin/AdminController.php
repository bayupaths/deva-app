<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index()
    {
        return view('pages.admin.profile.data-admin');
    }

    public function create()
    {
        return view('pages.admin.profile.create-admin');

    }

    public function store(Request $request)
    {
        // Logika untuk menyimpan data baru ke dalam database
    }

    public function show($id)
    {
        return view('pages.admin.profile.show-admin');
        // Logika untuk menampilkan data berdasarkan ID

    }

    public function edit($id)
    {
        // Logika untuk menampilkan formulir pengeditan data
        return view('pages.admin.profile.edit-admin');
    }

    public function update(Request $request, $id)
    {
        // Logika untuk menyimpan perubahan pada data
    }

    public function destroy($id)
    {
        // Logika untuk menghapus data
    }


    public function profile()
    {
        return view('pages.admin.profile.index');
    }

    public function settings()
    {
        return view('pages.admin.profile.setting');
    }
}
