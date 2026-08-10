<section class="website-section">

    <div class="container">

        <div class="section-heading">

            @if($section->sub_title)

                <div class="section-subtitle">

                    {{ $section->sub_title }}

                </div>

            @endif


            <h2 class="section-title">

                {{ $section->title }}

            </h2>


            @if($section->content)

                <div class="section-content">

                    {!! $section->content !!}

                </div>

            @endif

        </div>


        <div class="row g-4">

            <div class="col-lg-4 col-md-6">

                <div class="service-card">

                    <div class="service-icon">

                        <i class="bi bi-laptop"></i>

                    </div>

                    <h4>
                        Web Development
                    </h4>

                    <p>
                        Professional and responsive websites
                        designed for modern businesses.
                    </p>

                </div>

            </div>


            <div class="col-lg-4 col-md-6">

                <div class="service-card">

                    <div class="service-icon">

                        <i class="bi bi-phone"></i>

                    </div>

                    <h4>
                        Mobile Solutions
                    </h4>

                    <p>
                        Modern mobile experiences built
                        for your customers.
                    </p>

                </div>

            </div>


            <div class="col-lg-4 col-md-6">

                <div class="service-card">

                    <div class="service-icon">

                        <i class="bi bi-graph-up"></i>

                    </div>

                    <h4>
                        Digital Solutions
                    </h4>

                    <p>
                        Scalable digital solutions to help
                        your business grow.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>
