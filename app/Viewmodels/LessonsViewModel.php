<?php
namespace app\Viewmodels;

use app\Repository\LessonRepository;

/**
 *
 * @author jj
 *        
 */
class LessonsViewModel
{   
    public static function getLessons($userId)
    {
        $lessons = LessonRepository::getLessonsByUser($userId);
        return LessonsViewModel::transformLessons($lessons);
    }
    private static function transformLessons($lessons)
    {
        $arrayOfLessons = array();
        foreach($lessons as $nextUserLesson)
        {
            $arrayOfLessons[] = new LessonViewModel($nextUserLesson);
        }
        return $arrayOfLessons;
    }

}

