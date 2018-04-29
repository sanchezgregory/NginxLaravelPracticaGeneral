@extends('layouts.app')

@section('content')

    <div class="blog-header">
        <div class="container">
            <h1 class="blog-title">Crear contenido para el curso {{ $curse->title }}</h1>
            <p class="lead blog-description">Modulo para administradores</p>
        </div>
    </div>

    <div class="container">

        <div class="row">

            <div class="col-sm-8 blog-main">

                <div class="blog-post">
                    <h4 class="blog-post-title">Creacion de un nuevo contenido</h4>

                    <p class="blog-post-meta">{{ \Carbon\Carbon::now()->format('l jS \\of F Y h:i:s A') }}</p>

                    @include('partials.errors')

                    <form action="{{ route('contents.store', $curse) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Titulo del contenido:</label>
                            <input type="text" class="form-control" name = "title" value="{{ old('title') }}" id="title" aria-describedby="title" placeholder="title here">
                        </div>
                        <div class="form-group">
                            <label for="url">Url</label>
                            <input type="text" class="form-control" name="url" value="{{ old('url') }}" id="url">
                        </div>
                        <div class="form-group">
                            <label for="body">Contenido</label>
                            <textarea name="body" id="body" cols="84" rows="6">{{ old('body') }}</textarea>

                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="imageTitle">Titulo de la imagen</label>
                            <input type="text" name="imageTitle" class="form-control" id="imageTitle">
                        </div>
                        <div class="form-group">
                            <label for="source">Origen de la imagen</label>
                            <input type="text" name="source" class="form-control" id="source">
                        </div>
                        <div class="form-group">
                            <label for="image">recurso de imagen</label>
                            <input type="file" name="image" class="form-control-file" id="image">
                        </div>

                        <button type="submit" class="btn btn-primary">Aceptar</button>

                    </form>
                </div><!-- /.blog-post -->

                <nav class="blog-pagination">
                    <a class="btn btn-outline-primary" href="{{ route('curses.show', $curse->id) }}">Regresar</a>
                </nav>

            </div><!-- /.blog-main -->

            <div class="col-sm-3 offset-sm-1 blog-sidebar">
                <div class="sidebar-module sidebar-module-inset">
                    <h4>Acciones</h4>
                    <p><em>Crear nuevo contenido</em></p>
                </div>
            </div><!-- /.blog-sidebar -->

        </div><!-- /.row -->

    </div><!-- /.container -->
@endsection