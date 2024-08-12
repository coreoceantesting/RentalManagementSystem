<x-admin.layout>
    <x-slot name="title">Application List</x-slot>
    <x-slot name="heading">Application List</x-slot>

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
                                            @if (empty($list->stop_work_approval_at) && auth()->user()->roles->pluck('name')[0] == 'clerk')
                                                <a class="btn btn-sm btn-dark stop-work px-2 py-1" title="Stop Work" id="stopWork" data-id="{{ $list->id }}">Stop Work</a>
                                            @endif

                                            @if ($list->overall_status != "Closed" && auth()->user()->roles->pluck('name')[0] == 'registrar' )
                                                <button class="btn btn-sm btn-dark" data-id="{{ $list->id }}" id="closeComplaint">Close Complaint</button>
                                            @endif
                                            <a class="btn btn-sm btn-secondary view-hearing-detail px-2 py-1" title="View Hearing Details" data-id="{{ $list->id }}">View Hearing Details</a>
                                            <a class="btn btn-sm btn-warning view-explaination-detail px-2 py-1" title="View Explanation Call Details" data-id="{{ $list->id }}">View Explaination Call Details</a>
                                            <a class="btn btn-sm btn-info view-contractor-explaination-detail px-2 py-1" title="View Explanation Call Details" data-id="{{ $list->id }}">Contractor Explaination Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- hearing Details -->
            <div class="modal fade" id="hearingDetailsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hearing details (सुनावणीचे तपशील)</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Subject (विषय)</th>
                                        <th>Date & Time (सुनावणी तारीख वेळ)</th>
                                        <th>Place (सुनावणीचे ठिकाण)</th>
                                        <th>Document (दस्तऐवज)</th>
                                    </tr>
                                </thead>
                                <tbody id="hearingDetailsBody">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- explaination call Details -->
            <div class="modal fade" id="explanationCallDetailsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Explaination Call Details (सुनावणीचे तपशील)</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="explanationCallDetails"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- stop work model --}}
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Stop Work Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="updateForm" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="applicationId" id="applicationId">
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
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!--Contractor explaination call Details -->
            <div class="modal fade" id="contractorexplanationCallDetailsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Contractor Uploaded Document (कंत्राटदाराने अपलोड केलेले दस्तऐवज)</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="contractorexplanationCallDetails"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-admin.layout>

{{-- hearing Details --}}
<script>
    $(document).on('click', '.view-hearing-detail', function(e) {
        e.preventDefault();
        
        let applicationId = $(this).data('id');
        
        // Fetch the hearing details via AJAX
        $.ajax({
            url: "{{ route('application.hearing.details') }}", // Replace with your actual route
            type: 'GET',
            data: {
                id: applicationId
            },
            success: function(response) {
                if (response.success) {
                    let details = response.data;
                    let detailsHtml = '';

                    detailsHtml += '<tr>';
                    detailsHtml += '<td>' + (details.hearing_subject || 'NA') + '</td>';
                    detailsHtml += '<td>' + (details.hearing_datetime || 'NA') + '</td>';
                    detailsHtml += '<td>' + (details.hearing_place || 'NA') + '</td>';
                    detailsHtml += '<td>' + (details.hearing_doc ? '<a href="/storage/' + details.hearing_doc + '" target="_blank">View Document</a>' : 'NA') + '</td>';
                    detailsHtml += '</tr>';

                    $('#hearingDetailsBody').html(detailsHtml);
                    $('#hearingDetailsModal').modal('show');
                } else {
                    swal("Error!", "Could not fetch hearing details.", "error");
                }
            },
            error: function(xhr, status, error) {
                swal("Error!", "Something went wrong.", "error");
            }
        });
    });
</script>

