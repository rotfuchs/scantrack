<?php

use App\Livewire\History;
use App\Models\ScanHistory;
use Livewire\Livewire;

it('renders history page', function () {
    $this->get('/history')->assertSuccessful();
});

it('shows empty state when no history', function () {
    Livewire::test(History::class)
        ->assertSee('No Scans Yet')
        ->assertSee('Start scanning to see your history here');
});

it('shows scan history items', function () {
    ScanHistory::factory()->create(['content' => 'https://example.com']);

    Livewire::test(History::class)
        ->assertSee('https://example.com')
        ->assertDontSee('No Scans Yet');
});

it('can delete individual scan history item', function () {
    $scan = ScanHistory::factory()->create();

    Livewire::test(History::class)
        ->call('deleteItem', $scan->id);

    expect(ScanHistory::find($scan->id))->toBeNull();
});

it('can clear all history', function () {
    ScanHistory::factory()->count(5)->create();

    expect(ScanHistory::count())->toBe(5);

    Livewire::test(History::class)
        ->call('clearAll');

    expect(ScanHistory::count())->toBe(0);
});

it('shows clear all button only when history exists', function () {
    Livewire::test(History::class)
        ->assertDontSee('Clear All');

    ScanHistory::factory()->create();

    Livewire::test(History::class)
        ->assertSee('Clear All');
});

it('displays items in descending order by date', function () {
    $older = ScanHistory::factory()->create([
        'content' => 'older scan',
        'created_at' => now()->subDay(),
    ]);
    $newer = ScanHistory::factory()->create([
        'content' => 'newer scan',
        'created_at' => now(),
    ]);

    $component = Livewire::test(History::class);

    $items = $component->viewData('items');
    expect($items->first()->id)->toBe($newer->id);
    expect($items->last()->id)->toBe($older->id);
});
