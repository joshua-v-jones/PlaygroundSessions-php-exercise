<?php

namespace app\Http\Controllers;

use Illuminate\Http\JsonResponse;
use app\Viewmodels\LessonsViewModel;

class StudentProgressController extends Controller
{
    public function get(int $userId): JsonResponse
    {
        return "BLAH";
//         return response()->json(
//             LessonsViewModel::getLessons($userId)
//             );
    }
}
