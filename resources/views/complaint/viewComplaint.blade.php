<x-admin.layout>
    <x-slot name="title">View Complaint Details</x-slot>
    <x-slot name="heading">View Complaint Details</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


        <!-- Add Form -->
        <div class="row" id="addContainer">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3 row">
                            <div class="card-header">
                                <h4 class="text-center"><b>Applicant Details (अर्जदाराचे तपशील)</b></h4>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="applicant_name">Applicant Name (अर्जदाराचे नाव) <span class="text-danger">*</span></label>
                                <input class="form-control" id="applicant_name" name="applicant_name" type="text" placeholder="Enter Applicant Name" value="{{ $application_detail->applicant_name }}" readonly>
                                <span class="text-danger is-invalid applicant_name_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="applicant_current_address">Applicant Address (सध्याचा अर्जदाराचा पत्ता) <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="applicant_current_address" id="applicant_current_address" cols="30" rows="2" placeholder="Enter Applicant Current Address" readonly>{{ $application_detail->applicant_current_address }}</textarea>
                                <span class="text-danger is-invalid applicant_current_address_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="applicant_mobile_no">Applicant Mobile No (अर्जदाराचा मोबाईल क्र) <span class="text-danger">*</span></label>
                                <input class="form-control" id="applicant_mobile_no" name="applicant_mobile_no" type="number" placeholder="Enter Applicant Mobile No" value="{{ $application_detail->applicant_mobile_no }}" readonly>
                                <span class="text-danger is-invalid applicant_mobile_no_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="applicant_aadhar_no">Applicant Aadhar No (अर्जदाराचा आधार क्र)</label>
                                <input class="form-control" id="applicant_aadhar_no" name="applicant_aadhar_no" type="number" placeholder="Enter Applicant Aadhar No" value="{{ $application_detail->applicant_aadhar_no }}" readonly>
                                <span class="text-danger is-invalid applicant_aadhar_no_err"></span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="mb-3 row">
                            <div class="card-header">
                                <h4 class="text-center"><b>Current status of applicant in Annexure 2 (परिशिष्ट २ मधील अर्जदाराची सद्यस्तिथी )</b></h4>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label" for="original_no">A in original Pari-2. No (मुळ  परि -२ मधील अ . क्र :) <span class="text-danger">*</span></label>
                                <input class="form-control" id="original_no" name="original_no" type="text" placeholder="Enter Number" value="{{ $application_detail->original_no }}" readonly>
                                <span class="text-danger is-invalid original_no_err"></span>
                            </div>

                            <div class="col-md-6">
                                <label class="col-form-label" for="original_is_eligible">Eligible / Ineligible(पात्र / अपात्र ) <span class="text-danger">*</span></label>
                                <select class="form-control" name="original_is_eligible" id="original_is_eligible" disabled>
                                    <option value="">Select Option</option>
                                    <option value="yes" @if($application_detail->original_is_eligible == "yes") selected @endif>Yes / होय</option>
                                    <option value="no" @if($application_detail->original_is_eligible == "no") selected @endif>No / नाही</option>
                                </select>
                                <span class="text-danger is-invalid original_is_eligible_err"></span>
                            </div>

                            <div class="col-md-6">
                                <label class="col-form-label" for="appendix_no">A in Appendix Par-2. No : (पुरवणी  परि -२ मधील अ . क्र :) <span class="text-danger">*</span></label>
                                <input class="form-control" id="appendix_no" name="appendix_no" type="text" placeholder="Enter Number" value="{{ $application_detail->appendix_no }}" readonly>
                                <span class="text-danger is-invalid appendix_no_err"></span>
                            </div>

                            <div class="col-md-6">
                                <label class="col-form-label" for="appendix_is_eligible">Eligible / Ineligible(पात्र / अपात्र ) <span class="text-danger">*</span></label>
                                <select class="form-control" name="appendix_is_eligible" id="appendix_is_eligible" disabled>
                                    <option value="">Select Option</option>
                                    <option value="yes" @if($application_detail->appendix_is_eligible == "yes") selected @endif >Yes / होय</option>
                                    <option value="no" @if($application_detail->appendix_is_eligible == "no") selected @endif >No / नाही</option>
                                </select>
                                <span class="text-danger is-invalid appendix_is_eligible_err"></span>
                            </div>

                            <div class="col-md-6" id="appendix_doc_container" @if($application_detail->appendix_is_eligible == "yes") style="display: block;" @else style="display: none;" @endif >
                                <label class="col-form-label" for="appendix_doc">a copy if qualified in Supplementary Annexure-2 (पुरवणी परी - २ मध्ये पात्र असल्यास त्याची प्रत)<span class="text-danger">*</span></label>
                                {{-- <input class="form-control" id="appendix_doc" name="appendix_doc" type="file">
                                <span class="text-danger is-invalid appendix_doc_err"></span> --}}

                                <a target="blank" class="btn btn-sm btn-primary" href="{{ asset('storage/' . $application_detail->appendix_doc) }}">View Document</a>

                            </div>

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="mb-3 row">
                            <div class="card-header">
                                <h4 class="text-center"><b>Scheme Details (योजना तपशील)</b></h4>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label" for="scheme_name">Scheme Name (योजनेचे नाव) <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="scheme_name" id="scheme_name" value="{{ $application_detail->appendix_no }}" readonly>
                            </div>

                            <div class="col-md-6">
                                <label class="col-form-label" for="scheme_details">Scheme Details (योजना तपशील)<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="scheme_details" id="scheme_details" cols="30" rows="2" placeholder="Scheme Details" readonly>{{ $application_detail->scheme_details }}</textarea>
                                <span class="text-danger is-invalid scheme_details_err"></span>
                            </div>

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="mb-3 row">
                            <div class="card-header">
                                <h4 class="text-center"><b>Contractor Details (कंत्राटदार तपशील)</b></h4>
                            </div>

                            <div class="col-md-6">
                                <label class="col-form-label" for="contractor_name">Contractor Name <span class="text-danger">*</span></label>
                                <input class="form-control" name="contractor_name" id="contractor_name" placeholder="Contractor Name" value="{{ $application_detail->contractor_name }}" readonly>
                                <span class="text-danger is-invalid contractor_name_err"></span>
                            </div>

                            <div class="col-md-6">
                                <label class="col-form-label" for="contractor_details">Contractor Details (कंत्राटदार तपशील)<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="contractor_details" id="contractor_details" cols="30" rows="2" placeholder="Contractor Details" readonly>{{ $application_detail->contractor_details }}</textarea>
                                <span class="text-danger is-invalid contractor_details_err"></span>
                            </div>

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="mb-3 row">
                            <div class="card-header">
                                <h4 class="text-center"><b>Others Details (इतर तपशील)</b></h4>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label" for="date_of_demolition">Date of demolition of hut (झोपडी तोडल्याची दिनांक)<span class="text-danger">*</span></label>
                                <input class="form-control" type="date" name="date_of_demolition" id="date_of_demolition" value="{{ $application_detail->date_of_demolition }}" readonly>
                                <span class="text-danger is-invalid date_of_demolition_err"></span>
                            </div>

                            <div class="col-md-6">
                                <label class="col-form-label" for="is_there_rental_agreement">Is there a rental agreement? (भाडे करार करण्यात आलेला आहे का ?)<span class="text-danger">*</span></label>
                                <select class="form-control" name="is_there_rental_agreement" id="is_there_rental_agreement" disabled>
                                    <option value="">Select Option</option>
                                    <option value="yes" @if($application_detail->is_there_rental_agreement == "yes") selected @endif>Yes / होय</option>
                                    <option value="no" @if($application_detail->is_there_rental_agreement == "no") selected @endif>No / नाही</option>
                                </select>
                                <span class="text-danger is-invalid is_there_rental_agreement_err"></span>
                            </div>

                            <div class="col-md-6 rental_aggrement_container" @if($application_detail->is_there_rental_agreement == "yes") style="display: block" @else style="display: none" @endif >
                                <label class="col-form-label" for="date_of_agreement">Date of agreement (कराराची तारीख)<span class="text-danger">*</span></label>
                                <input class="form-control" type="date" name="date_of_agreement" id="date_of_agreement" value="{{ $application_detail->date_of_agreement }}" readonly>
                                <span class="text-danger is-invalid date_of_agreement_err"></span>
                            </div>

                            <div class="col-md-6 rental_aggrement_container" @if($application_detail->is_there_rental_agreement == "yes") style="display: block" @else style="display: none" @endif>
                                <label class="col-form-label" for="monthly_rate_of_rent">Monthly rate of rent (भाड्याचा मासिक दर)<span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="monthly_rate_of_rent" id="monthly_rate_of_rent"  value="{{ $application_detail->monthly_rate_of_rent }}" readonly>
                                <span class="text-danger is-invalid monthly_rate_of_rent_err"></span>
                            </div>

                            <div class="col-md-6">
                                <label class="col-form-label" for="is_developer_paid_earlier_rent">Has the developer paid the rent earlier? (विकासकाने पूर्वी भाडे दिले आहे ?)<span class="text-danger">*</span></label>
                                <select class="form-control" name="is_developer_paid_earlier_rent" id="is_developer_paid_earlier_rent" disabled>
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
                                <label class="col-form-label" for="old_monthly_rate_of_rent">Old Monthly rate of rent (भाड्याचा जुना मासिक दर)<span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="old_monthly_rate_of_rent" id="old_monthly_rate_of_rent" placeholder="Enter old Monlty rate of rent" value="{{ $application_detail->old_monthly_rate_of_rent  }}" readonly>
                                <span class="text-danger is-invalid old_monthly_rate_of_rent_err"></span>
                            </div>

                            <div class="col-md-6">
                                <label class="col-form-label" for="date_of_previous_rent_was">Date of month up to which previous rent was received (मागील भाडे कोणत्या महिन्यापर्यंत प्राप्त झाले त्याची दिनांक )<span class="text-danger">*</span></label>
                                <input class="form-control" type="date" name="date_of_previous_rent_was" id="date_of_previous_rent_was" value="{{ $application_detail->date_of_previous_rent_was  }}" readonly>
                                <span class="text-danger is-invalid date_of_previous_rent_was_err"></span>
                            </div>

                            <div class="col-md-6">
                                <label class="col-form-label" for="montly_received_rate">At what monthly rate was the said rent received? (सदरील भाडे कोणत्या मासिक दराने मिळाले)<span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="montly_received_rate" id="montly_received_rate" placeholder="Enter Amount" value="{{ $application_detail->montly_received_rate  }}" readonly>
                                <span class="text-danger is-invalid montly_received_rate_err"></span>
                            </div>


                        </div>
                    </div>

                    <div class="card-body">
                        <div class="mb-3 row">
                            <div class="card-header">
                                <h4 class="text-center"><b>Bank Details (बँक तपशील)</b></h4>
                            </div>

                            <div class="col-md-6">
                                <label class="col-form-label" for="bank_account_no">Bank Account No (बँक खाते क्र)<span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="bank_account_no" id="bank_account_no" placeholder="Enter Bank Account No" value="{{ $application_detail->bank_account_no  }}" readonly>
                                <span class="text-danger is-invalid bank_account_no_err"></span>
                            </div>

                            <div class="col-md-6">
                                <label class="col-form-label" for="bank_name">Bank Name (बँकेचे नाव)<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="bank_name" id="bank_name" placeholder="Enter Bank Name" value="{{ $application_detail->bank_name  }}" readonly>
                                <span class="text-danger is-invalid bank_name_err"></span>
                            </div>

                            <div class="col-md-6">
                                <label class="col-form-label" for="bank_address">Bank Address (बँकेचा पत्ता)<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="bank_address" id="bank_address" placeholder="Enter Bank Address" value="{{ $application_detail->bank_address  }}" readonly>
                                <span class="text-danger is-invalid bank_address_err"></span>
                            </div>

                            <div class="col-md-6">
                                <label class="col-form-label" for="ifsc_code">IFSC Code (आयएफएससी कोड)<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="ifsc_code" id="ifsc_code" placeholder="Enter IFSC Code" value="{{ $application_detail->ifsc_code  }}" readonly>
                                <span class="text-danger is-invalid ifsc_code_err"></span>
                            </div>

                            <div class="col-md-6">
                                <label class="col-form-label" for="copy_of_bank_passbook">Copy of first page of bank passbook (बँकेच्या पासबुकच्या प्रथम पृष्ठाची प्रत)<span class="text-danger">*</span></label>
                                {{-- <input class="form-control" type="file" name="copy_of_bank_passbook" id="copy_of_bank_passbook">
                                <span class="text-danger is-invalid copy_of_bank_passbook_err"></span> --}}
                                <a target="blank" class="btn btn-sm btn-primary" href="{{ asset('storage/' . $application_detail->copy_of_bank_passbook) }}">View Document</a>
                            </div>

                        </div>
                    </div>

                    @if ($application_detail->overall_status == "Pending" && auth()->user()->roles->pluck('name')[0] == 'clerk')
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary" id="approveBtn" data-id="{{ $application_detail->id }}">Approve</button>
                            <button type="reset" class="btn btn-warning" id="rejectBtn" data-id="{{ $application_detail->id }}">Reject</button>
                            <button type="reset" class="btn btn-danger" id="sendBtn" data-id="{{ $application_detail->id }}">Send</button>
                        </div>
                    @endif
                </div>
                <!-- Reject Remark Modal -->
                <div class="modal fade" id="rejectRemarkModal" tabindex="-1" aria-labelledby="rejectRemarkModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="rejectRemarkModalLabel">Reject Application</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form id="rejectForm">
                                @csrf
                                <div class="mb-3">
                                <label for="remark" class="form-label">Remark</label>
                                <textarea class="form-control" id="remark" name="remark" rows="3" required></textarea>
                                </div>
                                <input type="hidden" id="applicationId" name="application_id">
                            </form>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger" id="submitReject">Reject</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Send Remark Modal -->
                <div class="modal fade" id="sendRemarkModal" tabindex="-1" aria-labelledby="sendRemarkModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="sendRemarkModalLabel">Send Application</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form id="sendForm">
                                @csrf
                                <div class="mb-3">
                                <label for="sendRemark" class="form-label">Remark</label>
                                <textarea class="form-control" id="sendRemark" name="sendremark" rows="3" required></textarea>
                                </div>
                                <input type="hidden" id="sendApplicationId" name="application_id">
                            </form>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="submitSend">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
  
            </div>
              
        </div>

