<?php

use App\Models;

class UserLesson
{
    /**
     * Class variables needed by the model for later access
     */    
    //The lesson object that will be used to simplify and decouple the DB calls
    private $lesson;
    //The current difficulty to be set using the categories
    private $difficulty;
    //Boolean to be set based on segments within.
    private $isComplete;
    
    /*
     * Constant variables to house static strings
     */
    //An array of possible difficulty strings to be used in the setting of the difficulty
    private $difficulty_categories = array("Rookie", "Intermediate", "Advanced");
    //Difficulty used if number is not 1 - 9
    private $unknown_difficulty = "UNKNOWN";

    
    /**
     * @param @app/Models/Lesson $lesson a raw DB object to be parsed and put into the new dta structure
     */
    public function __construct($lesson)
    {
        $this->lesson = $lesson;
    }
    /**
     * This function will be used to convert the DB value to the desired
     * string of Rookie [1,2,3] Intermediate[4,5,6] and Advanced[7,8,9]
     * @param integer $difficulty Must be a vlaue between 1-9
     */
    private static function getDifficulty($difficulty)
    {
        switch ($difficulty)
        {
            case 1:
            case 2:
            case 3:
                $this->difficulty = $this->difficulty_categories[0];
                break;
            case 4:
            case 5:
            case 6:
                $this->difficulty = $this->difficulty_categories[1];
                break;
            case 7:
            case 8:
            case 9:
                $this->difficulty = $this->difficulty_categories[2];
                break;
            default:
                $this->difficulty= $this->unknown_difficulty;
                break;
        }
    }
    
    /**
     * This function will be used to determine if a lesson is complete by
     * simply passing the lesson id to the function
     * @param Models\Segment $segments all practice segments for a lesson 
     */
    private static function getIsComplete($segments)
    {
        $isLessonComplete = true;
        //Go through all segments for the current lesson
        foreach ($segments as $nextSegment)
        {
            $isSegmentComplete = false;
            //Create a variable of all practice records for tha segment for readability
            $allPracticeRecordsForSegment = $nextSegment->practiceRecords;
            //Go through the practice records to determine if there is a score over 80%
            //If a score of 80% or higher is found we can exit the loop as the segment is complet
            foreach($allPracticeRecordsForSegment as $nextPracticeRecord)
            {
                //Check each practice record score
                //IF a single score is higher than 79 the segment is complete
                if($nextPracticeRecord->score > 79)
                {
                    $isSegmentComplete = true;
                    break;
                }
            }
            //If a sigle non-complete segment is found the lesson is incomplete
            //and we can stop iterating
            //Check if the segment is NOT complete
            if(!$isSegmentComplete)
            {
                $isLessonComplete = false;
                break;
            }
        }
    }
    
}