<x-layouts.main>

    <div class="col-md-3 mx-auto mt-12">
        <div class="col-12 text-end mb-3">
            <a class="btn btn-success btn-sm" href="{{ route('products.index') }}">
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="card mx-auto">

            @if ($products->image)
                <img src="{{$products->getNormalImagePath()}}" width="150" class="mx-auto" alt="Product Image"
                    class="img-fluid">
            @else
                No Image
            @endif

            @if ($products->pdf)
                <a href="{{ asset('storage/' . $products->pdf) }}" target="_blank" class="mt-4 mx-auto">View PDF</a>
            @else
                No PDF
            @endif

            <div class="card-body mx-auto">
                <h3 class="card-title mx-auto">{{ $products->name }}</h3>
                <p class="card-text text-success fw-bold ">Brand: {{ $products->brand }}</p>
                <p class="card-text text-primary fw-bold">Price: {{ $products->price }} $</p>
            </div>
        </div>

</x-layouts.main>
