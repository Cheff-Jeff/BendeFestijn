@extends('layouts.app')

@section('content')
  @php($blocks = carbon_get_post_meta(get_the_ID(), 'page_blocks'))

  @if($blocks && is_array($blocks))
    @foreach($blocks as $block)
      @switch($block["_type"])
        @case("hero")
          @include('blocks.hero-block', ['data' => $block])
          @break
        
        {{-- @case("text_media")
          @include('blocks.text_media', ['data' => $block])
          @break --}}
        
        @default
          @break  
      @endswitch
    @endforeach
  @endif
@endsection
