<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        # code...
        $images = Image::published()->latest()->paginate(15);
        return view('images.index', compact('images'));
    }
    public function show(Image $image)
    {
        return view('images.show', compact('image'));
    }
    public function create()
    {
        # code...
        return view('images.create');
    }

    public function store(ImageRequest $request)
    {
        # code...
        dd($request);
    }
}
