<?php
namespace App\Viewmodels;

use App\Repository\LessonRepository;
use App\Models\UserLessons;

/**
 *  Lesson View Model class used to seperate the Db models and queries from the view
 *
 * @author jj
 *
 */
class LessonViewModel
{    
    
    public static function getLessons($userId)
    {
        //Create a new UserLesson object to populate with requested data
        $userLessons = new UserLessons();
        $lessonsByUserId = LessonRepository::getLessonsByUser($userId);
        foreach ($lessonsByUserId as $nextLesson)
        {
            $lessonSegments = LessonRepository::getLessonSegments($nextLesson->id);
            $userLessons->addUserLesson($nextLesson, $lessonSegments);
        }
        return $userLessons->toJson();
    }

}