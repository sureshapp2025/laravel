@extends('addresses.layout')

@section('content')
<div class="px-3 py-3">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white border-bottom-0 py-3">
            <h2 class="h4 font-weight-bold text-dark mb-0">Edit Address: {{ $address->CompanyName }}</h2>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('addresses.update', $address->Id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Row 1: Type | Account Code --}}
                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="Type" class="form-label fw-bold">User Type</label>
                        <select class="form-select form-control" id="Type" name="Type">
                            <option value="client" {{ old('Type', $address->Type) == 'client' ? 'selected' : '' }}>Client</option>
                            <option value="vendor" {{ old('Type', $address->Type) == 'vendor' ? 'selected' : '' }}>Vendor</option>
                            <option value="both"   {{ old('Type', $address->Type) == 'both'   ? 'selected' : '' }}>Both</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="AccountCode" class="form-label fw-bold">
                            Account Code (AO) <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               class="form-control"
                               id="AccountCode"
                               name="AccountCode"
                               value="{{ old('AccountCode', $address->AccountCode) }}"
                               required>
                    </div>
                </div>

                {{-- Row 2: Company Name --}}
                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="CompanyName" class="form-label fw-bold">
                            Company Name <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               class="form-control"
                               id="CompanyName"
                               name="CompanyName"
                               value="{{ old('CompanyName', $address->CompanyName) }}"
                               required>
                    </div>
                    <div class="col-md-6">
                        <label for="Country" class="form-label fw-bold">
                            Country <span class="text-danger">*</span>
                        </label>
                        <select class="form-select form-control" id="Country" name="Country" required>
                            <option value="">Select Country</option>
                            <option value="India" {{ old('Country', $address->Country) == 'India' ? 'selected' : '' }}>India</option>
                            <option value="Other Than India" {{ old('Country', $address->Country) == 'Other Than India' ? 'selected' : '' }}>Other Than India</option>
                        </select>
                    </div>
                </div>

                {{-- Row 3: Address Line 1 | Address Line 2 --}}
                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label id="ALine1Label" for="ALine1" class="form-label fw-bold">
                            Address Line 1 <span id="ALine1Star" class="text-danger">*</span>
                        </label>
                        <input type="text"
                               class="form-control"
                               id="ALine1"
                               name="ALine1"
                               value="{{ old('ALine1', $address->ALine1) }}"
                               maxlength="100">
                        <small id="ALine1Help" class="text-muted"></small>
                    </div>
                    <div class="col-md-6">
                        <label id="ALine2Label" for="ALine2" class="form-label fw-bold">
                            Address Line 2 <span id="ALine2Star" class="text-danger">*</span>
                        </label>
                        <input type="text"
                               class="form-control"
                               id="ALine2"
                               name="ALine2"
                               value="{{ old('ALine2', $address->ALine2) }}"
                               maxlength="100">
                        <small id="ALine2Help" class="text-muted"></small>
                    </div>
                </div>

                {{-- Row 4: Location | Pincode --}}
                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label id="LocationLabel" for="Location" class="form-label fw-bold">
                            Location <span id="LocationStar" class="text-danger">*</span>
                        </label>
                        <input type="text"
                               class="form-control"
                               id="Location"
                               name="Location"
                               value="{{ old('Location', $address->Location) }}">
                    </div>
                    <div class="col-md-6">
                        <label id="PincodeLabel" for="Pincode" class="form-label fw-bold">
                            Pincode <span id="PincodeStar" class="text-danger">*</span>
                        </label>
                        <input type="text"
                               class="form-control"
                               id="Pincode"
                               name="Pincode"
                               value="{{ old('Pincode', $address->Pincode) }}">
                        <small id="PincodeHelp" class="text-muted"></small>
                    </div>
                </div>

                {{-- State row (India only) --}}
                <div class="row mb-3" id="stateRow" style="display: none;">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="ddl_StateName" class="form-label fw-bold">
                            State <span class="text-danger">*</span>
                        </label>
                        <select name="ddl_StateName" id="ddl_StateName" class="form-select form-control">
                            <option value="">---Select State---</option>
                            <option value="96">OTHER THAN INDIA</option>
                            <option value="99">CENTRE JURISDICTION</option>
                            <option value="97">OTHER TERRITORY</option>
                            <option value="35">ANDAMAN AND NICOBAR ISLANDS</option>
                            <option value="37">ANDHRA PRADESH</option>
                            <option value="28">ANDHRA PRADESH(BEFORE DIVISION)</option>
                            <option value="12">ARUNACHAL PRADESH</option>
                            <option value="18">ASSAM</option>
                            <option value="10">BIHAR</option>
                            <option value="04">CHANDIGARH</option>
                            <option value="22">CHATTISGARH</option>
                            <option value="26">DADRA AND NAGAR HAVELI</option>
                            <option value="25">DAMAN AND DIU</option>
                            <option value="07">DELHI</option>
                            <option value="30">GOA</option>
                            <option value="24">GUJARAT</option>
                            <option value="06">HARYANA</option>
                            <option value="02">HIMACHAL PRADESH</option>
                            <option value="01">JAMMU AND KASHMIR</option>
                            <option value="20">JHARKHAND</option>
                            <option value="29">KARNATAKA</option>
                            <option value="32">KERALA</option>
                            <option value="38">LADAKH</option>
                            <option value="31">LAKSHADWEEP ISLANDS</option>
                            <option value="23">MADHYA PRADESH</option>
                            <option value="27">MAHARASHTRA</option>
                            <option value="14">MANIPUR</option>
                            <option value="17">MEGHALAYA</option>
                            <option value="15">MIZORAM</option>
                            <option value="13">NAGALAND</option>
                            <option value="21">ODISHA</option>
                            <option value="34">PUDUCHERRY</option>
                            <option value="03">PUNJAB</option>
                            <option value="08">RAJASTHAN</option>
                            <option value="11">SIKKIM</option>
                            <option value="33">TAMIL NADU</option>
                            <option value="36">TELANGANA</option>
                            <option value="16">TRIPURA</option>
                            <option value="09">UTTAR PRADESH</option>
                            <option value="05">UTTARAKHAND</option>
                            <option value="19">WEST BENGAL</option>
                        </select>
                        <input type="hidden" id="State"     name="State"     value="{{ old('State', $address->State) }}">
                        <input type="hidden" id="StateCode" name="StateCode" value="{{ old('StateCode', $address->StateCode) }}">
                    </div>
                </div>

                {{-- Row 5: GST No | Credit Days --}}
                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label id="GSTNoLabel" for="GSTNo" class="form-label fw-bold">GST No</label>
                        <input type="text"
                               class="form-control"
                               id="GSTNo"
                               name="GSTNo"
                               value="{{ old('GSTNo', $address->GSTNo) }}">
                        <small id="GSTNoHelp" class="text-muted"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="CreditDays" class="form-label fw-bold">Credit Days</label>
                        <input type="number"
                               class="form-control"
                               id="CreditDays"
                               name="CreditDays"
                               value="{{ old('CreditDays', $address->CreditDays) }}">
                    </div>
                </div>

                {{-- Row 6: PAN | Email --}}
                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="PAN" class="form-label fw-bold">PAN</label>
                        <input type="text" class="form-control" id="PAN" name="PAN" value="{{ old('PAN', $address->PAN) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="Email" class="form-label fw-bold">Email - ID</label>
                        <input type="email" class="form-control" id="Email" name="Email" value="{{ old('Email', $address->Email) }}">
                    </div>
                </div>

                {{-- Row 7: Contact Name | Phone --}}
                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="ContactName" class="form-label fw-bold">Contact Name</label>
                        <input type="text" class="form-control" id="ContactName" name="ContactName" value="{{ old('ContactName', $address->ContactName) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="Phone" class="form-label fw-bold">Phone</label>
                        <input type="text" class="form-control" id="Phone" name="Phone" value="{{ old('Phone', $address->Phone) }}">
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary px-4">Update Address</button>
                    <a href="{{ route('addresses.index') }}" class="btn btn-light ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function updateState() {
        var selectedVal  = $('#ddl_StateName').val();
        var selectedText = $('#ddl_StateName option:selected').text();

        if (selectedVal) {
            $('#StateCode').val(selectedVal);
            $('#State').val(selectedText);
        } else {
            $('#StateCode').val('');
            $('#State').val('');
        }
    }

    function handleCountryChange() {
        var country = $('#Country').val();

        if (country === 'India') {
            $('#stateRow').css('display', 'flex');
            $('#ddl_StateName').prop('required', true);

            $('#ALine1').prop({ required: true, maxlength: 100 });
            $('#ALine1Star').show();
            $('#ALine1Help').text('Required (max 100 characters)');

            $('#ALine2').prop({ required: true, maxlength: 100 });
            $('#ALine2Star').show();
            $('#ALine2Help').text('Required (max 100 characters)');

            $('#Location').prop('required', true);
            $('#LocationStar').show();

            var currentPincode = $('#Pincode').val();
            $('#Pincode').prop({
                required:  true,
                readonly:  false,
                maxlength: 6,
                minlength: 6
            }).val(currentPincode === '999999' ? '' : currentPincode);
            $('#PincodeStar').show();
            $('#PincodeHelp').text('6 digits mandatory');

            $('#GSTNoLabel').html('GST No <span class="text-danger">*</span>');
            if ($('#GSTNo').val() === 'URP') { $('#GSTNo').val(''); }
            $('#GSTNo').prop({
                readonly:  false,
                required:  true,
                maxlength: 16,
                minlength: 16
            });
            $('#GSTNoHelp').text('Exactly 16 characters required');

        } else if (country !== '') {
            $('#stateRow').hide();
            $('#ddl_StateName').prop('required', false).val('');
            $('#StateCode').val('96');
            $('#State').val('OTHER THAN INDIA');

            $('#ALine1').prop({ required: false, maxlength: 60 });
            $('#ALine1Star').hide();
            $('#ALine1Help').text('Optional (max 60 characters)');

            $('#ALine2').prop({ required: false, maxlength: 60 });
            $('#ALine2Star').hide();
            $('#ALine2Help').text('Optional (max 60 characters)');

            $('#Location').prop('required', false);
            $('#LocationStar').hide();

            $('#Pincode')
                .val('999999')
                .prop({ readonly: true, required: false })
                .removeAttr('minlength maxlength');
            $('#PincodeStar').hide();
            $('#PincodeHelp').text('Default 999999 (non-editable for non-India)');

            $('#GSTNoLabel').text('GST No');
            $('#GSTNo')
                .val('URP')
                .prop({ readonly: true, required: false })
                .removeAttr('minlength maxlength');
            $('#GSTNoHelp').text('Defaults to URP for non-India');

        } else {
            $('#stateRow').hide();
            $('#ddl_StateName').prop('required', false);

            $('#ALine1').prop({ required: false, maxlength: 100 });
            $('#ALine1Star').show();
            $('#ALine1Help').text('');

            $('#ALine2').prop({ required: false, maxlength: 100 });
            $('#ALine2Star').show();
            $('#ALine2Help').text('');

            $('#Location').prop('required', false);
            $('#LocationStar').show();

            $('#Pincode')
                .val('')
                .prop({ readonly: false, required: false })
                .removeAttr('minlength maxlength');
            $('#PincodeStar').show();
            $('#PincodeHelp').text('');

            $('#GSTNoLabel').text('GST No');
            $('#GSTNo')
                .prop({ readonly: false, required: false })
                .removeAttr('minlength maxlength');
            $('#GSTNoHelp').text('');
        }
    }

    $(document).ready(function () {
        var stateVal = $('#StateCode').val();
        if (stateVal) {
            $('#ddl_StateName').val(stateVal);
        }

        handleCountryChange();

        $('#Country').on('change', function () {
            handleCountryChange();
        });

        $('#ddl_StateName').on('change', function () {
            updateState();
        });
    });
</script>
@endsection
