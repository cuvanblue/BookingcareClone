<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href='/img/bookingcare-apple-touch-icon.png'>
    {{-- <link rel="stylesheet" href="/css/w3schools27.css"> --}}
    {{-- <link rel="stylesheet" href="/css/guest/clinicpage.css"> --}}
    <title>Đặt lịch khám với {{ $doctor->degree . ' ' . $doctor->name }}</title>
</head>

<body>
    @include('UserViews.share.Header')
    <style>
        * {
            color: #555;
        }

        .doctor-card {
            width: 100%;
        }

        .doctor-infor {
            width: 100%;
            padding: 10px 0 10px 0;
            display: flex;
            flex-direction: row;
            background-color: #F6F6F6;
            align-items: center;
            justify-content: center;
        }

        .doctor-infor img {
            width: 90px;
            height: 90px;
            margin: 0 15px;
            border-radius: 50%;
        }

        .overview {
            width: calc(100% - 80px);
            max-width: 600px;
        }

        .overview h3 {
            font-size: 14px;
        }

        .overview a {
            text-decoration: none;
            color: #337ab7;
            font-size: 16px;
            font-weight: 600;
            margin: 15px 0;
        }

        .overview h3,
        p {
            margin: 0;
        }

        .booking-infor {
            width: calc(100% - 20px);
            max-width: 700px;
            margin: 20px auto;
            padding: 0 10px 0 10px
        }

        .specialize {
            font: 16px;
            text-align: center;
            display: inline-block;
            border-radius: 5px;
            border: 1px solid #f89008;
            padding: 10px 20px 10px 20px;
        }

        .booking-infor input {
            border-radius: 3px;
            border: 1px #ccc solid;
            width: calc(100% - 10px);
            padding: 15px 0 15px 10px;
            font-size: 16px;
            color: #555;
            margin-top: 15px;
            display: block;
        }


        .booking-infor label {
            font-size: 16px;
            width: 90%;
            margin-top: 15px;
        }

        .booking-infor select {
            border-radius: 3px;
            border: 1px #ccc solid;
            padding: 15px 10px 15px 10px;
            font-size: 16px;
            color: #555;
            margin-top: 15px;
        }

        .booking-infor button {
            width: 100%;
            padding: 10px 0 10px 0;
            background-color: #FFC419;
            color: white;
            font-size: 18px;
            font-weight: 600;
            border: none;
        }

        .payment-input {
            padding: 8px;
        }

        .payment-input p {
            margin-top: 5px;
        }

        .checkout {
            background-color: #F6F6F6;
            padding: 5px 10px 10px 10px;
        }

        .checkout .row {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            margin-top: 10px;
        }
    </style>
    <div class="doctor-card">
        <div class="doctor-infor">
            <img
                src="/doctorimage/{{ File::exists(public_path('/doctorimage/' . $avatar)) ? $avatar : 'default_avatar.jpg' }}">
            <div class="overview">
                <h3>ĐẶT LỊCH KHÁM</h3>
                <h3><a href="/doctors/{{ $doctor->id }}">{{ $doctor->degree . ' ' . $doctor->name }}</a></h3>
                <p class="time">{{ $timeindex . ' ' . $date }}</p>
            </div>
        </div>
        <form class="booking-infor" action="/add-booking" method="post">
            <div class="specialize"><span><input style="width: auto; display:inline-block;" type="radio"
                        checked="checked" name="test">Khám &amp; Nội
                    soi Tai Mũi họng</span>
                <br>
                <span>{{ $doctor->price }}Đ</span>
            </div>
            <input style="display: none" type="text" value="{{ $doctor->id }}" name='doctorid'>
            <input style="display: none" type="text" value="{{ $schedule->id }}" name='scheduleid'>
            <input style="display: none" type="text" value="booked" name='status'>
            <input style="display: none" type="text" value="Thông tin khám bệnh" name='file'>
            <input type="text" placeholder="Họ tên bệnh nhân (bắt buộc)" name='patientname'>
            <div class="gender-input">
                <label>Nam</label>
                <input style="width: auto; display:inline-block;" type="radio" checked="checked" name="patientgender"
                    value="Nam">
                <label>Nữ</label>
                <input style="width: auto;display:inline-block;" type="radio" name="patientgender" value="Nữ">
            </div>
            <input type="text" placeholder="Số điện thoại liên hệ (bắt buộc)" name="patientphone">
            <label for="patientbirthday" style="display:block;">Ngày tháng năm sinh (bắt buộc)</label>
            <input type="date" name="patientbirthday" max="{{ date('Y-m-d') }}">
            <select id="search-select" name="patientprovince">
                <option value="">Tỉnh</option>
                @for ($i = 0; $i < count($cities); $i++)
                    {
                    <option value="{{ $cities[$i] }}">{{ $cities[$i] }}</option>
                    }
                @endfor
            </select>
            <input type="text" placeholder="Quận, huyện, thị xã (bắt buộc)" name="patientdistrict">
            <input type="text" placeholder="Địa chỉ cụ thể (bắt buộc)" name="patientaddress">
            <input type="text" placeholder="Lý do khám (bắt buộc)" name="details">
            <div class="payment-input">
                <label>Hình thức thanh toán:</label>
                <p><input style="width: auto; display:inline-block;"type="radio" checked="checked"
                        name="test2">Thanh toán tại cơ sở y tế</p>
            </div>
            <div class="checkout">
                <p class="row">
                    <span>Giá khám:</span>
                    <span>{{ $doctor->price }}Đ</span>
                </p>
                <p class="row">
                    <span>Phí đặt lịch</span>
                    <span>Miễn phí</span>
                </p>
                <hr>
                <p class="row">
                    <span>Tổng cộng</span>
                    <span>{{ $doctor->price }}Đ</span>
                </p>
            </div>
            <p style="width: 100%;text-align:center;margin: 10px 0;">Bookingcare đang giữ lịch khám hộ bạn trong: <span
                    id="timer"></span></p>
            <button type="submit">Xác nhận đặt lịch</button>
            @csrf
        </form>
    </div>
    @include('UserViews.share.Footer')
    <script>
        function startTimer(duration, display) {
            var timer = duration,
                minutes, seconds;
            setInterval(function() {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    location.href = "/doctors/{{ $doctor->id }}";
                }
            }, 1000);
        }

        window.onload = function() {

            startTimer(180, document.querySelector('#timer'));
        };
    </script>
</body>
