<?php

namespace App\Livewire\OutgoingItem;

use App\Models\Item;
use App\Models\Outgoing_item;
use Livewire\Component;

class Form extends Component
{
    public $item_code,
        $item_id,
        $quantity,
        $destination,
        $outgoing_date,
        $description;
    public $item_quantity;

    public function render()
    {
        $item_code = null;
        $items = Item::get();
        if ($this->item_id != null) {
            $item = Item::find($this->item_id);
            $this->item_code = $item->item_code;
            $this->item_quantity = $item->quantity;
        }
        return view('livewire.outgoing-item.form', compact('items'));
    }

    public function validateAdd()
    {
        $this->validate([
            'quantity' => 'integer|min:1',
            'destination' => 'required',
            'outgoing_date' => 'required',
        ]);
    }

    public function store()
    {
        $this->validateAdd();

        $item = Item::find($this->item_id);
        $newQuantity = $item->quantity;
        $newQuantity -= $this->quantity;

        $item->update([
            'quantity' => $newQuantity,
        ]);

        Outgoing_item::create([
            'item_id' => $this->item_id,
            'quantity' => $this->quantity,
            'destination' => $this->destination,
            'outgoing_date' => $this->outgoing_date,
            'description' => $this->description,
        ]);

        $this->clear();
        return redirect()->route('outgoingItems.list');
    }

    public function clear()
    {
        $this->item_code = null;
        $this->item_id = null;
        $this->quantity = null;
        $this->destination = null;
        $this->outgoing_date = null;
        $this->description = null;
        $this->item_quantity = null;
    }
}
