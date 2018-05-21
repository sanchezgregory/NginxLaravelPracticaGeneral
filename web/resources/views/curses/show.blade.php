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

                                <p class="blog-post-meta">Creado: {{ $curse->created_at }}</p>

                                <p class="blog-post-meta">Tips: {{ count($curse->contents) }}</p>

                                <p class="blog-post-meta">{{ $curse->premium? "Curso premium": "Curso normal"}}</p>

                                <a class="test-popup-link" href="{{ asset('storage/'.$curse->image) }}">
                                    <img src="{{ asset('storage/'.$curse->image) }}" class="img-fluid rounded img-thumbnail" alt="" width="120" height="90">
                                </a>
                                <hr>
                                Tags
                                <ul>
                                    @foreach($curse->tags as $tag)

                                        <li>{{ $tag->title }}</li>

                                    @endforeach
                                </ul>
                            </div>

                        </div>

                        <div class="col-6">
                            <p class="blog-post-meta">Temario</p>
                            <table class="table table-striped">

                                <thead>
                                    <tr>
                                        <th>Titulo</th> <th> Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($curse->contents as $content)

                                    <tr>
                                        <td><i class="fas fa-paperclip"></i> {{ $content->title }}</td> <td align="center"><a
                                                    href="{{ route('contents.show', $content) }}"><i class="fas fa-file-alt fa-xs"></i></a>|<i class="fas fa-pencil-alt fa-xs"></i></td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>

                            @include('partials.comments')

                        </div>
                    </div>

                </div>
                <?php $sig = $curse->id + 1 ?>
                <?php $ant = $curse->id - 1 ?>
                <nav class="blog-pagination">
                    <a class="btn btn-outline-primary {{ $curse->id == 1?"disabled":"" }}" href="{{ route('curses.show', $ant) }}">Anterior</a>
                    <a class="btn btn-outline-primary {{ $curse->isLast($curse)?"disabled":"" }}" href="{{ route('curses.show', $sig) }}">Siguiente</a>
                </nav>

            </div><!-- /.blog-main -->

            <div class="col-sm-3 offset-sm-1 blog-sidebar">
                <div class="sidebar-module sidebar-module-inset">
                    <p><i class="fas fa-list-alt"></i> <em><a href="{{ route('contents.create', $curse) }}"> Agregar contenido </a></em></p>
                    <p><i class="fas fa-list-alt"></i> <em><a href="{{ route('curses.edit', $curse) }}"> Editar curso </a></em></p>
                </div>
            </div><!-- /.blog-sidebar -->

        </div><!-- /.row -->

    </div><!-- /.container -->

@endsection

@section('scripts')

    <script>
        $(document).ready(function() {
            $('.test-popup-link').magnificPopup({type:'image'});
        });
    </script>

@endsection
