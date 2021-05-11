@if (count($errors) > 0)
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p class="mb-0" style="color: #333 !important;">{{ $error }}</p>
        @endforeach
    </div>
@endif