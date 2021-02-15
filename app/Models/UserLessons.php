<?php

namespace App\Models;

use JsonSerializable;
use Illuminate\Contracts\Support\Jsonable;

/**
 *  App\Models\UserLessons
 *  A JSONSerializable model class used to seperate the data structure
 *  defined by the DB schema to the desired simplified structure.
 *
 *  Represents all Lessons by a user
 * @author jj
 *
 */

class UserLessons implements JsonSerializable, Jsonable
{
    //An array of UserLesson objects 
    private $userLessons;
    
    /**
     * Simple function to create a new UserLesson.php and add it to the array userLessons from $this class
     * 
     * @param app\Models\Lesson.php $lesson A single lesson to add to the array of lessons for the User
     * @param app\Models\Segment.php $lessonSegments List of all lesson segments for the given lesson
     */
    public function addUserLesson($lesson, $lessonSegments)
    {
        $newUserLesson = new UserLesson($lesson, $lessonSegments);
        $this->userLessons[] = $newUserLesson;
    }
    /*
     * Required function by JsonSerilizable used to get the UserLessons into the desired format
     * This will be the JSON format returned when $this object is json_encoded
     */
    public function jsonSerialize()
    {
        return array('lessons' => $this->userLessons);
    }
    /*
     * Illuminate function required used to get the expected JSON when consumed by a controller
     */
    public function toJson($options = 0)
    {
        return json_encode($this, JSON_PRETTY_PRINT);
    }


}