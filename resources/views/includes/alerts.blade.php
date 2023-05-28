@if(isset($errors) && $errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p> {{ $error }}</p>
        @endforeach
    </div>
@endif

@if(session(config('constants.array_messages')))
    @foreach(session(config('constants.array_messages')) as $message)
    <script>
        $(document).Toasts('create', {
            title: 'Sucesso',
            body: '{{ $message }}',
            class: 'toast bg-success fade show',
            autohide: true,
            delay: 3000
        })
    </script>
    @endforeach
@endif