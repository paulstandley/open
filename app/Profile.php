<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $guarded = [];

    /**
    * The function returns profile image or default no image.
    *
    * @var function
    */
    public function profileImage()
    {
        $imagePath =  ($this->image) ? $this->image : 'profile/avP2UEIsRwh3BpuUeXJ1sr3sBk9Yg5bfi0xJoi9Y.jpeg';
        return '/storage/' . $imagePath;
    }

    
    /**
    * The followers relaysionship to the function 
    * that returns the model for the user relaysionship.
    *  
    * @return User
    */
    public function followers() 
    {
        return $this->belongsToMany(User::class);
    }

    /**
    * The function returns user model.
    *
    * @return User
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
