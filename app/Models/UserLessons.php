<?php

namespace App\Models;

use Illuminate\Contracts\Support\Jsonable;
use App\Repository\LessonRepository;

class UserLessons implements Jsonable
{
    //An array of UserLesson objects ready to be consumbed by a REST endpoint
    private $userLessons;
    
    public function __construct()
    {
    }
    /**
     * @param Lesson $lesson A single lesson to add to the array of lessons for the User
     * @param Segment $lessonSegments List of all lesson segments for the given lesson
     */
    public function addUserLesson($lesson, $lessonSegments)
    {
        $newUserLesson = new UserLesson($lesson, $lessonSegments);
        $this->userLessons[] = $newUserLesson;
    }

    public function toJson($options = 0)
    {       
        return array('lessons' => $this->userLessons);
    }
}