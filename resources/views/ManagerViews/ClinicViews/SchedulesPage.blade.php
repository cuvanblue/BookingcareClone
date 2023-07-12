<html lang="en">
@include('ManagerViews.share.head')

<body>
    <div class="topnav1">
        <a href="/clinic/home">Home</a>
        <a href="/clinic/doctors">Doctors</a>
        <a class="active" href="/clinic/schedules">Schedules</a>
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
    <div class="form-holder" id="add-schedule-form">
        <form class="w3-panel w3-card-4 addUserForm" action="/clinic/add-schedule" method="post">
            {{ csrf_field() }}
            <div class="top-section">
                <h2>Add Schedule</h2>
                <a onclick="hideForm()">CLOSE</a>
            </div>
            <div class="w3-section">
                <label>Doctor:</label>
                <Select name="doctorid">
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                    @endforeach
                </Select>
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
                <label>Status:</label>
                <input class="w3-input w3-hover-grey" type="text" name="status">
            </div>
            <button type="submit" class="adduser-submit-button">Submit</button>
        </form>
    </div>
    @foreach ($schedules as $schedule)
        <div class="form-holder" id="{{ $schedule->id }}">
            <form class="w3-panel w3-card-4 addUserForm" action="/clinic/edit-schedule" method="post"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="top-section">
                    <h2>Edit Schedule </h2>
                    <a onclick="hideEdit({{ $schedule->id }})">CLOSE</a>
                </div>
                <input style="display:none;" type="text" name="id" value="{{ $schedule->id }}">
                <div class="w3-section">
                    <label>Doctor ID:</label>
                    <input disabled class="w3-input w3-hover-grey" type="number" name="doctorid"
                        value="{{ $schedule->doctorid }}">
                    <label>Doctor: {{ $doctornames[$schedule->doctorid] }}</label>
                </div>
                <div class="w3-section">
                    <label>Date:</label>
                    <input disabled class="w3-input w3-hover-grey" type="date" name="date"
                        value="{{ $schedule->date }}">
                </div>
                <div class="w3-section">
                    <label>Time Index:</label>
                    <select disabled name="timeindex" id="timeindexbox">
                        @for ($i = 1; $i < count($timeindexes); $i++)
                            if($schedule->timeindex == $i){
                            <option selected value={{ $i }}>{{ $timeindexes[$i] }}</option>
                            }else{
                            <option value={{ $i }}>{{ $timeindexes[$i] }}</option>
                            }
                        @endfor
                    </select>
                </div>
                <div class="w3-section">
                    <label>Status:</label>
                    <input class="w3-input w3-hover-grey" type="text" name="status"
                        value="{{ $schedule->status }}">
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
            <button class="open-adduser-form-button" onclick="showForm();">Add Schedule</button>
            <form id="search-box" class="search-box" action="/clinic/search-schedule" method="get">
                <input id="search-input" type="text" name="keyword" placeholder="Find schedule" />
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
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $schedule)
                    <tr>
                        <td>
                            {{ $schedule->id }}
                        </td>
                        <td>
                            {{ $doctornames[$schedule->doctorid] }}
                        </td>
                        <td>
                            {{ $schedule->date }}
                        </td>
                        <td>
                            {{ $timeindexes[$schedule->timeindex] }}
                        </td>
                        <td>
                            {{ $schedule->status }}
                        </td>
                        <td>
                            <button type="submit" onclick="showEdit({{ $schedule->id }})"
                                class="w3-btn w3-white w3-border w3-border-green"
                                style="color: #04AA6D !important;
                                border-color: #04AA6D !important;">Details</button>
                            <button type="submit" onclick="Delete({{ $schedule->id }},'/clinic/delete-schedule')"
                                class="w3-btn w3-white w3-border w3-border-green"
                                style="color: #04AA6D !important;
                                border-color: #04AA6D !important;">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $schedules->links() }}
    </div>
    <script>
        hideForm = () => {
            document.getElementById("add-schedule-form").style.display = "none";
            document.getElementsByTagName('body')[0].style.height = 'auto';
            document.getElementsByTagName('body')[0].style.overflow = 'auto';
        }
        showForm = () => {
            document.getElementById("add-schedule-form").style.display = "block";
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
