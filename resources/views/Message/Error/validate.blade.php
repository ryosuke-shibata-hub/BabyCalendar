@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session('err_message'))
    <div class="alert alert-danger">
        <ul>
            <li>{{ session('err_message') }}</li>
        </ul>
    </div>
@endif
