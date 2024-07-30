<x-admin.layout>
    <x-slot name="title">Approved Application List</x-slot>
    <x-slot name="heading">Approved Application List</x-slot>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Citizen Name</th>
                                    <th>Citizen Mobile No</th>
                                    <th>Scheme Name</th>
                                    <th>Contractor Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($application_lists as $index => $list)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $list->applicant_name }}</td>
                                        <td>{{ $list->applicant_mobile_no }}</td>
                                        <td>{{ $list->SchemeName }}</td>
                                        <td>{{ $list->contractor_name }}</td>
                                        <td>{{ $list->overall_status }}</td>
                                        <td>
                                            <a href="{{ route('view.application.details', $list->id) }}" class="btn btn-sm btn-primary view-element px-2 py-1" title="View Details" data-id="{{ $list->id }}">View</a>
                                            @if ($list->explanation_call_one_at == "")
                                                <button data-id="{{ $list->id }}" class="btn btn-sm btn-primary" id="ExpOne">Explaination Call 1</button>
                                            @elseif ($list->explanation_call_one_at != "" && $list->explanation_call_two_at == "")
                                                <button class="btn btn-sm btn-success" data-id="{{ $list->id }}" id="ExpTwo">Explaination Call 2</button>
                                            @elseif ($list->explanation_call_one_at != "" && $list->explanation_call_two_at != "" && $list->explanation_call_three_at == "")
                                                <button class="btn btn-sm btn-warning" data-id="{{ $list->id }}" id="ExpThree">Explaination Call 3</button>
                                            @endif

                                            @if ($list->explanation_call_three_at != "" && $list->hearing_datetime == "")
                                                <button class="btn btn-sm btn-info" data-id="{{ $list->id }}" id="hearingCall">Call For Hearing</button>
                                            @endif

                                            @if ($list->overall_status != "Closed" )
                                                <button class="btn btn-sm btn-dark" data-id="{{ $list->id }}" id="closeComplaint">Close Complaint</button>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                        </table>
                    </div>
                </div>

                <!-- Explaination One Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Explaination Call One Detail</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="updateForm" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" name="applicationIdOne" id="applicationIdOne">
                                    <div class="form-group">
                                        <label for="subject">Subject (विषय) <span class="text-danger">*</span></label>
                                        <textarea name="subject" class="form-control" id="subject" cols="30" rows="2" placeholder="Enter Subject" required></textarea>
                                        <span class="text-danger is-invalid subject_err"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="document">Upload Document (दस्तऐवज अपलोड करा) <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" id="document" name="document" required>
                                        <span class="text-danger is-invalid document_err"></span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Explaination two Modal -->
                <div class="modal fade" id="exampleModalTwo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Explaination Call Two Detail</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="updateFormTwo" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" name="applicationIdTwo" id="applicationIdTwo">
                                    <div class="form-group">
                                        <label for="subjectTwo">Subject (विषय)<span class="text-danger">*</span></label>
                                        <textarea name="subjectTwo" class="form-control" id="subjectTwo" cols="30" rows="2" placeholder="Enter Subject" required></textarea>
                                        <span class="text-danger is-invalid subjectTwo_err"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="documentTwo">Upload Document (दस्तऐवज अपलोड करा)<span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" id="documentTwo" name="documentTwo" required>
                                        <span class="text-danger is-invalid documentTwo_err"></span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Explaination two Modal -->
                <div class="modal fade" id="exampleModalThree" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Third Explaination Call Detail</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="updateFormThree" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" name="applicationIdThree" id="applicationIdThree">
                                    <div class="form-group">
                                        <label for="subjectThree">Subject (विषय)<span class="text-danger">*</span></label>
                                        <textarea name="subjectThree" class="form-control" id="subjectThree" cols="30" rows="2" placeholder="Enter Subject" required></textarea>
                                        <span class="text-danger is-invalid subjectThree_err"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="documentThree">Upload Document (दस्तऐवज अपलोड करा)<span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" id="documentThree" name="documentThree" required>
                                        <span class="text-danger is-invalid documentThree_err"></span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Hearing Call -->
                <div class="modal fade" id="hearingCallModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Hearing Detail</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="hearingDetailForm" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" name="hearingApplicationId" id="hearingApplicationId">
                                    <div class="form-group">
                                        <label for="hearingSubject">Subject (विषय)<span class="text-danger">*</span></label>
                                        <textarea name="hearingSubject" class="form-control" id="hearingSubject" cols="30" rows="2" placeholder="Enter Subject" required></textarea>
                                        <span class="text-danger is-invalid hearingSubject_err"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="hearingPlace">Hearing Place (सुनावणीचे ठिकाण)<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="hearingPlace" name="hearingPlace" required>
                                        <span class="text-danger is-invalid hearingPlace_err"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="hearingTime">Hearing DateTime (सुनावणी तारीख वेळ)<span class="text-danger">*</span></label>
                                        <input type="datetime-local" class="form-control" id="hearingTime" name="hearingTime" required>
                                        <span class="text-danger is-invalid hearingTime_err"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="hearingDocument">Upload Document (दस्तऐवज अपलोड करा)<span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" id="hearingDocument" name="hearingDocument" required>
                                        <span class="text-danger is-invalid hearingDocument_err"></span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</x-admin.layout>

