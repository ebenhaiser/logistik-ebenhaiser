<?php

namespace App\Livewire\OutgoingItem;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Outgoing_item;

class Lists extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $keyword;
    public $itemID,
        $deletingName;
    public $editItem = false;
    public $item_code,
        $item_name,
        $quantity,
        $destination,
        $outgoing_date,
        $description;
    public function render()
    {
        if ($this->keyword != null) {
            $OutgoingItems = Outgoing_item::whereHas('item', function ($query) {
                $query->where('item_name', 'like', '%' . $this->keyword . '%');
            })
                ->orWhere('origin', 'like', '%' . $this->keyword . '%')
                ->orWhere('quantity', 'like', '%' . $this->keyword . '%')
                ->orderBy('outgoing_date', 'desc')
                ->paginate(10);
        } else {
            $OutgoingItems = Outgoing_item::orderBy('outgoing_date', 'desc')->paginate(10);
        }


        return view('livewire.outgoing-item.lists', compact('OutgoingItems'));
    }

    public function detail($id)
    {
        $item = Outgoing_item::find($id);
        $this->item_code = $item->item->item_code;
        $this->item_name = $item->item->item_name;
        $this->quantity = $item->quantity;
        $this->destination = $item->destination;
        $this->outgoing_date = $item->outgoing_date;
        $this->description = $item->description;
    }

    public function edit($id)
    {
        $this->editItem = true;
        $this->itemID = $id;
        $item = Outgoing_item::find($id);
        $this->item_code = $item->item->item_code;
        $this->item_name = $item->item->item_name;
        $this->quantity = $item->quantity;
        $this->destination = $item->destination;
        $this->outgoing_date = $item->outgoing_date;
        $this->description = $item->description;
    }

    public function update()
    {
        $outgoingItem = Outgoing_item::find($this->itemID);
        $itemQuantity = $outgoingItem->item->quantity;
        $itemQuantity += $outgoingItem->quantity;
        $itemQuantity -= $this->quantity;

        $item = Item::find($outgoingItem->item_id);
        $item->update([
            'quantity' => $itemQuantity,
        ]);

        $outgoingItem->update([
            'quantity' => $this->quantity,
            'destination' => $this->destination,
            'outgoing_date' => $this->outgoing_date,
            'description' => $this->description,
        ]);

        $this->clear();
    }

    public function delete_confirmation($id)
    {
        $this->itemID = $id;
        $this->deletingName = Outgoing_item::find($id)->item->item_name;
    }

    public function delete()
    {
        $id = $this->itemID;
        $deletedItem = Outgoing_item::find($id);
        $deletedQuantity = $deletedItem->quantity;
        $item = Item::find($deletedItem->item_id);
        $newQuantity = $item->quantity + $deletedQuantity;
        $item->update([
            'quantity' => $newQuantity,
        ]);
        Outgoing_item::find($id)->delete();
        $this->clear();
    }

    public function clear()
    {
        $this->itemID = null;
        $this->deletingName = null;
        $this->editItem = false;

        $this->item_code = null;
        $this->item_name = null;
        $this->quantity = null;
        $this->destination = null;
        $this->outgoing_date = null;
        $this->description = null;
    }
}
