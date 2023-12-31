@extends('AdminRocker.share.master')
@section('noi_dung')
    <div class="row">
        <div class="col-md-6">
            <div class="card border-info border-bottom border-3 border-0">
                <form action="/admin/cau-hinh/index" method="post">
                    @csrf
                    <div class="card-header bg-primary">
                        <strong class="card-title" style=" color: white; font-size: 20px">Cấu Hình Hệ Thống</strong>
                    </div>
                    <div class="card-body">
                        <div class="form-group mt-3">
                            <label>Ảnh Nền Trang Chủ</label>
                            <div class="input-group">
                                <input type="hidden" name="_id" value="{{ $config->_id }}">
                                <input value="{{ $config->bg_homepage }}" id="hinh_anh" class="form-control" type="text"
                                    name="bg_homepage">
                                <span class="input-group-prepend">
                                    <a id="lfm" data-input="hinh_anh" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                            </div>
                            <div id="holder" style="margin-top:15px;max-height:200px;">
                                <img style="height:200px;"
                                    src="{{ isset($config->bg_homepage) ? $config->bg_homepage : '/assets_client/img/banner/s_slider_bg.jpg' }}"
                                    alt="">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label>Phim Hiển Thị Trang Chủ</label>
                            <select class="form-control" name="id_phim">
                                @foreach ($danhSachPhim as $key => $value)
                                    <option
                                        {{ isset($config->id_phim) && $value->_id == $config->id_phim ? 'selected' : '' }}
                                        value="{{ $value->_id }}">{{ $value->ten_phim }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label>Phim Hiển Thị Trang Chủ</label>
                            <select class="form-control" name="phim_2">
                                @foreach ($danhSachPhim as $key => $value)
                                    <option {{ isset($config->phim_2) && $value->_id == $config->phim_2 ? 'selected' : '' }}
                                        value="{{ $value->_id }}">{{ $value->ten_phim }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label>Phim Hiển Thị Trang Chủ</label>
                            <select class="form-control" name="phim_3">
                                @foreach ($danhSachPhim as $key => $value)
                                    <option {{ isset($config->phim_3) && $value->_id == $config->phim_3 ? 'selected' : '' }}
                                        value="{{ $value->_id }}">{{ $value->ten_phim }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Cập Nhật Cấu Hình</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        var route_prefix = "/laravel-filemanager";
    </script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $("#lfm").filemanager('image', {
            prefix: route_prefix
        });
    </script>
@endsection
