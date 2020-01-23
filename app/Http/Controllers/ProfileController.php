<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the user profile.
     *
     * @param  $user 
     * @var $follows $postCount $followersCount $followingCount
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $postCount = Cache::remember(
            'count.post.' . $user->id,
            now()->addSeconds(30),
            function() use ($user) 
            {
                return $user->posts->count();
            }
        );
        $followersCount = Cache::remember(
            'count.followers.' . $user->id,
            now()->addSeconds(30),
            function() use ($user) 
            {
                return $user->profile->followers->count();
            }
        ); 

        $followingCount = Cache::remember(
            'count.following.' . $user->id,
            now()->addSeconds(30),
            function() use ($user) 
            {
                return $user->following->count();
            }
        );

        $follows = (auth()->user())
        ? auth()->user()->following->contains($user->id) : false;

        return view('profiles.index', compact('user', 'follows', 'postCount','followersCount', 'followingCount'));
    }

    /**
     * Show the form for editing the user profile.
     *
     * @param  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }
        
    /**
     * Show the form for updateing the user profile.
     * @var $data $imagePath $image $imageArray
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        $this->authorize('update', $user->profile);
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url'  => 'url',
            'image' => '',
        ]);

        if(request('image')) 
        {
            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();
            $imageArray = ['image' => $imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect("/profile/{$user->id}");
    }

}
