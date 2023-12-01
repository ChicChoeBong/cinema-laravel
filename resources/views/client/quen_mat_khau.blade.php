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
                            <input v-model="reset_password.email" type="text" placeholder="Nhập vào địa chỉ email">
                        </div>
                        <div class="col-md-12 text-right">
                            <button v-on:click="doiMatKhau()" class="btn">Quên Mật Khẩu</button>
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
</section>
@endsection
@section('js')
<script>
    new Vue({
        el  :  "#app",
        data:   {
            reset_password :   {},
        },
        methods :   {
            doiMatKhau() {
                axios
                    .post('/reset-password', this.reset_password)
                    .then((res) => {
                        if(res.data.status) {
                            toastr.success(res.data.message);
                            setTimeout(() => {
                                window.location.href = '/reset-password';
                            }, 3000);
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
