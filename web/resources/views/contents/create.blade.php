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
                        <div class="form-group clonedDesc" id="desc1">
                            <label for="imageTitle">Descripcion</label>
                            <input type="text" name="descripcion1" class="form-control" id="descripcion1">
                        </div>
                        <div class="form-group clonedImg" id="img1">
                            <label for="image1">Imagen</label>
                            <input type="file" name="image1" class="form-control-file" id="image1">
                        </div>

                        <div class="form-group">
                            <label for="image">¿Otra imagen?</label>
                            <button type="button" class="btn btn-primary"  id="btnAdd" > <i class="fas fa-angle-double-down"></i> </button>
                            <button type="button" class="btn btn-danger" id="btnDel" ><i class="fas fa-angle-double-up"></i> </button>
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
@section('scripts')

    <script>
        $(document).ready(function() {
            $('#btnDel').attr('disabled','disabled');
            $('#btnAdd').click(function() {

                var num = $('.clonedImg').length; // how many "duplicatable" input fields we currently have
                var num2 = $('.clonedDesc').length; // how many "duplicatable" input fields we currently have

                var newNum = new Number(num + 1); // the numeric ID of the new input field being added
                var newNum2 = new Number(num2 + 1); // the numeric ID of the new input field being added

                // create the new element via clone(), and manipulate it's ID using newNum value
                var newElem = $('#img' + num).clone().attr('id', 'img' + newNum);
                var newElem2 = $('#desc' + num).clone().attr('id', 'desc' + newNum2);

                // manipulate the name/id values of the input inside the new element
                newElem.children(':last').attr('id', 'image' + newNum).attr('name', 'image' + newNum);
                newElem2.children(':last').attr('id', 'descripcion' + newNum2).attr('name', 'descripcion' + newNum2);

                // insert the new element after the last "duplicatable" input field
                $('#img' + num).after(newElem);
                $('#desc' + num2).after(newElem2);

                // enable the "remove" button
                $('#btnDel').attr('disabled',false);

                // business rule: you can only add 10 names
                if (newNum == 4)
                    $('#btnAdd').attr('disabled','disabled');
            });

            $('#btnDel').click(function() {
                var num = $('.clonedImg').length; // how many "duplicatable" input fields we currently have
                var num2 = $('.clonedDesc').length; // how many "duplicatable" input fields we currently have
                $('#img' + num).remove(); // remove the last element
                $('#desc' + num2).remove(); // remove the last element

                // enable the "add" button
                $('#btnAdd').attr('disabled',false);

                // if only one element remains, disable the "remove" button
                if (num-1 == 1)
                    $('#btnDel').attr('disabled','disabled');
            });

        });

    </script>

@endsection
