<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use Illuminate\Http\Request;
use PDF;

class KamarController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $allowedPerPage = [3, 5, 10];
        
        if (!in_array($perPage, $allowedPerPage)) {
            $perPage = 10;
        }
        
        $search = $request->get('search');
        $statusFilter = $request->get('status_filter');
        
        $query = Kamar::with('typeKamar');
        
        // Apply search filter
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_kamar', 'like', '%' . $search . '%')
                  ->orWhereHas('typeKamar', function($typeQuery) use ($search) {
                      $typeQuery->where('nama', 'like', '%' . $search . '%');
                  });
            });
        }
        
        // Apply status filter
        if ($statusFilter && $statusFilter !== 'all') {
            $query->where('status_kamar', $statusFilter);
        }
        
        $kamars = $query->paginate($perPage);
        $kamars->appends($request->query());
        
        return view('admin.kamar.index', compact('kamars', 'perPage', 'search', 'statusFilter'));
    }

    public function create()
    {
        return view('admin.kamar.create');
    }

    public function store(Request $request)
    {
        // Implementation for storing kamar
    }

    public function show($id)
    {
        $kamar = Kamar::with([
            'typeKamar.gambarTypeKamar',
            'typeKamar.fasilitasKamarRel',
            'typeKamar.fasilitasKostRel'
        ])->findOrFail($id);
        $kebijakanKamar = $kamar->getKebijakanKamar();
        
        return view('admin.kamar.show', compact('kamar', 'kebijakanKamar'));
    }

    public function edit($id)
    {
        $kamar = Kamar::with([
            'typeKamar.gambarTypeKamar',
            'typeKamar.fasilitasKamarRel',
            'typeKamar.fasilitasKostRel'
        ])->findOrFail($id);
        $typeKamars = \App\Models\TypeKamar::all();
        $kebijakanKamars = \App\Models\KebijakanKamar::all();
        
        return view('admin.kamar.edit', compact('kamar', 'typeKamars', 'kebijakanKamars'));
    }

    public function update(Request $request, $id)
    {
        $kamar = Kamar::findOrFail($id);
        
        $validated = $request->validate([
            'nama_kamar' => 'required|string|max:255',
            'type_kamar_id' => 'required|exists:type_kamar,id',
            'status_kamar' => 'required|in:Tersedia,Booked,Dihuni',
            'kebijakan_kamar_ids' => 'nullable|array',
            'kebijakan_kamar_ids.*' => 'exists:kebijakan_kamar,id'
        ]);

        $kamar->update($validated);
        
        return redirect()->route('admin.kamar.index')
                        ->with('success', 'Kamar ' . $kamar->nama_kamar . ' berhasil diupdate');
    }

    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);
        $namaKamar = $kamar->nama_kamar;
        
        $kamar->delete();
        
        return redirect()->route('admin.kamar.index')
                        ->with('success', 'Kamar ' . $namaKamar . ' berhasil dihapus');
    }

    public function exportPdf(Request $request)
    {
        $search = $request->get('search');
        $statusFilter = $request->get('status_filter');
        
        $query = Kamar::with('typeKamar');
        
        // Apply same filters as index method
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_kamar', 'like', '%' . $search . '%')
                  ->orWhereHas('typeKamar', function($typeQuery) use ($search) {
                      $typeQuery->where('nama', 'like', '%' . $search . '%');
                  });
            });
        }
        
        if ($statusFilter && $statusFilter !== 'all') {
            $query->where('status_kamar', $statusFilter);
        }
        
        $kamars = $query->get();
        
        $pdf = PDF::loadView('admin.kamar.pdf', compact('kamars', 'search', 'statusFilter'));
        $pdf->setPaper('A4', 'landscape');
        
        $filename = 'daftar-kamar-kost-' . date('Y-m-d-H-i-s') . '.pdf';
        
        return $pdf->download($filename);
    }
}