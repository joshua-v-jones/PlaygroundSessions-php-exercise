<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

/**
 *
 * New Lumen migration to generate a view that will seperate the endpoint from the backend data structure.
 * @author Joshua Jones
 *
 */
class CreateStudentProgressView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //To be completed WRITE the correct SQL join to have a view that return the proper data structure
        //The SQL is currently INCOMPLETE and must be refined to return the proper data structure
        DB::statement("
            CREATE VIEW student_progress_view
            AS
            SELECT
                lessons.id,
                Lessons.difficulty,
                Lesson.isComplete
            FROM
                Lessons
                LEFT JOIN ;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_progress_view');
    }
}
