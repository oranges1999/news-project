<?php 

namespace App\ModelFilters;

use App\Enums\Status;
use EloquentFilter\ModelFilter;

class UserPostFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */

    public function setup(){
        $this->where('status',Status::Publish);
    }

    public function category($category)
    {
        if ($category!=='none') {
            return $this->related('category','category_id',$category);
        }
    }

    public function search($search)
    {
        if ($search) {
            return $this->whereLike('title',$search);
        }
    }

    public function author($author){
        if ($author) {
            return $this->related('user','user_id',$author);
        }
    }

    public function tags($tags){
        if ($tags) {
            return $this->whereHas('tags', function($query) use ($tags)
            {
                return $query->whereIn('tag_id', $tags);
            });
        }
    }

}
