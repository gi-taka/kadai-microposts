@extends('layouts.app')

@section('content')
<ul class="media-list">
    <div class="row">
        <aside class="col-sm-4">
            @include('users.card', ['user' => $user])
        </aside>
        <div class="col-sm-8">
            @include('users.navtabs', ['user' => $user])
        @foreach ($microposts as $micropost)
            <li class="media mb-3">
                <img class="mr-2 rounded" src="{{ Gravatar::src($micropost->user->email, 50) }}" alt="">
                <div class="media-body">
                    <div>
                        {!! link_to_route('users.show', $micropost->user->name, ['id' => $micropost->user->id]) !!} <span class="text-muted">posted at {{ $micropost->created_at }}</span>
                    </div>
                    <div>
                        <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                    </div>
                    <div class="row">
                    @if ($user->find(Auth::id())->is_favorite($micropost->id))
                        {!! Form::open(['route' => ['favorites.unfavorite', $micropost->id], 'method' => 'delete']) !!}
                            {!! Form::submit('Unavorite', ['class' => 'btn btn-success btn-sm ml-3']) !!}
                        {!! Form::close() !!}
                    @else
                        {!! Form::open(['route' => ['favorites.favorite', $micropost->id], 'method' => 'store']) !!}
                            {!! Form::submit('Favorite', ['class' => 'btn btn-light btn-sm ml-3']) !!}
                        {!! Form::close() !!}
                    @endif
                    @if (Auth::id() == $micropost->user_id)
                        {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    @endif
                    </div>
                </div>
            </li>
        @endforeach
        </div>
    </div>
</ul>
{{ $microposts->links('pagination::bootstrap-4') }}
@endsection