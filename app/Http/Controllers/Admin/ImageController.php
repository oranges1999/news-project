<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateImageRequest;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Image::where('user_id',Auth::id())->get();
        return view('admin.images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.images.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateImageRequest $request)
    {
        $dataImages = $request->validated();
        $this->storeImage($dataImages);
        return redirect()->route('admin.image.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function storeImage($images)
    {
        foreach ($images['images'] as $image) {
            // Get and create unique name for image
            $originalName = $image->getClientOriginalName();
            $name = $image->hashname();
            $imageName = time().'-'.$name;
            // Store the image
            $path = $image->storeAs(
                'public', $imageName
            );
            // Get image path of on the symlink folder
            $path = str_replace('public','storage',$path);
            // Resize the image using Intervention/Image
            $imgManager = new ImageManager(new Driver);
            $resizedImage = $imgManager->read($path);
            $resizedImage->resizeDown(960,540)->save();
            // Store the information of image to database
            $path = asset($path);
            $dataImage = array('user_id'=>Auth::id(),'path'=>$path,'original_name'=>$originalName);
            Image::create($dataImage);
        }
    }
}