{{-- explaination call one --}}
<script>
    $(document).ready(function(){

        document.getElementById('ExpOne').addEventListener('click', function() {
            var applicationId = $(this).data('id');
            $('#applicationIdOne').val(applicationId);
            $('#exampleModal').modal('show');
        });
        
        $('#updateForm').submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('application.explaination.one') }}", // Replace with your route
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.success) {
                        swal("Success!", data.success, "success")
                            .then(() => {
                                $('#exampleModal').modal('hide');
                                window.location.reload(); // Reload to reflect changes
                            });
                    } else {
                        if (data.errors) {
                            $.each(data.errors, function(key, error) {
                                $('#' + key + '_err').text(error);
                            });
                        } else {
                            swal("Error!", data.error, "error");
                        }
                    }
                },
                error: function(xhr, status, error) {
                    swal("Error!", "Something went wrong", "error");
                }
            });
        });



    });
</script>

{{-- explaination call Two --}}
<script>
    $(document).ready(function(){

        document.getElementById('ExpTwo').addEventListener('click', function() {
            var applicationId = $(this).data('id');
            $('#applicationIdTwo').val(applicationId);
            $('#exampleModalTwo').modal('show');
        });
        
        $('#updateFormTwo').submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('application.explaination.two') }}", // Replace with your route
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.success) {
                        swal("Success!", data.success, "success")
                            .then(() => {
                                $('#exampleModalTwo').modal('hide');
                                window.location.reload(); // Reload to reflect changes
                            });
                    } else {
                        if (data.errors) {
                            $.each(data.errors, function(key, error) {
                                $('#' + key + '_err').text(error);
                            });
                        } else {
                            swal("Error!", data.error, "error");
                        }
                    }
                },
                error: function(xhr, status, error) {
                    swal("Error!", "Something went wrong", "error");
                }
            });
        });



    });
</script>

{{-- explaination call Three --}}
<script>
    $(document).ready(function(){

        document.getElementById('ExpThree').addEventListener('click', function() {
            var applicationId = $(this).data('id');
            $('#applicationIdThree').val(applicationId);
            $('#exampleModalThree').modal('show');
        });
        
        $('#updateFormThree').submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('application.explaination.three') }}", // Replace with your route
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.success) {
                        swal("Success!", data.success, "success")
                            .then(() => {
                                $('#exampleModalThree').modal('hide');
                                window.location.reload(); // Reload to reflect changes
                            });
                    } else {
                        if (data.errors) {
                            $.each(data.errors, function(key, error) {
                                $('#' + key + '_err').text(error);
                            });
                        } else {
                            swal("Error!", data.error, "error");
                        }
                    }
                },
                error: function(xhr, status, error) {
                    swal("Error!", "Something went wrong", "error");
                }
            });
        });



    });
</script>

{{-- Submit Hearing Details --}}
<script>
    $(document).ready(function(){

        document.getElementById('hearingCall').addEventListener('click', function() {
            var applicationId = $(this).data('id');
            $('#hearingApplicationId').val(applicationId);
            $('#hearingCallModel').modal('show');
        });
        
        $('#hearingDetailForm').submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('application.hearingDetails.store') }}", // Replace with your route
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.success) {
                        swal("Success!", data.success, "success")
                            .then(() => {
                                $('#exampleModalThree').modal('hide');
                                window.location.href = "{{ route('hearingList') }}";
                            });
                    } else {
                        if (data.errors) {
                            $.each(data.errors, function(key, error) {
                                $('#' + key + '_err').text(error);
                            });
                        } else {
                            swal("Error!", data.error, "error");
                        }
                    }
                },
                error: function(xhr, status, error) {
                    swal("Error!", "Something went wrong", "error");
                }
            });
        });



    });
</script>

{{-- Close application --}}
<script>
    $("#closeComplaint").on("click", function(e) {
        e.preventDefault();
        swal({
            title: "Are you sure to close this application?",
            icon: "info",
            buttons: ["Cancel", "Confirm"]
        })
        .then((willApprove) => {
            if (willApprove) {
                var model_id = $(this).data("id"); 
                var url = "{{ route('application.close', ":model_id") }}";

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
                                    window.location.href = "{{ route('list.close.applications') }}";
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