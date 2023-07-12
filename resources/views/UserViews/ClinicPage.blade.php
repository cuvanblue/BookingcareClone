<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href='/img/bookingcare-apple-touch-icon.png'>
    {{-- <link rel="stylesheet" href="/css/w3schools27.css"> --}}
    <link rel="stylesheet" href="/css/guest/clinicpage.css">
    <title>BookingCare - Nền tảng Y tế chăm sóc sức khỏe toàn diện kết nối người dùng đến với dịch vụ y tế - chăm sóc
        sức khỏe chất lượng, hiệu quả và tin cậy</title>
</head>

<body>
    @include('UserViews.share.Header')
    <div class="maindiv">
        <div class="heade-maindiv">
            <div class="topspace">
            </div>
            <div class="overview-container">
                <div class="overview-section-1">
                    <div class="nameandavatar">
                        <img src="/clinicimage/{{ File::exists(public_path('/clinicimage/' . $avatar)) ? $avatar : 'default_avatar.jpg' }}"
                            alt="">
                        <div class="name">
                            <h3>{{ $clinic->fullname }}</h3>
                            <h4>{{ $clinic->address }}</h4>
                        </div>

                    </div>
                    <div class="navbar">
                        <div class="navbar-item">ĐẶT LỊCH KHÁM</div>
                        <div class="navbar-item">GIỚI THIỆU</div>
                        <div class="navbar-item">CHUYÊN MÔN</div>
                        <div class="navbar-item">TRANG THIẾT BỊ</div>
                        <div class="navbar-item">VỊ TRÍ</div>
                        <div class="navbar-item">QUY TRÌNH KHÁM</div>
                    </div>
                </div>
                <div class="overview-section-2">
                    <div class="iconic">
                        <img src="/img/iconic1.webp" alt="">
                        <span>Tất cả</span>
                    </div>
                    <div class="iconic"
                        style="background-image: linear-gradient(rgb(247, 247, 247), rgb(247, 247, 247));">
                        <img src="/img/iconic2.webp" alt="">
                        <span>Bác sĩ</span>
                    </div>
                    <div class="iconic"
                        style="background-image: linear-gradient(rgb(247, 247, 247), rgb(247, 247, 247));">
                        <img src="/img/iconic3.webp" alt="">
                        <span>Phẫu thuật</span>
                    </div>
                </div>
            </div>
            <div class="background-title">
                <img src="/img/background-title.webp" alt="">
            </div>
        </div>
        {{-- gioi thieu --}}
        <style>
            .introduce h1,
            h2,
            h3,
            h4 {
                font-weight: 600;
                color: rgb(51, 122, 183);
            }

            .introduce p {
                font-size: 16px;
            }
        </style>
        <div class="introduce">
            <div id="content"></div>
            <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
            <script>
                document.getElementById('content').innerHTML =
                    marked.parse(`{{ $clinic->introduce }}`);
            </script>
        </div>

        {{--  danh sach bac si --}}
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p style="color: red">{{ $error }}</p>
            @endforeach
        @endif
        @if (Session::has('error'))
            <p style="color: red">{{ Session::get('error') }}</p>
        @endif
        @if (Session::has('done'))
            <p style="color: green">{{ Session::get('done') }}</p>
        @endif
        <div class="doctor-header" style="border-bottom: rgba(231,229,229,1.00) 2px solid;">
            <h3 style="color: #49BCE2; font-weight:600; ">Danh sách bác sĩ của cơ sở:</h3>
            <form class="search-box" action="/clinics/{{ $clinic->id }}/search-doctor" method="get">
                <input id="search-input" type="text" name="keyword" placeholder="Tìm kiếm bác sĩ" />
                <select name="degree">
                    <option value="">Học vị</option>
                    @for ($i = 0; $i < count($degrees); $i++)
                        {
                        <option value="{{ $degrees[$i]->degree }}">{{ $degrees[$i]->degree }}</option>
                        }
                    @endfor

                </select>
                <select name="specialize">
                    <option value="">Chuyên khoa</option>
                    @for ($i = 0; $i < count($specializes); $i++)
                        {
                        <option value="{{ $specializes[$i]->specialize }}">{{ $specializes[$i]->specialize }}
                        </option>
                        }
                    @endfor
                </select>
                <button type="submit" style="background-color: #49BCE2;">Search</button>
                @csrf
            </form>
        </div>
        <div class="doctors-container">
            @foreach ($doctors as $doctor)
                @if ($doctor->status == 'working')
                    <div class="doctor-card">
                        <div class="doctor-infor">
                            <div class="left-infor">
                                <img src="/doctorimage/{{ File::exists(public_path('/doctorimage/' . $avatars[$doctor->id])) ? $avatars[$doctor->id] : 'default_avatar.jpg' }}"
                                    alt="">
                                <a href="/doctors/{{ $doctor->id }}">Xem thêm</a>
                            </div>
                            <div class="right-infor">
                                <h3 class="name">
                                    {{ $doctor->degree . ' ' . $doctor->name }}
                                </h3>
                                <p style="margin-top: 5px;">Nguyên Trưởng khoa Tai mũi họng trẻ em, Bệnh viện Tai Mũi
                                    Họng Trung ương
                                    Trên 25 năm công tác tại Bệnh viện Tai mũi họng Trung ương
                                    Chuyên khám và điều trị các bệnh lý Tai Mũi Họng người lớn và trẻ em
                                </p>
                                <p>
                                    <svg xml:space="preserve" width="14" height="14" preserveAspectRatio="none"
                                        viewBox="0 0 42 42" fill="#000">
                                        <path fill-rule="evenodd"
                                            d="M33 13.924C33 6.893 27.594 1 20.51 1S8 6.897 8 13.93C8 16.25 8.324 18 9.423 20h-.021l10.695 20.621c.402.551.824-.032.824-.032C20.56 41.13 31.616 20 31.616 20h-.009C32.695 18 33 16.246 33 13.924zm-18.249-.396c0-3.317 2.579-6.004 5.759-6.004 3.179 0 5.76 2.687 5.76 6.004s-2.581 6.005-5.76 6.005c-3.18 0-5.759-2.687-5.759-6.005z">
                                        </path>
                                    </svg>
                                    {{ $clinic->address }}
                                </p>
                            </div>
                        </div>
                        <div class="schedule-infor">
                            @include('UserViews.share.DoctorSchedules')
                            <p><b>ĐỊA CHỈ KHÁM:</b></p>
                            <p>{{ $clinic->fullname }}</p>
                            <p>{{ $clinic->address }}</p>
                            <h4>GIÁ KHÁM: <span
                                    style="color: rgba(102,102,102,1.00);">&nbsp;&nbsp;{{ $doctor->price }}Đ</span>
                                <a>&nbsp;&nbsp; Xem chi
                                    tiết</a>
                            </h4>
                            <h4>LOẠI BẢO HIỂM ÁP DỤNG: <a>&nbsp;&nbsp;Xem chi tiết</a></h4>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    @include('UserViews.share.Footer')
    <script>
        function changeDateHandle(selectid, classname) {
            let currentid = document.getElementById(selectid).value;
            let schedules = document.getElementsByClassName(classname);
            for (let i = 0; i < schedules.length; i++) {
                schedules[i].style.display = 'none';
            }
            document.getElementById(currentid).style.display = 'block';
        }
    </script>
</body>

</html>
