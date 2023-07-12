<?php

namespace App\Http\Service;

use App\Models\Clinic;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class ClinicService
{
    public static function create($request)
    {
        DB::beginTransaction();
        $result = false;
        $user = UserService::create($request, 2);
        try {
            $result = Clinic::create([
                'id' => $user->id,
                'name' => $request->input('name'),
                'fullname' => $request->input('fullname'),
                'address' => $request->input('address'),
                'introduce' => $request->input('introduce'),
                'status' => $request->input('status'),
            ]);
        } catch (Exception $ex) {
            $result = false;
        }
        if (!$result) {
            DB::rollback();
            Session()->flash('error', 'Thêm clinic không thành công');
        } else {
            DB::commit();
            Session()->flash('done', 'Thêm clinic thành công');
        }
    }
    public static function getAll($number)
    {
        // getAll(true) sẽ trả về tất cả k phân trang
        if (is_int($number) == true) {
            return Clinic::paginate((int) $number);
        }
        return Clinic::all();
    }
    public static function getSearch($request)
    {
        $type = $request->input('type') ? $request->input('type') : '';
        $city = $request->input('city') ? $request->input('city') : '';
        $keyword = $request->input('keyword') ? $request->input('keyword') : '';
        $clinics = Clinic::where('address', 'like', '%' . $city . '%')
            ->where('fullname', 'like', '%' . $type . '%')
            ->where(function ($query) use ($keyword) {
                $query->where('address', 'like', '%' . $keyword . '%')
                    ->orwhere('introduce', 'like', '%' . $keyword . '%')
                    ->orwhere('status', 'like', '%' . $keyword . '%')
                    ->orwhere('fullname', 'like', '%' . $keyword . '%');
            })
            ->paginate(8);
        Session()->flash('done', 'Tìm kiếm kết quả cho từ khóa: ' . $keyword . ' & ' . $type . ' & ' . $city);
        return $clinics;
    }
    public static function edit($request)
    {
        DB::beginTransaction();
        $result = true;
        try {
            $clinic = Clinic::find($request->input('id'));
            $clinic->name = $request->input('name');
            $clinic->fullname = $request->input('fullname');
            $clinic->address = $request->input('address');
            $clinic->introduce = $request->input('introduce');
            $clinic->status = $request->input('status');
            $clinic->save();
            $result = UserService::edit($request);
            if ($request->hasFile('image')) {
                $userid = $clinic->id;
                $file = $request->file('image');
                $name = $userid . 'clinic' . time() . $file->getClientOriginalName();
                $storedPath = $file->move('clinicimage', $name);
                $result *= AvatarService::changeAvatar($userid, $name, 'clinicimage');
            }
        } catch (Exception $ex) {
            $result = false;
        }
        // nếu okela hết thì commit còn không thì rollback
        if (!$result) {
            DB::rollback();
            Session()->flash('error', 'Chỉnh sửa clinic không thành công');
        } else {
            DB::commit();
            Session()->flash('done', 'Chỉnh sửa clinic thành công');
        }
    }
    public static function delete($request)
    {
        $result = false;
        try {
            $clinic = Clinic::where('id', $request->input('id'))->first();
            if ($clinic) {
                AvatarService::delete($clinic->id, 'clinicimage');
                $result = $clinic->delete();
            }
        } catch (Exception $ex) {
        }
        if ($result) {
            return response()->json([
                'error' => 'false',
                'message' => 'Xóa clinic thành công'
            ]);
        } else {
            return response()->json([
                'error' => 'true',
                'message' => 'Xóa clinic không thành công'
            ]);
        }
    }

}