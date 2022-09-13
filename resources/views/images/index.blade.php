<h1>All images</h1>


@foreach ($images as $image)
    <div>
        <a href="{{$image->permalink()}}">
            <img src="{{$image->fileUrl()}}" alt="{{$image->title}}" width="300" style="margin-top: 20px;">
        </a>
    </div>

@endforeach