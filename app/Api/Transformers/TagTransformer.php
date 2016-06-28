<?php

namespace App\Api\Transformers;
use App\Api\Transformers\Transformer;


class TagTransformer extends Transformer 
{
    /**
     * Transform a Tag.
     * 
     * @param  Tag $tag 
     * @return array
     */
    public function transform($tag) 
    {
        return [
            'name' => $tag['name']
        ];
    }
}