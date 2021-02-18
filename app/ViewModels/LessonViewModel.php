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
        //Use the LessonRepo to get all Lessons by user
        $lessonsByUserId = LessonRepository::getLessonsByUser($userId);

        //Iterate all lesson for a user and add them to the UserLessons model
        foreach ($lessonsByUserId as $nextLesson)
        {            
            //$lessonSegments = LessonRepository::getLessonSegments($nextLesson->id);
            $userLessons->addUserLesson($nextLesson);
        }

        //Simply returning the UserLesson object is all that is needed as Illimunate and JsonSerializable do the rest.
        return $userLessons;
    }

}