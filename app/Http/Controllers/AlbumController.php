<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Image;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index(){

       $albums = Album::all();
       return view('albums.index', ['albums' => $album]);
    }

    public function store(){
        $request->validate([
            'name' => 'required|string|max:255',
            'caption' => 'nullable|string|max:255',
            'event' => 'string|max:255'
        ]);

        Album::create($request->all());

        return redirect()->route('albums.index');
    }

    public function show(){
        return Album::find($id);
    }

    public function destroy(Album $album) {
        $album->delete();

        return redirect('albums.index');
    }
}
