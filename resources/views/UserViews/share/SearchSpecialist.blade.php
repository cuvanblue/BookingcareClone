<style>
    .search-specialist {
        width: 100%;
        height: 100%;
    }

    .search-specialist .title {
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
        height: 19px;
        width: 19px;
        padding-left: 20px;
        cursor: pointer;
    }

    .search-specialist .specialist-container {
        height: calc(100% - 50px);
        overflow: auto
    }

    .specialist-container::-webkit-scrollbar {
        width: 0.3em;
    }

    .specialist-container::-webkit-scrollbar-track {
        box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
    }

    .specialist-container::-webkit-scrollbar-thumb {
        background-color: darkgrey;
        outline: 1px solid slategrey;
    }

    .search-specialist .specialist-container .specialist-item {
        display: block;
        border-bottom: 1px solid #eee;
        overflow: auto;
        cursor: pointer;
    }

    .specialist-item img {
        height: 67px;
        width: 100px;
        margin: 15px;
        float: left;
    }

    .specialist-item p {
        font-size: 14px;
        float: left;
    }
</style>
<div class="search-specialist">
    <div class="title">
        <img src="img/left-arrow.svg" alt="" onclick="turnSearchSpecialist(false)">
        <span>Chuyên khoa</span>
    </div>
    <div class="specialist-container">
        <a class="specialist-item">
            <img src="img/chuyendalieu.jpg" alt="">
            <p>Chuyên da liễu</p>
        </a>
        <a class="specialist-item">
            <img src="img/chuyenhohap.jpg" alt="">
            <p>Chuyên Hô Hấp - Họng</p>
        </a>
        <a class="specialist-item">
            <img src="img/chuyennamhoc.jpg" alt="">
            <p>Nam Học</p>
        </a>
        <a class="specialist-item">
            <img src="img/chuyennhakhoa.jpg" alt="">
            <p>Nha khoa - chỉnh hình</p>
        </a>
        <a class="specialist-item">
            <img src="img/chuyennhi.jpg" alt="">
            <p>Bệnh nhi</p>
        </a>
        <a class="specialist-item">
            <img src="img/chuyensan.jpg" alt="">
            <p>Sản phụ khoa</p>
        </a>
        <a class="specialist-item">
            <img src="img/chuyentaimuihong.jpg" alt="">
            <p>Chuyên Tai Mũi Họng</p>
        </a>
        <a class="specialist-item">
            <img src="img/chuyentamthan.jpg" alt="">
            <p>Thần kinh</p>
        </a>
        <a class="specialist-item">
            <img src="img/chuyentieuhoa.jpg" alt="">
            <p>Tiêu hóa</p>
        </a>
        <a class="specialist-item">
            <img src="img/chuyentimmach.jpg" alt="">
            <p>Tim mạch</p>
        </a>
        <a class="specialist-item">
            <img src="img/chuyenxuongkhop.jpg" alt="">
            <p>Xương khớp - Vận động</p>
        </a>
    </div>
</div>
