<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
    @php
        $icon = 'logo.svg';
    @endphp
    <x-icon :src="$icon" />
    <x-ui.button />
    <x-alert type="warning" dismissible id="my-alert" class="mt-4 d-flex align-items-center" role="flash">
        {{-- <x-slot:title>
            Success
        </x-slot> --}}
        {{$component->icon()}}
        <p class="mb-0">Data has been removed {{$component->link('Undo')}} </p>
    </x-alert>
</body>
</html>