{{-- explaination call details --}}
<script>
    $(document).on('click', '.view-explaination-detail', function(e) {
        e.preventDefault();
        
        let applicationId = $(this).data('id');
        
        // Fetch the hearing details via AJAX
        $.ajax({
            url: "{{ route('application.explainationCall.details') }}", // Replace with your actual route
            type: 'GET',
            data: {
                id: applicationId
            },
            success: function(response) {
                if (response.success) {
                    let details = response.data;
                    var tableHtml = '<h3 class="text-center"> 1st Explanation Call Details (प्रथम स्पष्टीकरण कॉल तपशील) </h3><br>';
                    tableHtml += '<table class="table table-bordered">';
                    
                    // Use predefined headers
                    tableHtml += '<thead><tr>';
                    tableHtml += '<th scope="col">Subject (विषय)</th>';
                    tableHtml += '<th scope="col">Document (कागदपत्र)</th>';
                    tableHtml += '</tr></thead>';

                    // Create table body
                    tableHtml += '<tbody>';
                    tableHtml += '<tr>';
                    tableHtml += '<td scope="row">' + (details.explanation_subject_one || 'NA') + '</td>';
                    tableHtml += '<td>' + (details.explanation_doc_one ? '<a href="/storage/' + details.explanation_doc_one + '" target="_blank">View Document</a>' : 'NA') + '</td>';
                    tableHtml += '</tr>';
                    tableHtml += '</tbody></table>';

                    // 2nd explaination call details
                    tableHtml += '<br><h3 class="text-center"> 2nd Explanation Call Details (दुसरे स्पष्टीकरण कॉल तपशील) </h3><br>';
                    tableHtml += '<table class="table table-bordered">';
                    
                    // Use predefined headers
                    tableHtml += '<thead><tr>';
                    tableHtml += '<th scope="col">Subject (विषय)</th>';
                    tableHtml += '<th scope="col">Document (कागदपत्र)</th>';
                    tableHtml += '</tr></thead>';

                    // Create table body
                    tableHtml += '<tbody>';
                    tableHtml += '<tr>';
                    tableHtml += '<td scope="row">' + (details.explanation_subject_two || 'NA') + '</td>';
                    tableHtml += '<td>' + (details.explanation_doc_two ? '<a href="/storage/' + details.explanation_doc_two + '" target="_blank">View Document</a>' : 'NA') + '</td>';
                    tableHtml += '</tr>';
                    tableHtml += '</tbody></table>';

                    // 3rd explaination call details
                    tableHtml += '<br><h3 class="text-center"> 3rd Explanation Call Details (तिसरे स्पष्टीकरण कॉल तपशील) </h3><br>';
                    tableHtml += '<table class="table table-bordered">';
                    
                    // Use predefined headers
                    tableHtml += '<thead><tr>';
                    tableHtml += '<th scope="col">Subject (विषय)</th>';
                    tableHtml += '<th scope="col">Document (कागदपत्र)</th>';
                    tableHtml += '</tr></thead>';

                    // Create table body
                    tableHtml += '<tbody>';
                    tableHtml += '<tr>';
                    tableHtml += '<td scope="row">' + (details.explanation_subject_three || 'NA') + '</td>';
                    tableHtml += '<td>' + (details.explanation_doc_three ? '<a href="/storage/' + details.explanation_doc_three + '" target="_blank">View Document</a>' : 'NA') + '</td>';
                    tableHtml += '</tr>';
                    tableHtml += '</tbody></table>';

                    $('#explanationCallDetails').html(tableHtml);
                    $('#explanationCallDetailsModal').modal('show');
                } else {
                    swal("Error!", "Could not fetch hearing details.", "error");
                }
            },
            error: function(xhr, status, error) {
                swal("Error!", "Something went wrong.", "error");
            }
        });
    });
</script>

