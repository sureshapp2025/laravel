@extends('company_details.layout')

@section('content')
    <div class="px-4 py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="h5 font-weight-bold text-dark mb-0">Manage Company Profiles</h3>
            <a href="{{ route('company_details.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Add Company Profile
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="py-3 px-3">Logo</th>
                        <th class="py-3 px-3">Company Name</th>
                        <th class="py-3 px-3">Contact Details</th>
                        <th class="py-3 px-3">State Code / GST</th>
                        <th class="py-3 px-3">Tax Numbers (PAN/TAN)</th>
                        <th class="py-3 px-3">Status</th>
                        <th class="py-3 px-3 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companyDetails as $detail)
                        <tr>
                            <td class="py-3 px-3">
                                @if($detail->logo_path)
                                    <img src="{{ asset($detail->logo_path) }}" alt="{{ $detail->company_name }} Logo" class="img-thumbnail" style="max-height: 50px; max-width: 80px; object-fit: contain;">
                                @else
                                    <span class="text-muted" style="font-size: 11px;">No Logo</span>
                                @endif
                            </td>
                            <td class="py-3 px-3">
                                <div class="fw-bold text-dark">{{ $detail->company_name }}</div>
                            </td>
                            <td class="py-3 px-3">
                                <div style="font-size: 12px; line-height: 1.4;">
                                    <strong>Email:</strong> {{ $detail->email ?? 'N/A' }}<br>
                                    <strong>Phone:</strong> {{ $detail->telephone ?? 'N/A' }}
                                </div>
                            </td>
                            <td class="py-3 px-3">
                                <div style="font-size: 12px; line-height: 1.4;">
                                    <strong>State Code:</strong> {{ $detail->state_code ?? 'N/A' }}<br>
                                    <strong>GSTIN:</strong> {{ $detail->gst_number ?? 'N/A' }}
                                </div>
                            </td>
                            <td class="py-3 px-3">
                                <div style="font-size: 12px; line-height: 1.4;">
                                    <strong>PAN:</strong> {{ $detail->pan ?? 'N/A' }}<br>
                                    <strong>TAN:</strong> {{ $detail->tan ?? 'N/A' }}
                                </div>
                            </td>
                            <td class="py-3 px-3">
                                @if($detail->is_active)
                                    <span class="badge bg-success text-white px-2 py-1.5 rounded" style="font-size: 11px;"><i class="bi bi-patch-check-fill me-1"></i>Active</span>
                                @else
                                    <span class="badge bg-secondary text-white px-2 py-1.5 rounded" style="font-size: 11px;">Inactive</span>
                                @endif
                            </td>
                            <td class="py-3 px-3 text-end">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('company_details.show', $detail->id) }}" class="btn btn-info text-white" title="View">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                    <a href="{{ route('company_details.edit', $detail->id) }}" class="btn btn-warning text-white" title="Edit">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('company_details.destroy', $detail->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this company profile?');"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Delete">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @if($companyDetails->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-building-slash display-6 d-block mb-3"></i>
                                No company profiles created yet. Click "Add Company Profile" to get started.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
