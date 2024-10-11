<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlfaController extends Controller
{
    public function show(){
        $transNum = rand(0, 17866120);
        return view('payments.Alfa.show', compact('transNum'));
    }
}
