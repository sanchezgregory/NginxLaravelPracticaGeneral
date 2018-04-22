@if(Session::has('status') )

    <div class="alert alert-success">
        <ul>
            {{ Session::get('status') }}
        </ul>
    </div>

@endif