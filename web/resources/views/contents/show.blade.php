@extends('layouts.app')

@section('content')

    <div class="blog-header">
        <div class="container">
            <div class="fa-pull-right">{{ \Carbon\Carbon::now()->format('l jS \\of F Y h:i:s A') }}</div>
            <h1 class="blog-title">
                <a href="{{ route('curses.show', $content->curse) }}"> {{ $content->curse->title }} </a>
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
                                        <em><div class="a">{{ $image->title }}  </div></em>
                                        <p></p>
                                        <div class="text-center ">
                                            <a class="test-popup-link" href="{{ asset('storage/'.$image->path) }}">
                                                <img src="{{ asset('storage/'.$image->path) }}" class="img-fluid rounded img-thumbnail" alt="" width="120" height="90">
                                            </a>
                                        </div>
                                        <hr>

                                    @endforeach

                                @endif

                            </div>

                        </div>

                        <div class="col-6">
                            @include('partials.status')
                            @include('partials.errors')
                            <p class="blog-post-meta">{{ $content->title }}</p>

                                {{ $content->body }}
                            @include('partials.comments')
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
                    <p><i class="fas fa-list-alt"></i> <em><a href="{{ route('contents.edit', $content) }}"> Editar contenido </a></em></p>
                    <p><i class="fas fa-list-alt"></i> <em><a href="{{ route('contents.create', $content) }}" data-toggle="modal" data-target="#addImg"> Agregar imagen </a></em></p>
                    <p><i class="fas fa-list-alt"></i> <em><a href="{{ route('contents.delete', $content) }}" data-toggle="modal" data-target="#deleteContent"> Eliminar contenido </a></em></p>
                </div>
            </div><!-- /.blog-sidebar -->

        </div><!-- /.row -->

    </div><!-- /.container -->

    <!-- Modal -->
    <div class="modal fade" id="addImg" tabindex="-1" role="dialog" aria-labelledby="addImg" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="addImg">Nueva imagen para: <em> {{ $content->title }}</em></h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('images.store', $content) }}" method="post" enctype="multipart/form-data">

                        @csrf
                        <div class="form-group">
                            <label for="title">Descripcion de la imagen</label>
                            <input type="text" class="form-control" name="descripcion1">
                        </div>
                        <div class="form-group">
                            <label for="image1">Elija una imagen</label>
                            <input type="file" class="form-control" name="image1" id="image1">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        $(document).ready(function() {
            $('.test-popup-link').magnificPopup({type:'image'});
        });
    </script>

@endsection