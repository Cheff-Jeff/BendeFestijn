<section class="hero-block">
  <div class="slider">
    @foreach ($data["slider_content"] as $slide)
      {!! wp_get_attachment_image(
            $slide,
            'full',
            false,
            ['class' => 'slide-image']
          ) !!}
    @endforeach
  </div>

  <div class="hero-content">
    <div class="title">
      <span class="pre-title">{{ $data["pre-title"] }}</span>
      <h1>{{ $data["title"] }}</h1>
      <a href="{{ $data["button_link"] }}" target="{{ $data["button_target"] }}" class="btn btn-{{ $data["type"] }}">
        {{ $data["button_txt"] }}
      </a>
    </div>
  </div>
</section>