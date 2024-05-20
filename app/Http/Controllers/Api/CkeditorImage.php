<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CkeditorImage extends Controller
{
    public function imageUpload(Request $request){
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName,PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $path = 'media/'.Auth::id();
            $request->file('upload')->move(public_path($path),$fileName);
            $url = asset($path.$fileName);
            return response()->json(['fileName'=>$fileName,'uploaded'=>1,'url'=>$url]);
        }
    }
}