</x-admin.layout>

{{-- approved application --}}
<script>
    $("#approveBtn").on("click", function(e) {
        e.preventDefault();
        swal({
            title: "Are you sure to approve this application?",
            icon: "info",
            buttons: ["Cancel", "Confirm"]
        })
        .then((willApprove) => {
            if (willApprove) {
                var model_id = $(this).data("id"); // Assuming you have data-id attribute on the button
                var url = "{{ route('application.approve', ":model_id") }}";

                $.ajax({
                    url: url.replace(':model_id', model_id),
                    type: 'POST',
                    data: {
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.success) {
                            swal("Success!", data.success, "success")
                                .then(() => {
                                    window.location.reload();
                                });
                        } else {
                            swal("Error!", data.error, "error");
                        }
                    },
                    error: function(error) {
                        swal("Error!", "Something went wrong", "error");
                    },
                });
            }
        });
    });
</script>

{{-- reject application --}}

<script>
    $(document).ready(function() {
        
        $('#rejectBtn').click(function() {
            var applicationId = $(this).data('id');
            $('#applicationId').val(applicationId);
            $('#rejectRemarkModal').modal('show');
        });

        $('#submitReject').click(function() {
            var formData = $('#rejectForm').serialize();

            $.ajax({
                url: "{{ route('application.reject') }}",
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#rejectRemarkModal').modal('hide');
                    if(response.success) {
                        swal("Rejected!", response.success, "success").then((action) => {
                            window.location.reload();
                        });
                    } else {
                        swal("Error!", response.error, "error");
                    }
                },
                error: function(xhr) {
                    var error = xhr.responseJSON.message;
                    swal("Error!", error, "error");
                }
            });
        });



    });
</script>

{{-- send application to collector --}}
<script>
    $(document).ready(function() {
        $('#sendBtn').click(function() {
            var applicationId = $(this).data('id');
            $('#sendApplicationId').val(applicationId);
            $('#sendRemarkModal').modal('show');
        });

        $('#submitSend').click(function() {
            var formData = $('#sendForm').serialize();

            $.ajax({
                url: "{{ route('application.send') }}",
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#sendRemarkModal').modal('hide');
                    if(response.success) {
                        swal("Sent!", response.success, "success").then((action) => {
                            window.location.reload();
                        });
                    } else {
                        swal("Error!", response.error, "error");
                    }
                },
                error: function(xhr) {
                    var error = xhr.responseJSON.message;
                    swal("Error!", error, "error");
                }
            });
        });

    });
</script>