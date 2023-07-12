<?php
namespace App\Http\Controllers;

use App\Http\Requests\AddBookingGuestRequest;
use App\Http\Requests\AddBookingRequest;
use App\Http\Service\AvatarService;
use App\Http\Service\BookingService;
use App\Http\Service\ClinicService;
use App\Http\Service\DoctorService;
use App\Http\Service\InfService;
use App\Http\Service\ScheduleService;
use App\Http\Service\UserService;
use App\Models\AvatarImage;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GuestController
{

    public function postAddBooking(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctorid' => 'required|numeric',
            'scheduleid' => 'required|numeric',
            'patientphone' => 'required|numeric',
            'patientname' => 'required',
            'patientbirthday' => 'required',
            'patientgender' => 'required',
            'patientaddress' => 'required',
            'patientdistrict' => 'required',
            'patientprovince' => 'required',
            'details' => 'required',
            'status' => 'required',
            'file' => 'required',
        ]);
        if ($validator->fails()) {
            Schedule::find($request->input('scheduleid'))->delete();
            return redirect('/doctors/' . $request->input('doctorid'))->withErrors($validator)->withInput();
        } else {
            $schedule = Schedule::find($request->input('scheduleid'));
            $schedule->status = 'booked';
            $schedule->save();
            BookingService::createByGuest($request);
            return redirect('/doctors/' . $request->input('doctorid'));
        }
    }
    public function getBookingPage(string $doctorid, string $date, string $timeindex)
    {
        $doctor = Doctor::find($doctorid);
        if ($doctor && date("Y-m-d") < $date && 1 <= $timeindex && $timeindex < 22) {
            $check = Schedule::where('doctorid', $doctor->id)->where('date', $date)->where('timeindex', $timeindex)->first();
            if ($check) {
                $checkStatus = $check->status;
                $timeGap = (Carbon::now('UTC')->diffInMinutes($check->created_at));
                if ($checkStatus == 'pending' && $timeGap > 3) {
                    $check->delete();
                } else {
                    Session()->flash('error', 'Lịch khám vừa chọn không khả dụng, vui lòng chọn lại (chỉ được đặt lịch cho ngày hôm sau)');
                    return redirect()->to('/doctors/' . $doctorid);
                }
            }
            $newSchedule = Schedule::create([
                'doctorid' => $doctor->id,
                'date' => $date,
                'timeindex' => $timeindex,
                'status' => 'pending'

            ]);
            return view('UserViews.BookingPage', [
                'doctor' => $doctor,
                'avatar' => AvatarService::getAvatarOf($doctor->id),
                'schedule' => $newSchedule,
                'timeindex' => ScheduleService::timeindexes()[$timeindex],
                'index' => $timeindex,
                'date' => $date,
                'cities' => InfService::getcities(),
                'famousdoctors' => DoctorService::getDoctorByBookings(),
                'famousavatars' => AvatarService::getAvatarOf(DoctorService::getDoctorByBookings())
            ]);
        } else {
            return redirect()->route('error');
        }
    }
    public function getDoctorPage(string $doctorid)
    {
        $doctor = Doctor::find($doctorid);
        if ($doctor) {
            $doctorid = $doctor->id;
            $clinic = CLinic::find($doctor->clinicid);
            $timeindexes = ScheduleService::timeindexes();
            for ($i = 1; $i <= 4; $i++) {
                $schedules[$doctorid][$i] = $timeindexes;
                for ($j = 1; $j < count($schedules[$doctorid][$i]); $j++) {
                    $check = ScheduleService::checkScheduleExist(date("Y-m-d", strtotime('+' . $i . ' days')), $j, $doctorid);
                    if ($check) {
                        $checkStatus = $check->status;
                        $timeGap = (Carbon::now('UTC')->diffInMinutes($check->created_at));
                        if ($checkStatus == 'pending' && $timeGap > 3) {
                            $check->delete();
                        } else {
                            $schedules[$doctorid][$i][$j] = false;
                        }
                    }
                }
            }
            return view('UserViews.DoctorPage', [
                'clinic' => $clinic,
                'doctor' => $doctor,
                'avatar' => AvatarService::getAvatarOf($doctor->id),
                'schedules' => $schedules,
                'timeindexes' => $timeindexes,
                'famousdoctors' => DoctorService::getDoctorByBookings(),
                'famousavatars' => AvatarService::getAvatarOf(DoctorService::getDoctorByBookings())

            ]);
        } else {
            return redirect()->route('error');
        }
    }
    public function getClinicsPage()
    {
        return view('UserViews.ClinicList', [
            'clinics' => ClinicService::getAll('all'),
            'avatars' => AvatarService::getAvatarOf(ClinicService::getAll('true')),
            'cities' => InfService::getcities(),
            'alphabet' => InfService::getalphabet(),
            'famousdoctors' => DoctorService::getDoctorByBookings(),
            'famousavatars' => AvatarService::getAvatarOf(DoctorService::getDoctorByBookings())
        ]);
    }
    public function getSearchDoctorByClinic(Request $request, string $id)
    {
        $clinic = Clinic::find($id);
        if ($clinic) {
            $doctors = DoctorService::searchDoctorsByClinic($request, $id);

            foreach ($doctors as $doctor) {
                $doctorid = $doctor->id;
                for ($i = 1; $i <= 4; $i++) {
                    $schedules[$doctorid][$i] = ScheduleService::timeindexes();
                    for ($j = 1; $j < count($schedules[$doctorid][$i]); $j++) {
                        $check = ScheduleService::checkScheduleExist(date("Y-m-d", strtotime('+' . $i . ' days')), $j, $doctorid);
                        if ($check) {
                            $checkStatus = $check->status;
                            $timeGap = (Carbon::now('UTC')->diffInMinutes($check->created_at));
                            if ($checkStatus == 'pending' && $timeGap > 3) {
                                $check->delete();
                            } else {
                                $schedules[$doctorid][$i][$j] = false;
                            }
                        }
                    }
                }
            }
            return view('UserViews.ClinicPage', [
                'clinic' => $clinic,
                'avatar' => AvatarService::getAvatarOf($clinic->id) ? AvatarService::getAvatarOf($clinic->id) : 'default_avatar.jpg',
                'avatars' => AvatarService::getAvatarOf($doctors),
                'user' => User::find($id),
                'specializes' => $this->getspecializes(),
                'degrees' => $this->getdegree(),
                'doctors' => $doctors,
                'schedules' => $schedules,
                'timeindexes' => ScheduleService::timeindexes(),
                'famousdoctors' => DoctorService::getDoctorByBookings(),
                'famousavatars' => AvatarService::getAvatarOf(DoctorService::getDoctorByBookings())

            ]);
        } else {
            return redirect()->route('error');
        }
    }
    public function getClinicPage(Request $request, string $id)
    {
        $clinic = Clinic::find($id);
        if ($clinic) {
            $doctors = DoctorService::clinicFilter($clinic->id, 'all');
            foreach ($doctors as $doctor) {
                $doctorid = $doctor->id;
                for ($i = 1; $i <= 4; $i++) {
                    $schedules[$doctorid][$i] = ScheduleService::timeindexes();
                    for ($j = 1; $j < count($schedules[$doctorid][$i]); $j++) {
                        $check = ScheduleService::checkScheduleExist(date("Y-m-d", strtotime('+' . $i . ' days')), $j, $doctorid);
                        if ($check) {
                            $checkStatus = $check->status;
                            $timeGap = (Carbon::now('UTC')->diffInMinutes($check->created_at));
                            if ($checkStatus == 'pending' && $timeGap > 3) {
                                $check->delete();
                            } else {
                                $schedules[$doctorid][$i][$j] = false;
                            }
                        }
                    }
                }
            }

            return view('UserViews.ClinicPage', [
                'clinic' => $clinic,
                'avatar' => AvatarService::getAvatarOf($clinic->id) ? AvatarService::getAvatarOf($clinic->id) : 'default_avatar.jpg',
                'avatars' => AvatarService::getAvatarOf($doctors),
                'user' => User::find($id),
                'specializes' => $this->getspecializes(),
                'degrees' => $this->getdegree(),
                'doctors' => $doctors,
                'schedules' => $schedules,
                'timeindexes' => ScheduleService::timeindexes(),
                'famousdoctors' => DoctorService::getDoctorByBookings(),
                'famousavatars' => AvatarService::getAvatarOf(DoctorService::getDoctorByBookings())

            ]);
        } else {
            return redirect()->route('error');
        }
    }
    public function getSearchClinic(Request $request)
    {
        return view('UserViews.ClinicList', [
            'clinics' => ClinicService::getSearch($request),
            'avatars' => AvatarService::getAvatarOf(ClinicService::getAll('true')),
            'cities' => InfService::getcities(),
            'alphabet' => InfService::getalphabet(),
            'famousdoctors' => DoctorService::getDoctorByBookings(),
            'famousavatars' => AvatarService::getAvatarOf(DoctorService::getDoctorByBookings())
        ]);
    }
    public function getspecializes()
    {
        $spc = DB::table('doctors')->select('doctors.specialize')->groupBy('doctors.specialize')->get();
        return $spc;
    }
    public function getdegree()
    {
        $degree = DB::table('doctors')->select('doctors.degree')->groupBy('doctors.degree')->get();
        return $degree;
    }
    public function getHomePage()
    {
        return view('UserViews.HomePage', [
            'famousdoctors' => DoctorService::getDoctorByBookings(),
            'famousavatars' => AvatarService::getAvatarOf(DoctorService::getDoctorByBookings())
        ]);
    }
}