<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;

class ItemList extends Component
{
    public $items;
    public $search = '';

    public function mount()
    {
        // Fetch items when the component mounts
        $this->items = Item::all();
    }

    public function deleteItem($id)
    {
        // Find the movement and delete it
        $item = Item::find($id);

            $item->delete();

            session()->flash('message', 'تم اجراء بنجاح');
            $this->items = Item::all();


    }

    public function searching() {
        if ($this->search) {
            $this->items = Item::where('name', 'like', '%' . $this->search . '%')->get();
        } else {
            $this->items = Item::all(); // or some default behavior
        }
        
    }
    public function render()
    {
        return view('livewire.item-list');
    }
}
