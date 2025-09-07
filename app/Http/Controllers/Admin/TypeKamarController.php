<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeKamar;
use App\Models\FasilitasKost;
use App\Models\FasilitasKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class TypeKamarController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $allowedPerPage = [3, 5, 10];
        
        if (!in_array($perPage, $allowedPerPage)) {
            $perPage = 10;
        }
        
        $search = $request->get('search');
        
        $query = TypeKamar::query();
        
        // Apply search filter
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%')
                  ->orWhere('type_kasur', 'like', '%' . $search . '%')
                  ->orWhere('ukuran_kamar', 'like', '%' . $search . '%');
            });
        }
        
        $typeKamars = $query->paginate($perPage);
        $typeKamars->appends($request->query());
        
        return view('admin.type-kamar.index', compact('typeKamars', 'perPage', 'search'));
    }

    public function create()
    {
        $fasilitasKost = FasilitasKost::orderBy('nama')->get();
        $fasilitasKamar = FasilitasKamar::orderBy('nama')->get();
        
        return view('admin.type-kamar.create', compact('fasilitasKost', 'fasilitasKamar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:type_kamar,nama',
            'deskripsi' => 'required|string',
            'ukuran_kamar' => 'required|string|max:100',
            'type_kasur' => 'required|in:Single Bed,Double Bed,Queen Bed,King Bed',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|array',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'fasilitas_kost' => 'nullable|array',
            'fasilitas_kost.*' => 'exists:fasilitas_kost,id',
            'fasilitas_kamar' => 'nullable|array',
            'fasilitas_kamar.*' => 'exists:fasilitas_kamar,id'
        ]);

        // Handle image upload
        $gambarPaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $path = $file->store('type-kamar', 'public');
                $gambarPaths[] = $path;
            }
        }

        $typeKamar = TypeKamar::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'ukuran_kamar' => $request->ukuran_kamar,
            'type_kasur' => $request->type_kasur,
            'harga' => $request->harga,
            'gambar' => $gambarPaths,
            'fasilitas_kost' => $request->fasilitas_kost ?? [],
            'fasilitas_kamar' => $request->fasilitas_kamar ?? []
        ]);

        return redirect()->route('admin.type-kamar.index')->with('success', 'Tipe kamar berhasil ditambahkan!');
    }

    public function show($id)
    {
        $typeKamar = TypeKamar::findOrFail($id);
        return view('admin.type-kamar.show', compact('typeKamar'));
    }

    public function edit($id)
    {
        $typeKamar = TypeKamar::findOrFail($id);
        return view('admin.type-kamar.edit', compact('typeKamar'));
    }

    public function update(Request $request, $id)
    {
        $typeKamar = TypeKamar::findOrFail($id);
        
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ukuran_kamar' => 'required|string|max:100',
            'type_kasur' => 'required|string|in:Single Bed,Double Bed,Queen Bed,King Bed',
            'harga' => 'required|numeric|min:0',
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fasilitas_kost' => 'nullable|string',
            'fasilitas_kamar' => 'nullable|string'
        ]);

        $typeKamar->nama = $validated['nama'];
        $typeKamar->deskripsi = $validated['deskripsi'];
        $typeKamar->ukuran_kamar = $validated['ukuran_kamar'];
        $typeKamar->type_kasur = $validated['type_kasur'];
        $typeKamar->harga = $validated['harga'];
        
        // Handle fasilitas arrays
        if (!empty($validated['fasilitas_kost'])) {
            $typeKamar->fasilitas_kost = array_filter(explode("\n", $validated['fasilitas_kost']));
        }
        
        if (!empty($validated['fasilitas_kamar'])) {
            $typeKamar->fasilitas_kamar = array_filter(explode("\n", $validated['fasilitas_kamar']));
        }
        
        // Handle file uploads
        if ($request->hasFile('gambar')) {
            // Delete old images
            if ($typeKamar->gambar) {
                foreach ($typeKamar->gambar as $oldImage) {
                    if (Storage::disk('public')->exists($oldImage)) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }
            }
            
            // Store new images
            $gambarPaths = [];
            foreach ($request->file('gambar') as $gambar) {
                $path = $gambar->store('type-kamar', 'public');
                $gambarPaths[] = $path;
            }
            $typeKamar->gambar = $gambarPaths;
        }
        
        $typeKamar->save();
        
        return redirect()->route('admin.type-kamar.index')->with('success', 'Tipe kamar berhasil diupdate');
    }

    public function destroy($id)
    {
        $typeKamar = TypeKamar::findOrFail($id);
        
        // Delete associated images
        if ($typeKamar->gambar) {
            foreach ($typeKamar->gambar as $gambar) {
                if (Storage::disk('public')->exists($gambar)) {
                    Storage::disk('public')->delete($gambar);
                }
            }
        }
        
        $typeKamar->delete();
        
        return redirect()->route('admin.type-kamar.index')->with('success', 'Tipe kamar berhasil dihapus');
    }

    public function exportPdf(Request $request)
    {
        $search = $request->get('search');
        
        $query = TypeKamar::query();
        
        // Apply same search filter as index method
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%')
                  ->orWhere('type_kasur', 'like', '%' . $search . '%')
                  ->orWhere('ukuran_kamar', 'like', '%' . $search . '%');
            });
        }
        
        $typeKamars = $query->get();
        
        $pdf = PDF::loadView('admin.type-kamar.pdf', compact('typeKamars', 'search'));
        $pdf->setPaper('A4', 'landscape');
        
        $filename = 'daftar-tipe-kamar-' . date('Y-m-d-H-i-s') . '.pdf';
        
        return $pdf->download($filename);
    }

    public function addImage(Request $request, $id)
    {
        $typeKamar = TypeKamar::findOrFail($id);
        
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120' // 5MB max
        ]);
        
        try {
            $path = $request->file('image')->store('type-kamar', 'public');
            
            $gambar = $typeKamar->gambar ?? [];
            $gambar[] = $path;
            
            $typeKamar->gambar = $gambar;
            $typeKamar->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Gambar berhasil ditambahkan',
                'image_path' => $path
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengunggah gambar: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteImage($id, $index)
    {
        $typeKamar = TypeKamar::findOrFail($id);
        
        if (!$typeKamar->gambar || !isset($typeKamar->gambar[$index])) {
            return response()->json([
                'success' => false,
                'message' => 'Gambar tidak ditemukan'
            ], 404);
        }
        
        try {
            $gambar = $typeKamar->gambar;
            $imageToDelete = $gambar[$index];
            
            // Delete physical file if it's not a URL
            if (!str_starts_with($imageToDelete, 'http') && Storage::disk('public')->exists($imageToDelete)) {
                Storage::disk('public')->delete($imageToDelete);
            }
            
            // Remove from array and reindex
            array_splice($gambar, $index, 1);
            
            $typeKamar->gambar = array_values($gambar);
            $typeKamar->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Gambar berhasil dihapus'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus gambar: ' . $e->getMessage()
            ], 500);
        }
    }
}