<?php

namespace App\Http\Controllers;

use App\Models\Perniagaan;
use Illuminate\Http\Request;

class PerniagaanController extends Controller
{
    public function index(Request $request)
    {
        $query = Perniagaan::with(['bandar.negeri', 'produkServis']);

        // Search by name or description
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter by state (negeri)
        if ($request->filled('negeri')) {
            $query->whereHas('bandar', function ($q) use ($request) {
                $q->where('negeri_id', $request->negeri);
            });
        }

        $perniagaan = $query->paginate(12)->withQueryString();

        return view('perniagaan.index', compact('perniagaan'));
    }

    public function show(Perniagaan $perniagaan)
    {
        $perniagaan->load(['bandar.negeri', 'produkServis', 'industri']);
        
        return view('perniagaan.show', compact('perniagaan'));
    }
}