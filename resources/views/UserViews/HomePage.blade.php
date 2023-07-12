<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href='/img/bookingcare-apple-touch-icon.png'>
    <title>BookingCare - Nền tảng Y tế chăm sóc sức khỏe toàn diện kết nối người dùng đến với dịch vụ y tế - chăm sóc
        sức khỏe chất lượng, hiệu quả và tin cậy</title>
</head>

<body>
    @include('UserViews.share.Header')
    <style>
        .homepage-main {}

        .section-1 {
            width: 100%;
            overflow-y: auto;
            background-image: url("/img/homepage/bookingcare-cover-4.jpg");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            background-color: rgba(22, 24, 35, 0.3);
        }

        .section-1-search {
            margin: 100px auto 100px auto;
            height: 340px;
            width: 90%;
            max-width: 1170px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .section-1-search form {
            display: flex;
            flex-direction: row;
            align-items: center;
            overflow: auto;
            background-color: #F7D800;
            border-radius: 30px;
            width: 100%;
            max-width: 460px;
        }

        .section-1-search input {
            color: white;
            height: 52px;
            width: 100%;
            background-color: #F7D800;
            border: none;
            max-width: 380px;
            font-size: 16px;
            padding-left: 15px;
        }

        h1 {
            max-width: 500px;
            width: 100%;
            font-size: 32px;
            color: white;
            text-transform: uppercase;
            text-shadow: 1px 1px 1px #333;
        }

        .section-1-list {
            width: 100%;
            overflow: auto;
            background-image: linear-gradient(rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 1));
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
            text-align: center;
        }

        .section-1-list-line {

            width: calc(100% - 50px);
            max-width: 1440px;
            white-space: wrap;
            overflow: auto;
        }

        .section-1-list-line .item {
            width: 120px;
            height: 100%;
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            text-decoration: none;
            margin: 0 5px;
        }

        .section-1-list-line .item div {
            background: #fff;
            border-radius: 50%;
            -moz-box-shadow: 1px 2px 4px rgba(0, 0, 0, 0.5);
            -webkit-box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);
            box-shadow: 0px 1px 2px rgba(0, 0, 0, .5);
            width: 50px;
            height: 50px;
            margin: 2px auto;
            background-size: 32px;
            background-repeat: no-repeat;
            background-position: center;
            background-image: url("/img/homepage/khamchuyenkhoa.png");
        }

        .section-1-list-line .item p {
            text-decoration: none !important;
            font-size: 16px;
            color: black;
            margin: 0 0 0 0;
            margin-top: 10px;
            font-weight: 600;
        }

        .section-1-list-line .item p:hover {
            color: #49BCE2;

        }

        @media only screen and (max-width: 470px) {
            .section-1-list-line .item {
                margin: 0 0px;
            }
        }
    </style>
    <div class="homepage-main">
        <div class="section-1">
            <div class="section-1-search">
                <h1>NỀN TẢNG Y TẾ
                    CHĂM SÓC SỨC KHỎE TOÀN DIỆN</h1>
                <form action="">
                    <input type="text" name="" id="" disabled placeholder="Tìm kiếm cơ sở y tế">
                </form>

            </div>
            <div class="section-1-list">
                <div class="section-1-list-line">
                    <a class="item" href="/">
                        <div alt="" style="background-image: url('/img/homepage/khamchuyenkhoa.png');"> </div>
                        <p>Khám chuyên khoa</p>
                    </a>
                    <a class="item" href="/">
                        <div alt="" style="background-image: url('/img/homepage/khamtuxa.png');"> </div>
                        <p>Khám từ xa</p>
                    </a>
                    <a class="item" href="/">
                        <div alt="" style="background-image: url('/img/homepage/khamtongquat.png');"> </div>
                        <p>Khám tổng quát</p>
                    </a>
                    <a class="item" href="/">
                        <div alt="" style="background-image: url('/img/homepage/xetnghiemyhoc.png');"> </div>
                        <p>Xét nghiệm y học</p>
                    </a>
                    <a class="item" href="/">
                        <div alt="" style="background-image: url('/img/homepage/suckhoetinhthan.png');"> </div>
                        <p>Sức khỏe tinh thần</p>
                    </a>
                    <a class="item" href="/">
                        <div alt="" style="background-image: url('/img/homepage/khamnhakhoa.png');"> </div>
                        <p>Khám nha khoa</p>
                    </a>
                    <a class="item" href="/">
                        <div alt="" style="background-image: url('/img/homepage/goiphauthuat.png');"> </div>
                        <p>Gói phẫu thuật</p>
                    </a>
                    <a class="item" href="/">
                        <div alt="" style="background-image: url('/img/homepage/sanphamyte.png');"> </div>
                        <p>Sản phẩm y tế</p>
                    </a>
                    <a class="item" href="/">
                        <div alt="" style="background-image: url('/img/homepage/baitestsuckhoe.png');"> </div>
                        <p>Test sức khỏe</p>
                    </a>
                </div>
            </div>
        </div>
        <style>
            .section-2 {
                height: 400px;
                background-color: white;
                padding: 20px 0;
            }

            .blogs-container {
                width: 100%;
                max-width: 1170px;
                margin: 0 auto;
                white-space: nowrap;
                overflow: auto;
            }

            .blogs-container::-webkit-scrollbar {
                display: none;
            }

            /* Hide scrollbar for IE, Edge and Firefox */
            .blogs-container {
                -ms-overflow-style: none;
                /* IE and Edge */
                scrollbar-width: none;
                /* Firefox */
            }

            .blog-item {
                width: 250px;
                height: 360px;
                margin-right: 50px;
                display: inline-block;
                white-space: normal;
            }

            .blog-item .thumbnail {
                width: 100%;
                height: 140px;
                background-position: center center;
                background-repeat: no-repeat;
                background-size: cover;
                background-color: #eee;
                background-image: url("/img/blog.png");
            }

            .blog-item .title {
                font-weight: bold;
            }

            .blog-item a {
                font-weight: bold;
                color: #49BCE2;
                text-transform: uppercase;
                padding: 0;
                font-size: 0.8rem;
                text-overflow: ellipsis;
                white-space: nowrap;
                overflow: hidden;
                text-decoration: none;
            }
        </style>
        <div class="section-2">
            <div class="blogs-container">
                <div class="blog-item">
                    <div class="thumbnail">
                    </div>
                    <h3 class="title">Tư vấn phẫu thuật bao quy đầu trọn gói</h3>
                    <p class="overview">&nbsp;Mô hình "Nền tảng như một dịch vụ" bao gồm Website, ứng dụng di động và
                        phần mềm quản trị, tích hợp 3 trong 1 nền tảng tiện ích dễ dùng</p>
                    <a href="">Xem chi tiết</a>
                </div>
                <div class="blog-item">
                    <div class="thumbnail" style="background-image: url('/img/blog1.jpg')">
                    </div>
                    <h3 class="title">Tư vấn phẫu thuật bao quy đầu trọn gói</h3>
                    <p class="overview">&nbsp;Mô hình "Nền tảng như một dịch vụ" bao gồm Website, ứng dụng di động và
                        phần mềm quản trị, tích hợp 3 trong 1 nền tảng tiện ích dễ dùng</p>
                    <a href="">Xem chi tiết</a>
                </div>
                <div class="blog-item">
                    <div class="thumbnail" style="background-image: url('/img/blog2.jpg')">
                    </div>
                    <h3 class="title">Tư vấn phẫu thuật bao quy đầu trọn gói</h3>
                    <p class="overview">&nbsp;Mô hình "Nền tảng như một dịch vụ" bao gồm Website, ứng dụng di động và
                        phần mềm quản trị, tích hợp 3 trong 1 nền tảng tiện ích dễ dùng</p>
                    <a href="">Xem chi tiết</a>
                </div>
                <div class="blog-item">
                    <div class="thumbnail">
                    </div>
                    <h3 class="title">Tư vấn phẫu thuật bao quy đầu trọn gói</h3>
                    <p class="overview">&nbsp;Mô hình "Nền tảng như một dịch vụ" bao gồm Website, ứng dụng di động và
                        phần mềm quản trị, tích hợp 3 trong 1 nền tảng tiện ích dễ dùng</p>
                    <a href="">Xem chi tiết</a>
                </div>
                <div class="blog-item">
                    <div class="thumbnail"style="background-image: url('/img/blog1.jpg')">
                    </div>
                    <h3 class="title">Tư vấn phẫu thuật bao quy đầu trọn gói</h3>
                    <p class="overview">&nbsp;Mô hình "Nền tảng như một dịch vụ" bao gồm Website, ứng dụng di động và
                        phần mềm quản trị, tích hợp 3 trong 1 nền tảng tiện ích dễ dùng</p>
                    <a href="">Xem chi tiết</a>
                </div>
                <div class="blog-item">
                    <div class="thumbnail">
                    </div>
                    <h3 class="title">Tư vấn phẫu thuật bao quy đầu trọn gói</h3>
                    <p class="overview">&nbsp;Mô hình "Nền tảng như một dịch vụ" bao gồm Website, ứng dụng di động và
                        phần mềm quản trị, tích hợp 3 trong 1 nền tảng tiện ích dễ dùng</p>
                    <a href="">Xem chi tiết</a>
                </div>
            </div>
        </div>
    </div>
    @include('UserViews.share.Footer')
</body>

</html>
