<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Image::class);
    }
    public function index()
    {
        $images = Image::visibleFor(request()->user())->latest()->paginate(10)->withQueryString();
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
        $this->authorize('update', $image);
        return view('images.edit', compact('image'));
    }

    public function update(Image $image, ImageRequest $request)
    {
        $this->authorize('update', $image);
        $image->update($request->getData());
        return to_route('images.index')->with('message', 'Image has been updated successfully!');
    }
    public function destroy(Image $image)
    {
        if(Gate::denies('delete', $image)){
            abort(403, "Access denied");
        }
        $image->delete();
        return to_route('images.index')->with('message', 'Image has been removed successfully!');
    }
}
