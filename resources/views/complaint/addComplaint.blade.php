<x-admin.layout>
    <x-slot name="title">Add Complaint</x-slot>
    <x-slot name="heading">Add Complaint</x-slot>
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
                                    <h2 class="text-center"><b>Applicant Details (अर्जदाराचे तपशील)</b></h2>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="applicant_name">Applicant Name (अर्जदाराचे नाव) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="applicant_name" name="applicant_name" type="text" placeholder="Enter Applicant Name">
                                    <span class="text-danger is-invalid applicant_name_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="applicant_current_address">Applicant Address (सध्याचा अर्जदाराचा पत्ता) <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="applicant_current_address" id="applicant_current_address" cols="30" rows="2" placeholder="Enter Applicant Current Address"></textarea>
                                    <span class="text-danger is-invalid applicant_current_address_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="applicant_mobile_no">Applicant Mobile No (अर्जदाराचा मोबाईल क्र) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="applicant_mobile_no" name="applicant_mobile_no" type="number" placeholder="Enter Applicant Mobile No">
                                    <span class="text-danger is-invalid applicant_mobile_no_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="applicant_aadhar_no">Applicant Aadhar No (अर्जदाराचा आधार क्र)</label>
                                    <input class="form-control" id="applicant_aadhar_no" name="applicant_aadhar_no" type="number" placeholder="Enter Applicant Aadhar No">
                                    <span class="text-danger is-invalid applicant_aadhar_no_err"></span>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="card-header">
                                    <h2 class="text-center"><b>Current status of applicant in Annexure 2 (परिशिष्ट २ मधील अर्जदाराची सद्यस्तिथी )</b></h2>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label" for="original_no">A in original Pari-2. No (मुळ  परि -२ मधील अ . क्र :) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="original_no" name="original_no" type="text" placeholder="Enter Number">
                                    <span class="text-danger is-invalid original_no_err"></span>
                                </div>

                                <div class="col-md-6">
                                    <label class="col-form-label" for="original_is_eligible">Eligible / Ineligible(पात्र / अपात्र ) <span class="text-danger">*</span></label>
                                    <select class="form-control" name="original_is_eligible" id="original_is_eligible">
                                        <option value="">Select Option</option>
                                        <option value="yes">Yes / होय</option>
                                        <option value="no">No / नाही</option>
                                    </select>
                                    <span class="text-danger is-invalid original_is_eligible_err"></span>
                                </div>

                                <div class="col-md-6">
                                    <label class="col-form-label" for="appendix_no">A in Appendix Par-2. No : (पुरवणी  परि -२ मधील अ . क्र :) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="appendix_no" name="appendix_no" type="text" placeholder="Enter Number">
                                    <span class="text-danger is-invalid appendix_no_err"></span>
                                </div>

                                <div class="col-md-6">
                                    <label class="col-form-label" for="appendix_is_eligible">Eligible / Ineligible(पात्र / अपात्र ) <span class="text-danger">*</span></label>
                                    <select class="form-control" name="appendix_is_eligible" id="appendix_is_eligible">
                                        <option value="">Select Option</option>
                                        <option value="yes">Yes / होय</option>
                                        <option value="no">No / नाही</option>
                                    </select>
                                    <span class="text-danger is-invalid appendix_is_eligible_err"></span>
                                </div>

                                <div class="col-md-6" id="appendix_doc_container" style="display: none;">
                                    <label class="col-form-label" for="appendix_doc">Attach a copy if qualified in Supplementary Annexure-2 (पुरवणी परी - २ मध्ये पात्र असल्यास त्याची प्रत जोडावी)<span class="text-danger">*</span></label>
                                    <input class="form-control" id="appendix_doc" name="appendix_doc" type="file">
                                    <span class="text-danger is-invalid appendix_doc_err"></span>
                                </div>

                            </div>
                        </div>

                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="card-header">
                                    <h2 class="text-center"><b>Scheme Details (योजना तपशील)</b></h2>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label" for="scheme_name">Scheme Name (योजनेचे नाव) <span class="text-danger">*</span></label>
                                    <select class="form-control" name="scheme_name" id="scheme_name">
                                        <option value="">Select Shceme</option>
                                        @foreach ($schemes_list as $list)
                                            <option value="{{ $list->id }}">{{ $list->scheme_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger is-invalid scheme_name_err"></span>
                                </div>

                                <div class="col-md-6">
                                    <label class="col-form-label" for="scheme_details">Scheme Details (योजना तपशील)<span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="scheme_details" id="scheme_details" cols="30" rows="2" placeholder="Scheme Details" readonly></textarea>
                                    <span class="text-danger is-invalid scheme_details_err"></span>
                                </div>

                            </div>
                        </div>

                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="card-header">
                                    <h2 class="text-center"><b>Contractor Details (कंत्राटदार तपशील)</b></h2>
                                </div>

                                <div class="col-md-6">
                                    <label class="col-form-label" for="contractor_name">Contractor Name <span class="text-danger">*</span></label>
                                    <input class="form-control" name="contractor_name" id="contractor_name" placeholder="Contractor Name" readonly>
                                    {{-- <select class="form-control" name="contractor_name" id="contractor_name">
                                        <option value="">Contractor Name (कंत्राटदाराचे नाव)</option>
                                        @foreach ($contractor_list as $list)
                                            <option value="{{ $list->id }}">{{ $list->contractor_name }}</option>
                                        @endforeach
                                    </select> --}}
                                    <span class="text-danger is-invalid contractor_name_err"></span>
                                </div>

                                <div class="col-md-6">
                                    <label class="col-form-label" for="contractor_details">Contractor Details (कंत्राटदार तपशील)<span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="contractor_details" id="contractor_details" cols="30" rows="2" placeholder="Contractor Details" readonly></textarea>
                                    <span class="text-danger is-invalid contractor_details_err"></span>
                                </div>

                            </div>
                        </div>

                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="card-header">
                                    <h2 class="text-center"><b>Others Details (इतर तपशील)</b></h2>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label" for="date_of_demolition">Date of demolition of hut (झोपडी तोडल्याची दिनांक)<span class="text-danger">*</span></label>
                                    <input class="form-control" type="date" name="date_of_demolition" id="date_of_demolition">
                                    <span class="text-danger is-invalid date_of_demolition_err"></span>
                                </div>

                                <div class="col-md-6">
                                    <label class="col-form-label" for="is_there_rental_agreement">Is there a rental agreement? (भाडे करार करण्यात आलेला आहे का ?)<span class="text-danger">*</span></label>
                                    <select class="form-control" name="form-control" name="is_there_rental_agreement" id="is_there_rental_agreement">
                                        <option value="">Select Option</option>
                                        <option value="yes">Yes / होय</option>
                                        <option value="no">No / नाही</option>
                                    </select>
                                    <span class="text-danger is-invalid is_there_rental_agreement_err"></span>
                                </div>

                                <div class="col-md-6 rental_aggrement_container" style="display: none">
                                    <label class="col-form-label" for="date_of_agreement">Date of agreement (कराराची तारीख)<span class="text-danger">*</span></label>
                                    <input class="form-control" type="date" name="date_of_agreement" id="date_of_agreement">
                                    <span class="text-danger is-invalid date_of_agreement_err"></span>
                                </div>

                                <div class="col-md-6 rental_aggrement_container" style="display: none">
                                    <label class="col-form-label" for="monthly_rate_of_rent">Monthly rate of rent (भाड्याचा मासिक दर)<span class="text-danger">*</span></label>
                                    <input class="form-control" type="number" name="monthly_rate_of_rent" id="monthly_rate_of_rent" placeholder="Enter Monlty rate of rent">
                                    <span class="text-danger is-invalid monthly_rate_of_rent_err"></span>
                                </div>

                                <div class="col-md-6">
                                    <label class="col-form-label" for="is_developer_paid_earlier_rent">Has the developer paid the rent earlier? (विकासकाने पूर्वी भाडे दिले आहे ?)<span class="text-danger">*</span></label>
                                    <select class="form-control" name="form-control" name="is_developer_paid_earlier_rent" id="is_developer_paid_earlier_rent">
                                        <option value="">Select Option</option>
                                        <option value="yes">Yes / होय</option>
                                        <option value="no">No / नाही</option>
                                    </select>
                                    <span class="text-danger is-invalid is_developer_paid_earlier_rent_err"></span>
                                </div>

                                {{-- <div class="col-md-6">
                                    <label class="col-form-label" for="old_date_of_agreement">Old Date of agreement (कराराची जुनी तारीख)<span class="text-danger">*</span></label>
                                    <input class="form-control" type="date" name="old_date_of_agreement" id="old_date_of_agreement">
                                    <span class="text-danger is-invalid old_date_of_agreement_err"></span>
                                </div> --}}

                                <div class="col-md-6" id="old_monthly_rate_of_rent_container" style="display: none">
                                    <label class="col-form-label" for="old_monthly_rate_of_rent">Old Monthly rate of rent (भाड्याचा जुना मासिक दर)<span class="text-danger">*</span></label>
                                    <input class="form-control" type="number" name="old_monthly_rate_of_rent" id="old_monthly_rate_of_rent" placeholder="Enter old Monlty rate of rent">
                                    <span class="text-danger is-invalid old_monthly_rate_of_rent_err"></span>
                                </div>

                                <div class="col-md-6">
                                    <label class="col-form-label" for="date_of_previous_rent_was">Date of month up to which previous rent was received (मागील भाडे कोणत्या महिन्यापर्यंत प्राप्त झाले त्याची दिनांक )<span class="text-danger">*</span></label>
                                    <input class="form-control" type="date" name="date_of_previous_rent_was" id="date_of_previous_rent_was">
                                    <span class="text-danger is-invalid date_of_previous_rent_was_err"></span>
                                </div>

                                <div class="col-md-6">
                                    <label class="col-form-label" for="montly_received_date">At what monthly rate was the said rent received? (सदरील भाडे कोणत्या मासिक दराने मिळाले)<span class="text-danger">*</span></label>
                                    <input class="form-control" type="number" name="montly_received_date" id="montly_received_date">
                                    <span class="text-danger is-invalid montly_received_date_err"></span>
                                </div>


                            </div>
                        </div>

                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="card-header">
                                    <h2 class="text-center"><b>Bank Details (बँक तपशील)</b></h2>
                                </div>

                                <div class="col-md-6">
                                    <label class="col-form-label" for="bank_account_no">Bank Account No (बँक खाते क्र)<span class="text-danger">*</span></label>
                                    <input class="form-control" type="number" name="bank_account_no" id="bank_account_no">
                                    <span class="text-danger is-invalid bank_account_no_err"></span>
                                </div>

                                <div class="col-md-6">
                                    <label class="col-form-label" for="bank_name">Bank Name (बँकेचे नाव)<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="bank_name" id="bank_name">
                                    <span class="text-danger is-invalid bank_name_err"></span>
                                </div>

                                <div class="col-md-6">
                                    <label class="col-form-label" for="bank_address">Bank Address (बँकेचा पत्ता)<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="bank_address" id="bank_address">
                                    <span class="text-danger is-invalid bank_address_err"></span>
                                </div>

                                <div class="col-md-6">
                                    <label class="col-form-label" for="ifsc_code">IFSC Code (आयएफएससी कोड)<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="ifsc_code" id="ifsc_code">
                                    <span class="text-danger is-invalid ifsc_code_err"></span>
                                </div>

                                <div class="col-md-6">
                                    <label class="col-form-label" for="copy_of_bank_passbook">Copy of first page of bank passbook (बँकेच्या पासबुकच्या प्रथम पृष्ठाची प्रत)<span class="text-danger">*</span></label>
                                    <input class="form-control" type="file" name="copy_of_bank_passbook" id="copy_of_bank_passbook">
                                    <span class="text-danger is-invalid copy_of_bank_passbook_err"></span>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="addSubmit">Submit</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</x-admin.layout>


{{-- Add --}}
<script>
    $("#addForm").submit(function(e) {
        e.preventDefault();
        $("#addSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('complaint.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data)
            {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                        .then((action) => {
                            window.location.href = '{{ route('complaint.index') }}';
                        });
                else
                    swal("Error!", data.error2, "error");
            },
            statusCode: {
                422: function(responseObject, textStatus, jqXHR) {
                    $("#addSubmit").prop('disabled', false);
                    resetErrors();
                    printErrMsg(responseObject.responseJSON.errors);
                },
                500: function(responseObject, textStatus, errorThrown) {
                    $("#addSubmit").prop('disabled', false);
                    swal("Error occured!", "Something went wrong please try again", "error");
                }
            }
        });

    });
</script>

<script>
    $(document).ready(function() {
        $('#appendix_is_eligible').change(function() {
            if ($(this).val() === 'yes') {
                $('#appendix_doc_container').show();
            } else {
                $('#appendix_doc_container').hide();
            }
        });

        $('#is_there_rental_agreement').change(function() {
            if ($(this).val() === 'yes') {
                $('.rental_aggrement_container').show();
            } else {
                $('.rental_aggrement_container').hide();
            }
        });

        $('#is_developer_paid_earlier_rent').change(function() {
            if ($(this).val() === 'yes') {
                $('#old_monthly_rate_of_rent_container').show();
            } else {
                $('#old_monthly_rate_of_rent_container').hide();
            }
        });

    });
</script>


<script>
    $(document).ready(function() {
        $('#scheme_name').change(function() {
            var schemeId = $(this).val();
            if (schemeId) {
                $.ajax({
                    url: '/get-scheme-details/' + schemeId,
                    method: 'GET',
                    success: function(response) {
                        $('#scheme_details').val(response.scheme_detail.scheme_detail);
                        $('#contractor_name').val(response.contractor_detail.contractor_name);
                        $('#contractor_details').val(response.contractor_detail.contractor_address);
                    },
                    error: function() {
                        alert('Failed to fetch scheme details. Please try again.');
                    }
                });
            }
        });
    });
</script>