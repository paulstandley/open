<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $guarded = [];

    /**
    * The function returns post model.
    *
    * @var function
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
