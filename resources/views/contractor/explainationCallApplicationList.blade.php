<x-admin.layout>
    <x-slot name="title">Explaination Call Application List</x-slot>
    <x-slot name="heading">Explaination Call Application List</x-slot>

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
                                            <a class="btn btn-sm btn-warning view-explaination-detail px-2 py-1" title="View Explanation Call Details" data-id="{{ $list->id }}">Call Details</a>
                                            @if ($list->contractor_explanation_doc_one)
                                                <a class="btn btn-sm btn-info view-contractor-explaination-detail px-2 py-1" title="View Explanation Call Details" data-id="{{ $list->id }}">Contractor Explaination Details</a>    
                                            @endif
                                            @if (auth()->user()->roles->pluck('name')[0] == "contractor")
                                                @if (!empty($list->explanation_call_one_at) && empty($list->contractor_explanation_doc_one))
                                                    <a class="btn btn-sm btn-info upload-doc px-2 py-1" id="upload-doc" title="Upload Document" data-id="{{ $list->id }}">Upload Document</a>
                                                @endif  
                                                @if (!empty($list->explanation_call_two_at) && !empty($list->contractor_explanation_doc_one) && empty($list->contractor_explanation_doc_two))
                                                    <a class="btn btn-sm btn-success upload-doc-two px-2 py-1" id="upload-doc-two" title="Upload Document" data-id="{{ $list->id }}">Upload Document</a>    
                                                @endif
                                                @if (!empty($list->explanation_call_three_at) && !empty($list->contractor_explanation_doc_two) && empty($list->contractor_explanation_doc_three))
                                                    <a class="btn btn-sm btn-danger upload-doc-three px-2 py-1" id="upload-doc-three" title="Upload Document" data-id="{{ $list->id }}">Upload Document</a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                        </table>
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

                <!-- Upload document -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Upload Document For 1st Explanation Call</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="updateForm" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" name="applicationIdOne" id="applicationIdOne">
                                    <div class="form-group">
                                        <label for="document">Upload Document (दस्तऐवज अपलोड करा) <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" id="document" name="document" required>
                                        <span class="text-danger is-invalid document_err"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="remark_one">Remark (शेरा) <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="remark_one" id="remark_one" cols="30" rows="5" required></textarea>
                                        <span class="text-danger is-invalid remark_one_err"></span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- upload document 2 --}}
                <div class="modal fade" id="exampleModaltwo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Upload Document For 2nd Explaination Call</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="updateFormTwo" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" name="applicationIdTwo" id="applicationIdTwo">
                                    <div class="form-group">
                                        <label for="document_two">Upload Document (दस्तऐवज अपलोड करा) <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" id="document_two" name="document_two" required>
                                        <span class="text-danger is-invalid document_two_err"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="remark_two">Remark (शेरा) <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="remark_two" id="remark_two" cols="30" rows="5" required></textarea>
                                        <span class="text-danger is-invalid remark_two_err"></span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                {{-- upload document 3 --}}
                <div class="modal fade" id="exampleModalthree" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Upload Document For 3rd Explanation Call</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="updateFormThree" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" name="applicationIdThree" id="applicationIdThree">
                                    <div class="form-group">
                                        <label for="document_three">Upload Document (दस्तऐवज अपलोड करा) <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" id="document_three" name="document_three" required>
                                        <span class="text-danger is-invalid document_three_err"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="remark_three">Remark (शेरा) <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="remark_three" id="remark_three" cols="30" rows="5" required></textarea>
                                        <span class="text-danger is-invalid remark_three_err"></span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</x-admin.layout>

{{-- View explaination details --}}
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

{{--Upload explaination document uploaded by contractor one --}}
<script>
    $(document).ready(function(){

        document.getElementById('upload-doc').addEventListener('click', function() {
            var applicationId = $(this).data('id');
            $('#applicationIdOne').val(applicationId);
            $('#exampleModal').modal('show');
        });
        
        $('#updateForm').submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('application.upload.doc') }}", // Replace with your route
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

{{--Upload explaination document uploaded by contractor two --}}
<script>
    $(document).ready(function(){

        document.getElementById('upload-doc-two').addEventListener('click', function() {
            var applicationId = $(this).data('id');
            $('#applicationIdTwo').val(applicationId);
            $('#exampleModaltwo').modal('show');
        });
        
        $('#updateFormTwo').submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('application.upload.doc.two') }}", // Replace with your route
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.success) {
                        swal("Success!", data.success, "success")
                            .then(() => {
                                $('#exampleModaltwo').modal('hide');
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

{{--Upload explaination document uploaded by contractor three --}}
<script>
    $(document).ready(function(){

        document.getElementById('upload-doc-three').addEventListener('click', function() {
            var applicationId = $(this).data('id');
            $('#applicationIdThree').val(applicationId);
            $('#exampleModalthree').modal('show');
        });
        
        $('#updateFormThree').submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('application.upload.doc.three') }}", // Replace with your route
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.success) {
                        swal("Success!", data.success, "success")
                            .then(() => {
                                $('#exampleModalthree').modal('hide');
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