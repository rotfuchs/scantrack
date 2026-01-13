<?php

use App\Models\ScanHistory;

it('detects url type correctly', function () {
    expect(ScanHistory::detectType('https://example.com'))->toBe('url');
    expect(ScanHistory::detectType('http://example.com/path'))->toBe('url');
});

it('detects email type correctly', function () {
    expect(ScanHistory::detectType('test@example.com'))->toBe('email');
    expect(ScanHistory::detectType('user.name@domain.org'))->toBe('email');
});

it('detects phone type correctly', function () {
    expect(ScanHistory::detectType('+1234567890'))->toBe('phone');
    expect(ScanHistory::detectType('(555) 123-4567'))->toBe('phone');
});

it('detects wifi type correctly', function () {
    expect(ScanHistory::detectType('WIFI:T:WPA;S:MyNetwork;P:password;;'))->toBe('wifi');
});

it('defaults to text type for unknown content', function () {
    expect(ScanHistory::detectType('Just some random text'))->toBe('text');
    expect(ScanHistory::detectType('12345'))->toBe('text');
});

it('can create scan history records', function () {
    $scan = ScanHistory::create([
        'content' => 'https://example.com',
        'format' => 'QR_CODE',
        'type' => 'url',
    ]);

    expect($scan)->toBeInstanceOf(ScanHistory::class);
    expect($scan->content)->toBe('https://example.com');
    expect($scan->format)->toBe('QR_CODE');
    expect($scan->type)->toBe('url');
});

it('uses factory to create records', function () {
    $scan = ScanHistory::factory()->url()->create();

    expect($scan->type)->toBe('url');
    expect(filter_var($scan->content, FILTER_VALIDATE_URL))->not->toBeFalse();
});
