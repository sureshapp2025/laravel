@extends('products.layout')
  
@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 mb-md-4 gap-2">
        <h2 class="h3 font-weight-bold text-dark mb-0">Show Product</h2>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>
   
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body p-3 p-md-4">
                    <div class="mb-4">
                        <h5 class="font-weight-bold text-dark mb-2">Name</h5>
                        <p class="text-dark mb-0">{{ $product->name }}</p>
                    </div>
                    
                    <div class="mb-0">
                        <h5 class="font-weight-bold text-dark mb-2">Details</h5>
                        <p class="text-dark mb-0">{{ $product->detail }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
