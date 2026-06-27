@extends('company_details.layout')

@section('content')
    <div class="px-4 py-4">
        <div class="border-bottom pb-3 mb-4">
            <h3 class="h5 font-weight-bold text-dark mb-1">Edit Company Profile</h3>
            <p class="text-muted small mb-0">Modify the company profile configuration details below.</p>
        </div>

        <form action="{{ route('company_details.update', $companyDetail->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <!-- Company Name -->
                <div class="col-md-6">
                    <label for="company_name" class="form-label fw-semibold text-dark">Company Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{ old('company_name', $companyDetail->company_name) }}" placeholder="e.g. AO LOGISTICS" required>
                    @error('company_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="col-md-3">
                    <label for="email" class="form-label fw-semibold text-dark">Email Address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $companyDetail->email) }}" placeholder="e.g. nandan@aologistics.in">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Telephone -->
                <div class="col-md-3">
                    <label for="telephone" class="form-label fw-semibold text-dark">Telephone / Phone</label>
                    <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" value="{{ old('telephone', $companyDetail->telephone) }}" placeholder="e.g. +91 70222 84895">
                    @error('telephone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Address -->
                <div class="col-12">
                    <label for="address" class="form-label fw-semibold text-dark">Company Address <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" placeholder="Enter full postal address..." required>{{ old('address', $companyDetail->address) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- State Code -->
                <div class="col-md-3">
                    <label for="state_code" class="form-label fw-semibold text-dark">State Code</label>
                    <input type="text" class="form-control @error('state_code') is-invalid @enderror" id="state_code" name="state_code" value="{{ old('state_code', $companyDetail->state_code) }}" placeholder="e.g. 29">
                    @error('state_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- GST Number -->
                <div class="col-md-3">
                    <label for="gst_number" class="form-label fw-semibold text-dark">GST Number (GSTIN)</label>
                    <input type="text" class="form-control @error('gst_number') is-invalid @enderror" id="gst_number" name="gst_number" value="{{ old('gst_number', $companyDetail->gst_number) }}" placeholder="e.g. 29AHWPT9984H1ZV">
                    @error('gst_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- PAN -->
                <div class="col-md-3">
                    <label for="pan" class="form-label fw-semibold text-dark">PAN Number</label>
                    <input type="text" class="form-control @error('pan') is-invalid @enderror" id="pan" name="pan" value="{{ old('pan', $companyDetail->pan) }}" placeholder="e.g. AHWPT9984H">
                    @error('pan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- TAN -->
                <div class="col-md-3">
                    <label for="tan" class="form-label fw-semibold text-dark">TAN Number</label>
                    <input type="text" class="form-control @error('tan') is-invalid @enderror" id="tan" name="tan" value="{{ old('tan', $companyDetail->tan) }}" placeholder="e.g. BLRB24521A">
                    @error('tan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Company Logo Upload -->
                <div class="col-md-8">
                    <label for="logo" class="form-label fw-semibold text-dark">Company Logo</label>
                    <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/*" onchange="previewImage(event)">
                    <div class="form-text">Uploading a new logo will replace the current logo. Supported formats: JPEG, PNG, JPG, GIF, SVG, WEBP. Max size: 2MB.</div>
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Logo Preview -->
                <div class="col-md-4 text-center">
                    <div class="border rounded p-2 d-flex flex-column align-items-center justify-content-center" style="height: 100%; min-height: 100px; background-color: #fafafa;">
                        <span class="text-muted small mb-1 d-block">Logo Preview</span>
                        @if($companyDetail->logo_path)
                            <img id="logo-preview-img" src="{{ asset($companyDetail->logo_path) }}" alt="Preview" class="img-fluid" style="max-height: 80px; object-fit: contain;">
                            <span id="logo-preview-placeholder" class="text-muted small d-none"><i class="bi bi-image" style="font-size: 24px;"></i><br>No logo selected</span>
                        @else
                            <img id="logo-preview-img" src="#" alt="Preview" class="img-fluid d-none" style="max-height: 80px; object-fit: contain;">
                            <span id="logo-preview-placeholder" class="text-muted small"><i class="bi bi-image" style="font-size: 24px;"></i><br>No logo selected</span>
                        @endif
                    </div>
                </div>

                <!-- Active Status Toggle -->
                <div class="col-12 mt-4">
                    <div class="form-check form-switch p-3 border rounded" style="background-color: #f8f9fa;">
                        <input class="form-check-input ms-0 me-2" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', $companyDetail->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold text-dark" for="is_active">
                            Mark as Active Profile
                        </label>
                        <div class="form-text ms-4">When active, this company profile's details and logo will be automatically printed on all invoices and PDF documents. Setting this will deactivate any other active profiles.</div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                <a href="{{ route('company_details.index') }}" class="btn btn-light border">Cancel</a>
                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Update Profile</button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('logo-preview-img');
            const placeholder = document.getElementById('logo-preview-placeholder');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                    if(placeholder) placeholder.classList.add('d-none');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
