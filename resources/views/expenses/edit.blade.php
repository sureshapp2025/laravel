@extends('expenses.layout')

@section('content')
<div class="px-2">
    <div class="mb-4">
        <h2 class="h3 font-weight-bold text-dark mb-0">Edit Expense #{{ $expense->id }}</h2>
    </div>

    <form action="{{ route('expenses.update', $expense->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-4 mb-4">
            <h5 class="text-primary border-bottom pb-2 fw-bold">Basic Information</h5>
            
            <div class="col-md-4">
                <label for="Category" class="form-label fw-semibold">Category</label>
                <select name="Category" id="Category" class="form-select shadow-sm">
                    <option value="">Select Category</option>
                    <option value="Transportation" {{ $expense->Category == 'Transportation' ? 'selected' : '' }}>Transportation</option>
                    <option value="Food & Dining" {{ $expense->Category == 'Food & Dining' ? 'selected' : '' }}>Food & Dining</option>
                    <option value="Office Supplies" {{ $expense->Category == 'Office Supplies' ? 'selected' : '' }}>Office Supplies</option>
                    <option value="Maintenance" {{ $expense->Category == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                    <option value="Miscellaneous" {{ $expense->Category == 'Miscellaneous' ? 'selected' : '' }}>Miscellaneous</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="Date" class="form-label fw-semibold">Date <span class="text-danger">*</span></label>
                <input type="date" name="Date" id="Date" class="form-control shadow-sm" value="{{ $expense->Date }}" required>
            </div>

            <div class="col-md-4">
                <label for="JobNo" class="form-label fw-semibold">Job No <span class="text-danger">*</span></label>
                <select name="JobNo" id="JobNo" class="form-select shadow-sm" required>
                    <option value="">Select Job No</option>
                    @foreach($bookings as $bookingNo)
                        <option value="{{ $bookingNo }}" {{ $expense->JobNo == $bookingNo ? 'selected' : '' }}>{{ $bookingNo }}</option>
                    @endforeach
                    @if(!in_array($expense->JobNo, $bookings->toArray()))
                        <option value="{{ $expense->JobNo }}" selected>{{ $expense->JobNo }}</option>
                    @endif
                </select>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <h5 class="text-primary border-bottom pb-2 fw-bold">Company & Reference</h5>

            <div class="col-md-4">
                <label for="CompanyName" class="form-label">Company Name</label>
                <input type="text" name="CompanyName" id="CompanyName" class="form-control shadow-sm" value="{{ $expense->CompanyName }}">
            </div>

            <div class="col-md-4">
                <label for="Reference" class="form-label">Reference</label>
                <input type="text" name="Reference" id="Reference" class="form-control shadow-sm" value="{{ $expense->Reference }}">
            </div>

            <div class="col-md-4">
                <label for="AccountCode" class="form-label">Account Code</label>
                <input type="text" name="AccountCode" id="AccountCode" class="form-control shadow-sm" value="{{ $expense->AccountCode }}">
            </div>

            <div class="col-md-6">
                <label for="MAWB_MBL" class="form-label">MAWB / MBL</label>
                <input type="text" name="MAWB_MBL" id="MAWB_MBL" class="form-control shadow-sm" value="{{ $expense->MAWB_MBL }}">
            </div>

            <div class="col-md-6">
                <label for="Month" class="form-label">Month</label>
                <input type="text" name="Month" id="Month" class="form-control shadow-sm" value="{{ $expense->Month }}">
            </div>
        </div>

        <div class="row g-4 mb-4">
            <h5 class="text-primary border-bottom pb-2 fw-bold">Billing Details</h5>

            <div class="col-md-3">
                <label for="Currency" class="form-label">Currency</label>
                <input type="text" name="Currency" id="Currency" class="form-control shadow-sm" value="{{ $expense->Currency }}">
            </div>

            <div class="col-md-3">
                <label for="ExRate" class="form-label">Exchange Rate</label>
                <input type="number" step="0.01" name="ExRate" id="ExRate" class="form-control shadow-sm" value="{{ $expense->ExRate }}">
            </div>

            <div class="col-md-3">
                <label for="Total" class="form-label">Total Amount <span class="text-danger">*</span></label>
                <input type="number" step="0.01" name="Total" id="Total" class="form-control shadow-sm" value="{{ $expense->Total }}" required>
            </div>
            
            <div class="col-md-12">
                <label for="Description" class="form-label">Description</label>
                <textarea name="Description" id="Description" class="form-control shadow-sm" rows="3">{{ $expense->Description }}</textarea>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-3 pt-3 mb-5">
            <a href="{{ route('expenses.index') }}" class="btn btn-outline-secondary px-5">Cancel</a>
            <button type="submit" class="btn btn-primary px-5 shadow">Update Expense</button>
        </div>
    </form>
</div>
@endsection
