@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4 p-1">
            <img class="rounded-circle w-100" src="{{  $user->profile->profileImage()  }}" alt="download image">
        </div>
        <div class="col-8">
           <div class="d-flex justify-content-between align-items-baseline">
                <h2>{{  $user->username  }}</h2>

                <follow-button 
                    follows="{{  $follows  }}" 
                    class="p-1" 
                    user-id="{{  $user->id  }}">
                </follow-button>
                
                @can ('update', $user->profile)
                    <a class="btn btn-primary" href="/profile/{{  $user->id  }}/edit">Edit Profile</a>
                @endcan
                <a class="button btn btn-primary" href="{{ url('p/create') }}">Add New Post</a>
           </div>
            <section class="d-flex sec">
                <h4><strong>{{  $postCount  }}</strong> Posts</h4>
                <h4><strong>{{  $followersCount  }}</strong> Followers</h4>
                <h4><strong>{{  $followingCount  }}</strong> Following</h4>
            </section>
            @if ( $user->profile != null )
                <h3>{{  $user->profile->title  }}</h3>
                <p>{{  $user->profile->description  }}</p>
                <a href="{{  $user->profile->url  }}" target="_blank">{{  $user->profile->url  }}</a>
            @endif
        </div>
        <br>
        <div class="row pt-5">
            @foreach ($user->posts as $post)
                <div class="col-4 pb-4">
                    <a href="/p/{{  $post->id  }}">
                        <img class="w-100" src="/storage/{{ $post->image }}" alt="{{  $post->caption  }}">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection