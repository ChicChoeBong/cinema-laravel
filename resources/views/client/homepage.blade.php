<!doctype html>
<html class="no-js" lang="">

<head>
    @include('client.share.css')
</head>

<body>
    <!-- preloader -->
    <div id="preloader">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <img src="/assets_client/img/preloader.svg" alt="">
            </div>
        </div>
    </div>
    <!-- preloader-end -->
    <!-- Scroll-top -->
    <button class="scroll-top scroll-to-target" data-target="html">
        <i class="fas fa-angle-up"></i>
    </button>
    <!-- Scroll-top-end-->

    <!-- header-area -->
    @include('client.share.header')
    <!-- main-area -->
    <main>

        <!-- slider-area -->
        <section class="slider-area slider-bg"
            style="background-image: url('{{ isset($config->bg_homepage) ? $config->bg_homepage : '/assets_client/img/banner/s_slider_bg.jpg' }}')">
            <div class="slider-active">
                @if (isset($phim_1))
                    <div class="slider-item">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6 order-0 order-lg-2">
                                    <div class="slider-img text-center text-lg-right" data-animation="fadeInRight"
                                        data-delay="1s">
                                        <img src="{{ $phim_1->avatar }}" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="banner-content">
                                        <h6 class="sub-title" data-animation="fadeInUp" data-delay=".2s">CHICBONG</h6>
                                        <h2 class="title" data-animation="fadeInUp" data-delay=".4s">
                                            {{ $phim_1->ten_phim }}</h2>
                                        <div class="banner-meta" data-animation="fadeInUp" data-delay=".6s">
                                            <ul>
                                                <li class="quality">
                                                    <span>{{ $phim_1->the_loai }}</span>
                                                    <span>HD</span>
                                                </li><br>
                                                <li class="category">
                                                    {{ $phim_1->dien_vien }}
                                                </li><br>
                                                <li class="release-time">
                                                    <span><i class="far fa-calendar-alt"></i>
                                                        {{ $phim_1->ngay_khoi_chieu }}</span>
                                                    <span><i class="far fa-clock"></i> {{ $phim_1->thoi_luong }}
                                                        phút</span>
                                                </li><br>
                                            </ul>
                                        </div>
                                        <a href="{{ $phim_1->trailer }}" class="banner-btn btn popup-video"
                                            data-animation="fadeInUp" data-delay=".8s"><i class="fas fa-play"></i> Xem
                                            Ngay</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($phim_2))
                    <div class="slider-item">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6 order-0 order-lg-2">
                                    <div class="slider-img text-center text-lg-right" data-animation="fadeInRight"
                                        data-delay="1s">
                                        <img src="{{ $phim_2->avatar }}" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="banner-content">
                                        <h6 class="sub-title" data-animation="fadeInUp" data-delay=".2s">CHICBONG</h6>
                                        <h2 class="title" data-animation="fadeInUp" data-delay=".4s">
                                            {{ $phim_2->ten_phim }}</h2>
                                        <div class="banner-meta" data-animation="fadeInUp" data-delay=".6s">
                                            <ul>
                                                <li class="quality">
                                                    <span>{{ $phim_2->the_loai }}</span>
                                                    <span>hd</span>
                                                </li><br>
                                                <li class="category">
                                                    {{ $phim_2->dien_vien }}
                                                </li><br>
                                                <li class="release-time">
                                                    <span><i class="far fa-calendar-alt"></i>
                                                        {{ $phim_2->ngay_khoi_chieu }}</span>
                                                    <span><i class="far fa-clock"></i> {{ $phim_2->thoi_luong }}
                                                        phút</span>
                                                </li><br>
                                            </ul>
                                        </div>

                                        <a href="{{ $phim_2->trailer }}" class="banner-btn btn popup-video"
                                            data-animation="fadeInUp" data-delay=".8s"><i class="fas fa-play"></i> Xem
                                            Ngay</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($phim_3))
                    <div class="slider-item">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6 order-0 order-lg-2">
                                    <div class="slider-img text-center text-lg-right" data-animation="fadeInRight"
                                        data-delay="1s">
                                        <img src="{{ $phim_3->avatar }}" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="banner-content">
                                        <h6 class="sub-title" data-animation="fadeInUp" data-delay=".2s">CHICBONG</h6>
                                        <h2 class="title" data-animation="fadeInUp" data-delay=".4s">
                                            {{ $phim_3->ten_phim }}</h2>
                                        <div class="banner-meta" data-animation="fadeInUp" data-delay=".6s">
                                            <ul>
                                                <li class="quality">
                                                    <span>{{ $phim_3->the_loai }}</span>
                                                    <span>hd</span>
                                                </li><br>
                                                <li class="category">
                                                    {{ $phim_3->dien_vien }}
                                                </li><br>
                                                <li class="release-time">
                                                    <span><i class="far fa-calendar-alt"></i>
                                                        {{ $phim_3->ngay_khoi_chieu }}</span>
                                                    <span><i class="far fa-clock"></i> {{ $phim_3->thoi_luong }}
                                                        phút</span>
                                                </li><br>
                                            </ul>
                                        </div>
                                        <a href="{{ $phim_3->trailer }}" class="banner-btn btn popup-video"
                                            data-animation="fadeInUp" data-delay=".8s"><i class="fas fa-play"></i>
                                            Xem Ngay</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
        <!-- slider-area-end -->

        <!-- Phim Nổi bật -->
        <section class="ucm-area ucm-bg2" data-background="/assets_client/img/bg/ucm_bg02.jpg">
            <div class="container">
                <div class="row align-items-end mb-55">
                    <div class="col-lg-6">
                        <div class="section-title title-style-three text-center text-lg-left">
                            <span class="sub-title">CHICBONG</span>
                            <h2 class="title">Phim Nổi Bật</h2>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ucm-nav-wrap">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="dangChieu-tab" data-toggle="tab"
                                        href="#dangChieu" role="tab" aria-controls="tvShow"
                                        aria-selected="true">Phim Đang Chiếu</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="sapChieu-tab" data-toggle="tab" href="#sapChieu"
                                        role="tab" aria-controls="movies" aria-selected="false">Phim Sắp
                                        Chiếu</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="dangChieu" role="tabpanel"
                        aria-labelledby="dangChieu-tab">
                        <div class="ucm-active-two owl-carousel">
                            @foreach ($list_phim as $key => $value)
                                @if ($value->tinh_trang == 1)
                                    <div class="movie-item movie-item-two mb-30">
                                        <div class="movie-poster">
                                            <a href="/chi-tiet-phim/{{ $value->slug_ten_phim }}-{{ $value->_id }}"><img
                                                    src="{{ $value->avatar }}" alt=""></a>
                                        </div>
                                        <div class="movie-content">
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <h5 class="title"><a
                                                    href="/chi-tiet-phim/{{ $value->slug_ten_phim }}-{{ $value->_id }}">{{ $value->ten_phim }}</a>
                                            </h5>
                                            <span class="rel">{{ $value->dao_dien }}</span>
                                            <div class="movie-content-bottom">
                                                <ul>
                                                    <li class="tag">
                                                        <a href="#">HD</a>
                                                        <span class="like mt-1">{{ $value->thoi_luong }} phút</span>
                                                    </li>
                                                    <li>
                                                        <span class="like"><i class="fas fa-thumbs-up"></i>
                                                            3.5</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="sapChieu" role="tabpanel" aria-labelledby="sapChieu-tab">
                        <div class="ucm-active-two owl-carousel">
                            @foreach ($list_phim as $key => $value)
                                @if ($value->tinh_trang == 2)
                                    <div class="movie-item movie-item-two mb-30">
                                        <div class="movie-poster">
                                            <a href="/chi-tiet-phim/{{ $value->slug_ten_phim }}-{{ $value->_id }}"><img
                                                    src="{{ $value->avatar }}" alt=""></a>
                                        </div>
                                        <div class="movie-content">
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <h5 class="title"><a
                                                    href="/chi-tiet-phim/{{ $value->slug_ten_phim }}-{{ $value->_id }}">{{ $value->ten_phim }}</a>
                                            </h5>
                                            <span class="rel">{{ $value->dao_dien }}</span>
                                            <div class="movie-content-bottom">
                                                <ul>
                                                    <li class="tag">
                                                        <a href="#">HD</a>
                                                        <span class="like">{{ $value->thoi_luong }} phút</span>
                                                    </li>
                                                    <li>
                                                        <span class="like"><i class="fas fa-thumbs-up"></i>
                                                            3.5</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Phim Nổi bật-end -->

        <!-- gallery-area -->
        <div class="gallery-area position-relative">
            <div class="gallery-bg"></div>
            <div class="container-fluid p-0 fix">
                <div class="row gallery-active">
                    <div class="col-12">
                        <div class="gallery-item">
                            <img src="/assets_client/img/images/4.png" alt="">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="gallery-item">
                            <img src="/assets_client/img/images/1.png" alt="">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="gallery-item">
                            <img src="/assets_client/img/images/6.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider-nav"></div>
        </div>
        <!-- gallery-area-end -->

        <!-- top-rated-movie -->
        <section class="top-rated-movie tr-movie-bg2 mt-5" data-background="/assets_client/img/bg/tr_movies_bg.jpg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-title title-style-three text-center mb-70">
                            <span class="sub-title">ChicBong</span>
                            <h2 class="title">Các Phim Gần Đây</h2>
                        </div>
                    </div>
                </div>
                <div class="row movie-item-row">
                    @foreach ($list_phim as $key => $value)
                        @if ($value->tinh_trang == 2)
                            <div class="custom-col-">
                                <div class="movie-item movie-item-two">
                                    <div class="movie-poster">
                                        <img src="{{ $value->avatar }}" alt="">
                                        <ul class="overlay-btn">
                                            <li><a href="/chi-tiet-phim/{{ $value->slug_ten_phim }}-{{ $value->_id }}"
                                                    class="btn">Xem Chi Tiết</a></li>
                                        </ul>
                                    </div>
                                    <div class="movie-content">
                                        <div class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <h5 class="title"><a
                                                href="/chi-tiet-phim/{{ $value->slug_ten_phim }}-{{ $value->_id }}">{{ $value->ten_phim }}</a>
                                        </h5>
                                        <span class="rel">Adventure</span>
                                        <div class="movie-content-bottom">
                                            <ul>
                                                <li class="tag">
                                                    <a href="#">HD</a>
                                                    <span class="like mt-1">{{ $value->thoi_luong }} phút</span>
                                                </li>
                                                <li>
                                                    <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    </main>
    <!-- main-area-end -->
    <!-- footer-area -->
    @include('client.share.footer')
    <!-- footer-area-end -->
    <!-- JS here -->
    @include('client.share.js')
    @yield('js')
</body>
<script type="text/javascript">
    var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
    (function() {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/63b6e9fcc2f1ac1e202be2e4/1gm1841gk';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>

</html>
