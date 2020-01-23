<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }
    /**
     * Store a newly created resource following toggle profile in storage.
     *
     * @param  $user
     * @return \Illuminate\Http\Response
     */
    public function store(User  $user)
    {
        return auth()->user()->following()->toggle($user->profile);
    }
}
