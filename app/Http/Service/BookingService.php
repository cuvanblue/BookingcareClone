<?php
namespace App\Http\Service;

use App\Models\Booking;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Schedule;
use Exception;
use Illuminate\Support\Facades\DB;


class BookingService
{
    public static function create($request)
    {
        DB::beginTransaction();
        $schedule = Schedule::where('doctorid', '=', $request->input('doctorid'))->where('date', '=', $request->input('date'))->where('timeindex', '=', $request->input('timeindex'))->first();
        $result = !$schedule ? true : false;
        if ($result) {
            try {
                $result = ScheduleService::create($request);
                $schedule = Schedule::where('doctorid', '=', $request->input('doctorid'))->where('date', '=', $request->input('date'))->where('timeindex', '=', $request->input('timeindex'))->first();
                $doctor = Doctor::find($request->input('doctorid'));
                $clinic = Clinic::find($doctor->clinicid);
                Booking::create([
                    'doctorid' => $schedule->doctorid,
                    'scheduleid' => $schedule->id,
                    'patientemail' => $request->input('patientemail'),
                    'patientphone' => $request->input('patientphone'),
                    'patientname' => $request->input('patientname'),
                    'patientbirthday' => $request->input('patientbirthday'),
                    'patientgender' => $request->input('patientgender'),
                    'patientaddress' => $request->input('patientaddress'),
                    'patientdistrict' => $request->input('patientdistrict'),
                    'patientprovince' => $request->input('patientprovince'),
                    'details' => 'Cơ sở khám: ' . $clinic->fullname . ' Bác sĩ: ' . $doctor->name . ', ngày khám: ' . $schedule->date . ', ca khám: ' . ScheduleService::timeindexes()[$schedule->timeindex] . '. Thông tin thêm: ' . $request->input('details'),
                    'status' => $request->input('bookingstatus'),
                    'file' => $request->input('file')
                ]);
            } catch (Exception $e) {
                $result = false;
            }
        }
        if (!$result) {
            DB::rollback();
            Session()->flash('error', 'Thêm lịch khám không thành công');
        } else {
            DB::commit();
            Session()->flash('done', 'Thêm lịch khám thành công');
        }
    }
    public static function createByGuest($request)
    {
        DB::beginTransaction();
        $schedule = Schedule::find($request->input('scheduleid'));
        $doctor = Doctor::find($request->input('doctorid'));
        $clinic = Clinic::find($doctor->clinicid);
        $result = $schedule && $doctor && $schedule->doctorid == $doctor->id ? true : false;
        if ($result) {
            try {
                Booking::create([
                    'doctorid' => $schedule->doctorid,
                    'scheduleid' => $schedule->id,
                    'patientemail' => $request->input('patientemail') ? $request->input('patientemail') : 'guestmail@gmail.com',
                    'patientphone' => $request->input('patientphone'),
                    'patientname' => $request->input('patientname'),
                    'patientbirthday' => $request->input('patientbirthday'),
                    'patientgender' => $request->input('patientgender'),
                    'patientaddress' => $request->input('patientaddress'),
                    'patientdistrict' => $request->input('patientdistrict'),
                    'patientprovince' => $request->input('patientprovince'),
                    'details' => 'Cơ sở khám: ' . $clinic->fullname . ' Bác sĩ: ' . $doctor->name . ', ngày khám: ' . $schedule->date . ', ca khám: ' . ScheduleService::timeindexes()[$schedule->timeindex] . '. Thông tin thêm: ' . $request->input('details'),
                    'status' => $request->input('status'),
                    'file' => $request->input('file')
                ]);
            } catch (Exception $e) {
                $result = false;
            }
        }
        if (!$result) {
            DB::rollback();
            Session()->flash('error', 'Thêm lịch khám không thành công');
        } else {
            DB::commit();
            Session()->flash('done', 'Thêm lịch khám thành công');
        }
    }
    public static function search($request)
    {
        $option = $request->input('option') ? $request->input('option') : '';
        $keyword = $request->input('keyword') ? $request->input('keyword') : '';
        $bookings = DB::table('bookings')
            ->select('bookings.*')
            ->join('schedules', 'schedules.id', '=', 'bookings.scheduleid')
            ->where('schedules.date', 'like', '%' . $option . '%')
            ->where(function ($query) use ($keyword) {
                $query->where('bookings.doctorid', '=', $keyword)
                    ->orwhere('bookings.scheduleid', '=', $keyword)
                    ->orwhere('bookings.patientemail', '=', $keyword)
                    ->orwhere('bookings.patientphone', '=', $keyword)
                    ->orwhere('bookings.patientname', 'like', '%' . $keyword . '%')
                    ->orwhere('bookings.patientbirthday', '=', $keyword)
                    ->orwhere('bookings.patientgender', '=', $keyword)
                    ->orwhere('bookings.patientaddress', 'like', '%' . $keyword . '%')
                    ->orwhere('bookings.patientdistrict', '=', $keyword)
                    ->orwhere('bookings.patientprovince', '=', $keyword)
                    ->orwhere('bookings.details', 'like', '%' . $keyword . '%')
                    ->orwhere('bookings.status', 'like', '%' . $keyword . '%')
                    ->orwhere('bookings.file', 'like', '%' . $keyword . '%');
            })->paginate(20);
        Session()->flash('done', 'Tìm kiếm kết quả cho từ khóa: ' . $keyword . ' & ' . $option);
        return $bookings;
    }
    public static function searchByClinic($request, $clinicid)
    {
        $option = $request->input('option') ? $request->input('option') : '';
        $keyword = $request->input('keyword') ? $request->input('keyword') : '';
        $bookings = DB::table('bookings')
            ->select('bookings.*')
            ->join('doctors', 'doctors.id', '=', 'bookings.doctorid')
            ->join('schedules', 'schedules.id', '=', 'bookings.scheduleid')
            ->where('doctors.clinicid', '=', $clinicid)
            ->where('schedules.date', 'like', '%' . $option . '%')
            ->where(function ($query) use ($keyword) {
                $query->where('bookings.doctorid', '=', $keyword)
                    ->orwhere('bookings.scheduleid', '=', $keyword)
                    ->orwhere('bookings.patientemail', '=', $keyword)
                    ->orwhere('bookings.patientphone', '=', $keyword)
                    ->orwhere('bookings.patientname', 'like', '%' . $keyword . '%')
                    ->orwhere('bookings.patientbirthday', '=', $keyword)
                    ->orwhere('bookings.patientgender', '=', $keyword)
                    ->orwhere('bookings.patientaddress', 'like', '%' . $keyword . '%')
                    ->orwhere('bookings.patientdistrict', '=', $keyword)
                    ->orwhere('bookings.patientprovince', '=', $keyword)
                    ->orwhere('bookings.details', 'like', '%' . $keyword . '%')
                    ->orwhere('bookings.status', 'like', '%' . $keyword . '%')
                    ->orwhere('bookings.file', 'like', '%' . $keyword . '%');
            })->paginate(20);
        Session()->flash('done', 'Tìm kiếm kết quả cho từ khóa: ' . $keyword . ' & ' . $option);
        return $bookings;
    }
    public static function searchByDoctor($request, $doctorid)
    {
        $option = $request->input('option') ? $request->input('option') : '';
        $keyword = $request->input('keyword') ? $request->input('keyword') : '';
        $bookings = DB::table('bookings')
            ->select('bookings.*')
            ->join('doctors', 'doctors.id', '=', 'bookings.doctorid')
            ->join('schedules', 'schedules.id', '=', 'bookings.scheduleid')
            ->where('bookings.doctorid', '=', $doctorid)
            ->where('schedules.date', 'like', '%' . $option . '%')
            ->where(function ($query) use ($keyword) {
                $query->where('bookings.patientemail', '=', $keyword)
                    ->orwhere('bookings.patientphone', '=', $keyword)
                    ->orwhere('bookings.patientname', 'like', '%' . $keyword . '%')
                    ->orwhere('bookings.patientbirthday', '=', $keyword)
                    ->orwhere('bookings.patientgender', '=', $keyword)
                    ->orwhere('bookings.patientaddress', 'like', '%' . $keyword . '%')
                    ->orwhere('bookings.patientdistrict', '=', $keyword)
                    ->orwhere('bookings.patientprovince', '=', $keyword)
                    ->orwhere('bookings.details', 'like', '%' . $keyword . '%')
                    ->orwhere('bookings.status', 'like', '%' . $keyword . '%')
                    ->orwhere('bookings.file', 'like', '%' . $keyword . '%')
                    ->orwhere('schedules.date', 'like', '%' . $keyword . '%')
                    ->orwhere('schedules.timeindex', 'like', '%' . $keyword . '%');
            })->paginate(20);
        Session()->flash('done', 'Tìm kiếm kết quả cho từ khóa: ' . $keyword . ' & ' . $option);
        return $bookings;
    }
    public static function getAll($number)
    {
        return Booking::paginate((int) $number);
    }
    public static function getAllByClinic($number, $clinicid)
    {
        return $booking = DB::table('bookings')->select('bookings.*')
            ->join('doctors', 'doctors.id', '=', 'bookings.doctorid')
            ->where('doctors.clinicid', '=', $clinicid)
            ->paginate((int) $number);
    }
    public static function getAllByDoctor($number, $doctorid)
    {
        return $booking = DB::table('bookings')->select('bookings.*')
            ->join('doctors', 'doctors.id', '=', 'bookings.doctorid')
            ->where('doctors.id', '=', $doctorid)
            ->paginate((int) $number);
    }
    public static function edit($request)
    {
        DB::beginTransaction();
        $result = true;
        try {
            $booking = Booking::find($request->input('id'));
            $booking->patientphone = $request->input('patientphone');
            $booking->details = $request->input('details');
            $booking->status = $request->input('status');
            $booking->file = $request->input('file');
            $booking->save();
        } catch (Exception $e) {
            $result = false;
        }
        if (!$result) {
            DB::rollback();
            Session()->flash('error', 'Sửa lịch khám không thành công');
        } else {
            DB::commit();
            Session()->flash('done', 'Sửa lịch khám thành công');
        }
    }
    public static function delete($request)
    {
        $result = false;
        try {
            $booking = Booking::find($request->input('id'));
            $schedule = Schedule::find($booking->scheduleid);
            if ($schedule) {
                $result = $schedule->delete();
            } else {
                $result = $booking->delete();
            }
        } catch (Exception $ex) {
        }
        if ($result) {
            return response()->json([
                'error' => 'false',
                'message' => 'Xóa lịch khám thành công'
            ]);
        } else {
            return response()->json([
                'error' => 'true',
                'message' => 'Xóa lịch khám không thành công'
            ]);
        }
    }
}