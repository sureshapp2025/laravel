@php
// Helper function to convert number to Indian Rupees words
if (!function_exists('numberToWords')) {
    function numberToWords($num) {
        $number = (float)$num;
        $no = floor($number);
        $decimal = round(($number - $no) * 100);
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(
            0 => '', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 5 => 'Five',
            6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine', 10 => 'Ten',
            11 => 'Eleven', 12 => 'Twelve', 13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
            16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen', 19 => 'Nineteen', 20 => 'Twenty',
            30 => 'Thirty', 40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty', 70 => 'Seventy',
            80 => 'Eighty', 90 => 'Ninety'
        );
        $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
        while ($i < $digits_length) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred : $words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else {
                $str[] = null;
            }
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal > 0) ? " and " . ($words[floor($decimal / 10) * 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? $Rupees . 'Rupees ' : 'Zero Rupees ') . $paise . ' Only';
    }
}
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $invoice->billno }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f8f9fa;
            color: #333333;
        }
        
        /* Print container styles */
        .invoice-container {
            max-width: 900px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .company-title {
            font-size: 26px;
            font-weight: 800;
            color: #0d6efd;
            letter-spacing: -0.5px;
        }

        .invoice-title-badge {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 1px;
            padding: 8px 16px;
            background-color: #f1f3f5;
            border-radius: 6px;
            display: inline-block;
        }

        .border-dashed-bottom {
            border-bottom: 1.5px dashed #dee2e6;
        }

        .text-dark-blue {
            color: #1e3a8a;
        }

        .table-invoice th {
            background-color: #f8f9fa !important;
            color: #495057;
            font-weight: 700;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #dee2e6;
        }

        .table-invoice td {
            font-size: 13px;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
        }

        .totals-table td {
            font-size: 13px;
            padding: 6px 12px;
        }

        .terms-text {
            font-size: 11px;
            color: #6c757d;
            line-height: 1.5;
        }

        .bank-box {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            padding: 15px;
        }

        .bank-box td {
            font-size: 12px;
            padding: 2px 0;
        }

        /* Floating Actions Panel */
        .action-bar {
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
            padding: 12px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        /* Print Media Settings */
        @media print {
            body {
                background-color: #ffffff;
                color: #000000;
            }
            .action-bar {
                display: none !important;
            }
            .invoice-container {
                margin: 0;
                padding: 0;
                box-shadow: none;
                border: none;
                max-width: 100%;
                border-radius: 0;
            }
            .no-print {
                display: none !important;
            }
            .table-invoice th {
                background-color: #f1f3f5 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .bank-box {
                background-color: #ffffff !important;
                border: 1px solid #000000 !important;
            }
            /* Avoid page breaks in middle of tables */
            tr {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>

    <!-- Dynamic Action Bar (Hidden in Print) -->
    <div class="action-bar no-print">
        <div class="container-fluid" style="max-width: 900px;">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('invoices.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2 fw-semibold">
                    <i class="fas fa-arrow-left"></i> Back to Invoices
                </a>
                <div class="d-flex gap-2">
                    <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-outline-primary d-inline-flex align-items-center gap-2 fw-semibold">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <button onclick="window.print()" class="btn btn-primary d-inline-flex align-items-center gap-2 fw-bold shadow-sm">
                        <i class="fas fa-print"></i> Print / Save PDF
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Print Invoice Container -->
    <div class="invoice-container">
        <!-- COMPANY HEADER -->
        <div class="row align-items-start border-dashed-bottom pb-4 mb-4">
            <div class="col-7">
                <div class="company-title">TRACKSEN LOGISTICS</div>
                <div class="fs-7 text-muted mt-1">
                    No. 12, Third Floor, Rajaji Salai, Chennay - 600001<br>
                    <strong>GSTIN:</strong> 33AAACT9876A1Z0 | <strong>PAN:</strong> AAACT9876A<br>
                    <strong>Email:</strong> billing@tracksen.com | <strong>Phone:</strong> +91 44 2345 6789<br>
                    <strong>State:</strong> TAMIL NADU (State Code: 33)
                </div>
            </div>
            <div class="col-5 text-end">
                <div class="invoice-title-badge text-uppercase text-dark-blue mb-2">
                    @if($invoice->invoice_type == 'Proforma')
                        Proforma Invoice
                    @elseif($invoice->invoice_type == 'CreditNote')
                        Credit Note
                    @else
                        Tax Invoice
                    @endif
                </div>
                <div class="fs-7">
                    <strong>Invoice No:</strong> <span class="fw-bold text-dark fs-6">{{ $invoice->billno }}</span><br>
                    <strong>Invoice Date:</strong> {{ \Carbon\Carbon::parse($invoice->billdate)->format('d-M-Y') }}<br>
                    <strong>Due Date:</strong> {{ \Carbon\Carbon::parse($invoice->due_date)->format('d-M-Y') }} ({{ $invoice->credit_days ?? 30 }} days)<br>
                    <strong>Status:</strong> 
                    @if($invoice->status == 'Paid')
                        <span class="text-success fw-bold">PAID</span>
                    @else
                        <span class="text-danger fw-bold">UNPAID</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- CLIENT & SHIPPING ADDRESS PANELS -->
        <div class="row g-3 mb-4">
            <!-- Billing Details -->
            <div class="col-6 border-end">
                <h6 class="text-uppercase fw-bold text-dark-blue border-bottom pb-1 mb-2 fs-7">Bill To (Client)</h6>
                <div class="fw-bold text-dark fs-6">{{ $invoice->company_name }}</div>
                <div class="fs-7 text-muted">
                    {{ $invoice->aline1 }}<br>
                    @if($invoice->aline2){{ $invoice->aline2 }}<br>@endif
                    {{ $invoice->location }} - {{ $invoice->pincode }}<br>
                    @if($invoice->phone)<strong>Phone:</strong> {{ $invoice->phone }} | @endif
                    @if($invoice->email)<strong>Email:</strong> {{ $invoice->email }}<br>@endif
                    <strong>GSTIN:</strong> {{ $invoice->gst_no ?? 'URP' }}<br>
                    @if($invoice->pan)<strong>PAN:</strong> {{ $invoice->pan }}<br>@endif
                    <strong>State Name:</strong> {{ $invoice->state }} (State Code: {{ $invoice->state_code }})
                </div>
            </div>
            <!-- Shipping Details / Operations -->
            <div class="col-6 ps-3">
                <h6 class="text-uppercase fw-bold text-dark-blue border-bottom pb-1 mb-2 fs-7">Place of Supply & Delivery</h6>
                <div class="fs-7 text-muted">
                    <strong>Place of Supply:</strong> {{ $invoice->po_supply ?? $invoice->state }}<br>
                    @if($invoice->booking_no)
                        <strong>Job / Booking No:</strong> {{ $invoice->booking_no }}<br>
                    @endif
                    @if($invoice->proforma_invoice_no)
                        <strong>Proforma No:</strong> {{ $invoice->proforma_invoice_no }}<br>
                        <strong>Proforma Date:</strong> {{ $invoice->proforma_invoice_date ? \Carbon\Carbon::parse($invoice->proforma_invoice_date)->format('d-M-Y') : '-' }}<br>
                    @endif
                    @if($invoice->guarantee_l1)
                        <strong>MBL/AWB:</strong> {{ $invoice->guarantee_l1 }}<br>
                    @endif
                    @if($invoice->guarantee_l2)
                        <strong>HBL/AWB:</strong> {{ $invoice->guarantee_l2 }}<br>
                    @endif
                    @if($invoice->guarantee_l3)
                        <strong>BE/SB No. & Date:</strong> {{ $invoice->guarantee_l3 }} @if($invoice->exten_date) | {{ \Carbon\Carbon::parse($invoice->exten_date)->format('d-M-Y') }} @endif<br>
                    @endif
                    @if($invoice->guarantee_l4)
                        <strong>Line / Vessel:</strong> {{ $invoice->guarantee_l4 }}<br>
                    @endif
                </div>
            </div>
        </div>

        <!-- TRANSPORT DETAILS GRID -->
        @if($invoice->category || $invoice->stype || $invoice->hcode || $invoice->remarks || $invoice->taxsch || $invoice->irn || $invoice->version || $invoice->credit_note_no || $invoice->credit_note_date)
            <div class="bg-light p-3 rounded-2 border mb-4">
                <div class="row g-2 fs-8 text-muted">
                    @if($invoice->category)
                        <div class="col-md-3"><strong>Origin/POL:</strong> {{ $invoice->category }}</div>
                    @endif
                    @if($invoice->stype)
                        <div class="col-md-3"><strong>Dest/POD:</strong> {{ $invoice->stype }}</div>
                    @endif
                    @if($invoice->hcode)
                        <div class="col-md-3"><strong>Gross Weight:</strong> {{ $invoice->hcode }}</div>
                    @endif
                    @if($invoice->remarks && strlen($invoice->remarks) < 50)
                        <div class="col-md-3"><strong>Ch Wt/Volume:</strong> {{ $invoice->remarks }}</div>
                    @endif
                    @if($invoice->taxsch)
                        <div class="col-md-3"><strong>Packages:</strong> {{ $invoice->taxsch }}</div>
                    @endif
                    @if($invoice->irn)
                        <div class="col-md-3"><strong>EGM/IGM or Container:</strong> {{ $invoice->irn }}</div>
                    @endif
                    @if($invoice->version)
                        <div class="col-md-3"><strong>CBM:</strong> {{ $invoice->version }}</div>
                    @endif
                    @if($invoice->credit_note_no)
                        <div class="col-md-3"><strong>Shipper Invoice:</strong> {{ $invoice->credit_note_no }}</div>
                    @endif
                </div>
            </div>
        @endif

        <!-- PARTICULARS TABLE -->
        <table class="table table-invoice mb-4">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">S.No</th>
                    <th>Description of Services</th>
                    <th class="text-center" style="width: 100px;">HSN/SAC</th>
                    <th class="text-end" style="width: 110px;">Non-Taxable</th>
                    <th class="text-end" style="width: 110px;">Taxable</th>
                    <th class="text-center" style="width: 90px;">CGST</th>
                    <th class="text-center" style="width: 90px;">SGST</th>
                    <th class="text-center" style="width: 90px;">IGST</th>
                    <th class="text-end" style="width: 120px;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($particulars as $index => $item)
                    <tr>
                        <td class="text-center text-muted">{{ $index + 1 }}</td>
                        <td>
                            <div class="fw-bold text-dark">{{ $item->Particulars }}</div>
                            @if($item->Additional)
                                <div class="fs-8 text-muted mt-0.5">{{ $item->Additional }}</div>
                            @endif
                        </td>
                        <td class="text-center">{{ $item->HSN ?? '-' }}</td>
                        <td class="text-end">{{ number_format($item->NonTaxAmount, 2) }}</td>
                        <td class="text-end">{{ number_format($item->TaxAmount, 2) }}</td>
                        <td class="text-center text-muted fs-8">
                            @if($item->CGSTValue > 0)
                                {{ number_format($item->CGSTValue, 2) }}<br><span class="text-muted fs-9">{{ $item->CGST }}%</span>
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-center text-muted fs-8">
                            @if($item->SGSTValue > 0)
                                {{ number_format($item->SGSTValue, 2) }}<br><span class="text-muted fs-9">{{ $item->SGST }}%</span>
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-center text-muted fs-8">
                            @if($item->IGSTValue > 0)
                                {{ number_format($item->IGSTValue, 2) }}<br><span class="text-muted fs-9">{{ $item->IGST }}%</span>
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-end fw-bold text-dark">{{ number_format($item->Total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- TOTALS & COMPUTATIONS -->
        <div class="row align-items-start mb-4">
            <!-- Words Total -->
            <div class="col-7">
                <div class="mb-3">
                    <span class="fs-8 text-muted text-uppercase fw-bold d-block mb-1">Total Amount In Words:</span>
                    <span class="fw-bold text-dark-blue fs-7 italic">{{ numberToWords($invoice->grand_total) }}</span>
                </div>

                <!-- Bank Details -->
                <div class="bank-box mb-3">
                    <h6 class="text-uppercase fw-bold text-dark fs-8 border-bottom pb-1 mb-2"><i class="fas fa-university me-1.5 text-primary"></i>Bank Payment Instructions</h6>
                    <table class="w-100">
                        <tr>
                            <td style="width: 90px;" class="text-muted">Bank Name:</td>
                            <td class="fw-bold text-dark">{{ $invoice->bank ?? 'YES Bank' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Account Name:</td>
                            <td class="fw-bold text-dark">TRACKSEN LOGISTICS</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Account No:</td>
                            <td class="fw-bold text-dark">123456789012 (Current A/c)</td>
                        </tr>
                        <tr>
                            <td class="text-muted">IFSC Code:</td>
                            <td class="fw-bold text-dark">YESB0000123</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Branch:</td>
                            <td class="text-dark">Rajaji Salai, Chennai</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Numbers Total -->
            <div class="col-5">
                <table class="w-100 totals-table">
                    <tr class="border-bottom">
                        <td class="text-muted py-1.5">Total Non-Taxable:</td>
                        <td class="text-end fw-bold py-1.5">{{ number_format($invoice->total_non_tax, 2) }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <td class="text-muted py-1.5">Total Taxable:</td>
                        <td class="text-end fw-bold py-1.5">{{ number_format($invoice->total_tax, 2) }}</td>
                    </tr>
                    @if($invoice->cgst_value > 0)
                        <tr class="border-bottom text-muted">
                            <td class="py-1.5">CGST:</td>
                            <td class="text-end fw-semibold py-1.5">{{ number_format($invoice->cgst_value, 2) }}</td>
                        </tr>
                    @endif
                    @if($invoice->sgst_value > 0)
                        <tr class="border-bottom text-muted">
                            <td class="py-1.5">SGST:</td>
                            <td class="text-end fw-semibold py-1.5">{{ number_format($invoice->sgst_value, 2) }}</td>
                        </tr>
                    @endif
                    @if($invoice->igst_value > 0)
                        <tr class="border-bottom text-danger">
                            <td class="py-1.5">IGST:</td>
                            <td class="text-end fw-semibold py-1.5">{{ number_format($invoice->igst_value, 2) }}</td>
                        </tr>
                    @endif
                    <tr class="border-bottom">
                        <td class="text-muted py-1.5">Sub-Total:</td>
                        <td class="text-end fw-bold py-1.5 text-dark">{{ number_format($invoice->total, 2) }}</td>
                    </tr>
                    <tr class="border-bottom text-muted">
                        <td class="py-1.5">Round Off:</td>
                        <td class="text-end fw-semibold py-1.5">{{ number_format($invoice->round_off, 2) }}</td>
                    </tr>
                    <tr class="border-bottom bg-light">
                        <td class="fw-bold py-2 fs-6 text-primary">Grand Total:</td>
                        <td class="text-end fw-bold py-2 fs-6 text-primary">{{ number_format($invoice->grand_total, 2) }}</td>
                    </tr>
                    <tr class="border-bottom text-success">
                        <td class="py-1.5">Advance Paid:</td>
                        <td class="text-end fw-bold py-1.5">{{ number_format($invoice->advance, 2) }}</td>
                    </tr>
                    <tr class="bg-danger bg-opacity-10 text-danger rounded">
                        <td class="fw-bold py-2 fs-7">Balance Due:</td>
                        <td class="text-end fw-bold py-2 fs-7">{{ number_format($invoice->balance, 2) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- TERMS & SIGNATURE -->
        <div class="row align-items-end pt-3 mt-4 border-top">
            <div class="col-7">
                <div class="terms-text">
                    <strong>Terms & Conditions:</strong><br>
                    1. Interest @ 18% per annum will be charged if this bill is not paid within the due credit period.<br>
                    2. Any discrepancy in this bill must be notified within 7 days of receipt.<br>
                    3. All payments should be made by Cheque/DD/NEFT/RTGS favoring <strong>TRACKSEN LOGISTICS</strong>.<br>
                    4. Subject to Chennai Jurisdiction.
                </div>
            </div>
            <div class="col-5 text-end">
                <div class="fs-8 text-muted mb-4">For <strong>TRACKSEN LOGISTICS</strong></div>
                @if($invoice->hcode == 'E-Signature')
                    <div class="d-inline-block border border-2 border-primary border-opacity-25 rounded px-3 py-1 bg-primary bg-opacity-5 text-primary fw-bold fs-7 mb-2 text-center" style="transform: rotate(-3deg);">
                        E-SIGNATURE AUTHORIZED<br>
                        <span class="fs-9 text-muted fw-normal">System Digitally Verified</span>
                    </div>
                @else
                    <div class="text-dark-blue fw-bold fs-7 mb-2">{{ $invoice->hcode }}</div>
                @endif
                <div class="border-top pt-1 text-muted fs-8 fw-semibold">Authorized Signatory</div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
