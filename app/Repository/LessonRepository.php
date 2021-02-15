<?php
namespace app\Repository;

use App\Models\Lesson;
use App\Models\Segment;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Database repository to perform DB queries necessary for 
 * the lesson model
 * @author jj
 *        
 */
class LessonRepository
{
    
    /**
     * Gets all lessons for a particular user
     * @param int $userid
     */
    public static function getLessonsByUser($userId)
    {
       return Lesson::with(['segments','segments.practiceRecords' => function(HasMany $query) use ($userId) {
                $query->where('user_id', $userId);
            }])
            ->where('is_published',true)
            ->get()
            ->toArray();
    }
    /**
     * Gets all segments for a particular lesson
     */
    public static function getLessonSegments($lessonId)
    {
         $segments = Segment::all()->where('lesson_id','==', $lessonId);
         return $segments;
    }
}

