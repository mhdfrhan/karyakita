<?php

namespace App\Livewire\Dashboard\Saldo;

use App\Models\Mutations;
use Livewire\Component;
use Livewire\WithPagination;

class Mutasi extends Component
{
    use WithPagination;

    public $search;
    public $type = 'all';
    public $startDate;
    public $endDate;

    protected $queryString = [
        'search' => ['except' => ''],
        'type' => ['except' => 'all'],
        'startDate' => ['except' => ''],
        'endDate' => ['except' => '']
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $mutations = Mutations::query()
            ->where('user_id', auth()->id())
            ->when($this->search, function($query) {
                $query->where('description', 'like', '%' . $this->search . '%');
            })
            ->when($this->type != 'all', function($query) {
                $query->where('type', $this->type);
            })
            ->when($this->startDate, function($query) {
                $query->whereDate('created_at', '>=', $this->startDate);
            })
            ->when($this->endDate, function($query) {
                $query->whereDate('created_at', '<=', $this->endDate);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.dashboard.saldo.mutasi', [
            'mutations' => $mutations
        ]);
    }
}
