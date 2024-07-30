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
                                            <a class="btn btn-sm btn-secondary view-hearing-detail px-2 py-1" title="View Hearing Details" data-id="{{ $list->id }}">View Hearing Details</a>
                                            <a class="btn btn-sm btn-warning view-explaination-detail px-2 py-1" title="View Explanation Call Details" data-id="{{ $list->id }}">View Explaination Call Details</a>
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

        </div>
    </div>
</x-admin.layout>

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
