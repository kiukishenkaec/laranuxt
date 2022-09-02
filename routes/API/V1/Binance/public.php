<?php

use Illuminate\Support\Facades\Route;

Route::controller('SymbolController')->group(function () {
    Route::get('symbols', 'index')->name('symbols.index');
    Route::get('symbols/{id}', 'show')->name('symbols.show');
    Route::get('symbols/{id}/histories', 'histories')->name('symbols.show.histories');
});

Route::controller('SymbolHistoryController')->group(function () {
    Route::get('histories', 'index')->name('histories.index');
    Route::get('histories/{id}', 'show')->name('histories.show');
    Route::get('histories/{id}/symbols', 'symbols')->name('histories.show.symbols');
});
