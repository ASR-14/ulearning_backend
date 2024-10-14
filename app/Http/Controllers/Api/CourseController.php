<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
class CourseController extends Controller
{
    public function courseList(){

        // return response()->json([
        //     'code'=>200,
        //     'msg'=>'My course list is here',
        //     'data'=> "xxx"
        // ],200);

        try {
            $result = Course::select('name','thumbnail','lession_num','price','id')->get();
        return response()->json([
            'code'=>200,
            'msg'=>'My course list is here',
            'data'=> $result
        ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'code'=> 500,
                'msg'=> 'The field does not exist or you have a syntax error',
                'data'=> $th->getMessage()
                ],500);
        }
    }
}
