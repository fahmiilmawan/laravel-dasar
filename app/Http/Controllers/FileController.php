<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function upload(Request $request): string
    {
        $image = $request->file("picture");
        $image->storePubliclyAs("pictures",$image->getClientOriginalName(),"public");

        return "OK " .$image->getClientOriginalName();
    }
}
