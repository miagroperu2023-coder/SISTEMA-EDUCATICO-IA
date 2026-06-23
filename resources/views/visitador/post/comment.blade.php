@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('main')
    <section class="mt-4" id="contenido-bloques">
        <div class="contenedor">
            <div class="row">
                <div class="col-md-12">
                    @livewire('post-comment', ['post' => $post], key($user->id))
                </div>

            </div>
        </div>

        <div class="container">
            <div class="row">
                @foreach ($randomPosts as $post)
                    <div class="col-md-4">
                        <div class="mi-card my-2">
                            <div class="mi-card-content">
                                <a href="{{ route('visitador.post.comment', ['post' => $post]) }}">
                                    <div class="d-flex align-items-center">
                                        <i class='bx bx-link-alt color-general' style="font-size: 15px"></i>
                                        <h1 class="lead color-general" style="font-size: 16px">
                                            <strong>{{ $post->title }}</strong>
                                        </h1>
                                    </div>
                                </a>

                                <div class="d-flex justify-content-between align-items-center">
                                    <small>Por:
                                        <strong
                                            style="display: inline-block; width: 25px; height: 25px; background-color: #1a1f71; color: white; border-radius: 50%; text-align: center; line-height: 25px; font-weight: bold;">
                                            {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                        </strong>
                                    </small>

                                    <div>{{ $post->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('template.footer')
@endsection
