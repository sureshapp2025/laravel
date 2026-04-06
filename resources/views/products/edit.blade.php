@extends('products.layout')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 mb-md-4 gap-2">
        <h2 class="h3 font-weight-bold text-dark mb-0">Edit Product</h2>
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
                    <form action="{{ route('products.update',$product->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label font-weight-bold">CCode</label>
                                <input class="form-control" type="text" name="c_code" value="{{ old('c_code', $product->c_code) }}" maxlength="255">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label font-weight-bold">Particulars <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="particulars" value="{{ old('particulars', $product->particulars) }}" required maxlength="255">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label font-weight-bold">HSN</label>
                                <input class="form-control" type="text" name="hsn" value="{{ old('hsn', $product->hsn) }}" maxlength="255">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="form-label font-weight-bold">GST</label>
                                <select class="form-select" name="gst">
                                    <option value="0" {{ old('gst', $product->gst) == 0 ? 'selected' : '' }}>0.00</option>
                                    <option value="18" {{ old('gst', $product->gst) == 18 ? 'selected' : '' }}>18.00</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label font-weight-bold">IGST</label>
                                <select class="form-select" name="igst">
                                    <option value="0" {{ old('igst', $product->igst) == 0 ? 'selected' : '' }}>0.00</option>
                                    <option value="18" {{ old('igst', $product->igst) == 18 ? 'selected' : '' }}>18.00</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label font-weight-bold">CGST</label>
                                <select class="form-select" name="cgst">
                                    <option value="0" {{ old('cgst', $product->cgst) == 0 ? 'selected' : '' }}>0.00</option>
                                    <option value="9" {{ old('cgst', $product->cgst) == 9 ? 'selected' : '' }}>9.00</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label font-weight-bold">SGST</label>
                                <select class="form-select" name="sgst">
                                    <option value="0" {{ old('sgst', $product->sgst) == 0 ? 'selected' : '' }}>0.00</option>
                                    <option value="9" {{ old('sgst', $product->sgst) == 9 ? 'selected' : '' }}>9.00</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="except_particulars" value="1" id="except_particulars" {{ old('except_particulars', $product->except_particulars) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="except_particulars">Exceptional Particulars</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_service" value="1" id="is_service" {{ old('is_service', $product->is_service) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_service">IS Service</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="active" value="1" id="active" {{ old('active', $product->active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="active">Active</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
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
