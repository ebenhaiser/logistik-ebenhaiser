<?php

namespace App\Livewire\Item;

use App\Models\Incoming_item;
use App\Models\Item;
use App\Models\Outgoing_item;
use Livewire\Component;
use Livewire\WithPagination;

class Lists extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $keyword;
    public $itemID,
        $deletingName,
        $editItem = false;
    public $item_code,
        $item_name,
        $quantity;
    public $itemHistories = [];

    public function render()
    {
        if ($this->keyword != null) {
            $items = Item::where('item_code', 'like', '%' . $this->keyword . '%')
                ->orWhere('item_name', 'like', '%' . $this->keyword . '%')
                ->orWhere('quantity', 'like', '%' . $this->keyword . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $items = Item::orderBy('created_at', 'desc')->paginate(10);
        }
        return view('livewire.item.lists', compact('items'));
    }
    public function delete_confirmation($id)
    {
        $this->itemID = $id;
        $this->deletingName = Item::find($id)->item_name;
    }
    public function delete()
    {
        $id = $this->itemID;
        $deletedItem = Item::find($id);

        Item::find($id)->delete();
        $this->clear();
    }

    public function loadItemHistory($item_id)
    {
        $incoming = Incoming_item::where('item_id', $item_id)
            ->select('origin as asal', 'quantity', 'incoming_date as tanggal')
            ->get()
            ->map(function ($item) {
                return [
                    'status' => 'MASUK',
                    'asal' => $item->asal,
                    'tujuan' => '-',
                    'quantity' => $item->quantity,
                    'tanggal' => $item->tanggal,
                ];
            });

        $outgoing = Outgoing_item::where('item_id', $item_id)
            ->select('destination as tujuan', 'quantity', 'outgoing_date as tanggal')
            ->get()
            ->map(function ($item) {
                return [
                    'status' => 'KELUAR',
                    'asal' => '-',
                    'tujuan' => $item->tujuan,
                    'quantity' => $item->quantity,
                    'tanggal' => $item->tanggal,
                ];
            });

        $histories = $incoming->concat($outgoing)->sortByDesc('tanggal')->values();

        $this->itemHistories = $histories->toArray();
    }


    public function detail($id)
    {
        $item = Item::findOrFail($id);
        $this->itemID = $id;

        $this->item_code = $item->item_code;
        $this->item_name = $item->item_name;
        $this->quantity = $item->quantity;
        $this->loadItemHistory($item->id);
    }

    public function edit($id)
    {
        $this->editItem = true;
        $item = Item::findOrFail($id);
        $this->itemID = $id;

        $this->item_code = $item->item_code;
        $this->item_name = $item->item_name;
        $this->quantity = $item->quantity;
    }

    public function update()
    {
        $item = Item::findOrFail($this->itemID);
        $item->update([
            'item_name' => $this->item_name,
            'quantity' => $this->quantity,
        ]);

        $this->clear();
    }

    public function clear()
    {
        $this->itemID = null;
        $this->deletingName = null;
        $this->item_code = null;
        $this->item_name = null;
        $this->quantity = null;
        $this->itemHistories = [];
        $this->editItem = false;
    }
}
