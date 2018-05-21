@extends('layouts.app')

@section('content')

    <div class="blog-header">
        <div class="container">
            <h1 class="blog-title">Crear curso</h1>
            <p class="lead blog-description">Modulo para administradores</p>
        </div>
    </div>

    <div class="container">

        <div class="row">

            <div class="col-sm-8 blog-main">

                <div class="blog-post">
                    <h2 class="blog-post-title">Creacion de un nuevo curso</h2>

                    <p class="blog-post-meta">{{ \Carbon\Carbon::now()->format('l jS \\of F Y h:i:s A') }}</p>

                    <form action="{{ route('curses.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Titulo del curso</label>
                            <input type="text" class="form-control" name = "title" id="title" aria-describedby="title" placeholder="title here">
                            <small id="title" class="form-text text-muted">Titulo del curso, no mas de 50 caracteres</small>
                        </div>
                        <div class="form-group">
                            <label for="lessons">Lecciones del curso</label>
                            <input type="number" class="form-control" name="lessons" id="lessons" placeholder="Lessons quantity">
                            <small id="title" class="form-text text-muted">Solo números, entre 1 y 64</small>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="premium" id="premium">
                            <label class="form-check-label" for="premium">¿Es un curso premium?</label>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Imagen del Curso</label>
                            <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                        </div>

                        <button type="submit" class="btn btn-primary">Aceptar</button>

                    </form>
                </div><!-- /.blog-post -->

                <nav class="blog-pagination">
                    <a class="btn btn-outline-primary" href="#">Older</a>
                    <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
                </nav>

            </div><!-- /.blog-main -->

            <div class="col-sm-3 offset-sm-1 blog-sidebar">
                <div class="sidebar-module sidebar-module-inset">

                    @include('partials.errors')
                </div>
            </div><!-- /.blog-sidebar -->

        </div><!-- /.row -->

    </div><!-- /.container -->
@endsection