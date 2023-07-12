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
use App\Http\Service\ScheduleService;
use App\Http\Service\UserService;
use App\Models\Booking;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{

    protected $clinicService;
    protected $userService;
    protected $doctorService;
    public function __construct(DoctorService $doctorService, ClinicService $clinicService, UserService $userService)
    {
        $this->clinicService = $clinicService;
        $this->userService = $userService;
        $this->doctorService = $doctorService;
    }
    public function getHomePage()
    {
        $currentdoctor = Doctor::find(Auth::user()->id);
        $currentavatar = AvatarService::getAvatarOf(Auth::user()->id);
        return view('ManagerViews.DoctorViews.HomePage', ['title' => $currentdoctor->name . ' | Home', 'currentdoctor' => $currentdoctor, 'currentuser' => Auth::user(), 'currentavatar' => $currentavatar ? $currentavatar : 'default_avatar.jpg']);
    }

    public function editCurrentDoctor(EditDoctorRequest $request)
    {
        $this->doctorService->edit($request);
        return redirect()->back();
    }
    // crud booking
    public function getBookingPage()
    {
        $currentdoctor = Doctor::find(Auth::user()->id);
        $timeindexes = ScheduleService::timeindexes();
        $temps = Booking::all();
        foreach ($temps as $booking) {
            $schedule = Schedule::find($booking->scheduleid);
            $scheduleinfor[$schedule->id] = (string) $schedule->date . " " . (string) $timeindexes[$schedule->timeindex];
        }
        return view('ManagerViews.DoctorViews.BookingsPage', [
            'title' => $currentdoctor->name . ' | Booking Manager',
            'bookings' => BookingService::getAllByDoctor(20, $currentdoctor->id),
            'scheduleinfor' => $scheduleinfor,
            'schedules' => Schedule::all(),
            'timeindexes' => $timeindexes,
            'currentdoctor' => $currentdoctor
        ]);
    }
    public function getSearchBookingsPage(Request $request)
    {
        $currentdoctor = Doctor::find(Auth::user()->id);
        $timeindexes = ScheduleService::timeindexes();
        $temps = Booking::all();
        foreach ($temps as $booking) {
            $schedule = Schedule::find($booking->scheduleid);
            $scheduleinfor[$schedule->id] = (string) $schedule->date . " " . (string) $timeindexes[$schedule->timeindex];
        }
        return view('ManagerViews.DoctorViews.BookingsPage', [
            'title' => $currentdoctor->name . ' | Booking Manager',
            'bookings' => BookingService::searchByDoctor($request, $currentdoctor->id),
            'scheduleinfor' => $scheduleinfor,
            'schedules' => Schedule::all(),
            'timeindexes' => $timeindexes,
            'currentdoctor' => $currentdoctor
        ]);
    }
    public function postEditBooking(EditBookingRequest $request)
    {
        BookingService::edit($request);
        return redirect()->back();
    }
}