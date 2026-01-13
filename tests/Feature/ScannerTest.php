<?php

use App\Livewire\Scanner;
use Livewire\Livewire;

it('renders scanner page', function () {
    $this->get('/')->assertSuccessful();
});

it('shows ready to scan state initially', function () {
    Livewire::test(Scanner::class)
        ->assertSee('Ready to Scan')
        ->assertSee('Start Scanning');
});

it('does not show result card initially', function () {
    Livewire::test(Scanner::class)
        ->assertDontSee('Scan Successful')
        ->assertSet('showResult', false);
});

it('can dismiss result and return to ready state', function () {
    Livewire::test(Scanner::class)
        ->set('showResult', true)
        ->set('lastScannedContent', 'https://example.com')
        ->set('lastScannedType', 'url')
        ->call('dismissResult')
        ->assertSet('showResult', false)
        ->assertSet('lastScannedContent', null)
        ->assertSee('Ready to Scan');
});
