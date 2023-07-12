<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddBookingRequest;
use App\Http\Requests\AddScheduleRequest;
use App\Http\Requests\EditAdminRequest;
use App\Http\Requests\AddClinicRequest;
use App\Http\Requests\EditClinicRequest;
use App\Http\Requests\AddDoctorRequest;
use App\Http\Requests\EditBookingRequest;
use App\Http\Requests\EditDoctorRequest;
use App\Http\Requests\EditScheduleRequest;
use App\Http\Service\AvatarService;
use App\Http\Service\DoctorService;
use App\Http\Service\ScheduleService;
use App\Http\Service\BookingService;
use App\Http\Service\InfService;
use App\Models\Admin;
use App\Models\Doctor;
use App\Models\User;
use App\Http\Service\ClinicService;
use App\Http\Service\UserService;
use App\Models\Booking;
use App\Models\Clinic;
use App\Models\Schedule;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function getHomePage()
    {
        $currentAdmin = Admin::where('id', Auth::user()->id)->first();
        $currentAvatar = AvatarService::getAvatarOf(Auth::user()->id);
        return view('ManagerViews.AdminHomePage', ['title' => 'Admin | Home', 'currentAdmin' => $currentAdmin, 'currentAuth' => Auth::user(), 'currentAvatar' => $currentAvatar ? $currentAvatar : 'default_avatar.jpg']);
    }
    public function getClinicsPage()
    {
        return view('ManagerViews.AdminClinicsPage', [
            'title' => 'Admin | Clinics Manager',
            'clinics' => ClinicService::getAll(8),
            'emails' => UserService::getEmailOf(ClinicService::getAll(true)),
            'avatars' => AvatarService::getAvatarOf(ClinicService::getAll(true)),
            'cities' => InfService::getcities()
        ]);
    }
    public function getSearchClinicsPage(Request $request)
    {
        return view('ManagerViews.AdminClinicsPage', [
            'title' => 'Admin | Clinics Manager',
            'clinics' => ClinicService::getSearch($request),
            'emails' => UserService::getEmailOf(ClinicService::getAll(true)),
            'avatars' => AvatarService::getAvatarOf(ClinicService::getAll(true)),
            'cities' => InfService::getcities()
        ]);
    }
    public function postAddClinic(AddClinicRequest $request)
    {
        ClinicService::create($request);
        return redirect()->back();
    }
    public function postEditClinic(EditClinicRequest $request)
    {
        ClinicService::edit($request);
        return redirect()->back();
    }
    public function deleteClinic(Request $request)
    {
        return ClinicService::delete($request);
    }
    // CRUD doctor
    public function getDoctorsPage()
    {
        $doctors = DoctorService::getAll('all');
        return view('ManagerViews.AdminDoctorsPage', [
            'title' => 'Admin | Doctors Manager',
            'doctors' => DoctorService::getAll(20),
            'mails' => UserService::getEmailOf($doctors),
            'avatars' => AvatarService::getAvatarOf($doctors),
            'degrees' => InfService::getdegree(),
            'specializes' => InfService::getspecializes()
        ]);
    }
    public function getSearchDoctorsPage(Request $request)
    {
        $doctors = DoctorService::getSearch($request);
        return view('ManagerViews.AdminDoctorsPage', [
            'title' => 'Admin | Doctors Manager',
            'doctors' => $doctors,
            'mails' => UserService::getEmailOf($doctors),
            'avatars' => AvatarService::getAvatarOf($doctors),
            'degrees' => InfService::getdegree(),
            'specializes' => InfService::getspecializes()
        ]);
    }
    public function postAddDoctor(AddDoctorRequest $request)
    {
        DoctorService::create($request);
        return redirect()->back();
    }
    public function postEditDoctor(EditDoctorRequest $request)
    {
        DoctorService::edit($request);
        return redirect()->back();
    }
    public function deleteDoctor(Request $request)
    {
        return DoctorService::delete($request);
    }
    public function editCurrentAdmin(EditAdminRequest $request)
    { // controller sửa admin
        try {
            DB::beginTransaction();
            $result = true;
            $userid = Auth::user()->id;
            $currentAdmin = Admin::where('id', $userid)->first();
            $currentAdmin->address = $request->input('address');
            $currentAdmin->phone = $request->input('phone');
            $currentAdmin->save();
            // sửa avatar nếu có
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $name = $userid . 'admin' . time() . $file->getClientOriginalName();
                $storedPath = $file->move('adminimage', $name);
                $result = AvatarService::changeAvatar($userid, $name, 'adminimage');
            }
            // sửa password nếu có 
            if ($request->input('password')) {
                $user = User::where('id', Auth::user()->id)->first();
                $result = UserService::edit($request);
            }
        } catch (Exception $e) {
            $result = false;
        }
        // nếu okela hết thì commit còn không thì rollback
        if ($result) {
            DB::commit();
            Session()->flash('done', 'Sửa thông tin thành công');
        } else {
            DB::rollback();
            Session()->flash('error', 'Có lỗi xảy ra vui lòng thử lại');
        }
        return redirect()->back();
    }

    // crud schedule
    public function getSchedulesPage()
    {
        $doctornames = [];
        $temps = Schedule::all();
        foreach ($temps as $schedule) {
            $doctor = Doctor::find($schedule->doctorid);
            $doctornames[$doctor->id] = $doctor->name;
        }
        return view('ManagerViews.AdminSchedulesPage', [
            'title' => 'Admin | Schedules Manager',
            'schedules' => ScheduleService::getAll(20),
            'doctornames' => $doctornames,
            'timeindexes' => ScheduleService::timeindexes()
        ]);
    }
    public function getSearchSchedulesPage(Request $request)
    {
        $doctornames = [];
        $temps = Schedule::all();
        foreach ($temps as $schedule) {
            $doctor = Doctor::find($schedule->doctorid);
            $doctornames[$doctor->id] = $doctor->name;
        }
        return view('ManagerViews.AdminSchedulesPage', [
            'title' => 'Admin | Schedules Manager',
            'schedules' => ScheduleService::search($request),
            'doctornames' => $doctornames,
            'timeindexes' => ScheduleService::timeindexes()
        ]);
    }
    public function postAddSchedule(AddScheduleRequest $request)
    {
        ScheduleService::create($request);
        return redirect()->back();
    }
    public function postEditSchedule(EditScheduleRequest $request)
    {
        ScheduleService::edit($request);
        return redirect()->back();
    }
    public function deleteSchedule(Request $request)
    {
        return ScheduleService::delete($request);
    }

    // crud booking
    public function getBookingPage()
    {
        $doctornames = [];
        $scheduleinfor = [];
        $timeindexes = ScheduleService::timeindexes();
        $temps = Schedule::all();
        foreach ($temps as $schedule) {
            $doctor = Doctor::find($schedule->doctorid);
            $doctornames[$schedule->id] = $doctor->name;
        }
        $temps = Booking::all();
        foreach ($temps as $booking) {
            $schedule = Schedule::find($booking->scheduleid);
            $scheduleinfor[$schedule->id] = (string) $schedule->date . " " . (string) $timeindexes[$schedule->timeindex];
        }
        return view('ManagerViews.AdminBookingsPage', [
            'title' => 'Admin | Booking Manager',
            'bookings' => BookingService::getAll(20),
            'doctornames' => $doctornames,
            'scheduleinfor' => $scheduleinfor,
            'schedules' => Schedule::all(),
            'timeindexes' => $timeindexes
        ]);
    }
    public function getSearchBookingsPage(Request $request)
    {
        $doctornames = [];
        $scheduleinfor = [];
        $timeindexes = ScheduleService::timeindexes();
        $temps = Schedule::all();
        foreach ($temps as $schedule) {
            $doctor = Doctor::find($schedule->doctorid);
            $doctornames[$schedule->id] = $doctor->name;
        }
        $temps = Booking::all();
        foreach ($temps as $booking) {
            $schedule = Schedule::find($booking->scheduleid);
            $scheduleinfor[$schedule->id] = (string) $schedule->date . " " . (string) $timeindexes[$schedule->timeindex];
        }
        return view('ManagerViews.AdminBookingsPage', [
            'title' => 'Admin | Booking Manager',
            'bookings' => BookingService::search($request),
            'doctornames' => $doctornames,
            'scheduleinfor' => $scheduleinfor,
            'schedules' => Schedule::all(),
            'timeindexes' => $timeindexes
        ]);
    }
    public function postAddBooking(AddBookingRequest $request)
    {
        BookingService::create($request);
        return redirect()->back();
    }
    public function postEditBooking(EditBookingRequest $request)
    {
        BookingService::edit($request);
        return redirect()->back();
    }
    public function deleteBooking(Request $request)
    {
        return BookingService::delete($request);
    }
}