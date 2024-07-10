<x-layouts.main>


        <div class="row">
            <div class="col-12 text-center">
                <h1>Products Table</h1>
            </div>
            <div class="col-12 text-end mb-3">
                <a class="btn btn-success btn-sm" href="{{ route('products.create') }}">
                    <i class="bi bi-plus-circle"></i>
                </a>
            </div>
            <div class="col-12">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Price</th>
                            {{-- <th>Image</th>
                            <th>PDF</th> --}}
                            <th>Created At</th>
                            <th colspan="3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->brand }}</td>
                            <td>{{ $product->price }} $</td>
                            <td>{{ $product->created_at }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('products.show', $product->id) }}">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-warning btn-sm" href="{{ route('products.edit', $product->id) }}">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


</x-layouts.main>
