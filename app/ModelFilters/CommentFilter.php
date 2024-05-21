<?php 

namespace App\ModelFilters;

use App\Enums\UserRole;
use EloquentFilter\ModelFilter;
use Illuminate\Support\Facades\Auth;

class CommentFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function setup(){
        return $this->withTrashed();
    }

    public function status($status)
    {
        if ($status!=='none') {
            return $this->where('status',$status);
        }
    }

    public function search($search)
    {
        if ($search) {
            return $this->whereLike('content',$search);
        }
    }
}
