<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConcerstController extends Controller
{
    public function show($id)
    {
      $concert = Concert::find($id);
      return view('concerst.show', ['concert' => $concert]);
    }
}
