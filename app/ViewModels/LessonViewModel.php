<?php
namespace App\Viewmodels;

use App\Repository\LessonRepository;

/**
 *  Lesson View Model class used to seperate the Db models and queries from the view
 *
 * @author jj
 *
 */
class LessonViewModel
{    
    /**
     * @param @app/Models/Lesson $lesson a raw DB object to be parsed and put into the new dta structure
     */
    public function __construct()
    {

    }
    
    public function getLessons($userId)
    {
        $lessonsByUserId = LessonRepository::getLessonsByUser($userId);
        foreach ($lessonsByUserId as $nextLesson)
        {
            
        }
    }

}