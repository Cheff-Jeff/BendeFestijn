@push('styles')
  @vite(['resources/css/blocks/hero.scss'])
@endpush

@push('scripts')
  @vite(['resources/js/blocks/hero.js'])
@endpush

<section class="hero-block">
  <div class="splide" role="group" aria-label="Splide Basic HTML Example">
    <div class="splide__track">
      <ul class="splide__list">
        @foreach ($data["slider_content"] as $slide)
          <li class="splide__slide">
            {!! wp_get_attachment_image(
                $slide,
                'full',
                false,
                ['class' => 'slide-image']
              ) !!}
          </li>
        @endforeach
      </ul>
    </div>
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