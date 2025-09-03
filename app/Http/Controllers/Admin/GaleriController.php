<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('created_at', 'desc')->get();
        return view('admin.galeri.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'upload_method' => 'required|in:file,url',
            'foto' => 'required_if:upload_method,file|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url_foto' => 'required_if:upload_method,url|nullable|url'
        ]);

        $gallery = new Gallery();
        $gallery->type = 'galeri';
        $gallery->judul = $validated['judul'];
        $gallery->alt_text = $validated['judul'];
        $gallery->deskripsi = $validated['deskripsi'];
        $gallery->is_published = true;
        
        // Handle photo upload based on method
        if ($validated['upload_method'] === 'file' && $request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('galeri', $filename, 'public');
            $gallery->nama_file = $filename;
            $gallery->path = $path;
        } elseif ($validated['upload_method'] === 'url' && !empty($validated['url_foto'])) {
            $gallery->nama_file = basename($validated['url_foto']);
            $gallery->path = $validated['url_foto'];
        }
        
        $gallery->save();
        
        return redirect()->route('admin.galeri.index')->with('success', 'Foto berhasil ditambahkan');
    }

    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.galeri.show', compact('gallery'));
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.galeri.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);
        
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'upload_method' => 'required|in:file,url',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url_foto' => 'nullable|url'
        ]);

        $gallery->judul = $validated['judul'];
        $gallery->alt_text = $validated['judul'];
        $gallery->deskripsi = $validated['deskripsi'];
        
        // Handle photo update based on method
        if ($validated['upload_method'] === 'file' && $request->hasFile('foto')) {
            // Delete old file if it's a local file
            if (!str_starts_with($gallery->path, 'http') && Storage::disk('public')->exists($gallery->path)) {
                Storage::disk('public')->delete($gallery->path);
            }
            
            // Store new file
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('galeri', $filename, 'public');
            $gallery->nama_file = $filename;
            $gallery->path = $path;
        } elseif ($validated['upload_method'] === 'url' && !empty($validated['url_foto'])) {
            // Delete old file if it's a local file
            if (!str_starts_with($gallery->path, 'http') && Storage::disk('public')->exists($gallery->path)) {
                Storage::disk('public')->delete($gallery->path);
            }
            
            $gallery->nama_file = basename($validated['url_foto']);
            $gallery->path = $validated['url_foto'];
        }
        
        $gallery->save();
        
        return redirect()->route('admin.galeri.index')->with('success', 'Foto berhasil diupdate');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        
        // Delete associated file if it's a local file
        if (!str_starts_with($gallery->path, 'http') && Storage::disk('public')->exists($gallery->path)) {
            Storage::disk('public')->delete($gallery->path);
        }
        
        $gallery->delete();
        
        return redirect()->route('admin.galeri.index')->with('success', 'Foto berhasil dihapus');
    }
}