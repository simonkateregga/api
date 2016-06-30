<?php

use App\Lesson;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LessonsTest extends ApiTester
{

    use Factory;

    /** @test */
    public function it_fetches_lessons() 
    {
        $this->times(3)->make('App\Lesson');

        $this->getJson('api/v1/lessons');

        $this->assertResponseOk();
    }

    /** @test */
    public function it_fetches_a_single_lesson() 
    {        
        $this->make('App\Lesson');

        $lesson = $this->getJson('api/v1/lessons/1')->data;

        $this->assertResponseOk();
        $this->assertObjectHasAttributes($lesson, 'body', 'active');
    }

    /** @test */
    public function it_404s_if_a_lesson_is_not_found() 
    {
        $lesson = $this->getJson('api/v1/lessons/x')->error;

        $this->assertResponseStatus(404);
        $this->assertObjectHasAttribute('status_code', $lesson);
        $this->seeStatusCode(404);       
    }

    /** @test */
    public function it_creates_a_new_lesson_given_valid_parameters() 
    {
        $this->withoutMiddleware()->post('api/v1/lessons', $this->getStub());
        $this->assertResponseStatus(201);
        $this->seeStatusCode(201);       
    }

    /** @test */
    public function it_throws_422_if_new_lesson_request_fails_validation() 
    {
        $this->withoutMiddleware()->getJson('api/v1/lessons', 'POST');
        $this->assertResponseStatus(422);
        $this->seeStatusCode(422);       
    }

    /** @test */
    public function it_paginates_when_multiple_lessons_are_created()
    {
        $this->times(20)->make('App\Lesson');
        $paginator = $this->getJson('api/v1/lessons')->paginator;

        $this->assertObjectHasAttributes($paginator, 'total_count', 'total_pages', 'current_page', 'limit');
        $this->assertEquals($paginator->total_count, 20);
        $this->assertEquals($paginator->current_page, 1);
    }

    /**
     * Get faker properties for the lesson.
     * 
     * @return array
     */
    public function getStub() 
    {
        return [
            'title' => $this->fake->sentence,
            'body' =>$this->fake->paragraph,
            'some_bool' => $this->fake->boolean
        ];
    }   
}
