<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OutgoingItemController extends Controller
{
    public function inputForm()
    {
        return view('outgoing_item_form');
    }

    public function listView()
    {
        return view('outgoing_item_list');
    }
}
