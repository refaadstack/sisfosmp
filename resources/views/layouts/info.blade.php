@if (count($errors)>0)
<div class="alert alert-danger mt-2">
    <ul>
        @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
        @endforeach
    </ul>
</div>
@endif
@if (session('info'))
    <div class="alert alert-success mt-2">
         {{ session('info') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger mt-2">
         {{ session('error') }}
    </div>
@endif