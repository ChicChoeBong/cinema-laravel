<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class PhimSeeder extends Seeder
{
    public function run()
    {
        // 1. Khi seeder thì ta muốn xóa toàn bộ dữ liệu ở table đó
        DB::collection('phims')->delete();

        // 2. Ta sẽ thêm mới phim bằng lệnh create
        DB::collection('phims')->insert([
            [
                'ten_phim'          => "Avatar 2: Dòng Chảy Của Nước",
                'slug_ten_phim'     => "avatar-2-dong-chay-cua-nuoc",
                'dao_dien'          => "James Cameron",
                'dien_vien'         => "Kate Winslet, Zoe Saldana, Sam Worthington, Sigourney Weaver, Oona Chaplin",
                'the_loai'          => "Hành Động, Khoa Học Viễn Tưởng, Phiêu Lưu",
                'thoi_luong'        => 192,
                'ngay_khoi_chieu'   => "2023-12-16",
                'avatar'            => "https://hcm01.vstorage.vngcloud.vn/v1/AUTH_0e0c1e7edc044168a7f510dc6edd223b/media-prd/cache/short/6279e78130231059285890.jpeg",
                'mo_ta'             => "Câu chuyện của “Avatar: Dòng Chảy Của Nước” lấy bối cảnh 10 năm sau những sự kiện xảy ra ở phần đầu tiên. Phim kể câu chuyện về gia đình mới của Jake Sully (Sam Worthington thủ vai) cùng những rắc rối theo sau và bi kịch họ phải chịu đựng khi phe loài người xâm lược hành tinh Pandora. ",
                'trailer'           => "https://www.youtube.com/embed/qRYLXirsJPQ",
                'tinh_trang'        => 2,
            ],

            [
                'ten_phim'          => "One Piece Film Red",
                'slug_ten_phim'     => "one-piece-film-red",
                'dao_dien'          => "Goro Taniguchi",
                'dien_vien'         => "Shuuichi Ikeda, Mayumi Tanaka, Kazuya Nakai, Akemi Okamura, Kappei Yamaguchi",
                'the_loai'          => "Hoạt Hình, Phiêu Lưu",
                'thoi_luong'        => 115,
                'ngay_khoi_chieu'   => "2023-11-25",
                'avatar'            => "https://hcm01.vstorage.vngcloud.vn/v1/AUTH_0e0c1e7edc044168a7f510dc6edd223b/media-prd/cache/short/63439b379b15e195782023.jpeg",
                'mo_ta'             => "Bối cảnh One Piece Film Red diễn ra ở hòn đảo âm nhạc Elegia, nơi diva nổi tiếng bậc nhất thế giới tên Uta thực hiện buổi biểu diễn trực tiếp đầu tiên trước công chúng. Uta đứng trên sân khấu với một ước mơ giản dị rằng ”Âm nhạc của tôi sẽ khiến cho thế giới hạnh phúc”. Đằng sau hình ảnh cô ca sĩ sở hữu giọng hát ở “đẳng cấp hoàn toàn khác” là một thân thế vô cùng bí ẩn được che giấu.",
                'trailer'           => "https://www.youtube.com/embed/7Ma1uab-bQM",
                'tinh_trang'        => 0,
            ],

            [
                'ten_phim'          => "Mèo Đi Hia: Điều Ước Cuối Cùng",
                'slug_ten_phim'     => "meo-di-hia-dieu-uoc-cuoi-cung",
                'dao_dien'          => "Joel Crawford",
                'dien_vien'         => "Antonio Banderas, Florence Pugh, Salma Hayek, Olivia Colman, Wagner Moura",
                'the_loai'          => "Hoạt Hình, Phiêu Lưu",
                'thoi_luong'        => 103,
                'ngay_khoi_chieu'   => "2023-11-30",
                'avatar'            => "https://hcm01.vstorage.vngcloud.vn/v1/AUTH_0e0c1e7edc044168a7f510dc6edd223b/media-prd/cache/short/6384c1b54b7c6826593912.jpeg",
                'mo_ta'             => "Puss phát hiện ra rằng niềm đam mê phiêu lưu mạo hiểm của anh đã gây ra hậu quả: Anh đã đốt cháy 8 trong số 9 mạng sống của mình, bây giờ chỉ còn lại đúng một mạng. Anh ta bắt đầu một cuộc hành trình để tìm Điều ước cuối cùng thần thoại trong Rừng Đen nhằm khôi phục lại chín mạng sống của mình. Chỉ còn một mạng sống, đây có lẽ sẽ là cuộc hành trình nguy hiểm nhất của Puss.",
                'trailer'           => "https://www.youtube.com/embed/dpxEGogRrpM",
                'tinh_trang'        => 2,
            ],
        ]);
    }
}
