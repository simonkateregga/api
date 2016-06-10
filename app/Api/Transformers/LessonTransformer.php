<?php

namespace App\Api\Transformers;
use App\Api\Transformers\Transformer;


class LessonTransformer extends Transformer 
{
    /**
     * Transform a Lesson.
     * 
     * @param  Lesson $lesson 
     * @return array
     */
    public function transform($lesson) 
    {
        return [
            'title' => $lesson['title'],
            'body'  => $lesson['body'],
            'active' => (boolean) $lesson['some_bool']
        ];
    }
}