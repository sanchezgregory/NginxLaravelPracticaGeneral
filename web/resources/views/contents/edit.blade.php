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

                                    @if($content->hasImage($content))

                                        <p class="blog-post-meta"><em>las imagenes se editan por separado</em></p>

                                        @foreach($content->images as $image)
                                            <em><div class="a">{{ $image->title }}  </div></em>
                                            <p></p>
                                            <div class="text-center ">

                                                <a href="#" data-toggle="modal" class="btn btn-block btn-danger" data-target="#editImg{{$image->id}}"><img src="{{ asset('storage/'.$image->path) }}" class="img-fluid rounded img-thumbnail" alt="" width="120" height="90"></a>

                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="editImg{{ $image->id }}" tabindex="-1" role="dialog" aria-labelledby="editImg" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editImg">Editar imagen: {{ $image->title }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('images.update', $image) }}" method="post" enctype="multipart/form-data">

                                                                @csrf
                                                                {{ method_field('PUT') }}

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

                                            <hr>

                                        @endforeach

                                    @else
                                        <p class="blog-post-meta"><em>No hay imagenes</em></p>
                                    @endif

                                </div>

                            </div>
                            <form action="{{ route('contents.update', $content) }}" method="POST" id="formContent">

                                @csrf
                                {{ method_field('PUT') }}
                                <div class="col-6">

                                    <p class="blog-post-meta">
                                        <input type="text" class="form-control" name="title" value="{{ $content->title }}">
                                    </p>

                                    <textarea name="body" id="body" cols="60" rows="20" class="form-control">
                                        {{ $content->body }}
                                    </textarea>

                                </div>
                            </form>
                        </div>

                    </div>
                    <?php $sig = $content->id + 1 ?>
                    <?php $ant = $content->id - 1 ?>
                    <nav class="blog-pagination">
                        <a class="btn btn-outline-primary {{ $content->id == 1?"disabled":"" }}" href="{{ route('contents.edit', $ant) }}">Anterior</a>
                        <a class="btn btn-outline-primary {{ $content->isLast($content->id)?"disabled":"" }}" href="{{ route('contents.edit', $sig) }}">Siguiente</a>
                    </nav>

                </div><!-- /.blog-main -->

                <div class="col-sm-3 offset-sm-1 blog-sidebar">
                    <div class="sidebar-module sidebar-module-inset" id="formContent">
                        <input type="submit" class="btn btn-block btn-warning" value="Editar contenido" form="formContent">
                        <p>
                        <p><em><a href="{{ route('contents.delete', $content) }}" data-toggle="modal" class="btn btn-block btn-danger" data-target="#deleteContent"> <i class="fas fa-trash-alt"></i> Eliminar contenido </a></em></p>
                    </div>
                </div><!-- /.blog-sidebar -->

            </div><!-- /.row -->

        </div><!-- /.container -->

@endsection