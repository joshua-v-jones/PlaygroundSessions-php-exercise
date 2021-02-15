<?php

namespace App\Http\Controllers;


use App\Viewmodels\LessonViewModel;
use Illuminate\Http\JsonResponse;

class StudentProgressController extends Controller
{
    
    public function get(int $userId):JsonResponse
    {
        return response()->json(LessonViewModel::getLessons($userId));
    }
}
