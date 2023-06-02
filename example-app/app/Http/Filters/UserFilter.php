<?php


namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class UserFilter extends AbstractFilter
{

    public const FIRST = 'first';
    // public const DESCRIBE = 'describe';
    // public const SORT = 'sort';
    // public const CATEGORE = 'categore';
  
    protected function getCallbacks(): array
    {
        return [
            self::FIRST => [$this, 'first'],
            // self::DESCRIBE => [$this, 'describe'],
            // self::SORT => [$this, 'sort'],
            // self::CATEGORE => [$this, 'categore'],
        ];
    }

    public function first(Builder $builder, $value)
    {
        $builder->where('first_name', 'like', "%{$value}%");
      
       // $builder->orderBy('id')->get();
    }
   
    // public function describe(Builder $builder, $value)
    // {
    //     $builder->where('describe', 'like', "%{$value}%");
    // }

    // public function sort(Builder $builder, $value)
    // {
    //     if ($value=="ascending")
    //     $builder->orderByDesc('title')->get();
    //        else
    //     $builder->orderBy('title')->get();
             
    // }
  
    // public function categore(Builder $builder, $value)
    // {
    //     $builder->where('сategory_id',$value);
    // }
}
