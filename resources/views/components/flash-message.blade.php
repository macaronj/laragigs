@if (session('status'))
<div class="alert alert-success fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel text-white px-48 py-3">
    {{ session('status') }}
</div>
@endif
