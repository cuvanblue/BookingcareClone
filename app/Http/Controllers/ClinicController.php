<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddBookingRequest;
use App\Http\Requests\AddDoctorRequest;
use App\Http\Requests\AddScheduleRequest;
use App\Http\Requests\EditBookingRequest;
use App\Http\Requests\EditClinicRequest;
use App\Http\Requests\EditDoctorRequest;
use App\Http\Requests\EditScheduleRequest;
use App\Http\Service\AvatarService;
use App\Http\Service\BookingService;
use App\Http\Service\ClinicService;
use App\Http\Service\DoctorService;
use App\Http\Service\InfService;
use App\Http\Service\ScheduleService;
use App\Http\Service\UserService;
use App\Models\Booking;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClinicController extends Controller
{
    public function getHomePage()
    {
        $currentClinic = Clinic::find(Auth::user()->id);
        $currentAvatar = AvatarService::getAvatarOf(Auth::user()->id);
        return view('ManagerViews.ClinicViews.HomePage', ['title' => $currentClinic->fullname . ' | Home', 'currentClinic' => $currentClinic, 'currentAuth' => Auth::user(), 'currentAvatar' => $currentAvatar ? $currentAvatar : 'default_avatar.jpg']);
    }
    public function editCurrentClinic(EditClinicRequest $request)
    {
        ClinicService::edit($request);
        return redirect()->back();
    }

    // CRUD doctor
    public function getDoctorsPage()
    {
        $currentClinic = Clinic::find(Auth::user()->id);
        $doctors = DoctorService::getDoctorsByClinic($currentClinic->id);
        return view('ManagerViews.ClinicViews.DoctorsPage', [
            'title' => $currentClinic->fullname . ' | Doctors Manager',
            'doctors' => $doctors,
            'emails' => UserService::getEmailOf($doctors),
            'avatars' => AvatarService::getAvatarOf($doctors),
            'currentclinic' => $currentClinic,
            'degrees' => InfService::getdegree(),
            'specializes' => InfService::getspecializes()
        ]);
    }
    public function getSearchDoctorsPage(Request $request)
    {
        $currentClinic = Clinic::find(Auth::user()->id);
        $doctors = DoctorService::searchDoctorsByClinic($request, $currentClinic->id);
        return view('ManagerViews.ClinicViews.DoctorsPage', [
            'title' => $currentClinic->fullname . ' | Doctors Manager',
            'doctors' => $doctors,
            'emails' => UserService::getEmailOf($doctors),
            'avatars' => AvatarService::getAvatarOf($doctors),
            'currentclinic' => $currentClinic,
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
    // crud schedule
    public function getSchedulesPage()
    {
        $currentClinic = Clinic::find(Auth::user()->id);
        $doctors = Doctor::where('clinicid', '=', $currentClinic->id)->get();
        $doctornames = [];
        $temps = Schedule::all();
        foreach ($temps as $schedule) {
            $doctor = Doctor::find($schedule->doctorid);
            $doctornames[$doctor->id] = $doctor->name;
        }
        return view('ManagerViews.ClinicViews.SchedulesPage', [
            'title' => $currentClinic->fullname . ' | Schedules Manager',
            'schedules' => ScheduleService::getAllByClinic($currentClinic->id),
            'doctornames' => $doctornames,
            'timeindexes' => ScheduleService::timeindexes(),
            'doctors' => $doctors
        ]);
    }
    public function getSearchSchedulesPage(Request $request)
    {
        $currentClinic = Clinic::find(Auth::user()->id);
        $doctors = Doctor::where('clinicid', '=', $currentClinic->id)->get();
        $doctornames = [];
        $temps = Schedule::all();
        foreach ($temps as $schedule) {
            $doctor = Doctor::find($schedule->doctorid);
            $doctornames[$doctor->id] = $doctor->name;
        }
        return view('ManagerViews.ClinicViews.SchedulesPage', [
            'title' => $currentClinic->fullname . ' | Schedules Manager',
            'schedules' => ScheduleService::searchByClinic($request, $currentClinic->id),
            'doctornames' => $doctornames,
            'timeindexes' => ScheduleService::timeindexes(),
            'doctors' => $doctors
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
        $currentClinic = Clinic::find(Auth::user()->id);
        $doctors = Doctor::where('clinicid', '=', $currentClinic->id)->get();
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
        return view('ManagerViews.ClinicViews.BookingsPage', [
            'title' => $currentClinic->fullname . ' | Booking Manager',
            'bookings' => BookingService::getAllByClinic(20, $currentClinic->id),
            'doctornames' => $doctornames,
            'scheduleinfor' => $scheduleinfor,
            'schedules' => Schedule::all(),
            'timeindexes' => $timeindexes,
            'doctors' => $doctors
        ]);
    }
    public function getSearchBookingsPage(Request $request)
    {
        $currentClinic = Clinic::find(Auth::user()->id);
        $doctors = Doctor::where('clinicid', '=', $currentClinic->id)->get();
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
        return view('ManagerViews.ClinicViews.BookingsPage', [
            'title' => $currentClinic->fullname . ' | Booking Manager',
            'bookings' => BookingService::searchByClinic($request, $currentClinic->id),
            'doctornames' => $doctornames,
            'scheduleinfor' => $scheduleinfor,
            'schedules' => Schedule::all(),
            'timeindexes' => $timeindexes,
            'doctors' => $doctors
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