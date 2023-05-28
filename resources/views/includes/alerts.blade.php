@if(isset($errors) && $errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p> {{ $error }}</p>
        @endforeach
    </div>
@endif

@if(session(config('constants.array_messages')))
    <div class="alert alert-success">
        @foreach(session(config('constants.array_messages')) as $message)
            <p> {{ $message }}</p>
        @endforeach
    </div>
@endif