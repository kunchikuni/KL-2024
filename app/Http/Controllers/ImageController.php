<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    public function index(){
        $images = Image::latest()->with(['comments', 'likes'])->get();
        return view('image.index', ['images'=> $images]);

    }

    public function store(Request $request) {
        $request->validate([
            
            'album_id' => 'required|exists:album,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000'
        ]);


    $file = $request->file('image');
    $path = $file->store('images', 'public'); 

    $image = new Image();
    $image->album_id = $request->album_id;
    $image->file_path = $path;
    $image->save();

    return redirect()->back()-with('success', 'Image uploaded successfully');
    
    }

    public function show(Image $image)
    {
        return Image::find($id);
    }

}
