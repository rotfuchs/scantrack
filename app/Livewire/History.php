<?php

namespace App\Livewire;

use App\Models\ScanHistory;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class History extends Component
{
    public function deleteItem(int $id): void
    {
        ScanHistory::destroy($id);
    }

    public function clearAll(): void
    {
        ScanHistory::truncate();
    }

    public function openItem(int $id): void
    {
        $item = ScanHistory::find($id);

        if (! $item) {
            return;
        }

        if ($item->type === 'url') {
            \Native\Mobile\Facades\Browser::open($item->content);
        } elseif ($item->type === 'email') {
            \Native\Mobile\Facades\Browser::open('mailto:'.$item->content);
        } elseif ($item->type === 'phone') {
            \Native\Mobile\Facades\Browser::open('tel:'.$item->content);
        }
    }

    public function render()
    {
        return view('livewire.history', [
            'items' => ScanHistory::query()->latest()->get(),
        ]);
    }
}
