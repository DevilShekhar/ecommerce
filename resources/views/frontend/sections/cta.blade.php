<section class="cta-section">

    <div class="container">

        @if($section->title)

            <h2>
                {{ $section->title }}
            </h2>

        @endif


        @if($section->content)

            <div>

                {!! $section->content !!}

            </div>

        @endif


        @if($section->button_text)

            <a
                href="{{ $section->button_url ?? '#' }}"
                class="btn-main mt-3"
            >

                {{ $section->button_text }}

                <i class="bi bi-arrow-right ms-2"></i>

            </a>

        @endif

    </div>

</section>
