@if (session('success'))
        <p style="color: #082">
            {{ session('success') }}
        </p>
@endif

@if (session('error'))
        <p style="color: #f00">
            {{ session('success') }}
        </p>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p style="color: #f00;">
            {{ $error }}
        </p>
    @endforeach
@endif
