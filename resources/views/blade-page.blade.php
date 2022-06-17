@extends($page->theme_layout->key ?: $page->type->theme_layout->key)
{{--{{ dd($content) }}--}}
@section('content')
    {!! $content !!}
@endsection
