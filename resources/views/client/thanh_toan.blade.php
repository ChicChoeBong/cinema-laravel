@extends('client.master')
@section('content')
    <section class="movie-details-area" data-background="/assets_client/img/bg/movie_details_bg.jpg">
        <div id="app" class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="episode-watch-wrap">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <button class="btn-block text-left" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span class="season">Tên Phim: {{ $phim->ten_phim }} - Lịch Chiếu:
                                            {{ Carbon\Carbon::parse($phim->thoi_gian_bat_dau)->format('H:i d/m/Y') }}</span>
                                        <span class="video-count">{{ $tongVe }} Vé đã đặt</span>
                                    </button>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <ul>
                                            @foreach ($dsGheBan as $key => $value)
                                                <li><a href="" class="popup-video"><i
                                                            class="fa-solid fa-couch"></i>Ghế {{ $value->ten_ghe }}</a>
                                                    <span class="duration"><i class="fa-solid fa-money-bill"></i> 15
                                                        đ</span></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <form action="{{ route('paypal') }}" method="POST">
                                        @csrf
                                        <button class="btn-block text-left collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <span class="season">Tổng Tiền Thanh Toán</span>
                                            <span class="video-count"
                                                name="price">{{ number_format($tongVe * 15, 0, '.', ',') }} vnđ</span>
                                        </button>
                                        {{-- <button class="btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span class="season">Thanh Toán Ngân Hàng VCB</span>
                                    <span class="video-count">Bạn cần thanh toán {{ number_format($tongVe * 15, 0, '.', ',') }} vnđ<br>Qua số tài khoản 9345884657. <br>Nội dung là {{ $maGiaoDich }}</span>
                                </button> --}}
                                        <button class="btn-block text-left" type="button" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <span class="season">Thời Gian Có Thể Thanh Toán</span>
                                            <span class="video-count">
                                                <a href="" class="btn"
                                                    style="background-color: #e4d804; color: black">@{{ time }}
                                                    s</a>
                                            </span>
                                        </button>
                                        <div class="row">
                                            <div class="col-md-6">
                                                {{-- <div id="paypal-button-container"></div> --}}
                                                <button type="submit" >Thanh toán paypal</button>
                                            </div>
                                            <div class="col-md-6 text-left">
                                                <span class="video-count">
                                                    <a class="btn" style="background-color: #e4d804; color: black"
                                                        id="done" v-on:click="done()" hidden>DONE</a>
                                                </span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="https://www.paypalobjects.com/donate/sdk/donate-sdk.js" charset="UTF-8"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                time: 200,
            },
            created() {
                setInterval(() => {
                    if (this.time <= 1) {
                        toastr.error("Đã hết thời gian thanh toán");
                        window.location.replace("/");
                    }
                    this.time--;
                }, 1000);
            },
            methods: {
                done() {
                    axios
                        .get('/client/done')
                        .then((res) => {
                            toastr.success("Đã đặt vé thành công!");
                            window.location = '/';
                        });
                },
            },
        });
    </script>
    <script>
        PayPal.Donation.Button({
            env: 'sandbox',
            hosted_button_id: 'FSD6HQPBKTRZE',
            // business: 'YOUR_EMAIL_OR_PAYERID',
            image: {
                src: 'https://th.bing.com/th/id/R.177f3b7255d22008d0ad3a35704c662a?rik=uxJt6INpWcVXXw&riu=http%3a%2f%2f2.bp.blogspot.com%2f-gzW3J2sXFm0%2fU5h4jgo_1UI%2fAAAAAAAACqo%2fE5KtY-0gZfw%2fs1600%2fLogo%2bPaypal.png&ehk=hMnHFaduw2ySO0BMkGc3oikIhTyV2gKP%2fC3ene6UeMo%3d&risl=&pid=ImgRaw&r=0',
                title: 'PayPal - The safer, easier way to pay online!',
                alt: 'Pay with PayPal button'
            },
            onComplete: function(params) {
                toastr.success("Đã thanh toán thành công!");
            },
        }).render('#paypal-button-container');

        $('#paypal-button-container').click(function() {
            let p = document.getElementById('done');
            p.removeAttribute("hidden");
        });
    </script>
@endsection
