<html lang="en">
@include('ManagerViews.share.head')

<body>
    <div class="topnav1">
        <a href="/admin/home">Home</a>
        <a href="/admin/clinics">Clinics</a>
        <a href="/admin/doctors">Doctors</a>
        <a href="/admin/schedules">Schedules</a>
        <a class="active" href="/admin/bookings">Bookings</a>
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
    <div class="form-holder" id="add-booking-form">
        <form class="w3-panel w3-card-4 addUserForm" action="/admin/add-booking" method="post">
            {{ csrf_field() }}
            <div class="top-section">
                <h2>Add Booking</h2>
                <a onclick="hideForm()">CLOSE</a>
            </div>
            <div class="w3-section">
                <label>Doctor ID:</label>
                <input class="w3-input w3-hover-grey" type="number" name="doctorid">
            </div>
            <div class="w3-section">
                <label>Date:</label>
                <input class="w3-input w3-hover-grey" type="date" name="date">
            </div>
            <div class="w3-section">
                <label>Time Index:</label>
                <select name="timeindex" id="timeindexbox">
                    @for ($i = 1; $i < count($timeindexes); $i++)
                        <option value={{ $i }}>{{ $timeindexes[$i] }}</option>
                    @endfor
                </select>
            </div>
            <div class="w3-section">
                <label>Email:</label>
                <input class="w3-input w3-hover-grey" type="email" name="patientemail">
            </div>
            <div class="w3-section">
                <label>Phone:</label>
                <input class="w3-input w3-hover-grey" type="text" name="patientphone">
            </div>
            <div class="w3-section">
                <label>Name:</label>
                <input class="w3-input w3-hover-grey" type="text" name="patientname">
            </div>
            <div class="w3-section">
                <label>Birthday:</label>
                <input class="w3-input w3-hover-grey" type="date" name="patientbirthday">
            </div>
            <div class="w3-section">
                <label>Gender:</label>
                <input class="w3-input w3-hover-grey" type="text" name="patientgender">
            </div>
            <div class="w3-section">
                <label>Address:</label>
                <input class="w3-input w3-hover-grey" type="text" name="patientaddress">
            </div>
            <div class="w3-section">
                <label>Province:</label>
                <input class="w3-input w3-hover-grey" type="text" name="patientprovince">
            </div>
            <div class="w3-section">
                <label>District:</label>
                <input class="w3-input w3-hover-grey" type="text" name="patientdistrict">
            </div>
            <div class="w3-section">
                <label>Details:</label>
                <input class="w3-input w3-hover-grey" type="text" name="details">
            </div>
            <div class="w3-section">
                <label>Status:</label>
                <input class="w3-input w3-hover-grey" type="text" name="bookingstatus">
            </div>
            <div class="w3-section">
                <label>File:</label>
                <input class="w3-input w3-hover-grey" type="text" name="file">
            </div>
            <button type="submit" class="adduser-submit-button">Submit</button>
        </form>
    </div>
    @foreach ($bookings as $booking)
        <div class="form-holder" id="{{ $booking->id }}">
            <form class="w3-panel w3-card-4 addUserForm" action="/admin/edit-booking" method="post"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="top-section">
                    <h2>Edit Booking </h2>
                    <a onclick="hideEdit({{ $booking->id }})">CLOSE</a>
                </div>
                <input style="display:none;" type="text" name="id" value="{{ $booking->id }}">
                <div class="w3-section">
                    <label>Doctor ID:</label>
                    <input disabled class="w3-input w3-hover-grey" type="number" name="doctorid"
                        value="{{ $booking->doctorid }}">
                    <label>{{ $doctornames[$booking->scheduleid] }}</label>
                </div>
                <div class="w3-section">
                    <label>Date:</label>
                    @php
                        foreach ($schedules as $schedule) {
                            if ($schedule->id == $booking->scheduleid) {
                                $currentdate = $schedule->date;
                                $currentindex = $schedule->timeindex;
                                break;
                            }
                        }
                    @endphp
                    <input disabled class="w3-input w3-hover-grey" type="date" name="date"
                        value="{{ $currentdate }}">
                </div>
                <div class="w3-section">
                    <label>Time Index:</label>
                    <select disabled name="timeindex" id="timeindexbox">
                        @for ($i = 1; $i < count($timeindexes); $i++)
                            if($currentindex == $i){
                            <option selected value={{ $i }}>{{ $timeindexes[$i] }}</option>
                            }else{
                            <option value={{ $i }}>{{ $timeindexes[$i] }}</option>
                            }
                        @endfor
                    </select>
                </div>
                <div class="w3-section">
                    <label>Email:</label>
                    <input disabled class="w3-input w3-hover-grey" type="email" name="patientemail"
                        value="{{ $booking->patientemail }}">
                </div>
                <div class="w3-section">
                    <label>Phone:</label>
                    <input class="w3-input w3-hover-grey" type="text" name="patientphone"
                        value="{{ $booking->patientphone }}">
                </div>
                <div class="w3-section">
                    <label>Name:</label>
                    <input disabled class="w3-input w3-hover-grey" type="text"
                        name="patientname"value="{{ $booking->patientname }}">
                </div>
                <div class="w3-section">
                    <label>Birthday:</label>
                    <input disabled class="w3-input w3-hover-grey" type="date"
                        name="patientbirthday"value="{{ $booking->patientbirthday }}">
                </div>
                <div class="w3-section">
                    <label>Gender:</label>
                    <input disabled class="w3-input w3-hover-grey" type="text"
                        name="patientgender"value="{{ $booking->patientgender }}">
                </div>
                <div class="w3-section">
                    <label>Address:</label>
                    <input disabled class="w3-input w3-hover-grey" type="text"
                        name="patientaddress"value="{{ $booking->patientaddress }}">
                </div>
                <div class="w3-section">
                    <label>Province:</label>
                    <input disabled class="w3-input w3-hover-grey" type="text"
                        name="patientprovince"value="{{ $booking->patientprovince }}">
                </div>
                <div class="w3-section">
                    <label>District:</label>
                    <input disabled class="w3-input w3-hover-grey" type="text"
                        name="patientdistrict"value="{{ $booking->patientdistrict }}">
                </div>
                <div class="w3-section">
                    <label>Details:</label>
                    <input class="w3-input w3-hover-grey" type="text"
                        name="details"value="{{ $booking->details }}">
                </div>
                <div class="w3-section">
                    <label>Status:</label>
                    <input class="w3-input w3-hover-grey" type="text"
                        name="status"value="{{ $booking->status }}">
                </div>
                <div class="w3-section">
                    <label>File:</label>
                    <input class="w3-input w3-hover-grey" type="text"
                        name="file"value="{{ $booking->file }}">
                </div>
                <button type="submit" class="adduser-submit-button">Edit</button>
            </form>
        </div>
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
            <button class="open-adduser-form-button" onclick="showForm();">Add Booking</button>
            <form id="search-box" class="search-box" action="/admin/search-booking" method="get">
                <input id="search-input" type="text" name="keyword" placeholder="Find booking" />
                <input class="w3-input w3-hover-grey" type="date" name="option">
                <button type="submit">Search</button>
                @csrf
            </form>
        </div>
        <table class="w3-table-all w3-hoverable">
            <thead>
                <tr class="user-table-header">
                    <th>ID</th>
                    <th>Doctor</th>
                    <th>Date Time</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>
                            {{ $booking->id }}
                        </td>
                        <td>
                            {{ $doctornames[$booking->scheduleid] }}
                        </td>
                        <td>
                            {{ $scheduleinfor[$booking->scheduleid] }}
                        </td>
                        <td>
                            {{ $booking->patientemail }}
                        </td>
                        <td>
                            {{ $booking->patientname }}
                        </td>
                        <td>
                            {{ $booking->status }}
                        </td>
                        <td>
                            <button type="submit" onclick="showEdit({{ $booking->id }})"
                                class="w3-btn w3-white w3-border w3-border-green"
                                style="color: #04AA6D !important;
                                border-color: #04AA6D !important;">Details</button>
                            <button type="submit" onclick="Delete({{ $booking->id }},'/admin/delete-booking')"
                                class="w3-btn w3-white w3-border w3-border-green"
                                style="color: #04AA6D !important;
                                border-color: #04AA6D !important;">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $bookings->links() }}
    </div>
    <script>
        hideForm = () => {
            document.getElementById("add-booking-form").style.display = "none";
            document.getElementsByTagName('body')[0].style.height = 'auto';
            document.getElementsByTagName('body')[0].style.overflow = 'auto';
        }
        showForm = () => {
            document.getElementById("add-booking-form").style.display = "block";
            document.getElementsByTagName('body')[0].style.height = '100%';
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
