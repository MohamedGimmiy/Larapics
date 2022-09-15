<x-layout title="Discover free images">
    <h1>All images</h1>

    <a href="{{route('images.create')}}">Upload image</a>

    @if ($message = session('message'))
        <div>{{$message}}</div>
    @endif
    @foreach ($images as $image)
        <div>
            <div>
                <a href="{{$image->permalink()}}">
                    <img src="{{$image->fileUrl()}}" alt="{{$image->title}}" width="300" style="margin-top: 20px;">
                </a>
            </div>
            <div>
                <a href="{{$image->route('edit')}}">Edit</a>
                <x-form action="{{$image->route('destroy')}}" method="DELETE" style="display: inline;">
                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                </x-form>
            </div>
        </div>

    @endforeach
</x-layout>
