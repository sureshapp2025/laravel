@extends('products.layout')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 mb-md-4 gap-2">
        <h2 class="h3 font-weight-bold text-dark mb-0">Product Management</h2>
        @if(Auth::user()->role === 'super_admin')
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Create New Product
        </a>
        @endif
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3 px-3">No</th>
                            <th class="py-3 px-3">Name</th>
                            <th class="py-3 px-3 d-none d-md-table-cell">Details</th>
                            <th class="py-3 px-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td class="py-3 px-3">{{ ++$i }}</td>
                            <td class="py-3 px-3">{{ $product->name }}</td>
                            <td class="py-3 px-3 d-none d-md-table-cell">{{ Str::limit($product->detail, 50) }}</td>
                            <td class="py-3 px-3">
                                <div class="d-flex flex-column flex-md-row gap-1">
                                    <a href="{{ route('products.show',$product->id) }}" class="btn btn-sm btn-info text-white">
                                        <i class="bi bi-eye"></i><span class="d-none d-lg-inline ms-1">Show</span>
                                    </a>
                                    
                                    @if(Auth::user()->role === 'super_admin')
                                    <a href="{{ route('products.edit',$product->id) }}" class="btn btn-sm btn-warning text-white">
                                        <i class="bi bi-pencil"></i><span class="d-none d-lg-inline ms-1">Edit</span>
                                    </a>
                                    
                                    <form action="{{ route('products.destroy',$product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="bi bi-trash"></i><span class="d-none d-lg-inline ms-1">Delete</span>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="mt-3 mt-md-4">
        {!! $products->links() !!}
    </div>
@endsection
