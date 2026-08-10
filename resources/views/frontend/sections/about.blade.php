<section class="website-section about-section">

    <div class="container">

        <div class="row align-items-center g-5">

            <div class="col-lg-6">

                @if($section->image)

                    <img
                        src="{{ asset('storage/' . $section->image) }}"
                        alt="{{ $section->title }}"
                        class="about-image"
                    >

                @endif

            </div>


            <div class="col-lg-6">

                <div class="about-content">

                    @if($section->sub_title)

                        <div class="section-subtitle">

                            {{ $section->sub_title }}

                        </div>

                    @endif


                    @if($section->title)

                        <h2 class="section-title">

                            {{ $section->title }}

                        </h2>

                    @endif


                    @if($section->content)

                        <div class="section-content">

                            {!! $section->content !!}

                        </div>

                    @endif


                    @if($section->button_text)

                        <a
                            href="{{ $section->button_url ?? '#' }}"
                            class="btn-main mt-4"
                        >

                            {{ $section->button_text }}

                            <i class="bi bi-arrow-right ms-2"></i>

                        </a>

                    @endif

                </div>

            </div>

        </div>

    </div>

</section>
