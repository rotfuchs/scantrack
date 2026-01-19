<?php

namespace App\Livewire;

use App\Models\ScanHistory;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Native\Mobile\Attributes\OnNative;
use Native\Mobile\Events\Scanner\CodeScanned;
use Native\Mobile\Facades\Scanner as NativeScanner;

#[Layout('layouts.app')]
class Scanner extends Component
{
    public ?string $lastScannedContent = null;

    public ?string $lastScannedFormat = null;

    public ?string $lastScannedType = null;

    public bool $showResult = false;

    public function startScan(): void
    {
        NativeScanner::scan();
    }

    #[OnNative(CodeScanned::class)]
    public function onBarcodeScanned(string $data, string $format, ?string $id = null): void
    {
        if (empty($data)) {
            return;
        }

        $type = ScanHistory::detectType($data);

        ScanHistory::create([
            'content' => $data,
            'format' => $format,
            'type' => $type,
        ]);

        $this->lastScannedContent = $data;
        $this->lastScannedFormat = $format;
        $this->lastScannedType = $type;
        $this->showResult = true;
    }

    public function dismissResult(): void
    {
        $this->showResult = false;
        $this->lastScannedContent = null;
        $this->lastScannedFormat = null;
        $this->lastScannedType = null;
    }

    public function openContent(): void
    {
        if (! $this->lastScannedContent) {
            return;
        }

        if ($this->lastScannedType === 'url') {
            \Native\Mobile\Facades\Browser::open($this->lastScannedContent);
        } elseif ($this->lastScannedType === 'email') {
            \Native\Mobile\Facades\Browser::open('mailto:'.$this->lastScannedContent);
        } elseif ($this->lastScannedType === 'phone') {
            \Native\Mobile\Facades\Browser::open('tel:'.$this->lastScannedContent);
        }
    }

    public function render()
    {
        return view('livewire.scanner');
    }
}
