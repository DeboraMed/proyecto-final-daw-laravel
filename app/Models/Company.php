<?php

use App\Models\User;

class Company extends Model
{
    public function user()
    {
        return $this->morphOne('App\User', 'userable');
    }

}
