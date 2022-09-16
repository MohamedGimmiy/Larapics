<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::published()->latest()->paginate(3)->withQueryString();
        return view('images.index', compact('images'));
    }
    public function show(Image $image)
    {
        return view('images.show', compact('image'));
    }
    public function create()
    {
        return view('images.create');
    }

    public function store(ImageRequest $request)
    {
        Image::create($request->getData());
        return to_route('images.index')->with('message', 'Image has been uploaded successfully!');
    }

    public function edit(Image $image)
    {
        if(request()->user()->id !==  $image->user_id){
            abort(403, "Access denied");
        }
        return view('images.edit', compact('image'));
    }

    public function update(Image $image, ImageRequest $request)
    {
        $image->update($request->getData());
        return to_route('images.index')->with('message', 'Image has been updated successfully!');
    }
    public function destroy(Image $image)
    {
        if(request()->user()->id !==  $image->user_id){
            abort(403, "Access denied");
        }
        $image->delete();
        return to_route('images.index')->with('message', 'Image has been removed successfully!');
    }
}
