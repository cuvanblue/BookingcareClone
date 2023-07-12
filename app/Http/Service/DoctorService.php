<?php

namespace App\Http\Service;

use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class DoctorService
{
    public static function create($request)
    {
        DB::beginTransaction();
        $result = Clinic::find($request->input('clinicid'));
        if ($result) {
            try {
                $user = UserService::create($request, 1);
                $result = Doctor::create([
                    'id' => $user->id,
                    'name' => $request->input('name'),
                    'address' => $request->input('address'),
                    'phone' => $request->input('phone'),
                    'gender' => $request->input('gender'),
                    'price' => $request->input('price'),
                    'clinicid' => $request->input('clinicid'),
                    'career' => $request->input('career'),
                    'specialize' => $request->input('specialize'),
                    'degree' => $request->input('degree'),
                    'status' => $request->input('status'),
                ]);
            } catch (Exception $ex) {
                $result = false;
            }
        }
        if (!$result) {
            DB::rollback();
            Session()->flash('error', 'Thêm Doctor không thành công');
        } else {
            DB::commit();
            Session()->flash('done', 'Thêm Doctor thành công');
        }

    }
    public static function fix()
    {
        $doctors = Doctor::all();
        foreach ($doctors as $doctor) {
            $doctor->career =
                '**PGs.Ts.Bs.Nguyễn Thị Hoài An - Phẫu thuật cắt Amidan/nạo VA**

* Chuyên gia đầu ngành về Tai mũi họng và phẫu thuật Tai mũi họng 

* Nguyên Trưởng khoa Tai Mũi Họng trẻ em, Bệnh viện Tai Mũi Họng Trung ương

* Trên 25 năm công tác tại Bệnh viện Tai Mũi Họng Trung ương 

**Thông tin phẫu thuật cắt Amidan/nạo VA**

**Phương pháp phẫu thuật**

Cắt amidan/nạo VA bằng coblator công nghệ plasma, đây gần như là phương pháp hiện đại nhất trong phẫu thuật Amidan, VA. Phương pháp này giúp bệnh nhân rút ngắn thời gian phẫu thuật và thời gian hồi phục sau phẫu thuật.

**Thời gian phẫu thuật:  ** Khoảng 30 - 45 phút 

**Quy trình phẫu thuật **

* Bước 1: Thăm khám với PGs.Ts.Bs. Nguyễn Thị Hoài An

* Bước 2: Thực hiện các dịch vụ cận lâm sàng theo chỉ định để đảm bảo an toàn trước phẫu thuật.

* Bước 3: Nếu sức khỏe đủ điều kiện sẽ được sắp xếp lịch phẫu thuật trong cùng ngày 

**Thời gian xuất viện:** Trong ngày hoặc sau 24h (tùy thuộc tình trạng sức khỏe bệnh nhân) 

**Chế độ bảo hiểm**

* Bảo hiểm y tế nhà nước: Bệnh nhân được chi trả theo quy định nhà nước. Thông thường danh mục được chi trả tại các bệnh viện tư nhân tương đối thấp.

* Bảo hiểm tư nhân: Với bảo hiểm bảo lãnh trực tiếp sẽ được bệnh viện hướng dẫn để khấu trừ trực tiếp khi thực hiện phẫu thuật. Trường hợp còn lại sẽ được hỗ trợ hoàn thành giấy tờ để bệnh nhân tự thanh toán với công ty bảo hiểm.

**Địa chỉ phẫu thuật**

Bệnh nhân thực hiện phẫu thuật tại Bệnh viện Đa khoa An Việt. Tai Mũi Họng là chuyên khoa mũi nhọn của Bệnh viện An Việt với sự góp mặt của nhiều PGS.TS đầu ngành, đã công tác nhiều năm tại Bệnh viện Tai mũi họng Trung ương.

Hiện nay, Bệnh viện An Việt áp dụng công nghệ Plasma hiện đại để phẫu thuật cắt amidan cho trẻ. Đây là kỹ thuật tiên tiến, an toàn, hiệu quả, nhanh chóng nhất hiện nay, được giới chuyên môn ưu tiên áp dụng.

Phương pháp được thực hiện bởi những bác sỹ chuyên môn cao.';
            $doctor->save();
        }
    }
    public static function getAll($number)
    {
        if (is_int($number)) {
            return Doctor::paginate((int) $number);
        }
        return Doctor::all();
    }
    public static function clinicFilter($clinicid, $paginate)
    {
        if (is_int($paginate)) {
            return Doctor::where('clinicid', $clinicid)->paginate($paginate);
        }
        return Doctor::where('clinicid', $clinicid)->get();
    }
    public static function edit($request)
    {
        DB::beginTransaction();
        $result = Clinic::find($request->input('clinicid'));
        if ($result) {
            try {
                $doctor = Doctor::find($request->input('id'));
                $doctor->address = $request->input('address');
                $doctor->phone = $request->input('phone');
                $doctor->gender = $request->input('gender');
                $doctor->price = $request->input('price');
                $doctor->clinicid = $request->input('clinicid');
                $doctor->career = $request->input('career');
                $doctor->specialize = $request->input('specialize');
                $doctor->degree = $request->input('degree');
                $doctor->status = $request->input('status');
                $doctor->save();
                $result = UserService::edit($request);
                if ($request->hasFile('image')) {
                    $userid = $doctor->id;
                    $file = $request->file('image');
                    $name = $userid . 'doctor' . time() . $file->getClientOriginalName();
                    $storedPath = $file->move('doctorimage', $name);
                    $result *= AvatarService::changeAvatar($userid, $name, 'doctorimage');
                }
            } catch (Exception $ex) {
                $result = false;
            }
        }
        // nếu okela hết thì commit còn không thì rollback
        if (!$result) {
            DB::rollback();
            Session()->flash('error', 'Chỉnh sửa bác sĩ không thành công');
        } else {
            DB::commit();
            Session()->flash('done', 'Chỉnh sửa bác sĩ thành công');
        }
    }
    public static function delete($request)
    {
        $result = false;
        try {
            $Doctor = Doctor::find($request->input('id'));
            if ($Doctor) {
                $result = $Doctor->delete();
            }
        } catch (Exception $ex) {
        }
        if ($result) {
            return response()->json([
                'error' => 'false',
                'message' => 'Xóa Doctor thành công'
            ]);
        } else {
            return response()->json([
                'error' => 'true',
                'message' => 'Xóa Doctor không thành công'
            ]);
        }
    }
    public static function getSearch($request)
    {
        $degree = $request->input('degree') ? $request->input('degree') : '';
        $specialize = $request->input('specialize') ? $request->input('specialize') : '';
        $keyword = $request->input('keyword') ? $request->input('keyword') : '';
        $Doctors = Doctor::where('specialize', 'like', '%' . $specialize . '%')->where('degree', 'like', '%' . $degree . '%')
            ->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orwhere('address', 'like', '%' . $keyword . '%')
                    ->orwhere('phone', '=', $keyword)
                    ->orwhere('gender', '=', $keyword)
                    ->orwhere('price', '=', $keyword)
                    ->orwhere('career', 'like', '%' . $keyword . '%')
                    ->orwhere('status', 'like', '%' . $keyword . '%');
            })->paginate(20);
        Session()->flash('done', 'Tìm kiếm kết quả cho từ khóa: ' . $keyword . ' & ' . $degree . ' & ' . $specialize);
        return $Doctors;
    }
    public static function getDoctorsByClinic($clinicid)
    {
        $Doctors = Doctor::where('clinicid', '=', $clinicid)->paginate(20);
        return $Doctors;
    }
    public static function searchDoctorsByClinic($request, $clinicid)
    {
        $degree = $request->input('degree') ? $request->input('degree') : '';
        $specialize = $request->input('specialize') ? $request->input('specialize') : '';
        $keyword = $request->input('keyword') ? $request->input('keyword') : '';
        $Doctors = Doctor::where('clinicid', '=', $clinicid)->where('specialize', 'like', '%' . $specialize . '%')->where('degree', 'like', '%' . $degree . '%')
            ->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orwhere('address', 'like', '%' . $keyword . '%')
                    ->orwhere('phone', '=', $keyword)
                    ->orwhere('gender', '=', $keyword)
                    ->orwhere('price', '=', $keyword)
                    ->orwhere('career', 'like', '%' . $keyword . '%')
                    ->orwhere('status', 'like', '%' . $keyword . '%');
            })->paginate(20);
        Session()->flash('done', 'Tìm kiếm kết quả cho từ khóa: ' . $keyword . ' & ' . $degree . ' & ' . $specialize);
        return $Doctors;
    }
    public static function getDoctorByBookings()
    {
        $doctors = DB::table('doctors')
            ->join('bookings', 'doctors.id', '=', 'bookings.doctorid')
            ->select('doctors.id', 'doctors.name', 'doctors.degree', 'doctors.specialize', DB::raw('COUNT(bookings.id) as bookings_count'))
            ->groupBy('doctors.id', 'doctors.name', 'doctors.degree', 'doctors.specialize')
            ->orderBy('bookings_count', 'desc')
            ->get();
        return $doctors;
    }
}