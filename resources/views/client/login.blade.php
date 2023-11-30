@extends('client.master')
@section('content')
<section id="app" class="contact-area contact-bg" data-background="/assets_client/img/bg/contact_bg.jpg" style="background-image: url(&quot;img/bg/contact_bg.jpg&quot;);">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="contact-form-wrap">
                    <div class="widget-title mb-50">
                        <h5 class="title">Đăng Nhập</h5>
                    </div>
                    <div class="contact-form">
                        <div class="col-md-12">
                            <input v-model="login.email" type="text" placeholder="Nhập vào địa chỉ email">
                        </div>
                        <div class="col-md-12">
                            <input v-model="login.password" type="password" placeholder="Nhập vào mật khẩu">
                        </div>
                        <div class="row">
                            <div class="col-md-6 text-left mb-3">
                                <a href="/reset-password" class="text-white">Quên mật khẩu?</a>
                            </div>
                            <div class="col-md-6 text-right mb-3">
                                <a href="/register" class="text-white">Bạn chưa có tài khoản? Đăng Ký</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center mb-3">
                                <button v-on:click="dangNhap()" class="btn pl-5 pr-5">Đăng Nhập</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-center fw-bold mx-3 mb-0 text-muted mb-3">Hoặc đăng nhập bằng</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 text-right mb-3">
                                <a class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998" href="#!" role="button">
                                    <i class="fab fa-facebook-f me-2"></i>Facebook
                                </a>
                            </div>
                            <div class="col-md-6 text-left">
                                <a class="btn btn-primary btn-lg btn-block" style="background-color: rgb(201, 41, 41)" href="#!" role="button">
                                    <i class="fa-brands fa-google" style="color: #ffffff;"></i>Google
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="widget-title mb-50">
                    <h5 class="title">Thông Tin Về Chúng Tôi</h5>
                </div>
                <div class="contact-info-wrap">
                    <p><span>ChicBong Cinema :</span> Tận hưởng từng khoảnh khắc của bạn</p>
                    <div class="contact-info-list">
                        <ul>
                            <li>
                                <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                                <p><span>Địa chỉ :</span> 42 Cao Thắng, Thanh Bình, Hải Châu, Đà Nẵng</p>
                            </li>
                            <li>
                                <div class="icon"><i class="fas fa-phone-alt"></i></div>
                                <p><span>Điện thoại :</span> 0123456789</p>
                            </li>
                            <li>
                                <div class="icon"><i class="fas fa-envelope"></i></div>
                                <p><span>Email :</span> chicbong@gmail.com</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script>
    new Vue({
        el  :  "#app",
        data:   {
            login :   {},
        },
        methods :   {
            dangNhap() {
                axios
                    .post('/login', this.login)
                    .then((res) => {
                        if(res.data.status) {
                            // toastr.success(res.data.message);
                            setTimeout(() => {
                                window.location.href = '/';
                            });
                        }
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0]);
                        });
                    });
            },
        },
    });
</script>
@endsection
