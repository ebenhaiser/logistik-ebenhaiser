<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function itemListView()
    {
        return view('item_list');
    }
}
