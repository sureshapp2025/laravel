@extends('products.layout')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 mb-md-4 gap-2">
    <h2 class="h3 font-weight-bold text-dark mb-0">Add New Product</h2>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
</div>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <strong class="font-weight-bold">Whoops!</strong>
        <span>There were some problems with your input.</span>
        <ul class="mt-2 mb-0 small">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-8">
        <div class="card shadow-sm">
            <div class="card-body p-3 p-md-4">
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label font-weight-bold" for="name">
                            Name
                        </label>
                        <input class="form-control" id="name" type="text" name="name" placeholder="Product Name">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label font-weight-bold" for="detail">
                            Detail
                        </label>
                        <textarea class="form-control" id="detail" name="detail" placeholder="Product Details" rows="5"></textarea>
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-check-circle me-1"></i> Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
