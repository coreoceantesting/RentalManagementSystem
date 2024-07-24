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
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
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
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                    <span class="text-danger is-invalid appendix_is_eligible_err"></span>
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
