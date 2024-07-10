<x-layouts.main>


    <div class="row">
        <div class="col-12 text-center">
            <h1>Add product</h1>
        </div>
        <div class="col-12 text-end mb-3">
            <a class="btn btn-success btn-sm" href="{{ route('products.index') }}">
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="col-12">
            <form action="{{ route('products.update', $products->id) }}" enctype="multipart/form-data" method="POST"
                autocomplete="off">
                @csrf
                @method('PUT')
                <div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input value="{{ $products->name }}"
                                class="form-control @error('name')  is-invalid @enderror" type="text" id="name"
                                name="name">
                            @error('name')
                                <p class="text-danger">Please enter products' name!</p>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="brand" class="form-label">Brand:</label>
                            <input value="{{ $products->brand }}"
                                class="form-control @error('brand')  is-invalid @enderror" type="text" id="brand"
                                name="brand">
                            @error('brand')
                                <p class="text-danger">Please enter products' brand!</p>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Price:</label>
                            <input value="{{ $products->price }}"
                                class="form-control  @error('price')  is-invalid @enderror" type="number"
                                id="price" name="price">
                            @error('price')
                                <p class="text-danger">Please enter products' price!</p>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="image" class="form-label">Image:</label>
                            <input type="file" value="{{ old('image') }}"
                                class="form-control  @error('image')  is-invalid @enderror" type="text"
                                id="image" name="image" placeholder="Choose image">
                            @error('image')
                                <p class="text-danger">Please enter products' image!</p>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="pdf" class="form-label">PDF file:</label>
                            <input type="file" value="{{ old('pdf') }}"
                                class="form-control  @error('pdf')  is-invalid @enderror" type="text" id="pdf"
                                name="pdf" placeholder="Choose pdf file">
                            @error('pdf')
                                <p class="text-danger">Please enter products' pdf</p>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-3">
                            <p></p>
                            <button type="submit" class="btn btn-success col-md-12">Submit</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>


</x-layouts.main>
