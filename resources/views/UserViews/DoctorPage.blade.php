<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href='/img/bookingcare-apple-touch-icon.png'>
    {{-- <link rel="stylesheet" href="/css/w3schools27.css"> --}}
    {{-- <link rel="stylesheet" href="/css/guest/clinicpage.css"> --}}
    <title>{{ $doctor->degree . ' ' . $doctor->name }}</title>
</head>

<body>
    @include('UserViews.share.Header')
    <style>
        .doctor-infor img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-right: 20px;
        }

        .doctor-card {
            margin: 20px auto 0 auto;
            width: calc(100% - 20px);
            max-width: 1170px;
            padding: 10 10px 10px 10px;
            border-radius: 8px;
            display: flex;
            flex-flow: column;
        }

        .doctor-card .doctor-infor {
            width: 100%;
            display: flex;
        }

        .overview {
            width: calc(100% - 120px);
            max-width: 600px;
        }

        .overview h3 {
            margin-top: 0;
        }

        .interact button {
            border: none;
            border-radius: 5px;
            background-color: #4080FF;
            padding: 5px 8px;
            color: white;
        }

        .doctor-card .schedule-infor {
            color: rgba(102, 102, 102, 1.00);
            width: 100%;
            padding: 15px 0px 0px 0px;
            display: flex;
            flex-direction: row;
        }

        .main-infor {
            width: 50%;
        }

        .another-infor {
            width: 50%;
            padding-top: 80px;
            padding-left: 20px;
        }

        .schedule-infor select {
            color: rgb(51, 122, 183);
            font-size: 14px;
            font-weight: 700;
            border: none;
            border-bottom: 1px black solid;
        }

        .schedule-infor h4 {
            font-size: 14px;
            font-weight: 700;
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        .schedule-infor button {
            color: rgba(102, 102, 102, 1.00);
            margin-right: 8px;
            background-color: #FFF8AE;
            margin-top: 5px;
            padding: 10px;
            white-space: nowrap;
            font-size: 14px;
            font-weight: 700;
            border: none;
        }

        .schedules {
            margin-bottom: 10px;
            padding-bottom: 15px;
            border-bottom: 1px rgb(238, 238, 238) solid;
        }

        .schedule-infor p {
            margin: 0;
            font-size: 14px;
        }

        h4 span {
            font-weight: 500;
            font-size: 14px;
        }

        h4 a {
            font-weight: 600;
            color: rgba(72, 196, 211, 1.00);
            font-size: 14px;
        }

        .introduce {}


        @media only screen and (max-width: 600px) {
            .schedule-infor {
                flex-direction: column !important;
            }

            .schedule-infor .main-infor,
            .another-infor {
                width: 100%;
            }

            .another-infor {
                padding: 0;
            }
        }
    </style>
    <div class="doctor-card">
        <div class="doctor-infor">
            <img
                src="/doctorimage/{{ File::exists(public_path('/doctorimage/' . $avatar)) ? $avatar : 'default_avatar.jpg' }}">
            <div class="overview">
                <h3>{{ $doctor->degree . ' ' . $doctor->name }}</h3>
                <p>Nguyên Trưởng khoa Tai mũi họng trẻ em, Bệnh viện Tai Mũi Họng Trung ương
                    Trên 25 năm công tác tại Bệnh viện Tai mũi họng Trung ương
                    Chuyên khám và điều trị các bệnh lý Tai Mũi Họng người lớn và trẻ em
                </p>
                <p class="interact">
                    <button>Thích 12</button>
                    <button>Chia sẻ</button>
                </p>
            </div>
        </div>
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
        <div class="schedule-infor">
            <div class="main-infor">
                @include('UserViews.share.DoctorSchedules')
            </div>
            <div class="another-infor">
                <p><b>ĐỊA CHỈ KHÁM:</b></p>
                <p>{{ $clinic->fullname }}</p>
                <p>{{ $clinic->address }}</p>
                <h4>GIÁ KHÁM: <span>&nbsp;&nbsp;{{ $doctor->price }}Đ</span> <a>&nbsp;&nbsp; Xem chi
                        tiết</a></h4>
                <h4>LOẠI BẢO HIỂM ÁP DỤNG: <a>&nbsp;&nbsp;Xem chi tiết</a></h4>
            </div>

        </div>
        <div class="introduce">
            <div id="content"></div>
            <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
            <script>
                document.getElementById('content').innerHTML =
                    marked.parse(`{{ $doctor->career }}`);
            </script>
        </div>
    </div>
    @include('UserViews.share.Footer')
    <script>
        function changeDateHandle(selectid, classname) {
            let currentid = document.getElementById(selectid).value;
            let schedules = document.getElementsByClassName(classname);
            for (let i = 0; i < schedules.length; i++) {
                console.log(schedules[i]);
                schedules[i].style.display = 'none';
            }
            document.getElementById(currentid).style.display = 'block';
        }
    </script>
</body>
