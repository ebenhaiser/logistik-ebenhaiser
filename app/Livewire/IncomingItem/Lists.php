<?php

namespace App\Livewire\IncomingItem;

use App\Models\Incoming_item;
use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

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
        $origin,
        $incoming_date,
        $description;

    public function render()
    {

        if ($this->keyword != null) {
            $IncomingItems = Incoming_item::whereHas('item', function ($query) {
                $query->where('item_name', 'like', '%' . $this->keyword . '%');
            })
                ->orWhere('origin', 'like', '%' . $this->keyword . '%')
                ->orWhere('quantity', 'like', '%' . $this->keyword . '%')
                ->orderBy('incoming_date', 'desc')
                ->paginate(10);
        } else {
            $IncomingItems = Incoming_item::orderBy('incoming_date', 'desc')->paginate(10);
        }


        return view('livewire.incoming-item.lists', compact('IncomingItems'));
    }

    public function detail($id)
    {
        $item = Incoming_item::find($id);
        $this->item_code = $item->item->item_code;
        $this->item_name = $item->item->item_name;
        $this->quantity = $item->quantity;
        $this->origin = $item->origin;
        $this->incoming_date = $item->incoming_date;
        $this->description = $item->description;
    }

    public function edit($id)
    {
        $this->editItem = true;
        $this->itemID = $id;
        $item = Incoming_item::find($id);
        $this->item_code = $item->item->item_code;
        $this->item_name = $item->item->item_name;
        $this->quantity = $item->quantity;
        $this->origin = $item->origin;
        $this->incoming_date = $item->incoming_date;
        $this->description = $item->description;
    }

    public function update()
    {
        $incomingIitem = Incoming_item::find($this->itemID);
        $itemQuantity = $incomingIitem->item->quantity;
        $itemQuantity -= $incomingIitem->quantity;
        $itemQuantity += $this->quantity;

        $item = Item::find($incomingIitem->item_id);
        $item->update([
            'quantity' => $itemQuantity,
        ]);

        $incomingIitem->update([
            'quantity' => $this->quantity,
            'origin' => $this->origin,
            'incoming_date' => $this->incoming_date,
            'description' => $this->description,
        ]);


        $this->clear();
    }

    public function delete_confirmation($id)
    {
        $this->itemID = $id;
        $this->deletingName = Incoming_item::find($id)->item->item_name;
    }

    public function delete()
    {
        $id = $this->itemID;
        $deletedItem = Incoming_item::find($id);
        $deletedQuantity = $deletedItem->quantity;
        $item = Item::find($deletedItem->item_id);
        $newQuantity = $item->quantity - $deletedQuantity;
        if ($newQuantity <= 0) {
            $newQuantity = 0;
        }
        $item->update([
            'quantity' => $newQuantity,
        ]);
        Incoming_item::find($id)->delete();
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
        $this->origin = null;
        $this->incoming_date = null;
        $this->description = null;
    }
}
