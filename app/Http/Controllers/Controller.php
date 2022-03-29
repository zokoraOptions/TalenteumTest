<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    // public function functionName($id)
    // {
    //     $id = 2;
    //     $test = new user;
    //     $product =  $test->getAllProduct();
    //     return view('chemin', ['produit', $product]);
    // }
}
