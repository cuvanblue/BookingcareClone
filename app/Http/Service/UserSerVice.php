<?php

namespace App\Http\Service;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;

class UserService
{
    public static function create($request, $role)
    {
        try {
            $user = User::create([
                'email' => $request->input('email'),
                'role' => $role,
                'password' => Hash::make('password1')
            ]);
            return $user;
        } catch (Exception $ex) {
            return false;
        }
    }
    public static function edit($request)
    {
        try {
            $user = User::find($request->input('id'));
            $user->email = $request->input('email') ? $request->input('email') : $user->email;
            $user->password = $request->input('password') ? Hash::make($request->input('password')) : $user->password;
            $user->save();
            return true;
        } catch (Exception $ex) {
        }
        return false;
    }
    public static function getEmailOf($users)
    {
        // nếu $users là mảng đối tượng thì trả về email tương ứng với mỗi đối tượng
        // nếu getEmailOf('all') thì trả về email của tất cả user
        $temp = [];
        if ($users != 'all') {
            foreach ($users as $user) {
                $check = User::find($user->id);
                if ($check) {
                    $temp[$user->id] = $check->email;
                }
            }
        }
        if ($users == 'all') {
            $checks = User::all();
            foreach ($checks as $check) {
                $temp[$check->id] = $check->email;
            }
        }
        return $temp;
    }
}