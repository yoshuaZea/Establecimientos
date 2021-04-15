<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OopsController extends Controller{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request){
        $msg = isset($_GET['msg']) ? $_GET['msg'] : Session::get('msg');

        return view('oops')->with('msg', $msg);
    }
}
