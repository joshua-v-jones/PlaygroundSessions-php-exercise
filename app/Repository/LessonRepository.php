<?php
namespace App\Repository;
/**
 * Database repository to perform DB queries necessary for
 * the lesson model
 * @author jj
 *
 */
use App\Models\Lesson;
use App\Models\Segment;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        ->limit(5)
        ->get();
         //Lesson::all()->where([['user_id','=', $userId],['is_published', '=', 'true']])->toArray();
    }
    /**
     * Gets all segments for a particular lesson
     */
    public static function getLessonSegments($lessonId)
    {
        $segments = Segment::all()->where('lesson_id','=', $lessonId);
        return $segments;
    }
}