<?php

namespace App\Filament\Direktori\Pages;

use Filament\Pages\Page;
use App\Models\Perniagaan;
use Illuminate\Database\Eloquent\Builder;

class DirektoriPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static string $view = 'filament.direktori.pages.direktori-page';

    protected static ?string $title = 'Direktori Perniagaan';

    protected static ?string $navigationLabel = 'Direktori';

    protected static ?int $navigationSort = 1;

    public $search = '';
    public $kategori = '';
    public $negeri = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'kategori' => ['except' => ''],
        'negeri' => ['except' => ''],
    ];

    public function getViewData(): array
    {
        $perniagaanQuery = Perniagaan::query()
            ->with(['bandar.negeri', 'industri']);

        // Apply search filter
        if ($this->search) {
            $perniagaanQuery->where(function (Builder $query) {
                $query->where('nama', 'like', '%' . $this->search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $this->search . '%');
            });
        }

        // Apply category filter
        if ($this->kategori) {
            $perniagaanQuery->where('kategori', $this->kategori);
        }

        // Apply state filter
        if ($this->negeri) {
            $perniagaanQuery->whereHas('bandar', function (Builder $query) {
                $query->where('negeri_id', $this->negeri);
            });
        }

        $perniagaan = $perniagaanQuery->latest()->paginate(12);

        return [
            'perniagaan' => $perniagaan,
            'totalPerniagaan' => Perniagaan::count(),
            'negeriList' => \App\Models\Negeri::all(),
        ];
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->kategori = '';
        $this->negeri = '';
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedKategori()
    {
        $this->resetPage();
    }

    public function updatedNegeri()
    {
        $this->resetPage();
    }
}