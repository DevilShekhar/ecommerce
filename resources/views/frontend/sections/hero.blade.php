<section
    class="hero-section"
    style="--hero-image: url('{{ $section->image
        ? asset('storage/' . $section->image)
        : asset('assets/admin/images/maintanance.svg') }}');"
>

    <div class="container">

        <div class="hero-content">

            @if($section->sub_title)

                <div class="hero-subtitle">

                    {{ $section->sub_title }}

                </div>

            @endif


            @if($section->title)

                <h1 class="hero-title">

                    {{ $section->title }}

                </h1>

            @endif


            @if($section->content)

                <div class="hero-description">

                    {!! $section->content !!}

                </div>

            @endif


            @if($section->button_text)

                <a
                    href="{{ $section->button_url ?? '#' }}"
                    class="btn-main"
                >

                    {{ $section->button_text }}

                    <i class="bi bi-arrow-right ms-2"></i>

                </a>

            @endif

        </div>

    </div>

</section>
