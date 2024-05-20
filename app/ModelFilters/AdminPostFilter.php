<?php 

namespace App\ModelFilters;

use App\Enums\UserRole;
use EloquentFilter\ModelFilter;
use Illuminate\Support\Facades\Auth;

class AdminPostFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public function setup()
    {
        if (Auth::user()->role===UserRole::Writer) {
            $this->related('user','user_id',Auth::id());
        }
    }

    public function status($status)
    {
        if ($status!=='none') {
            return $this->where('status',$status);
        }
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

   
}
