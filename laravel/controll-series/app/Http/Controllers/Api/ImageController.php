<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        // we can create a form request for this request but we only have this endpoint
        // at moment so I will do the validation here
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the file type and size as needed
        ]);
        

        $coverPath = $request->file('image')->store('series_cover', 'public');

        return response()
            ->json(['image_path' => $coverPath], 201);
    }
}
