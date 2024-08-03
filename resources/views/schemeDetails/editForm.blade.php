<x-admin.layout>
    <x-slot name="title">Edit Detailas</x-slot>
    <x-slot name="heading">Edit Detailas</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


        <!-- Add Form -->
        <div class="row" id="addContainer">
            <div class="col-sm-12">
                <div class="card">
                    <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="card-header">
                                    <h4 class="text-center"><b>Update Details (तपशील अपडेट करा)</b></h4>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="name_of_scheme">Name Of Scheme (योजनेचे नाव)<span class="text-danger">*</span></label>
                                    <input class="form-control" id="name_of_scheme" name="name_of_scheme" type="text" placeholder="Enter Name Of Scheme" value="{{ $scheme_detail->name_of_scheme }}">
                                    <span class="text-danger is-invalid name_of_scheme_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="location_of_scheme">Location Of Scheme (योजनेची जागा)<span class="text-danger">*</span></label>
                                    <input class="form-control" id="location_of_scheme" name="location_of_scheme" type="text" placeholder="Enter Applicant Name" value="{{ $scheme_detail->location_of_scheme }}">
                                    <span class="text-danger is-invalid location_of_scheme_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="land_details">Land Details (जमिनीची माहिती)<span class="text-danger">*</span></label>
                                    <input class="form-control" id="land_details" name="land_details" type="text" placeholder="Enter Land Details" value="{{ $scheme_detail->land_details }}">
                                    <span class="text-danger is-invalid land_details_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="developer_name">Developer Name (विकसकाचे नाव)<span class="text-danger">*</span></label>
                                    <input class="form-control" id="developer_name" name="developer_name" type="text" placeholder="Enter Developer Name" value="{{ $scheme_detail->developer_name }}">
                                    <span class="text-danger is-invalid developer_name_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="architect_name">Architect Name (आर्किटेक्टचे नाव)<span class="text-danger">*</span></label>
                                    <input class="form-control" id="architect_name" name="architect_name" type="text" placeholder="Enter Architect Name" value="{{ $scheme_detail->architect_name }}">
                                    <span class="text-danger is-invalid architect_name_err"></span>
                                </div>

                                <div class="col-md-4">
                                </div>

                                <hr class="mt-2">

                                <div class="col-md-5">
                                    <label class="col-form-label" for="name_of_slum_developer">Name Of Slum Developer (झोपडपट्टी विकासकाचे नाव)<span class="text-danger">*</span></label>
                                    <input class="form-control" id="name_of_slum_developer" name="name_of_slum_developer" type="text" placeholder="Enter Name Of Slum Developer" value="{{ $scheme_detail->name_of_slum_developer }}">
                                    <span class="text-danger is-invalid name_of_slum_developer_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="numbering_annexure_two">Numbering Annexure 2 (परिशिष्ट 2 क्रमांकन)<span class="text-danger">*</span></label>
                                    <input class="form-control" id="numbering_annexure_two" name="numbering_annexure_two" type="file" placeholder="Enter Numbering Annexure 2">
                                    <span class="text-danger is-invalid numbering_annexure_two_err"></span>
                                </div>

                                <hr class="mt-2">

                                {{-- <h3 class="text-center">Bank Details (बँक तपशील)</h3> --}}

                                <div class="col-md-4">
                                    <label class="col-form-label" for="bank_name">Bank Name (बँकेचे नाव)<span class="text-danger">*</span></label>
                                    <input class="form-control" id="bank_name" name="bank_name" type="text" placeholder="Enter Bank Name" value="{{ $scheme_detail->bank_name }}">
                                    <span class="text-danger is-invalid bank_name_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="bank_account_no">Bank Account Number (बँक खाते नंबर)<span class="text-danger">*</span></label>
                                    <input class="form-control" id="bank_account_no" name="bank_account_no" type="text" placeholder="Enter Bank Account Number" value="{{ $scheme_detail->bank_account_no }}">
                                    <span class="text-danger is-invalid bank_account_no_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="upload_cancelled_cheque">Upload Cancelled Cheque (रद्द चेक अपलोड करा)<span class="text-danger">*</span></label>
                                    <input class="form-control" id="upload_cancelled_cheque" name="upload_cancelled_cheque" type="file" placeholder="Enter Applicant Name">
                                    <span class="text-danger is-invalid upload_cancelled_cheque_err"></span>
                                </div>

                                <hr class="mt-2">
                                
                                {{-- <h3 class="text-center">Others Details (इतर तपशील)</h3> --}}
                                
                                <div class="col-md-4">
                                    <label class="col-form-label" for="period_of_rent">Period Of Rent (भाड्याचा कालावधी)<span class="text-danger">*</span></label>
                                    <input class="form-control" id="period_of_rent" name="period_of_rent" type="text" placeholder="Enter Period Of Rent" value="{{ $scheme_detail->period_of_rent }}">
                                    <span class="text-danger is-invalid period_of_rent_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="amount_to_pay">Amount To Pay (देय रक्कम)<span class="text-danger">*</span></label>
                                    <input class="form-control" id="amount_to_pay" name="amount_to_pay" type="text" placeholder="Enter Amount To Pay" value="{{ $scheme_detail->amount_to_pay }}">
                                    <span class="text-danger is-invalid amount_to_pay_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="paid_amount">Paid Amount (भरलेली रक्कम)<span class="text-danger">*</span></label>
                                    <input class="form-control" id="paid_amount" name="paid_amount" type="text" placeholder="Enter Paid Amount" value="{{ $scheme_detail->paid_amount }}">
                                    <span class="text-danger is-invalid paid_amount_err"></span>
                                </div>

                                {{-- <div class="col-md-4">
                                    <label class="col-form-label" for="balance_amount">Balance Amount (शिल्लक रक्कम)<span class="text-danger">*</span></label>
                                    <input class="form-control" id="balance_amount" name="balance_amount" type="text" placeholder="Enter Balance Amount">
                                    <span class="text-danger is-invalid balance_amount_err"></span>
                                </div> --}}

                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="addSubmit">Submit</button>
                            <a href="{{ route('list.schemeDetails') }}" class="btn btn-warning">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</x-admin.layout>
