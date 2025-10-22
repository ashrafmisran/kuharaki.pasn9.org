<?php

namespace App\Http\Controllers;

use App\Models\ProdukServis;
use Illuminate\Http\Request;

class ProdukServisController extends Controller
{
    public function index(Request $request)
    {
        $query = ProdukServis::with(['perniagaan.industri']);

        // Search by name or description
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }

        // Filter by industry (through perniagaan relationship)
        if ($request->filled('industri')) {
            $query->whereHas('perniagaan.industri', function ($q) use ($request) {
                $q->where('industri.id', $request->industri);
            });
        }

        // Filter by price range
        if ($request->filled('harga_min')) {
            $query->where('harga', '>=', $request->harga_min);
        }

        if ($request->filled('harga_max')) {
            $query->where('harga', '<=', $request->harga_max);
        }

        $produkServis = $query->paginate(16)->withQueryString();

        // Get list of industries for filter dropdown
        $industriList = \App\Models\Industri::orderBy('nama')->get();

        return view('produk-servis.index', compact('produkServis', 'industriList'));
    }

    public function show(ProdukServis $produkServis)
    {
        $produkServis->load(['perniagaan.bandar.negeri', 'perniagaan.industri']);

        // Find related ProdukServis by same Industri (excluding current)
        $relatedProdukServis = collect();
        $industri = $produkServis->perniagaan && $produkServis->perniagaan->industri->count() > 0
            ? $produkServis->perniagaan->industri->first()
            : null;
        if ($industri) {
            $relatedProdukServis = ProdukServis::whereHas('perniagaan.industri', function($q) use ($industri) {
                $q->where('industri.id', $industri->id);
            })
            ->where('id', '!=', $produkServis->id)
            ->limit(6)
            ->get();
        }
        // If none found, fallback to same Perniagaan
        if ($relatedProdukServis->count() == 0 && $produkServis->perniagaan) {
            $relatedProdukServis = ProdukServis::where('perniagaan_id', $produkServis->perniagaan->id)
                ->where('id', '!=', $produkServis->id)
                ->limit(6)
                ->get();
        }

        return view('produk-servis.show', compact('produkServis', 'relatedProdukServis'));
    }
}