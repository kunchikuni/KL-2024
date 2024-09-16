<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\RedisJob;

class LikeController extends Controller
{

    public function __construct() {
        
        $this->middleware(['auth']);
    }

    public function like(Image $image)
    {
        if ($image->likedBy($request->auth()->user()->id())); {
            return response(null, 409); //Conflict http
        }

        $image->likes()->create([

            'user_id' => $request->auth()->user()->id,
            'image_id' => $request->image()->id
        ]); 

        return back();
    }

    public function unlike(Image $image, Request $request)
    {
        $request->Auth::user()->likes()->where('image_id', $image->id)->delete();

        return redirect()->back();

    }
}
