@extends('layouts.app')

@section('content')

    <div class="blog-header">
        <div class="container">
            <div class="fa-pull-right">{{ \Carbon\Carbon::now()->format('l jS \\of F Y h:i:s A') }}</div>
            <h1 class="blog-title">
                {{ $content->curse->title }}
            </h1>

        </div>
    </div>

    <div class="container">

        <div class="row">

            <div class="col-sm-8 blog-main">
                <div class="container">
                    <div class="row">
                        <div class="col-3">
                            <div class="blog-post">

                                <p class="blog-post-meta">Fecha: {{ $content->created_at }}</p>

                                <p class="blog-post-meta">Images: {{ count($content->images) }}</p>

                                @if($content->hasImage($content))

                                    @foreach($content->images as $image)
                                        <em>Titulo: </em>{{ $image->title }}
                                        <p></p>
                                        <div class="text-center ">
                                            <img src="{{ asset('storage/'.$image->path) }}" class="img-fluid rounded img-thumbnail" alt="" width="120" height="90">
                                        </div>
                                        <em><p>Fuente:</em> {{ $image->source }}</p>
                                        <hr>

                                    @endforeach

                                @endif

                            </div>

                        </div>

                        <div class="col-6">
                            <p class="blog-post-meta">{{ $content->title }}</p>

                                {{ $content->body }}

                        </div>
                    </div>

                </div>
                <?php $sig = $content->id + 1 ?>
                <?php $ant = $content->id - 1 ?>
                <nav class="blog-pagination">
                    <a class="btn btn-outline-primary {{ $content->id == 1?"disabled":"" }}" href="{{ route('contents.show', $ant) }}">Anterior</a>
                    <a class="btn btn-outline-primary {{ $content->isLast($content->id)?"disabled":"" }}" href="{{ route('contents.show', $sig) }}">Siguiente</a>
                </nav>

            </div><!-- /.blog-main -->

            <div class="col-sm-3 offset-sm-1 blog-sidebar">
                <div class="sidebar-module sidebar-module-inset">
                    <p><i class="fas fa-list-alt"></i> <em><a href="{{ route('contents.create', $content) }}"> Actualizar contenido </a></em></p>
                    <p><i class="fas fa-list-alt"></i> <em><a href="{{ route('contents.create', $content) }}" data-toggle="modal" data-target="#exampleModal"> Agregar imagen </a></em></p>
                </div>
            </div><!-- /.blog-sidebar -->

        </div><!-- /.row -->

    </div><!-- /.container -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nueva imagen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <em>Contenido: {{ $content->title }}</em>
                    <form action="{{ route('images.store', $content) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="image" id="image">
                        title:
                        <input type="text" name="imageTitle" id="title">
                        Fuente:
                        <input type="text" name="source" id="source">
                        <input type="submit" value="Aceptar">
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection