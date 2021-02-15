<?php

namespace App\Models;

use JsonSerializable;
use Illuminate\Contracts\Support\Jsonable;

class UserLessons implements JsonSerializable, Jsonable
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
    public function jsonSerialize()
    {
        return array('lessons' => $this->userLessons);
    }
    public function toJson($options = 0)
    {
        return json_encode($this, JSON_PRETTY_PRINT);
    }


}