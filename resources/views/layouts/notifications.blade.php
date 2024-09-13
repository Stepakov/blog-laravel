@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session( 'success' ))
    <div class="alert alert-success">
        {{ session( 'success' ) }}
    </div>
@endif


@if (session( 'message' ))
    <div class="alert alert-success">
        {{ session( 'message' ) }}
    </div>
@endif


@if (session( 'status' ))
    <div class="alert alert-success">
        {{ session( 'status' ) }}
    </div>
@endif
