@extends('layouts.app')

@section('content')

    <div class="blog-header">
        <div class="container">
            <h1 class="blog-title">Crear cursos</h1>
            <p class="lead blog-description">Admin_module</p>
        </div>
    </div>

    <div class="container">

        <div class="row">

            <div class="col-sm-8 blog-main">

                <div class="blog-post">
                    <h2 class="blog-post-title">Todos los Cursos</h2>

                    <p>Cantidad: {{ count($curses) }}</p>
                    <hr>
                    <div class="container">
                        <div class="row">
                            <div class="col-4">
                                <h3>Premium {{ count($premiums) }}</h3>
                                <ul>
                                    @foreach($premiums as $premium)
                                        <li><a href="{{ route('curses.show', $premium) }}"><i class="far fa-edit"></i></a> {{ $premium->title }}, {{ count($premium->contents) }} tips</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-4">
                                <h3>Free {{ count($normals) }}</h3>
                                <ul>
                                    @foreach($normals as $normal)
                                        <li><a href="{{ route('curses.show', $normal) }}"><i class="far fa-edit"></i></a> {{ $normal->title }}, {{ count($normal->contents) }} tips</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>


                </div><!-- /.blog-post -->

                <div class="blog-post">
                    <h2 class="blog-post-title">Another blog post</h2>
                    <p class="blog-post-meta">December 23, 2013 by <a href="#">Jacob</a></p>

                    <p>Cum sociis natoque penatibus et magnis <a href="#">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>
                    <blockquote>
                        <p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    </blockquote>
                    <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                    <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                </div><!-- /.blog-post -->

                <nav class="blog-pagination">
                    <a class="btn btn-outline-primary" href="#">Older</a>
                    <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
                </nav>

            </div><!-- /.blog-main -->

            <div class="col-sm-3 offset-sm-1 blog-sidebar">
                <div class="sidebar-module sidebar-module-inset">
                    <h4>Acciones</h4>
                    <p><em><a href="{{ route('curses.create') }}">Crear cursos</em></a></p>
                </div>
            </div><!-- /.blog-sidebar -->

        </div><!-- /.row -->

    </div><!-- /.container -->
@endsection