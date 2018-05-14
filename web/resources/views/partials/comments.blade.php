<?php
    $parent = new stdClass();

    if(isset($curse)) {

        $parent = $curse;
        $ent = 'curses';
    }
    else {
        $parent = $content;
        $ent = 'contents';
    }

?>
<hr>

<em>Comentarios</em> <a href="#" data-toggle="modal" class="btn btn-success" data-target="#addcomment">Add</a>
<div>
    <ul>
        @foreach($parent->comments->sortByDesc('created_at') as $comment)
            <li>
                {{ $comment->body }} <div class="a"><em>by {{ $comment->user->name }}, {{ $comment->created_at->DiffForHumans()     }}</em></div>

            </li>
        @endforeach
    </ul>
</div>

<!-- Modal -->
<div class="modal fade" id="addcomment" tabindex="-1" role="dialog" aria-labelledby="editImg" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editImg">Usuario: {{ auth()->user()->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route( $ent.'.storeComment', $parent ) }}" method="post" enctype="multipart/form-data">

                    @csrf

                    <div class="form-group">
                        <label for="title">Comentario</label>
                        <textarea name="body" id="" cols="30" rows="10" class="form-control">

                            </textarea>
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
