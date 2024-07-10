<x-layouts.main>

    <div class="d-flex w-100 justify-content-center align-items-center full-height">
        @auth
            <a href="{{ route('products.index') }}" class="btn btn-success px-3 py-2">
                Show products table ->
            </a>
        @else
            <a href="{{ route('login') }}" class="btn btn-success px-3 py-2">
                Login or Register
            </a>
        @endauth
    </div>


</x-layouts.main>
