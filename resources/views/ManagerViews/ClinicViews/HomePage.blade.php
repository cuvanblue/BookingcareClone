<html lang="en">

@include('ManagerViews.share.head')

<body>
    <div class="topnav1">
        <a class="active" href="/clinic/home">Home</a>
        <a href="/clinic/doctors">Doctors</a>
        <a href="/clinic/schedules">Schedules</a>
        <a href="/clinic/bookings">Bookings</a>
        <a href="/logout">Log out <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <g id="Interface / Log_Out">
                        <path id="Vector"
                            d="M12 15L15 12M15 12L12 9M15 12H4M9 7.24859V7.2002C9 6.08009 9 5.51962 9.21799 5.0918C9.40973 4.71547 9.71547 4.40973 10.0918 4.21799C10.5196 4 11.0801 4 12.2002 4H16.8002C17.9203 4 18.4796 4 18.9074 4.21799C19.2837 4.40973 19.5905 4.71547 19.7822 5.0918C20 5.5192 20 6.07899 20 7.19691V16.8036C20 17.9215 20 18.4805 19.7822 18.9079C19.5905 19.2842 19.2837 19.5905 18.9074 19.7822C18.48 20 17.921 20 16.8031 20H12.1969C11.079 20 10.5192 20 10.0918 19.7822C9.71547 19.5905 9.40973 19.2839 9.21799 18.9076C9 18.4798 9 17.9201 9 16.8V16.75"
                            stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </g>
            </svg> </a>
    </div>
    <form class="w3-panel w3-card-4 details-form" action="/clinic/edit" method="POST" enctype="multipart/form-data"
        style="width: 95%; margin: 20px auto 10px auto;">
        {{ csrf_field() }}
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

        <div class="top-section">
            <h2>Details about {{ $currentClinic->name }}</h2>
        </div>
        <input style="display:none;" type="text" name="id" value="{{ $currentClinic->id }}">
        <div class="w3-section">
            <img class="user-avatar"
                src="/clinicimage/{{ File::exists(public_path('/clinicimage/' . $currentAvatar)) ? $currentAvatar : 'default_avatar.jpg' }}"
                alt="">
        </div>
        <div class="w3-section">
            <label>Name:</label>
            <input class="w3-input w3-hover-grey" type="text" name="name" value="{{ $currentClinic->name }}">
        </div>
        <div class="w3-section">
            <label>Full name:</label>
            <input class="w3-input w3-hover-grey" type="text" name="fullname" value="{{ $currentClinic->fullname }}">
        </div>
        <div class="w3-section">
            <label>Email:</label>
            <input class="w3-input w3-hover-grey" type="email" name="email" value="{{ $currentAuth->email }}">
        </div>
        <div class="w3-section">
            <label>Address:</label>
            <input class="w3-input w3-hover-grey" type="text" name="address" value="{{ $currentClinic->address }}">
        </div>
        <div class="w3-section">
            <label>Introduce:</label>
            <textarea style="width:100%;" id="introducetextarea{{ $currentClinic->id }}" cols="30" rows="20"
                name="introduce"></textarea>
        </div>
        <div class="w3-section">
            <label>Status:</label>
            <input class="w3-input w3-hover-grey" type="text" name="status"value="{{ $currentClinic->status }}">
        </div>
        <div class="w3-section">
            <label>Change Password:</label>
            <input class="w3-input w3-hover-grey" type="password" name="password" value="">
        </div>
        <div class="w3-section">
            <label>Change avatar:</label>
            <input class="w3-input w3-hover-grey" type="file" name="image" value="">
        </div>
        <button type="submit" class="adduser-submit-button">Edit</button>
    </form>
    <script>
        var simplemde{{ $currentClinic->id }} = new SimpleMDE({
            element: document.getElementById("introducetextarea{{ $currentClinic->id }}")
        });
        simplemde{{ $currentClinic->id }}.value(`{{ $currentClinic->introduce }}`);
    </script>
</body>

</html>
