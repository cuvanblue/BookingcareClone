<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href='/img/bookingcare-apple-touch-icon.png'>
    <link rel="stylesheet" href="/css/w3schools27.css">
    <link rel="stylesheet" href="/css/index.css">
    <title>BookingCare - Nền tảng Y tế chăm sóc sức khỏe toàn diện kết nối người dùng đến với dịch vụ y tế - chăm sóc
        sức khỏe chất lượng, hiệu quả và tin cậy</title>
</head>

<body>
    @include('UserViews.share.Header')
    <style>
        .maindiv {

            width: calc(100% -20px);
            max-width: 1175px;
            margin: 0 auto;
            padding: 0 10px 0 10px;
        }

        .heade-maindiv {
            flex-wrap: wrap;
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }

        .clinics-container {
            width: 100%;
            max-width: 1175px;
            margin: 20px auto;
            height: auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        .clinic-item {

            width: 260px;
            height: 200px;
            display: block;
            margin: 0 20px 20px 0;
            text-decoration: none;
        }

        .clinic-image {
            border: 2px solid;
            border-color: rgb(213, 213, 213);
            height: 150px;
            width: 100%;
            background-image: url("/clinicimage/default_avatar.jpg");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }

        .p1 {
            font-size: 16px;
            color: rgb(40, 49, 63);
            padding-top: 10px;
            font-weight: 700;
            display: flex;
            text-align: center;
            justify-content: center;
        }

        .alphabet {
            margin-top: 20px;
        }

        .alphabet a {
            cursor: pointer;
            padding: 2px 13px;
            font-size: 16px;
            font-weight: 600;
            border: 1px solid;
            border-color: rgb(238, 238, 238);
            font-family: Montserrat, sans-serif !important;
        }

        .alphabet a:hover {
            color: black
        }

        .clinicbyalphabet {
            width: 100%;
        }

        .p2 {
            background-color: rgb(69, 190, 229);
            text-align: center;
            font-size: 24px;
            font-weight: 700;
            color: rgb(255, 255, 255);
            padding: 5px;
            width: 51px;
            height: 49px;
            margin-bottom: 10px;
        }

        .clinics {
            padding-top: 25px;
            width: 100%;
            border-top: 2px solid rgb(238, 238, 238);
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        .clinic-item:hover {
            color: black;
        }
    </style>
    <div class="maindiv">
        <div class="heade-maindiv" style="border-bottom: rgba(231,229,229,1.00) 2px solid;">
            <h3 style="color: #49BCE2; font-weight:600; ">Cơ sở y tế</h3>
            <form id="search-box" class="search-box" action="/clinics/search" method="get">
                <input id="search-input" type="text" name="keyword" placeholder="Find Clinic" />
                <select id="search-select" name="type">
                    <option value="">All types</option>
                    <option value="Bệnh Viện">Hospital</option>
                    <option value="Phòng khám">Private Clinic</option>
                </select>
                <select id="search-select" name="city">
                    <option value="">All cities</option>
                    @for ($i = 0; $i < count($cities); $i++)
                        {
                        <option value="{{ $cities[$i] }}">{{ $cities[$i] }}</option>
                        }
                    @endfor
                </select>
                <button type="submit" style="background-color: #49BCE2;">Search</button>
                @csrf
            </form>
        </div>
        <div class="alphabet">
            @for ($i = 0; $i < count($alphabet); $i++)
                <a onclick="onClickAlphabet({{ $i }})">{{ $alphabet[$i] }}</a>
            @endfor
        </div>
        <div class="clinics-container">
            @for ($i = 0; $i < count($alphabet); $i++)
                @php
                    $check = false;
                    foreach ($clinics as $clinic) {
                        if ($clinic->status == 'working' && (substr($clinic->name, 0, 1) == $alphabet[$i] || substr($clinic->name, 0, 1) == strtolower($alphabet[$i]))) {
                            $check = true;
                            break;
                        }
                    }
                @endphp
                @if ($check)
                    <div id="{{ $i }}" class="clinicbyalphabet">
                        <p class="p2">{{ $alphabet[$i] }}</p>
                        <div class="clinics">
                            @foreach ($clinics as $clinic)
                                @if (
                                    $clinic->status == 'working' &&
                                        (substr($clinic->name, 0, 1) == $alphabet[$i] || substr($clinic->name, 0, 1) == strtolower($alphabet[$i])))
                                    <a class="clinic-item" href="/clinics/{{ $clinic->id }}">
                                        <div class="clinic-image"background-image:
                                            url("/clinicimage/{{ File::exists(public_path('/clinicimage/' . $avatars[$clinic->id])) ? $avatars[$clinic->id] : 'default_avatar.jpg' }}");>
                                        </div>
                                        <p class=".p1">{{ $clinic->fullname }}</p>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

            @endfor

        </div>
    </div>
    <script>
        const onClickAlphabet = (index) => {
            console.log(index);
            window.scrollBy(0, document.getElementById(index).offsetTop);
        }
    </script>
    @include('UserViews.share.Footer')
</body>

</html>
