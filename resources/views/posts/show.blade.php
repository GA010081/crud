@extends('layouts.master')

@section('title', '文章詳細頁')

@section('content')
<!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url('{{ asset('img/post-bg.jpg') }}')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-heading">
                    <h1> {{ $posts->title }}</h1>
                    <h2 class="subheading">{{$posts->sub_title}}</h2>
                    <span class="meta">由 <a href="#">Start Bootstrap</a> {{$posts->updated_at}}</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Post Content -->
<article>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">

                <div class="text-right" style="margin-bottom: 50px;">
                    <a href="{{route('posts.edit',$posts->id)}}" class="btn btn-primary" role="button">編輯</a>
                    

                    {!!Form::open(['route'=>['posts.destroy',$posts->id],'method'=>'delete','style'=>'display:inline'])!!}
                    {!!Form::submit('刪除',['class'=>'btn btn-danger', 'role'=>'button'])!!}
                    {!!Form::close()!!}             
                </div>

                <div style="margin-bottom: 30px;">
                    {{!! $posts->content !!}}
                </div>

                <!-- Comments Form -->
                <div class="well">
                    <h4>留下您的意見：</h4>
                    <form role="form">
                        <div class="form-group">
                            {!! Form::label('name', '姓名：') !!}
                            {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'required']) !!}

                            {!! Form::label('email', 'Email：') !!}
                            {!! Form::email('email', null, ['id' => 'email', 'class' => 'form-control', 'required']) !!}

                            {!! Form::label('content', '內文：') !!}
                            {!! Form::textarea('content', null, ['rows' => 3, 'id' => 'content', 'class' => 'form-control', 'required']) !!}
                        </div>
                        {!! Form::submit('送出', ['class' => 'btn btn-primary']) !!}
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                @foreach($posts->comments as $comment)
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">{{$comment->name}} ({{$comment->email}})
                            <small>{{$comment->created_at}}</small>
                        </h4>
                        留言回覆內容 {{ $comment->content }}
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</article>
@endsection