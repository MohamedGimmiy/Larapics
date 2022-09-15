<div {{ $attributes->merge([ 'class' => $getClasses, 'role' => $attributes->prepends('alert')]) }}>
    @isset($title)
    <h4 class="alert-heading">{{$title}}</h4>
    @endisset

    {{$slot}}
    @if ($dismissible)
    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
    @endif
</div>
