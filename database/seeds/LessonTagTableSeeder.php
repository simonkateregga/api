<?php

use App\Tag;
use App\Lesson;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class LessonTagTableSeeder extends Seeder
{ 
    public function run() {
        $faker = Faker::create();

        $lessonIds = Lesson::lists('id')->toArray();
        $tagIds = Tag::lists('id')->toArray();

        foreach(range(1, 30) as $index) {
            DB::table('lesson_tag')->insert([
                'lesson_id' => $faker->randomElement($lessonIds),
                'tag_id' => $faker->randomElement($tagIds)
            ]);
        }
    }
}
