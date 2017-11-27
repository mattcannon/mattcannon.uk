<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use League\CommonMark\CommonMarkConverter;

class Post extends Model
{
    protected $guarded =[];

    public function getFormattedBodyAttribute()
    {
        $converter = new CommonMarkConverter();

        return $converter->convertToHtml($this->attributes['body']);
    }
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }


}
