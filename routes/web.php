<?php

use App\Livewire\History;
use App\Livewire\Scanner;
use Illuminate\Support\Facades\Route;

Route::get('/', Scanner::class)->name('scanner');
Route::get('/history', History::class)->name('history');
