<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;

class AddItem extends Component
{
    public $name;
    public $quantity;
    public $description;
    public $location;

    public function addItem()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
        ]);

        Item::create([
            'name' => $this->name,
            'quantity' => $this->quantity,
            'in_quantity' => $this->quantity,
            'description' => $this->description,
            'location' => $this->location,
        ]);
        session()->flash('message', 'تم اضافة بنجاح!');

        $this->reset();

    }

    public function render()
    {
        return view('livewire.add-item');
    }
}
