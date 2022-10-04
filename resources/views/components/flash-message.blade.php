@if ($message = session('message'))
<x-alert type="success" dismissable>
    {{$component->icon()}}
    {{$message}}
</x-alert>
@endif
