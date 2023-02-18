@if(session('succsess_msg'))
    <div class="alert alert-success">
        <ul>
            <li>{{ session('succsess_msg') }}</li>
        </ul>
    </div>
@endif
