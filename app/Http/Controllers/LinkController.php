<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function get()
    {
        $links = Link::all();

        return response()->json([
            'status' => '200',
            'links' => $links,
        ]);
    }
}
