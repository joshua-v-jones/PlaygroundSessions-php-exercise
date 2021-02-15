<?php

namespace App\Models;

use Illuminate\Contracts\Support\Jsonable;
use App\Repository\LessonRepository;

class UserLessons implements Jsonable
{
    //An array of UserLesson objects ready to be consumbed by a REST endpoint
    private $userLessons;
    
    public function __construct($lessons)
    {
        $this->setUserLessons($lessons);
    }
    
    /**
     * @param Lesson $lessons A list of lessons for a particular user
     */
    public function setUserLessons($lessons)
    {
        foreach ($userLessons as $nextUserLesson)
        {
            $nextLessonSegments = LessonRepository::getLessonSegments($nextUserLesson->id);
            $newUserLesson = new UserLesson($nextUserLesson, $nextLessonSegments);
            $this->userLessons[] = $newUserLesson;
        }
    }

    public function toJson($options = 0)
    {       
        return array('lessons' => $this->userLessons);
    }
}