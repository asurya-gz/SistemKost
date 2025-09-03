<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function create()
    {
        return view('admin.laporan.create');
    }

    public function store(Request $request)
    {
        // Implementation for storing laporan
    }

    public function show($id)
    {
        return view('admin.laporan.show', compact('id'));
    }

    public function edit($id)
    {
        return view('admin.laporan.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Implementation for updating laporan
    }

    public function destroy($id)
    {
        // Implementation for deleting laporan
    }
}