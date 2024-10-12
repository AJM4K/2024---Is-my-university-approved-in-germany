<?php

use App\Livewire\AddItem;
use App\Livewire\AddItemMovement;
use App\Livewire\HomePage;
use App\Livewire\ItemList;
use App\Livewire\ItemMovementList;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', HomePage::class)->name('homePage');

Route::get('/', ItemList::class)->name('itemPage');


Route::get('/item-movements', ItemMovementList::class)->name('movementPage');

Route::get('/add-item', AddItem::class)->name('addItemPage');
Route::get('/add-item-movement', AddItemMovement::class)->name('addItemMovementPage');



