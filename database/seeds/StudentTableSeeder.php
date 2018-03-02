<?php
use App\Student;
use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$student = new Student();
        $student->name = str_random(10);
        $student->age = rand(1,100);
        $student->sex = array_rand([10,20,30],1)[0];
        $student->save();*/
        factory('App\Student', 50)->create();
    }
}
