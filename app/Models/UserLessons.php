<?php

namespace App\Models;

use Illuminate\Contracts\Support\Jsonable;
use App\Repository\LessonRepository;

class UserLessons implements Jsonable
{
    //An array of UserLesson objects ready to be consumbed by a REST endpoint
    private $userLessons;
    
    public function __construct($lessons, $segments)
    {
        $this->setUserLessons($lessons, $segments);
    }
    
    /**
     * @param Lesson $lessons A list of lessons for a particular user
     */
    public function setUserLessons($lessons, $segments)
    {
        foreach ($userLessons as $nextUserLesson)
        {
            $newUserLesson = new UserLesson($nextUserLesson, $segments);
            $this->userLessons[] = $newUserLesson;
        }
    }

    public function toJson($options = 0)
    {       
        return array('lessons' => $this->userLessons);
    }
}