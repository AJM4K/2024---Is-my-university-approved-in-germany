<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\ItemsMovement;
use Livewire\Component;

class AddItemMovement extends Component
{
    public $item_id;
    public $quantity;
    public $location;
    public $movement_type;
    public $description; // New property
    public $search = '';
    public $items = [];

    public function mount()
    {
        $this->fetchItems();
    }

    public function fetchItems()
    {
        $this->items = Item::where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function updatedSearch()
    {
        $this->fetchItems();
    }

    public function addMovement()
    {
        $this->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'location' => 'nullable|string',
            'movement_type' => 'required|in:in,out',
            'description' => 'nullable|string',
        'movement_type' => 'required|in:in,out',
        ]);
        // Create the movement record
        ItemsMovement::create([
            'item_id' => $this->item_id,
            'quantity' => $this->quantity,
            'location' => $this->location,
            'description' => $this->description,
            'status' => $this->movement_type,
        ]);
        // Update item quantities based on the movement type
        $item = Item::find($this->item_id);
        if ($this->movement_type === 'in') {
            $item->in_quantity += $this->quantity;
            $item->out_quantity -= $this->quantity;
        } else {
            $item->out_quantity += $this->quantity;
            $item->in_quantity -= $this->quantity;
        }
        $item->save();

        // Reset the input fields
        $this->reset();

        session()->flash('message', ' تم تسجيل الحركة بنجاح!');
    }

    public function render()
    {
        return view('livewire.add-item-movement');
    }
}
