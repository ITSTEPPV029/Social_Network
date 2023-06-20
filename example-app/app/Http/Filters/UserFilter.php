<?php


namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class UserFilter extends AbstractFilter
{
    public const NAME = 'name';
    public const NICK = 'nick_name';
    public const DATE = 'date_of_birth';
    public const GENDER = 'gender';
    public const CITY = 'city';

    public const AGEPET = 'agePet';
    public const GENDERPET= 'genderPet';
    public const KINDPET = 'kindPet';
    
    protected function getCallbacks(): array
    {
        return [
            self::NAME => [$this, 'name'],
            self::NICK => [$this, 'nick_name'],
            self::DATE => [$this, 'dateBirth'],
            self::CITY => [$this, 'city'],
            self::GENDER => [$this, 'gender'],

            self::AGEPET => [$this, 'agePet'],
            self::GENDERPET => [$this, 'genderPet'],
            self::KINDPET => [$this, 'kindPet'],
        ];
    }

    public function name(Builder $builder, $value)
    {
        $builder->where(DB::raw("CONCAT (first_name,' ', last_name)"),'LIKE',"%{$value}%");   
    }
   
    public function nick_name(Builder $builder, $value)
    {
        $builder->where('nick_name', 'like', "%{$value}%");
    }


    public function city(Builder $builder, $value)
    {
        $builder->where('city', 'like', "%{$value}%");      
    }
  

    public function gender(Builder $builder, $value)
    {
        $builder->where('gender', 'like', "%{$value}%");
    }
    public function dateBirth(Builder $builder, $value)
    {
        $builder->whereDate('date_of_birth', '>', $value);
    }


    public function agePet(Builder $builder, $value)
    {
        $builder->whereHas('pets', function ($query) use ($value) {
            $query->where('age', '<', $value);
        });
    }
    public function genderPet(Builder $builder, $value)
    {
        $builder->whereHas('pets', function ($query) use ($value) {
            $query->where('gender', 'LIKE', "%{$value}%");
        });
    }
    public function kindPet(Builder $builder, $value)
    {
        $builder->whereHas('pets', function ($query) use ($value) {
            $query->where('kind_of', 'LIKE', "%{$value}%");
        });
    }
}
