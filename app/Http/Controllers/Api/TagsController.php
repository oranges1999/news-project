<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagsResource;
use App\Models\Tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function showTags()
    {
        return TagsResource::collection(Tags::all());
    }

    public function createTags(Request $request)
    {
        $data = array('name'=>$request->input('name'));
        $tag = Tags::create($data);
        return new TagsResource($tag);
    }
}
