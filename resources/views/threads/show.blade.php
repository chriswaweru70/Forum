@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                <a href="#"> {{ $thread->creator->name }}</a> posted:
                    {{ $thread->title }}
                </div>
                <div class="panel-body">
                    {{ $thread->body }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach($thread->replies as $reply)
               @include ('threads.reply')
            @endforeach
        </div>
    </div>
    @if (auth()->check())
        <div class="row">
            <div class="col-md-8 col-md-offset-2" style="margin-top: 20px;">
            <form method="POST" action="{{ $thread->path() . '/replies'}}">
                {{ csrf_field() }}
                 <div class="form-group">
                    <textarea name="body" id="body" class="form-control" placeholder="Have Something Good to say?" rows="5"></textarea>
                 </div>
                 <button type="submit" class="btn btn-success">Post</button>
            </form>
            </div>
        </div>
    @else 
    <p style="text-align: center">Please <a href="{{ route('login') }}">Signin</a>to participate in this discussion</p>
    @endif
</div>
@endsection