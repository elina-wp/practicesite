<?php 
    $title = get_field('section_title'); ?>
<section class="leadspace leadspace-home bg-white @@leadspaceSkin d-flex align-items-center position-relative">
    <div class="container">
        <div class="row align-items-start align-items-lg-center">
            <div class="col-md-7 offset-xl-1 col-xl-6">
                <article class="card-leadspace">
                    <h1 class="card-leadspace__title mb-6">@@mainText <span class="leadspace-home__spanner">@@borderText</span>. </h1>
                    <p class="mb-0">
                        @@para
                    </p>
                    <a href="#" class="btn btn-primary mt-3"><?php echo  $title; ?></a>
                    <p>this is test</p>
                    <h2>this is heading</h2>
                </article>
            </div>
            <div class="col-md-5 col-xl-5">`
                <div class="bodymoving mx-auto mt-6 mt-md-0 ms-md-11">
                    <div class="body-line" data-path="@@bodyMovingPath"></div>
                </div>
            </div>
        </div>
    </div>
</section>