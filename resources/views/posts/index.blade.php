@extends('layouts.app')

@section('content')
<div class="container">
  @foreach ($posts as $post)
    <div class="row post_section p-4">
      <div class="col-8">
        <a href="/profile/{{  $post->user->id  }}">
          <img class="w-100" src="/storage/{{  $post->image  }}" alt="{{  $post->caption  }}">
        </a>
      </div>
      <div class="col-4">
        <div class="d-flex align-items-center">
          <div class="pr-3">
            <img src="{{  $post->user->profile->profileImage()  }}" alt="profile pick" class="rounded-circle w-100" style="max-width: 50px;">
          </div>
          <div>
            <div class="font-weight-bold">
              <a href="/profile/{{  $post->user->id  }}">
                <span class="text-dark">
                  {{  $post->user->username  }}
                </span>
              </a>
              <a href="/profile/{{  $post->user->id  }}" class="pl-2">Follow</a>
            </div>
          </div>
        </div>
        <hr>
        <p>
        <span class="font-weight-bold">
          <a href="/profile/{{  $post->user->id  }}">
            <span class="text-dark">
              {{  $post->user->username  }}
            </span>
          </a>
          </span>
          {{  $post->caption  }}
        </p>
      </div>
    </div>
    <hr>
  @endforeach
  <div class="row">
    <div class="col-12 d-flex justify-content-center">
      {{  $posts->links()  }}
    </div>
  </div>
</div>
@endsection