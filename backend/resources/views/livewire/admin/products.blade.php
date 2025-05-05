<div>
   <div class="container-fluid p-4">
    <div class="card rounded-3">
        <div class="card-header p-3">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-auto">
                    <h4 class="card-title mb-0">Products</h4>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">
                        Add Product
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <table class="table table-responsive table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                {{-- <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>
                                <button class="btn btn-info btn-sm" wire:click="edit({{ $product->id }})">
                                    Edit
                                </button>
                                <button class="btn btn-danger btn-sm" wire:click="delete({{ $product->id }})">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No products found</td>
                        </tr>
                    @endforelse
                </tbody> --}}
            </table>
        </div>
    </div>
   </div>
</div>
