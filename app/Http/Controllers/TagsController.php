<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Lesson;
use App\Http\Requests;
use App\Api\Transformers\TagTransformer;

class TagsController extends apiController
{

    /**
     * Transformer property.
     * 
     * @var TagTransformer
     */
    protected $tagTransformer;

    
    public function __construct(TagTransformer $tagTransformer) 
    {
        $this->tagTransformer = $tagTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lessonId = null) 
    {
        $tags = $this->getTags($lessonId);

        return $this->respond([
            'data' => $this->tagTransformer->transformCollection($tags->all())
            ]);       
    }

    /**
     * Get the lesson's tags
     * 
     * @param  Integer $lessonId 
     * @return Tag           
     */
    public function getTags($lessonId = null) 
    {
        return $lessonId ? Lesson::findorfail($lessonId)->tags : Tag::all();
    }
}
