<style>
    .search-doctor {
        width: 100%;
        height: 100%;
    }

    .search-doctor .title {
        z-index: 2;
        height: 50px;
        width: 100%;
        box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .title span {
        font-size: 20px;
        margin-left: 20px;
    }

    .title img {
        height: 19px !important;
        width: 19px;
        padding-left: 20px;
        cursor: pointer;
    }

    .title img,
    .title img:before,
    .title img:after {
        box-sizing: unset;
    }

    .search-doctor .search-doctor-form {
        height: 50px;
        width: 100%;
        background-color: #F5F5F5;
        margin-top: 4px;
    }

    .search-doctor .search-doctor-form input {
        height: 35px;
        width: 98%;
        margin: 6px 1% 10px 1%;
        border-radius: 15px;
        border: 1px #ccc solid;
        padding-left: 10px;
        font-size: 16px;
    }

    .search-doctor .doctor-container {
        height: calc(100% - 100px);
        overflow: auto
    }

    .doctor-container::-webkit-scrollbar {
        width: 0.3em;
    }

    .doctor-container::-webkit-scrollbar-track {
        box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
    }

    .doctor-container::-webkit-scrollbar-thumb {
        background-color: darkgrey;
        outline: 1px solid slategrey;
    }

    .search-doctor .doctor-container .doctor-item-famous {
        display: block;
        border-bottom: 1px solid #eee;
        overflow: auto;
        cursor: pointer;
    }

    .doctor-item-famous img {
        height: 50px;
        width: 50px;
        margin: 15px;
        float: left;
        border-radius: 50%;
    }

    .doctor-item-famous p {
        font-size: 14px;
        float: left;
    }

    .doctor-item-famous p span {
        display: block;
        font-size: 12px;
        padding-top: 5px;
    }
</style>
<div class="search-doctor">
    <div class="title">
        <img src="/img/left-arrow.svg" alt="" onclick="turnSearchDoctor(false)">
        <span>Bác sĩ</span>
    </div>
    <form action="" class="search-doctor-form">
        <input type="search" placeholder="Tìm kiếm bác sĩ">
    </form>
    <div class="doctor-container">
        <p style="padding-left: 18px"><b>Bác sĩ nổi bật</b></p>
        @foreach ($famousdoctors as $doctor)
            <a class="doctor-item-famous" href="/doctors/{{ $doctor->id }}">
                <img src="/doctorimage/{{ File::exists(public_path('/doctorimage/' . $famousavatars[$doctor->id])) ? $famousavatars[$doctor->id] : 'default_avatar.jpg' }}"
                    alt="">
                <p>{{ $doctor->degree }} {{ ' ' }} {{ $doctor->name }}
                    <span>{{ $doctor->specialize }}</span>
                </p>
            </a>
        @endforeach

    </div>
</div>
