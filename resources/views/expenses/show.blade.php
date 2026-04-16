@extends('expenses.layout')

@section('content')
<div class="px-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 font-weight-bold text-dark mb-0">Expense Details #{{ $expense->id }}</h2>
        <div class="btn-group">
            <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-primary">
                <i class="bi bi-pencil me-1"></i> Edit
            </a>
            <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" onsubmit="return confirm('Confirm delete?');" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-trash me-1"></i> Delete
                </button>
            </form>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="p-4 border rounded bg-light h-100">
                <h5 class="text-primary mb-3 border-bottom pb-2">Basic Info</h5>
                <p><strong>Category:</strong> {{ $expense->Category ?: 'N/A' }}</p>
                <p><strong>Job No:</strong> {{ $expense->JobNo }}</p>
                <p><strong>Date:</strong> {{ $expense->Date ? \Carbon\Carbon::parse($expense->Date)->format('d-m-Y') : 'N/A' }}</p>
                <p><strong>Month:</strong> {{ $expense->Month }}</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-4 border rounded bg-light h-100">
                <h5 class="text-primary mb-3 border-bottom pb-2">Financials</h5>
                <p><strong>Currency:</strong> {{ $expense->Currency }}</p>
                <p><strong>Exchange Rate:</strong> {{ number_format($expense->ExRate, 2) }}</p>
                <p class="fs-4"><strong>Total:</strong> <span class="text-success fw-bold">{{ number_format($expense->Total, 2) }} {{ $expense->Currency }}</span></p>
                <p><strong>Account Code:</strong> {{ $expense->AccountCode ?: 'N/A' }}</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-4 border rounded bg-light h-100">
                <h5 class="text-primary mb-3 border-bottom pb-2">References</h5>
                <p><strong>Company Name:</strong> {{ $expense->CompanyName ?: 'N/A' }}</p>
                <p><strong>MAWB / MBL:</strong> {{ $expense->MAWB_MBL ?: 'N/A' }}</p>
                <p><strong>Reference:</strong> {{ $expense->Reference ?: 'N/A' }}</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-4 border rounded bg-light h-100">
                <h5 class="text-primary mb-3 border-bottom pb-2">Description</h5>
                <p>{{ $expense->Description ?: 'No description provided.' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
