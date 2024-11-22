<?php

namespace App\Livewire\Dashboard\Jasa;

use App\Models\Services;
use App\Models\Shops;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = "";

    public $setDeleteName = "", $setDeleteId;

    public function render()
    {
        $shop = Shops::where('user_id', Auth::id())->first();

        if ($shop == null) {
            return redirect(route('daftarToko'));
        }

        $service = $shop->services()->where('title', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(8)
            ->onEachSide(1);

        return view('livewire.dashboard.jasa.index', [
            'service' => $service
        ]);
    }

    public function setDelete($slug)
    {
        $service = Services::where('slug', $slug)->first();

        if (!$service) {
            return redirect(route('dashboard'));
        }

        $this->setDeleteName = $service->title;
        $this->setDeleteId = $service->id;
    }

    public function deleteService()
    {
        $service = Services::find($this->setDeleteId);

        if (!$service) {
            return redirect(route('dashboard'));
        }

        foreach ($service->images as $image) {
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
            $image->delete();
        }

        $service->delete();
        $this->dispatch('close-modal', 'confirm-service-deletion');
        $this->dispatch('notify', message: 'Jasa berhasil dihapus!', type: 'success');
    }
}
