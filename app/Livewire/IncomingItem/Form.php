<?php

namespace App\Livewire\IncomingItem;

use App\Models\Incoming_item;
use App\Models\Item;
use Livewire\Component;

class Form extends Component
{
    public $item_code,
        $item_name = null,
        $item_id = null,
        $quantity = null,
        $origin = null,
        $incoming_date = null,
        $description = null;
    public $item_status = 0;

    public function render()
    {
        $items = Item::get();
        if ($this->item_status == 0) {
            $this->item_code = 'BRG-' . time();
        } else {
            if ($this->item_id != null) {
                $item = Item::find($this->item_id);
                $this->item_code = $item->item_code;
                $this->item_name = $item->item_name;
            } else {
                $this->item_code = null;
                $this->item_name = null;
            }
        }
        return view('livewire.incoming-item.form', compact('items'));
    }

    public function validateAdd()
    {
        if ($this->item_status == 0) {
            $this->validate([
                'item_name' => 'required',
                'quantity' => 'integer|min:1',
                'origin' => 'required',
                'incoming_date' => 'required',
            ]);
        } else {
            $this->validate([
                'quantity' => 'integer|min:1',
                'origin' => 'required',
                'incoming_date' => 'required',
            ]);
        }
    }

    public function store()
    {
        $this->validateAdd();
        if ($this->item_status == 0) {
            $item = Item::create([
                'item_code' => $this->item_code,
                'item_name' => $this->item_name,
                'quantity' => $this->quantity,
            ]);

            Incoming_item::create([
                'item_id' => $item->id,
                'quantity' => $this->quantity,
                'origin' => $this->origin,
                'incoming_date' => $this->incoming_date,
                'description' => $this->description,
            ]);
        } else {
            $item = Item::find($this->item_id);
            $newQuantity = $item->quantity + $this->quantity;
            $item->update([
                'quantity' => $newQuantity,
            ]);

            Incoming_item::create([
                'item_id' => $this->item_id,
                'quantity' => $this->quantity,
                'origin' => $this->origin,
                'incoming_date' => $this->incoming_date,
                'description' => $this->description,
            ]);
        }

        $this->clear();
        return redirect()->route('incomingItems.list');
    }


    public function clear()
    {
        $this->item_name = null;
        $this->quantity = null;
        $this->origin = null;
        $this->incoming_date = null;
        $this->description = null;
    }
}
