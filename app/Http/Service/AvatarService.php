<?php

namespace App\Http\Service;

use App\Models\AvatarImage;
use Illuminate\Support\Facades\File;
use PHPUnit\Exception;

class AvatarService
{
    public static function changeAvatar($userid, $image, $folder)
    {
        // check xem user này đã có ảnh chưa? 
        // nếu chưa thì tạo instance để lưu lại
        // nếu có rồi thì xóa file cũ đi rồi update lại tên ảnh
        $result = true;
        try {
            $currentAvatar = AvatarImage::where('userid', $userid)->first();
            if (!$currentAvatar) {
                AvatarImage::create([
                    'userid' => $userid,
                    'image' => $image
                ]);
            } else {
                if (File::exists(public_path("/$folder/" . $currentAvatar->image))) {
                    File::delete(public_path("/$folder/" . $currentAvatar->image));
                }
                $currentAvatar->image = $image;
                $currentAvatar->save();
            }
        } catch (Exception $e) {
            $result = false;
        }
        return $result;
    }
    public static function getAvatarOf($users)
    {
        // nếu truyền vào mảng -> trả về avatar tương ứng
        // truyền vào 'all' trả về tất cả
        // truyền vào số int trả về avatar của id đó
        if (is_int($users)) {
            return AvatarImage::where('userid', $users)->first() ? AvatarImage::where('userid', $users)->first()->image : 'default_avatar.jpg';
        }
        if ($users != 'all') {
            $temp = [];
            foreach ($users as $user) {
                $image = AvatarImage::where('userid', $user->id)->first();
                if ($image) {
                    $temp[$user->id] = $image->image;
                } else {
                    $temp[$user->id] = 'default_avatar.jpg';
                }

            }
            return $temp;
        }
        return AvatarImage::all();
    }
    public static function delete($userid, $folder)
    {
        $result = true;
        try {
            $currentAvatar = AvatarImage::where('userid', $userid)->first();
            if ($currentAvatar) {
                if (File::exists(public_path("/$folder/" . $currentAvatar->image))) {
                    File::delete(public_path("/$folder/" . $currentAvatar->image));
                }
                $currentAvatar->delete();
            }
        } catch (Exception $e) {
            return false;
        }
        return $result;
    }
}