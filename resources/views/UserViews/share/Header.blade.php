<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat&family=Source+Code+Pro&display=swap');

    body {
        margin: 0;
        font: 14px/1.5 'Montserrat', sans-serif;
    }

    .header {
        position: relative;
        width: 100%;
        padding: 20px 0;
    }

    .header-container {

        width: 100%;
        max-width: 1175px;
        margin: 0 auto;
        background-color: white;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-content: center;
        font: 14px/1.5 'Montserrat', sans-serif;
    }

    .header-container .header-logo {
        display: flex;
        flex-direction: row;
        align-items: center;
        margin-left: 15px;
    }

    .header-logo button {
        width: 22px;
        height: 22px;
        background-color: transparent;
        border: none;
        padding: 0;
        margin-right: 10px
    }

    button svg {
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .header-logo a {
        width: 160px;
        height: 40px;
    }

    .header-container .header-nav {
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .header-nav .header-nav-link {
        overflow: auto;
        cursor: pointer;
        margin-right: 30px;
        color: #474747;
    }

    .header-nav-link h4 {
        margin: 0;
        font-size: 13px;
    }

    .header-nav-link p {
        margin: 0;
        margin-top: 5px;
        font-size: 11px;
    }

    .header-support {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        color: #45C3D2;
        font-weight: 600;
        margin-right: 15px;
    }

    .header-support .support-text {
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .header-support .support-text span {
        color: #969495;
        margin-left: 5px;
    }

    .header .left-side-menu {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        display: none;
        z-index: 2;
    }

    .left-side-menu .back-ground {
        width: 100%;
        height: 100vh;
        background-color: black;
        opacity: 0.5;
        z-index: 1;
    }

    .left-side-menu .menu-container {
        z-index: 2;
        position: absolute;
        top: 0;
        left: 0;
        width: 260px;
        height: 100vh;
        overflow: auto;
        background-color: white;
        opacity: 1;

    }

    .menu-container::-webkit-scrollbar {
        width: 0.3em;
    }

    .menu-container::-webkit-scrollbar-track {
        box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
    }

    .menu-container::-webkit-scrollbar-thumb {
        background-color: darkgrey;
        outline: 1px solid slategrey;
    }

    .left-side-menu .menu-container p {
        background-color: #F1F1F1;
        width: 96%;
        padding: 9px 0 9px 4%;
        margin: 0;
        font-size: 13px;
    }

    .left-side-menu .menu-container ul {
        width: 100%;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .left-side-menu .menu-container ul li {
        width: 100%;
    }

    .left-side-menu .menu-container ul li a {
        display: flex;
        width: 90%;
        text-decoration: none;
        border-bottom: 1px solid #eee;
        color: #45C3D2;
        font-size: 17px;
        align-items: center;
        justify-content: flex-start;
        padding: 10px 4% 10px 6%;
        font-weight: lighter;
    }

    .left-side-menu .menu-container ul li a img {
        width: 35px;
        height: 35px;
        margin: 40px 20px 40px 0;
    }

    .header .search-specialist-box {
        display: none;
        width: 100%;
        height: 96vh;
        position: absolute;
        top: 0;
        left: 0;
        background-color: white;
    }

    .header .search-doctor-box {
        z-index: 3;
        display: none;
        width: 100%;
        height: 96vh;
        position: absolute;
        top: 0;
        left: 0;
        background-color: white;
    }

    h4 {
        font: 14px/1.5 'Montserrat', sans-serif;
        font-weight: 600;
    }

    @media only screen and (max-width: 1000px) {
        .header-nav {
            display: none !important;
        }
    }
</style>
<div class="header">
    <div class="header-container">
        <div class="header-logo">
            <button onclick="turnSideBar(true)">
                <svg fill="#787878" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" width="25px" height="25px" viewBox="0 0 124.00 124.00"
                    xml:space="preserve" stroke="#787878" transform="rotate(0)" stroke-width="0.0012400000000000002">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC"
                        stroke-width="1.984"></g>
                    <g id="SVGRepo_iconCarrier">
                        <g>
                            <path d="M112,6H12C5.4,6,0,11.4,0,18s5.4,12,12,12h100c6.6,0,12-5.4,12-12S118.6,6,112,6z">
                            </path>
                            <path
                                d="M112,50H12C5.4,50,0,55.4,0,62c0,6.6,5.4,12,12,12h100c6.6,0,12-5.4,12-12C124,55.4,118.6,50,112,50z">
                            </path>
                            <path
                                d="M112,94H12c-6.6,0-12,5.4-12,12s5.4,12,12,12h100c6.6,0,12-5.4,12-12S118.6,94,112,94z">
                            </path>
                        </g>
                    </g>
                </svg>
            </button>
            <a href="/">
                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 666.63 146.21">
                    <defs>
                        <style>
                            .cls-1 {
                                fill: #49bce2;
                            }

                            .cls-2 {
                                fill: #ffc10e;
                            }
                        </style>
                    </defs>
                    <title>Logo_1</title>
                    <path class="cls-1"
                        d="M73.11,41.43a31.68,31.68,0,1,0,31.68,31.68A31.68,31.68,0,0,0,73.11,41.43Zm19.9,38H79.43V93.08H66.78V79.43H53.21V66.78H66.78V53.13H79.43V66.78H93Z" />
                    <path class="cls-1"
                        d="M73.11,125.24A52.13,52.13,0,0,1,21,74.49h0V21.88a73.09,73.09,0,1,0,107.67,98.74L112.71,107A52,52,0,0,1,73.11,125.24Z" />
                    <path class="cls-1"
                        d="M73.11,0A72.82,72.82,0,0,0,44.3,5.91L44,6.06a3.76,3.76,0,0,0-2.13,3.37v22A52.14,52.14,0,0,1,113.36,40l16.19-13.33A73,73,0,0,0,73.11,0Z" />
                    <path class="cls-2"
                        d="M184.43,45.71a16.32,16.32,0,0,1,7.32,5,11.82,11.82,0,0,1,2.59,7.61,12.14,12.14,0,0,1-2.63,7.77,13.19,13.19,0,0,1-7.16,4.53,13.92,13.92,0,0,1,8.54,4.94,14.53,14.53,0,0,1,3.12,9.39,13.67,13.67,0,0,1-2.67,8.38,16.6,16.6,0,0,1-7.61,5.5,32.11,32.11,0,0,1-11.57,1.9h-28V44H173.3A32.23,32.23,0,0,1,184.43,45.71Zm-7.08,19.34a5.15,5.15,0,0,0,1.78-4.17,4.83,4.83,0,0,0-1.78-4,7.28,7.28,0,0,0-4.86-1.34H161.16v11h11.33A7.31,7.31,0,0,0,177.35,65.06Zm1.3,22.54a5.25,5.25,0,0,0,2.27-4.53,4.93,4.93,0,0,0-2.27-4.25,10.22,10.22,0,0,0-6.15-1.5H161.16v11.9h11.33A10.4,10.4,0,0,0,178.64,87.59Z" />
                    <path class="cls-2"
                        d="M236.67,59.23a20.42,20.42,0,0,1,8.42,7.85,22.53,22.53,0,0,1,3,11.69,22.68,22.68,0,0,1-3,11.77,20.41,20.41,0,0,1-8.42,7.85,29.58,29.58,0,0,1-25.09,0,20.13,20.13,0,0,1-8.38-7.85,22.91,22.91,0,0,1-3-11.77,22.75,22.75,0,0,1,3-11.69,20.13,20.13,0,0,1,8.38-7.85,29.58,29.58,0,0,1,25.09,0ZM217.33,71.08a11.57,11.57,0,0,0-2.59,7.85,11.69,11.69,0,0,0,2.59,7.93,8.55,8.55,0,0,0,6.8,3,8.64,8.64,0,0,0,6.88-3,11.7,11.7,0,0,0,2.59-7.93A11.47,11.47,0,0,0,231,71.08a8.68,8.68,0,0,0-6.84-3A8.56,8.56,0,0,0,217.33,71.08Z" />
                    <path class="cls-2"
                        d="M287.81,59.23a20.42,20.42,0,0,1,8.42,7.85,22.53,22.53,0,0,1,3,11.69,22.68,22.68,0,0,1-3,11.77,20.41,20.41,0,0,1-8.42,7.85,29.58,29.58,0,0,1-25.09,0,20.13,20.13,0,0,1-8.38-7.85,22.91,22.91,0,0,1-3-11.77,22.75,22.75,0,0,1,3-11.69,20.13,20.13,0,0,1,8.38-7.85,29.58,29.58,0,0,1,25.09,0ZM268.47,71.08a11.57,11.57,0,0,0-2.59,7.85,11.69,11.69,0,0,0,2.59,7.93,8.55,8.55,0,0,0,6.8,3,8.64,8.64,0,0,0,6.88-3,11.7,11.7,0,0,0,2.59-7.93,11.47,11.47,0,0,0-2.63-7.85,8.68,8.68,0,0,0-6.84-3A8.56,8.56,0,0,0,268.47,71.08Z" />
                    <path class="cls-2"
                        d="M334.59,100.7l-9.22-16.51-4.45,4.61v11.9H306.5v-60h14.41V71.73l14-14.81h16.35l-16,16.91,16.35,26.87Z" />
                    <path class="cls-2"
                        d="M369.34,38.92a7.5,7.5,0,0,1,2.15,5.54,7.53,7.53,0,0,1-2.15,5.5,7.92,7.92,0,0,1-10.92,0,7.53,7.53,0,0,1-2.15-5.5,7.5,7.5,0,0,1,2.15-5.54,8,8,0,0,1,10.92,0Zm-12.5,18h14.32V100.7H356.84Z" />
                    <path class="cls-2"
                        d="M422.11,60.89q4.33,4.53,4.33,12.22v27.6H412.11V77.24a8.21,8.21,0,0,0-2-5.87,7.1,7.1,0,0,0-5.42-2.14,8.31,8.31,0,0,0-5.87,2.35,9.54,9.54,0,0,0-2.71,6V100.7h-14.4V56.92h14.4V64a15.56,15.56,0,0,1,6-5.74,17.85,17.85,0,0,1,8.46-1.94Q417.78,56.36,422.11,60.89Z" />
                    <path class="cls-2"
                        d="M477.66,56.92v39.9a19,19,0,0,1-3,10.64,19.42,19.42,0,0,1-8.37,7A29.52,29.52,0,0,1,453.87,117a36.57,36.57,0,0,1-10.6-1.54,33.6,33.6,0,0,1-9-4.13l5-10a25.78,25.78,0,0,0,6.47,3.16,22.62,22.62,0,0,0,7,1.13,12,12,0,0,0,7.69-2.27,7.46,7.46,0,0,0,2.83-6.15V92.53q-4.37,5.75-12.46,5.75A17.56,17.56,0,0,1,434.57,88.2a24.55,24.55,0,0,1-2.39-11,24.29,24.29,0,0,1,2.31-10.84A17.28,17.28,0,0,1,441,59a17.85,17.85,0,0,1,9.55-2.59,17.42,17.42,0,0,1,7.32,1.5,14.29,14.29,0,0,1,5.46,4.33V56.92Zm-16.75,28a10.92,10.92,0,0,0,2.43-7.36,11.05,11.05,0,0,0-2.43-7.45,8.64,8.64,0,0,0-12.83,0,11,11,0,0,0-2.47,7.4,10.8,10.8,0,0,0,2.47,7.36,8.13,8.13,0,0,0,6.43,2.83A8,8,0,0,0,460.91,84.92Z" />
                    <path class="cls-2"
                        d="M522.17,57.69a15.69,15.69,0,0,0-7.53-2.06,14.72,14.72,0,0,0-7.81,2.15,15.19,15.19,0,0,0-5.54,5.91,18.35,18.35,0,0,0,0,16.75,15.18,15.18,0,0,0,5.54,5.91,14.71,14.71,0,0,0,7.81,2.15,17.18,17.18,0,0,0,7.28-1.78,23.06,23.06,0,0,0,6.8-4.86l8.66,9.31a34.62,34.62,0,0,1-11,7.73,30.45,30.45,0,0,1-27.8-1,28.38,28.38,0,0,1-10.68-10.6,29.51,29.51,0,0,1-3.88-15.05,28.28,28.28,0,0,1,14.85-25.33,32.25,32.25,0,0,1,28-1.17,30.92,30.92,0,0,1,10.44,7.16l-8.58,10.36A21.17,21.17,0,0,0,522.17,57.69Z" />
                    <path class="cls-2"
                        d="M576.56,60.52q5,4.17,5.1,11.69V100.7H567.49V95.77q-4.37,5.58-13.19,5.58-7,0-11-3.76a13,13,0,0,1-4-9.91A11.76,11.76,0,0,1,543.66,78q4.33-3.48,12.42-3.56h11.41v-.49a5.84,5.84,0,0,0-2.14-4.86,9.79,9.79,0,0,0-6.19-1.7,25,25,0,0,0-6.19.89A36.81,36.81,0,0,0,546,70.84l-4-9.71a57,57,0,0,1,10.24-3.6,43.48,43.48,0,0,1,10.16-1.17Q571.54,56.36,576.56,60.52ZM564.42,90a6.84,6.84,0,0,0,3.08-4.09v-3.8h-8.58q-6.07,0-6.07,4.53a4.47,4.47,0,0,0,1.58,3.6,6.49,6.49,0,0,0,4.33,1.34A10.16,10.16,0,0,0,564.42,90Z" />
                    <path class="cls-2"
                        d="M611.15,58.38a16.49,16.49,0,0,1,8.21-2V69.55a21.73,21.73,0,0,0-2.18-.08,13.32,13.32,0,0,0-8.25,2.39,9.15,9.15,0,0,0-3.64,6.51V100.7h-14.4V56.92h14.4v7.28A15.77,15.77,0,0,1,611.15,58.38Z" />
                    <path class="cls-2"
                        d="M660.88,62.75q5.74,6.31,5.75,17.32,0,1.7-.08,2.59H636.12a10.51,10.51,0,0,0,3.64,5.71,10.07,10.07,0,0,0,6.31,2,13.66,13.66,0,0,0,5.46-1.13,15.43,15.43,0,0,0,4.82-3.32l7.53,7.53a22.19,22.19,0,0,1-8.21,5.79,28.33,28.33,0,0,1-10.88,2,26.18,26.18,0,0,1-12.3-2.75,19.12,19.12,0,0,1-8.05-7.77A23.57,23.57,0,0,1,621.63,79a24.16,24.16,0,0,1,2.83-11.86,19.56,19.56,0,0,1,8-7.93,24.85,24.85,0,0,1,12-2.79Q655.13,56.44,660.88,62.75ZM652.63,75a8.43,8.43,0,0,0-2.23-6.11,8.46,8.46,0,0,0-11.57,0,11.27,11.27,0,0,0-3,6.15Z" />
                </svg>
            </a>
        </div>
        <div class="header-nav">
            <a class="header-nav-link" onclick="turnSearchSpecialist(true)">
                <h4>Chuyên khoa</h4>
                <p>Tìm bác sĩ theo chuyên khoa</p>
            </a>
            <a class="header-nav-link" href="/clinics" style="text-decoration:none;">
                <h4>Cơ sở y tế</h4>
                <p>Chọn bệnh viện phòng khám</p>
            </a>
            <a class="header-nav-link" onclick="turnSearchDoctor(true)">
                <h4>Bác sĩ</h4>
                <p>Chọn bác sĩ giỏi</p>
            </a>
            <a class="header-nav-link">
                <h4>Gói khám</h4>
                <p>Khám sức khỏe tổng quát</p>
            </a>
        </div>
        <div class="header-support">
            <div class="support-text">
                <svg width="20px" height="20px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"
                    fill="#45C3D2" stroke="#45C3D2">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path fill="#45C3D2"
                            d="M512 64a448 448 0 1 1 0 896 448 448 0 0 1 0-896zm23.744 191.488c-52.096 0-92.928 14.784-123.2 44.352-30.976 29.568-45.76 70.4-45.76 122.496h80.256c0-29.568 5.632-52.8 17.6-68.992 13.376-19.712 35.2-28.864 66.176-28.864 23.936 0 42.944 6.336 56.32 19.712 12.672 13.376 19.712 31.68 19.712 54.912 0 17.6-6.336 34.496-19.008 49.984l-8.448 9.856c-45.76 40.832-73.216 70.4-82.368 89.408-9.856 19.008-14.08 42.24-14.08 68.992v9.856h80.96v-9.856c0-16.896 3.52-31.68 10.56-45.76 6.336-12.672 15.488-24.64 28.16-35.2 33.792-29.568 54.208-48.576 60.544-55.616 16.896-22.528 26.048-51.392 26.048-86.592 0-42.944-14.08-76.736-42.24-101.376-28.16-25.344-65.472-37.312-111.232-37.312zm-12.672 406.208a54.272 54.272 0 0 0-38.72 14.784 49.408 49.408 0 0 0-15.488 38.016c0 15.488 4.928 28.16 15.488 38.016A54.848 54.848 0 0 0 523.072 768c15.488 0 28.16-4.928 38.72-14.784a51.52 51.52 0 0 0 16.192-38.72 51.968 51.968 0 0 0-15.488-38.016 55.936 55.936 0 0 0-39.424-14.784z">
                        </path>
                    </g>
                </svg>
                <span>Hỗ trợ</span>
            </div>
            <span class="support-phone">024-7301-2468</span>
        </div>
    </div>
    <div class="left-side-menu">
        <div class="menu-container">
            <ul>
                <li>
                    <a href="">Trang chủ</a>
                </li>
                <li>
                    <a href="">Cẩm nang</a>
                </li>
                <li>
                    <a href="">Liên hệ hợp tác</a>
                </li>
                <li>
                    <a href="">Sức khỏe doanh nghiệp</a>
                </li>
                <li>
                    <a href="">Gói chuyển đổi số doanh nghiệp</a>
                </li>
                <li>
                    <a href="">Tuyển dụng</a>
                </li>
            </ul>
            <p>VỀ BOOKINGCARE</p>
            <ul>
                <li>
                    <a href="">Dành cho bệnh nhân</a>
                </li>
                <li>
                    <a href="/login">Dành cho bác sĩ</a>
                </li>
                <li>
                    <a href="">Vai trò của BookingCare</a>
                </li>
                <li>
                    <a href="">Liên hệ</a>
                </li>
                <li>
                    <a href="">Câu hỏi thường gặp</a>
                </li>
                <li>
                    <a href="">Điều khoản sử dụng</a>
                </li>
                <li>
                    <a href="">Quy trình hỗ trợ giải quyết khiếu nại</a>
                </li>
                <li>
                    <a href="">Quy chế hoạt động</a>
                </li>
                <li>
                    <a href="">
                        <img src="/img/fbicon.svg" alt="">
                        <img src="/img/yticon.svg" alt="">
                    </a>
                </li>
            </ul>
        </div>
        <div class="back-ground" onclick="turnSideBar(false)">

        </div>
    </div>
    <div class="search-specialist-box">
        @include('UserViews.share.SearchSpecialist')
    </div>
    <div class="search-doctor-box">
        @include('UserViews.share.SearchDoctor')
    </div>
</div>
<script>
    function turnSideBar(state) {
        document.querySelectorAll('.left-side-menu')[0].style.display = state ? 'block' : 'none';
        document.body.style = state ? 'overflow:hidden;' : 'overflow:auto;';
    }

    function turnSearchSpecialist(state) {
        document.querySelectorAll('.search-specialist-box')[0].style.display = state ? 'block' : 'none';
        document.body.style = state ? 'overflow:hidden;' : 'overflow:auto;';
    }

    function turnSearchDoctor(state) {
        document.querySelectorAll('.search-doctor-box')[0].style.display = state ? 'block' : 'none';
        document.body.style = state ? 'overflow:hidden;' : 'overflow:auto;';
    }
</script>
