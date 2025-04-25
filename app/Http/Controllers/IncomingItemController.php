<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IncomingItemController extends Controller
{
    public function inputForm()
    {
        return view('incoming_item_form');
    }

    public function listView()
    {
        return view('incoming_item_list');
    }
}
