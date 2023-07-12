<?php
namespace App\Http\Service;

use App\Models\Doctor;
use App\Models\Schedule;
use Exception;
use Illuminate\Support\Facades\DB;

class ScheduleService
{
    public static function timeindexes()
    { //có 21 ca làm
        return [
            'temp',
            '06:30 - 07:00',
            '07:00 - 07:30',
            '07:30 - 08:00',
            '08:00 - 08:30',
            '08:30 - 09:00',
            '09:00 - 09:30',
            '09:30 - 10:00',
            '10:00 - 10:30',
            '10:30 - 11:00',
            '11:00 - 11:30',
            '13:00 - 13:30',
            '13:30 - 14:00',
            '14:00 - 14:30',
            '14:30 - 15:00',
            '15:00 - 15:30',
            '15:30 - 16:00',
            '16:00 - 16:30',
            '16:30 - 17:00',
            '17:00 - 17:30',
            '17:30 - 18:00',
            '18:00 - 18:30'
        ];
    }
    public static function create($request)
    {
        DB::beginTransaction();
        $result = Doctor::find($request->input('doctorid')) ? true : false;
        if ($result) {
            try {
                $schedule = Schedule::create([
                    'doctorid' => $request->input('doctorid'),
                    'date' => $request->input('date'),
                    'timeindex' => $request->input('timeindex'),
                    'status' => $request->input('status') ? $request->input('status') : 'selected',
                ]);
            } catch (Exception $e) {
                $result = false;
            }
        }
        if (!$result) {
            DB::rollback();
            Session()->flash('error', 'Thêm lịch không thành công');
        } else {
            DB::commit();
            Session()->flash('done', 'Thêm lịch thành công');
        }
        return $result;
    }
    public static function edit($request)
    {
        DB::beginTransaction();
        $result = true;
        try {
            $schedule = Schedule::find($request->input('id'));
            $schedule->status = $request->input('status');
            $schedule->save();
        } catch (Exception $e) {
            $result = false;
        }
        if (!$result) {
            DB::rollback();
            Session()->flash('error', 'Sửa lịch không thành công');
        } else {
            DB::commit();
            Session()->flash('done', 'Sửa lịch thành công');
        }
    }
    public static function getAll($number)
    {
        return Schedule::paginate((int) $number);
    }
    public static function getAllByClinic($clinicid)
    {
        $schedules = DB::table('schedules')->select('schedules.*')
            ->join('doctors', 'doctors.id', '=', 'schedules.doctorid')
            ->join('clinics', 'clinics.id', '=', 'doctors.clinicid')
            ->where('clinics.id', '=', $clinicid)
            ->paginate(20);
        return $schedules;
    }
    public static function getAllByDoctor($doctorid, $option)
    {
        if (is_int($option)) {
            $doctors = DB::table('schedules')->select('schedules.*')
                ->join('doctors', 'doctors.id', '=', 'schedules.doctorid')
                ->where('doctors.id', '=', $doctorid)
                ->paginate(20);
            return $doctors;
        } else {
            $doctors = DB::table('schedules')->select('schedules.*')
                ->join('doctors', 'doctors.id', '=', 'schedules.doctorid')
                ->where('doctors.id', '=', $doctorid);
            return $doctors;
        }

    }
    public static function delete($request)
    {
        $result = false;
        try {
            $schedule = Schedule::find($request->input('id'));
            if ($schedule) {
                $result = $schedule->delete();
            }
        } catch (Exception $ex) {
        }
        if ($result) {
            return response()->json([
                'error' => 'false',
                'message' => 'Xóa lịch thành công'
            ]);
        } else {
            return response()->json([
                'error' => 'true',
                'message' => 'Xóa lịch không thành công'
            ]);
        }
    }
    public static function search($request)
    {
        $option = $request->input('option') ? $request->input('option') : '';
        $keyword = $request->input('keyword') ? $request->input('keyword') : '';
        $schedules = Schedule::where('date', 'like', '%' . $option . '%')
            ->where(function ($query) use ($keyword) {
                $query->where('status', 'like', '%' . $keyword . '%')
                    ->orwhere('doctorid', '=', $keyword)
                    ->orwhere('timeindex', '=', $keyword);
            })
            ->paginate(20);
        Session()->flash('done', 'Tìm kiếm kết quả cho từ khóa: ' . $keyword . ' & ' . $option);
        return $schedules;
    }
    public static function searchByClinic($request, $clinicid)
    {
        $option = $request->input('option') ? $request->input('option') : '';
        $keyword = $request->input('keyword') ? $request->input('keyword') : '';
        $schedules = DB::table('schedules')->select('schedules.*')
            ->join('doctors', 'doctors.id', '=', 'schedules.doctorid')
            ->join('clinics', 'clinics.id', '=', 'doctors.clinicid')
            ->where('clinics.id', '=', $clinicid)
            ->where('date', 'like', '%' . $option . '%')
            ->where(function ($query) use ($keyword) {
                $query->where('schedules.status', 'like', '%' . $keyword . '%')
                    ->orwhere('schedules.doctorid', '=', $keyword)
                    ->orwhere('clinics.fullname', 'like', '%' . $keyword . '%')
                    ->orwhere('doctors.name', 'like', '%' . $keyword . '%')
                    ->orwhere('schedules.timeindex', '=', $keyword);
            })
            ->paginate(20);
        Session()->flash('done', 'Tìm kiếm kết quả cho từ khóa: ' . $keyword . ' & ' . $option);
        return $schedules;
    }
    public static function searchByDoctor($request, $doctorid)
    {
        $option = $request->input('option') ? $request->input('option') : '';
        $keyword = $request->input('keyword') ? $request->input('keyword') : '';
        $schedules = DB::table('schedules')->select('schedules.*')
            ->join('doctors', 'doctors.id', '=', 'schedules.doctorid')
            ->where('doctors.id', '=', $doctorid)
            ->where('date', 'like', '%' . $option . '%')
            ->where(function ($query) use ($keyword) {
                $query->where('schedules.status', 'like', '%' . $keyword . '%')
                    ->orwhere('schedules.timeindex', '=', $keyword);
            })
            ->paginate(20);
        Session()->flash('done', 'Tìm kiếm kết quả cho từ khóa: ' . $keyword . ' & ' . $option);
        return $schedules;
    }
    public static function checkScheduleExist($date, $timeindex, $doctorid)
    {
        $schedule = Schedule::where('doctorid', '=', $doctorid)
            ->where('date', 'like', $date)->where('timeindex', '=', $timeindex)->first();
        if ($schedule) {

            return $schedule;
        }
        return false;
    }
}