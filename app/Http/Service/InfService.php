<?php

namespace App\Http\Service;

use Illuminate\Support\Facades\DB;

class InfService
{
    public static function getcities()
    {
        return $cities = ['Hà Nội', 'Thành phố Hồ Chí Minh', 'Đà Nẵng', 'Vũng Tàu', 'Thừa Thiên - Huế'];
    }
    public static function getalphabet()
    {
        return $alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
    }
    public static function getspecializes()
    {
        $spc = DB::table('doctors')->select('doctors.specialize')->groupBy('doctors.specialize')->get();
        return $spc;
    }
    public static function getdegree()
    {
        $degree = DB::table('doctors')->select('doctors.degree')->groupBy('doctors.degree')->get();
        return $degree;
    }
}