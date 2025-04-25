<?php

namespace App\Http\Controllers;

use App\Models\Incoming_item;
use App\Models\Item;
use App\Models\Outgoing_item;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $incomingItems = Incoming_item::orderBy('incoming_date', 'desc')->limit(5)->get();
        $outgoingItems = Outgoing_item::orderBy('outgoing_date', 'desc')->limit(5)->get();
        $items = Item::orderBy('quantity', 'desc')->limit(5)->get();
        return view('index', compact('incomingItems', 'outgoingItems', 'items'));
    }
}
