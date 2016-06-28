<?php
use App\Lesson;
use App\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Tables to truncate
     * 
     * @var array
     */
    protected $tables = [
        'lessons',
        'tags',
        'lesson_tag'
    ];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->cleanDatabase();
        Eloquent::unguard();

        $this->call('LessonsTableSeeder');
        $this->call('TagsTableSeeder');
        $this->call('LessonTagTableSeeder');
    }

    /**
     * Clean Database
     * 
     * @return void
     */
    public function cleanDatabase() 
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach( $this->tables as $tableName) {
            DB::table($tableName)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
