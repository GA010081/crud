@extends('layouts.master')

@section('title', '文章列表')

@section('content')
<!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url('{{ asset('img/home-bg.jpg') }}')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1>文章列表</h1>
                    <hr class="small">
                    <span class="subheading">歡迎瀏覽本平台文章</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div>
                        @if(session('message'))

                        {{ session('message') }}

                        @endif
                    </div>
            <div class="text-right">
                <a href="#" class="btn btn-primary" role="button">新增</a>
            </div>

            @foreach($posts as $index=>$post)
            <div class="post-preview">
                <a href="{{ route('posts.show', $post->id) }}">
                    <h2 class="post-title">
                       {{ ($index+1).'-'.$post->title }}
                    </h2>
                    <h3 class="post-subtitle">
                      {{$post->sub_title}}
                    </h3>
                </a>
                <p class="post-meta">由 <a href="#"></a> 發表於 {{$post->created_at->diffForHumans()}}</p>
            </div>
            <hr>
            @endforeach
            
            <!-- Pager -->
            <nav class="text-center">
                {{$posts->render()}}
            </nav>
        </div>
    </div>
</div>
@endsection