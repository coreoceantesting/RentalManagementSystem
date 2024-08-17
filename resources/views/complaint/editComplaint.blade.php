<x-admin.layout>
    <x-slot name="title">View Complaint Details</x-slot>
    <x-slot name="heading">View Complaint Details</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


        <!-- Add Form -->
        <div class="row" id="addContainer">
            <div class="col-sm-12">
                <form class="theme-form" name="editForm" id="editForm" enctype="multipart/form-data">
                    @csrf
                        <div class="card">
                            <input type="hidden" name="edit_model_id" id="edit_model_id" value="{{ $application_detail->id }}">
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <div class="card-header">
                                        <h4 class="text-center"><b>Applicant Details (अर्जदाराचे तपशील)</b></h4>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-form-label" for="applicant_name">Applicant Name (अर्जदाराचे नाव)</label>
                                        <input class="form-control" id="applicant_name" name="applicant_name" type="text" placeholder="Enter Applicant Name" value="{{ $application_detail->applicant_name }}" >
                                        <span class="text-danger is-invalid applicant_name_err"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-form-label" for="applicant_current_address">Applicant Address (सध्याचा अर्जदाराचा पत्ता)</label>
                                        <textarea class="form-control" name="applicant_current_address" id="applicant_current_address" cols="30" rows="2" placeholder="Enter Applicant Current Address">{{ $application_detail->applicant_current_address }}</textarea>
                                        <span class="text-danger is-invalid applicant_current_address_err"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-form-label" for="applicant_mobile_no">Applicant Mobile No (अर्जदाराचा मोबाईल क्र)</label>
                                        <input class="form-control" id="applicant_mobile_no" name="applicant_mobile_no" type="number" placeholder="Enter Applicant Mobile No" value="{{ $application_detail->applicant_mobile_no }}">
                                        <span class="text-danger is-invalid applicant_mobile_no_err"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-form-label" for="applicant_aadhar_no">Applicant Aadhar No (अर्जदाराचा आधार क्र)</label>
                                        <input class="form-control" id="applicant_aadhar_no" name="applicant_aadhar_no" type="number" placeholder="Enter Applicant Aadhar No" value="{{ $application_detail->applicant_aadhar_no }}">
                                        <span class="text-danger is-invalid applicant_aadhar_no_err"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <div class="card-header">
                                        <h4 class="text-center"><b>Current status of applicant in Annexure 2 (परिशिष्ट २ मधील अर्जदाराची सद्यस्तिथी )</b></h4>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label" for="original_no">A in original Pari-2. No (मुळ  परि -२ मधील अ . क्र :)</label>
                                        <input class="form-control" id="original_no" name="original_no" type="text" placeholder="Enter Number" value="{{ $application_detail->original_no }}">
                                        <span class="text-danger is-invalid original_no_err"></span>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="col-form-label" for="original_is_eligible">Eligible / Ineligible(पात्र / अपात्र )</label>
                                        <select class="form-control" name="original_is_eligible" id="original_is_eligible">
                                            <option value="">Select Option</option>
                                            <option value="yes" @if($application_detail->original_is_eligible == "yes") selected @endif>Yes / होय</option>
                                            <option value="no" @if($application_detail->original_is_eligible == "no") selected @endif>No / नाही</option>
                                        </select>
                                        <span class="text-danger is-invalid original_is_eligible_err"></span>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="col-form-label" for="appendix_no">A in Appendix Par-2. No : (पुरवणी  परि -२ मधील अ . क्र :)</label>
                                        <input class="form-control" id="appendix_no" name="appendix_no" type="text" placeholder="Enter Number" value="{{ $application_detail->appendix_no }}">
                                        <span class="text-danger is-invalid appendix_no_err"></span>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="col-form-label" for="appendix_is_eligible">Eligible / Ineligible(पात्र / अपात्र )</label>
                                        <select class="form-control" name="appendix_is_eligible" id="appendix_is_eligible">
                                            <option value="">Select Option</option>
                                            <option value="yes" @if($application_detail->appendix_is_eligible == "yes") selected @endif >Yes / होय</option>
                                            <option value="no" @if($application_detail->appendix_is_eligible == "no") selected @endif >No / नाही</option>
                                        </select>
                                        <span class="text-danger is-invalid appendix_is_eligible_err"></span>
                                    </div>

                                    <div class="col-md-6" id="appendix_doc_container" @if($application_detail->appendix_is_eligible == "yes") style="display: block;" @else style="display: none;" @endif >
                                        <label class="col-form-label" for="appendix_doc">a copy if qualified in Supplementary Annexure-2 (पुरवणी परी - २ मध्ये पात्र असल्यास त्याची प्रत)</label>
                                        <input class="form-control" id="appendix_doc" name="appendix_doc" type="file">
                                        <span class="text-danger is-invalid appendix_doc_err"></span>

                                        <a target="blank" class="btn btn-sm btn-primary" href="{{ asset('storage/' . $application_detail->appendix_doc) }}">View Document</a>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <div class="card-header">
                                        <h4 class="text-center"><b>Scheme Details (योजना तपशील)</b></h4>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label" for="scheme_name">Scheme Name (योजनेचे नाव)</label>
                                        <select class="form-control" name="scheme_name" id="scheme_name">
                                            <option value="">Select Shceme</option>
                                            @foreach ($schemes_list as $list)
                                                <option value="{{ $list->id }}" @if($application_detail->scheme_name == $list->id) selected @endif>{{ $list->scheme_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger is-invalid scheme_name_err"></span>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="col-form-label" for="scheme_details">Scheme Details (योजना तपशील)</label>
                                        <textarea class="form-control" name="scheme_details" id="scheme_details" cols="30" rows="2" placeholder="Scheme Details" readonly>{{ $application_detail->scheme_details }}</textarea>
                                        <span class="text-danger is-invalid scheme_details_err"></span>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <div class="card-header">
                                        <h4 class="text-center"><b>Developer Details (विकसक तपशील)</b></h4>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="col-form-label" for="contractor_name">Developer Name (विकसकाचे नाव)</label>
                                        <input class="form-control" name="contractor_name" id="contractor_name" placeholder="Developer Name" value="{{ $application_detail->contractor_name }}" readonly>
                                        <span class="text-danger is-invalid contractor_name_err"></span>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="col-form-label" for="contractor_details">Developer Details (विकसक तपशील)</label>
                                        <textarea class="form-control" name="contractor_details" id="contractor_details" cols="30" rows="2" placeholder="Developer Details" readonly>{{ $application_detail->contractor_details }}</textarea>
                                        <span class="text-danger is-invalid contractor_details_err"></span>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <div class="card-header">
                                        <h4 class="text-center"><b>Others Details (इतर तपशील)</b></h4>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label" for="date_of_demolition">Date of demolition of hut (झोपडी तोडल्याची दिनांक)</label>
                                        <input class="form-control" type="date" name="date_of_demolition" id="date_of_demolition" value="{{ $application_detail->date_of_demolition }}">
                                        <span class="text-danger is-invalid date_of_demolition_err"></span>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="col-form-label" for="is_there_rental_agreement">Is there a rental agreement? (भाडे करार करण्यात आलेला आहे का ?)</label>
                                        <select class="form-control" name="is_there_rental_agreement" id="is_there_rental_agreement">
                                            <option value="">Select Option</option>
                                            <option value="yes" @if($application_detail->is_there_rental_agreement == "yes") selected @endif>Yes / होय</option>
                                            <option value="no" @if($application_detail->is_there_rental_agreement == "no") selected @endif>No / नाही</option>
                                        </select>
                                        <span class="text-danger is-invalid is_there_rental_agreement_err"></span>
                                    </div>

                                    <div class="col-md-6 rental_aggrement_container" @if($application_detail->is_there_rental_agreement == "yes") style="display: block" @else style="display: none" @endif >
                                        <label class="col-form-label" for="date_of_agreement">Date of agreement (कराराची तारीख)</label>
                                        <input class="form-control" type="date" name="date_of_agreement" id="date_of_agreement" value="{{ $application_detail->date_of_agreement }}">
                                        <span class="text-danger is-invalid date_of_agreement_err"></span>
                                    </div>

                                    <div class="col-md-6 rental_aggrement_container" @if($application_detail->is_there_rental_agreement == "yes") style="display: block" @else style="display: none" @endif>
                                        <label class="col-form-label" for="monthly_rate_of_rent">Monthly rate of rent (भाड्याचा मासिक दर)</label>
                                        <input class="form-control" type="number" name="monthly_rate_of_rent" id="monthly_rate_of_rent"  value="{{ $application_detail->monthly_rate_of_rent }}">
                                        <span class="text-danger is-invalid monthly_rate_of_rent_err"></span>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="col-form-label" for="is_developer_paid_earlier_rent">Has the developer paid the rent earlier? (विकासकाने पूर्वी भाडे दिले आहे ?)</label>
                                        <select class="form-control" name="is_developer_paid_earlier_rent" id="is_developer_paid_earlier_rent">
                                            <option value="">Select Option</option>
                                            <option value="yes" @if($application_detail->is_developer_paid_earlier_rent == "yes") selected @endif>Yes / होय</option>
                                            <option value="no" @if($application_detail->is_developer_paid_earlier_rent == "no") selected @endif>No / नाही</option>
                                        </select>
                                        <span class="text-danger is-invalid is_developer_paid_earlier_rent_err"></span>
                                    </div>

                                    {{-- <div class="col-md-6">
                                        <label class="col-form-label" for="old_date_of_agreement">Old Date of agreement (कराराची जुनी तारीख)<span class="text-danger">*</span></label>
                                        <input class="form-control" type="date" name="old_date_of_agreement" id="old_date_of_agreement">
                                        <span class="text-danger is-invalid old_date_of_agreement_err"></span>
                                    </div> --}}

                                    <div class="col-md-6" id="old_monthly_rate_of_rent_container"  @if($application_detail->is_developer_paid_earlier_rent == "yes") style="display: block" @else style="display: none" @endif>
                                        <label class="col-form-label" for="old_monthly_rate_of_rent">Old Monthly rate of rent (भाड्याचा जुना मासिक दर)</label>
                                        <input class="form-control" type="number" name="old_monthly_rate_of_rent" id="old_monthly_rate_of_rent" placeholder="Enter old Monlty rate of rent" value="{{ $application_detail->old_monthly_rate_of_rent  }}">
                                        <span class="text-danger is-invalid old_monthly_rate_of_rent_err"></span>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="col-form-label" for="date_of_previous_rent_was">Date of month up to which previous rent was received (मागील भाडे कोणत्या महिन्यापर्यंत प्राप्त झाले त्याची दिनांक )</label>
                                        <input class="form-control" type="date" name="date_of_previous_rent_was" id="date_of_previous_rent_was" value="{{ $application_detail->date_of_previous_rent_was  }}">
                                        <span class="text-danger is-invalid date_of_previous_rent_was_err"></span>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="col-form-label" for="montly_received_rate">At what monthly rate was the said rent received? (सदरील भाडे कोणत्या मासिक दराने मिळाले)</label>
                                        <input class="form-control" type="number" name="montly_received_rate" id="montly_received_rate" placeholder="Enter Amount" value="{{ $application_detail->montly_received_rate  }}">
                                        <span class="text-danger is-invalid montly_received_rate_err"></span>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <div class="card-header">
                                        <h4 class="text-center"><b>Bank Details (बँक तपशील)</b></h4>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="col-form-label" for="bank_account_no">Bank Account No (बँक खाते क्र)</label>
                                        <input class="form-control" type="number" name="bank_account_no" id="bank_account_no" placeholder="Enter Bank Account No" value="{{ $application_detail->bank_account_no  }}">
                                        <span class="text-danger is-invalid bank_account_no_err"></span>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="col-form-label" for="bank_name">Bank Name (बँकेचे नाव)</label>
                                        <input class="form-control" type="text" name="bank_name" id="bank_name" placeholder="Enter Bank Name" value="{{ $application_detail->bank_name  }}">
                                        <span class="text-danger is-invalid bank_name_err"></span>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="col-form-label" for="bank_address">Bank Address (बँकेचा पत्ता)</label>
                                        <input class="form-control" type="text" name="bank_address" id="bank_address" placeholder="Enter Bank Address" value="{{ $application_detail->bank_address  }}">
                                        <span class="text-danger is-invalid bank_address_err"></span>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="col-form-label" for="ifsc_code">IFSC Code (आयएफएससी कोड)</label>
                                        <input class="form-control" type="text" name="ifsc_code" id="ifsc_code" placeholder="Enter IFSC Code" value="{{ $application_detail->ifsc_code  }}">
                                        <span class="text-danger is-invalid ifsc_code_err"></span>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="col-form-label" for="copy_of_bank_passbook">Copy of first page of bank passbook (बँकेच्या पासबुकच्या प्रथम पृष्ठाची प्रत)</label>
                                        <input class="form-control" type="file" name="copy_of_bank_passbook" id="copy_of_bank_passbook">
                                        <span class="text-danger is-invalid copy_of_bank_passbook_err"></span>
                                        <a target="blank" class="btn btn-sm btn-primary" href="{{ asset('storage/' . $application_detail->copy_of_bank_passbook) }}">View Document</a>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary" id="editSubmit">Submit</button>
                                <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
              
        </div>

</x-admin.layout>

{{-- Add --}}
<script>
    $("#editForm").submit(function(e) {
        e.preventDefault();
        $("#editSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        formdata.append('_method', 'PUT');
        var model_id = $('#edit_model_id').val();
        var url = "{{ route('update.application.details', ":model_id") }}";
        $.ajax({
            url: url.replace(':model_id', model_id),
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
                            window.location.href = '{{ route('list.all.applications') }}';
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
                        $('#contractor_id').val(response.contractor_detail.id);
                    },
                    error: function() {
                        alert('Failed to fetch scheme details. Please try again.');
                    }
                });
            }
        });
    });
</script>



