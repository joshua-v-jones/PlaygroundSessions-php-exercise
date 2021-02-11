<?php
namespace app\Models;

/**
 *
 * * Small model class that will harness the existing eloquent 
 *  models to create the desired data structure for a single student lesson.
 *
 * @author jj
 *        
 */
class StudentLesson
{

    //Integer used to store the lesson ID of this particular student lesson
    private $lesson_id;
    //String used to get the difficulty of the lesson 
    //and transform it to the desired data structure
    private $difficulty;
    //An array of possible difficulty strings to be used in the setting of the difficulty
    private $difficulty_categories = array("Rookie", "Intermediate", "Advanced");
    //Difficulty used if number is not 1 - 9 
    private $unknown_difficulty = "UNKNOWN";
    //Boolean used to get the completioness of a lesson into the correct structure
    private $isComplete;
    
    /**
     * Empty constructor
     */
    public function __construct($lesson_id)
    {
        $this->lesson_id = $lesson_id;
    }
    
    /**
     * @return mixed
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
     * @param mixed $isComplete
     */
    public function setIsComplete()
    {
        $segments = Segment::all()->where('lesson_id','==', $this->lesson_id);
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