{{-- stop work --}}
<script>
    $(document).ready(function(){

        document.getElementById('stopWork').addEventListener('click', function() {
            var applicationId = $(this).data('id');
            $('#applicationId').val(applicationId);
            $('#exampleModal').modal('show');
        });
        
        $('#updateForm').submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('application.stopwork.store') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.success) {
                        swal("Success!", data.success, "success")
                            .then(() => {
                                $('#exampleModal').modal('hide');
                                window.location.reload();
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

{{-- contractor explaination details --}}
<script>
    $(document).on('click', '.view-contractor-explaination-detail', function(e) {
        e.preventDefault();
        
        let applicationId = $(this).data('id');
        
        // Fetch the hearing details via AJAX
        $.ajax({
            url: "{{ route('application.explainationCall.details') }}", // Replace with your actual route
            type: 'GET',
            data: {
                id: applicationId
            },
            success: function(response) {
                if (response.success) {
                    let details = response.data;
                    // contractor uploaded document
                    var tableHtml = '<h3 class="text-center"> 1st Contractor Explanation Call Details (प्रथम कंत्राटदार स्पष्टीकरण कॉल तपशील) </h3><br>';
                    tableHtml += '<table class="table table-bordered">';
                    tableHtml += '<thead><tr>';
                    tableHtml += '<th scope="col">Document (कागदपत्र)</th>';
                    tableHtml += '<th scope="col">Remark (शेरा)</th>';
                    tableHtml += '</tr></thead>';
                    tableHtml += '<tbody>';
                    tableHtml += '<tr>';
                    tableHtml += '<td>' + (details.contractor_explanation_doc_one ? '<a href="/storage/' + details.contractor_explanation_doc_one + '" target="_blank">View Document</a>' : 'NA') + '</td>';
                    tableHtml += '<td scope="row">' + (details.contractor_explanation_remark_one || 'NA') + '</td>';
                    tableHtml += '</tr>';
                    tableHtml += '</tbody></table>';

                    tableHtml += '<h3 class="text-center"> 2nd Contractor Explanation Call Details (दुसरे कंत्राटदार स्पष्टीकरण कॉल तपशील) </h3><br>';
                    tableHtml += '<table class="table table-bordered">';
                    tableHtml += '<thead><tr>';
                    tableHtml += '<th scope="col">Document (कागदपत्र)</th>';
                    tableHtml += '<th scope="col">Remark (शेरा)</th>';
                    tableHtml += '</tr></thead>';
                    tableHtml += '<tbody>';
                    tableHtml += '<tr>';
                    tableHtml += '<td>' + (details.contractor_explanation_doc_two ? '<a href="/storage/' + details.contractor_explanation_doc_two + '" target="_blank">View Document</a>' : 'NA') + '</td>';
                    tableHtml += '<td scope="row">' + (details.contractor_explanation_remark_two || 'NA') + '</td>';
                    tableHtml += '</tr>';
                    tableHtml += '</tbody></table>';

                    tableHtml += '<h3 class="text-center"> 3rd Contractor Explanation Call Details (तिसरे कंत्राटदार स्पष्टीकरण कॉल तपशील) </h3><br>';
                    tableHtml += '<table class="table table-bordered">';
                    tableHtml += '<thead><tr>';
                    tableHtml += '<th scope="col">Document (कागदपत्र)</th>';
                    tableHtml += '<th scope="col">Remark (शेरा)</th>';
                    tableHtml += '</tr></thead>';
                    tableHtml += '<tbody>';
                    tableHtml += '<tr>';
                    tableHtml += '<td>' + (details.contractor_explanation_doc_three ? '<a href="/storage/' + details.contractor_explanation_doc_three + '" target="_blank">View Document</a>' : 'NA') + '</td>';
                    tableHtml += '<td scope="row">' + (details.contractor_explanation_remark_three || 'NA') + '</td>';
                    tableHtml += '</tr>';
                    tableHtml += '</tbody></table>';


                    $('#contractorexplanationCallDetails').html(tableHtml);
                    $('#contractorexplanationCallDetailsModal').modal('show');
                } else {
                    swal("Error!", "Could not fetch hearing details.", "error");
                }
            },
            error: function(xhr, status, error) {
                swal("Error!", "Something went wrong.", "error");
            }
        });
    });
</script>
