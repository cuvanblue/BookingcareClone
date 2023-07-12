<html lang="en">
@include('ManagerViews.share.head')

<body>
    <div class="topnav1">
        <a href="/admin/home">Home</a>
        <a href="/admin/clinics">Clinics</a>
        <a class="active" href="/admin/doctors">Doctors</a>
        <a href="/admin/schedules">Schedules</a>
        <a href="/admin/bookings">Bookings</a>
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
    <div class="form-holder" id="add-doctor-form">
        <form class="w3-panel w3-card-4 addUserForm" action="/admin/add-doctor" method="post">
            {{ csrf_field() }}
            <div class="top-section">
                <h2>Add doctor</h2>
                <a onclick="hideForm()">CLOSE</a>
            </div>
            <div class="w3-section">
                <label>Name:</label>
                <input class="w3-input w3-hover-grey" type="text" name="name">
            </div>
            <div class="w3-section">
                <label>Address:</label>
                <input class="w3-input w3-hover-grey" type="text" name="address">
            </div>
            <div class="w3-section">
                <label>Email:</label>
                <input class="w3-input w3-hover-grey" type="email" name="email">
            </div>
            <div class="w3-section">
                <label>Phone:</label>
                <input class="w3-input w3-hover-grey" type="text" name="phone">
            </div>
            <div class="w3-section">
                <label>Gender:</label>
                <input class="w3-input w3-hover-grey" type="text" name="gender">
            </div>
            <div class="w3-section">
                <label>Price:</label>
                <input class="w3-input w3-hover-grey" type="number" name="price">
            </div>
            <div class="w3-section">
                <label>Clinic ID:</label>
                <input class="w3-input w3-hover-grey" type="number" name="clinicid">
            </div>
            <div class="w3-section">
                <label>Career:</label>
                <input class="w3-input w3-hover-grey" type="text" name="career">
            </div>
            <div class="w3-section">
                <label>Specialize:</label>
                <input class="w3-input w3-hover-grey" type="text" name="specialize">
            </div>
            <div class="w3-section">
                <label>Degree:</label>
                <input class="w3-input w3-hover-grey" type="text" name="degree">
            </div>
            <div class="w3-section">
                <label>Status:</label>
                <input class="w3-input w3-hover-grey" type="text" name="status">
            </div>
            <button type="submit" class="adduser-submit-button">Submit</button>
        </form>
    </div>
    @foreach ($doctors as $doctor)
        <div class="form-holder" id="{{ $doctor->id }}">
            <form class="w3-panel w3-card-4 addUserForm" action="/admin/edit-doctor" method="post"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="top-section">
                    <h2>Edit Doctor {{ $doctor->name }}</h2>
                    <a onclick="hideEdit({{ $doctor->id }})">CLOSE</a>
                </div>

                <input style="display:none;" type="text" name="id" value="{{ $doctor->id }}">
                <div class="w3-section">
                    <img class="user-avatar"
                        src="/doctorimage/{{ File::exists(public_path('/doctorimage/' . $avatars[$doctor->id])) ? $avatars[$doctor->id] : 'default_avatar.jpg' }}"
                        alt="">
                </div>
                <div class="w3-section">
                    <label>Name:</label>
                    <input class="w3-input w3-hover-grey" type="text" name="name" value="{{ $doctor->name }}"
                        disabled>
                </div>
                <div class="w3-section">
                    <label>Address:</label>
                    <input class="w3-input w3-hover-grey" type="text" name="address"
                        value="{{ $doctor->address }}">
                </div>
                <div class="w3-section">
                    <label>Email:</label>
                    <input class="w3-input w3-hover-grey" type="email" name="email"
                        value="{{ $mails[$doctor->id] }}">
                </div>
                <div class="w3-section">
                    <label>Phone:</label>
                    <input class="w3-input w3-hover-grey" type="text" name="phone"
                        value="{{ $doctor->phone }}">
                </div>
                <div class="w3-section">
                    <label>Gender:</label>
                    <input class="w3-input w3-hover-grey" type="text"
                        name="gender"value="{{ $doctor->gender }}">
                </div>
                <div class="w3-section">
                    <label>Price:</label>
                    <input class="w3-input w3-hover-grey" type="number"
                        name="price"value="{{ $doctor->price }}">
                </div>
                <div class="w3-section">
                    <label>Clinic ID:</label>
                    <input class="w3-input w3-hover-grey" type="number"
                        name="clinicid"value="{{ $doctor->clinicid }}">
                </div>
                <div class="w3-section">
                    <label>Career:</label>
                    <textarea style="width:100%;" id="introducetextarea{{ $doctor->id }}" cols="30" rows="20"
                        name="career"></textarea>
                </div>
                <div class="w3-section">
                    <label>Specialize:</label>
                    <input class="w3-input w3-hover-grey" type="text"
                        name="specialize"value="{{ $doctor->specialize }}">
                </div>
                <div class="w3-section">
                    <label>Degree:</label>
                    <input class="w3-input w3-hover-grey" type="text"
                        name="degree"value="{{ $doctor->degree }}">
                </div>
                <div class="w3-section">
                    <label>Status:</label>
                    <input class="w3-input w3-hover-grey" type="text"
                        name="status"value="{{ $doctor->status }}">
                </div>
                <div class="w3-section">
                    <label>Change Password:</label>
                    <input class="w3-input w3-hover-grey" type="password" name="password"value="">
                </div>
                <div class="w3-section">
                    <label>Change avatar:</label>
                    <input class="w3-input w3-hover-grey" type="file" name="image" value="">
                </div>
                <button type="submit" class="adduser-submit-button">Edit</button>
            </form>
        </div>
        <script>
            var simplemde{{ $doctor->id }} = new SimpleMDE({
                element: document.getElementById("introducetextarea{{ $doctor->id }}")
            });
            simplemde{{ $doctor->id }}.value(`{{ $doctor->career }}`);
        </script>
    @endforeach
    <div class="w3-container">
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
        <div style="margin: 10px 0 0 0 !important;">
            <button class="open-adduser-form-button" onclick="showForm();">Add Doctor</button>
            <form id="search-box" class="search-box" action="/admin/search-doctor" method="get">
                <input id="search-input" type="text" name="keyword" placeholder="Find Doctor" />
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
                <button type="submit">Search</button>
                @csrf
            </form>
        </div>
        <table class="w3-table-all w3-hoverable">
            <thead>
                <tr class="user-table-header">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Specialize</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($doctors as $doctor)
                    <tr>
                        <td>
                            {{ $doctor->id }}
                        </td>
                        <td>
                            {{ $doctor->name }}
                        </td>
                        <td>
                            {{ $doctor->specialize }}
                        </td>
                        <td>
                            {{ $doctor->status }}
                        </td>
                        <td>
                            <button type="submit" onclick="showEdit({{ $doctor->id }})"
                                class="w3-btn w3-white w3-border w3-border-green"
                                style="color: #04AA6D !important;
                                border-color: #04AA6D !important;">Details</button>
                            <button type="submit" onclick="Delete({{ $doctor->id }},'/admin/delete-doctor')"
                                class="w3-btn w3-white w3-border w3-border-green"
                                style="color: #04AA6D !important;
                                border-color: #04AA6D !important;">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $doctors->links() }}
    </div>
    <script>
        hideForm = () => {
            document.getElementById('add-doctor-form').style.display = "none";
            document.getElementsByTagName('body')[0].style.height = 'auto';
            document.getElementsByTagName('body')[0].style.overflow = 'auto';
        }
        showForm = () => {
            document.getElementById('add-doctor-form').style.display = "block";
            document.getElementsByTagName('body')[0].style.height = '100vh';
            document.getElementsByTagName('body')[0].style.overflow = 'hidden';
        }
        hideEdit = (index) => {
            document.getElementById(index).style.display = "none";
            document.getElementsByTagName('body')[0].style.height = 'auto';
            document.getElementsByTagName('body')[0].style.overflow = 'auto';
        }
        showEdit = (index) => {
            document.getElementById(index).style.display = "block";
            document.getElementsByTagName('body')[0].style.height = '100vh';
            document.getElementsByTagName('body')[0].style.overflow = 'hidden';
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function Delete(id, url) {
            if (confirm("Bạn có thực sự muốn xóa đối tượng này không?")) {
                $.ajax({
                    type: 'DELETE',
                    datatype: JSON,
                    data: {
                        id
                    },
                    url: url,
                    success: function(result) {
                        console.log(result);
                        if (result.error == 'false') {
                            alert(result.message);
                            location.reload();
                        } else {
                            alert(result.message);
                        }
                    }
                });
            }
        }
    </script>
</body>

</html>
