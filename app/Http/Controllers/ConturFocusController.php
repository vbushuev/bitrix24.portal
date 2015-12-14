<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \vsb\ConturFocus;

class ConturFocusController extends Controller
{
    /**
     * Search method
     *
     * @return \Illuminate\Http\Response
     */
    public function Search($q)
    {
        //
    }
    public function getIndex(Request $rq){
        return view('contur-focus.index');
    }
}
