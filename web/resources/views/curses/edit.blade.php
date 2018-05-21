@extends('layouts.app')

@section('content')

        <div class="blog-header">
            <div class="container">
                <div class="fa-pull-right">{{ \Carbon\Carbon::now()->format('l jS \\of F Y h:i:s A') }}</div>
                <h1 class="blog-title">
                    {{ $curse->title }}
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

                                    <p class="blog-post-meta">Fecha: {{ $curse->created_at }}</p>

                                    <p class="blog-post-meta"><em>La imagen se edita por separado</em></p>

                                    <p></p>
                                    <div class="text-center ">

                                        <a href="#" data-toggle="modal" class="btn btn-block btn-danger" data-target="#editImg"><img src="{{ asset('storage/'.$curse->image) }}" class="img-fluid rounded img-thumbnail" alt="" width="120" height="90"></a>

                                    </div>

                                    <hr>
                                </div>

                            </div>
                            <div class="col-6">
                                <form action="{{ route('curses.update', $curse) }}" method="POST" id="formContent">

                                    @csrf
                                    {{ method_field('PUT') }}
                                    <div class="col-12">

                                        <p class="blog-post-meta">
                                            <input type="text" class="form-control" name="title" value="{{ $curse->title }}">
                                        </p>

                                        <p class="blog-post-meta">
                                            <input type="text" class="form-control" name="premium" value="{{ $curse->premium }}">
                                        </p>

                                    </div>
                                    <hr>
                                    <div class="a">Tags del curso:
                                        <select class="js-example-basic-single form-control" name="tags[]" multiple="multiple">
                                            @foreach($tags as $tag)
                                                @foreach($curse->tags as $curseTag)
                                                    @if($tag->id == $curseTag->id)
                                                        <option value="{{ $tag->id }}" selected>{{ $tag->title }}</option>
                                                    @else
                                                        <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <?php $sig = $curse->id + 1 ?>
                    <?php $ant = $curse->id - 1 ?>
                    <nav class="blog-pagination">
                        <a class="btn btn-outline-primary {{ $curse->id == 1?"disabled":"" }}" href="{{ route('curses.edit', $ant) }}">Anterior</a>
                        <a class="btn btn-outline-primary {{ $curse->isLast($curse)?"disabled":"" }}" href="{{ route('curses.edit', $sig) }}">Siguiente</a>
                    </nav>

                </div><!-- /.blog-main -->

                <div class="col-sm-3 offset-sm-1 blog-sidebar">
                    <div class="sidebar-module sidebar-module-inset" id="formContent">
                        <input type="submit" class="btn btn-block btn-warning" value="Editar curse" form="formContent">
                        <p>
                        <p><em><a href="{{ route('curses.delete', $curse) }}" data-toggle="modal" class="btn btn-block btn-danger" data-target="#deleteContent"> <i class="fas fa-trash-alt"></i> Eliminar curso </a></em></p>
                    </div>
                </div><!-- /.blog-sidebar -->

            </div><!-- /.row -->

        </div><!-- /.container -->

        <!-- Modal -->
        <div class="modal fade" id="editImg" tabindex="-1" role="dialog" aria-labelledby="editImg" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editImg">Editar imagen: </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('curses.update', $curse) }}" method="post" enctype="multipart/form-data">

                            @csrf
                            {{ method_field('PUT') }}

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
    <script type="text/javascript" class="js-code-placeholder">
        $('.js-example-basic-single').select2({
            tags: true,
            tokenSeparators: [','],
            createTag: function (params) {
                var term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    newTag: true // add additional parameters
                }
            }
        });
    </script>
@endsection