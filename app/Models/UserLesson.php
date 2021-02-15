<?php

namespace App\Models;


use Illuminate\Contracts\Support\Jsonable;

class UserLesson implements Jsonable
{
    /**
     * Class variables needed by the model for later access
     */    
    //The lesson object that will be used to simplify and decouple the DB calls
    private $lesson;
    //All segements for the lesson object
    private $segments;
    //The lessson ID of the lesson that will be used on construction of the data structure
    private $lesson_id;
    //The difficulty string that will be transformed from numbers to the appropriate string found in the
    //$difficulty_categories array declared below
    private $difficulty;
    //The boolean to be set based on the user practice segments attached to the lesson
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
     * @param @app/Models/Segment $segments a raw DB object to be parsed and put into the new dta structure
     */
    public function __construct($lesson, $segments)
    {
        //Set the lesson id
        $this->lesson_id = $lesson->id;
        $this->setDifficulty($lesson->difficulty);
        $this->setIsComplete($segments);
    }
    public function toJson($options = 0)
    {
        return
        [
            'id'   => $this->getLesson_id(),
            'difficulty' => $this->getDifficulty(),
            'isComplete' => $this->getIsComplete()
        ];
    }
    /**
     * @return mixed
     */
    public function getLesson_id()
    {
        return $this->lesson_id;
    }

    /**
     * @return string
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * @return mixed
     */
    public function getIsComplete()
    {
        return $this->isComplete;
    }

    /**
     * @param mixed $lesson_id
     */
    public function setLesson_id($lesson_id)
    {
        $this->lesson_id = $lesson_id;
    }

    /**
     * This function will be used to convert the DB value to the desired
     * string of Rookie [1,2,3] Intermediate[4,5,6] and Advanced[7,8,9]
     * @param integer $difficulty Must be a vlaue between 1-9
     */
    public function setDifficulty($difficulty)
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
     * @param Segment $segments all practice segments for a lesson
     */
    public function setIsComplete($segments)
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
            //If a single non-complete segment is found the lesson is incomplete
            //and we can stop iterating
            //Check if the segment is NOT complete
            if(!$isSegmentComplete)
            {
                $isLessonComplete = false;
                break;
            }
        }
        $this->isComplete = $isLessonComplete;
    }

}