@extends('client.master')
@section('content')
<section class="contact-area contact-bg" id="app" data-background="/assets_client/img/bg/contact_bg.jpg" style="background-image: url(&quot;img/bg/contact_bg.jpg&quot;);">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="contact-form-wrap">
                    <div class="widget-title mb-50">
                        <h5 class="title">Đăng Ký Tài Khoản</h5>
                    </div>
                    <div class="contact-form">
                        <div class="col-md-12">
                            <input v-model="register.ho_va_ten" type="text"  placeholder="Nhập vào họ và tên">
                        </div>
                        <div class="col-md-12">
                            <input v-model="register.email" type="email"  placeholder="Nhập vào email">
                        </div>
                        <div class="col-md-12">
                            <input v-model="register.so_dien_thoai" type="tel"  placeholder="Nhập vào số điện thoại">
                        </div>
                        <div class="col-md-12">
                            <input v-model="register.dia_chi" type="text"  placeholder="Nhập vào địa chỉ">
                        </div>
                        <div class="col-md-12">
                            <input v-model="register.ngay_sinh" type="date"  placeholder="Nhập vào ngày sinh">
                        </div>
                        <div class="col-md-12">
                            <input v-model="register.password" type="password"  placeholder="Nhập vào mật khẩu">
                        </div>
                        <div class="col-md-12">
                            <input v-model="register.re_password" type="password"  placeholder="Nhập lại mật khẩu">
                        </div>
                        <div class="col-md-12">
                            <select v-model="register.gioi_tinh" style="background-color: #1f1e24; color: #bcbcbc; border: 1px solid #1f1e24; padding: 14px 25px; margin-bottom: 30px; width: 100%;">
                                <option value="1">Giới Tính Nam</option>
                                <option value="0">Giới Tính Nữ</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="/login" class="btn">Đăng Nhập</a>
                            </div>
                            <div class="col-md-6 text-right">
                                <button v-on:click="dangKy()" class="btn">Đăng Ký</button>
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
</section>
@endsection
@section('js')
<script>
    new Vue({
        el  :  "#app",
        data:   {
            register :   {},
        },
        methods :   {
            dangKy() {
                axios
                    .post('/register', this.register)
                    .then((res) => {
                        if(res.data.status) {
                            toastr.success(res.data.message);
                            setTimeout(() => {
                                window.location.href = '/thong-bao';
                            }, 5000);
                        } else {
                            toastr.error(res.data.message);
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
