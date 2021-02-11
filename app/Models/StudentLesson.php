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
    //Boolean used to get the completioness of a lesson into the correct structure
    private $isComplete;
    
    /**
     * Empty constructor
     */
    public function __construct()
    {
        
    }
    
    /**
     * @return mixed
     */
    public function getLesson_id()
    {
        return $this->lesson_id;
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
     * @param mixed $lesson_id
     */
    public function setLesson_id($lesson_id)
    {
        $this->lesson_id = $lesson_id;
    }

    /**
     * @param mixed $difficulty
     */
    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;
    }

    /**
     * @param mixed $isComplete
     */
    public function setIsComplete($isComplete)
    {
        $this->isComplete = $isComplete;
    }
}

