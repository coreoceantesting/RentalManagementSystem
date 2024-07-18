<x-admin.layout>
    <x-slot name="title">Architects</x-slot>
    <x-slot name="heading">Architects</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


        <!-- Add Form -->
        <div class="row" id="addContainer" style="display:none;">
            <div class="col-sm-12">
                <div class="card">
                    <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                        @csrf

                        <div class="card-header">
                            <h4 class="card-title">Add Architect</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="architect_name">Architect Name<span class="text-danger">*</span></label>
                                    <input class="form-control" id="architect_name" name="architect_name" type="text" placeholder="Enter Architect Name">
                                    <span class="text-danger is-invalid architect_name_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="architect_mobile_no">Architect Mobile No <span class="text-danger">*</span></label>
                                    <input class="form-control" id="architect_mobile_no" name="architect_mobile_no" type="number" placeholder="Enter Architect Mobile No">
                                    <span class="text-danger is-invalid architect_mobile_no_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="architect_email">Architect Email <span class="text-danger">*</span></label>
                                    <input class="form-control" id="architect_email" name="architect_email" type="email" placeholder="Enter Architect Email">
                                    <span class="text-danger is-invalid architect_email_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="architect_address">Architect Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="architect_address" id="architect_address" cols="30" rows="4"></textarea>
                                    <span class="text-danger is-invalid architect_address_err"></span>
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



        {{-- Edit Form --}}
        <div class="row" id="editContainer" style="display:none;">
            <div class="col">
                <form class="form-horizontal form-bordered" method="post" id="editForm">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Architect</h4>
                        </div>
                        <div class="card-body py-2">
                            <input type="hidden" id="edit_model_id" name="edit_model_id" value="">
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="architect_name">Architect Name <span class="text-danger">*</span></label>
                                    <input class="form-control" id="architect_name" name="architect_name" type="text" placeholder="Enter Architect Name">
                                    <span class="text-danger is-invalid architect_name_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="architect_mobile_no">Architect Mobile No <span class="text-danger">*</span></label>
                                    <input class="form-control" id="architect_mobile_no" name="architect_mobile_no" type="number" placeholder="Enter Architect Mobile No">
                                    <span class="text-danger is-invalid architect_mobile_no_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="architect_email">Architect Email <span class="text-danger">*</span></label>
                                    <input class="form-control" id="architect_email" name="architect_email" type="email" placeholder="Enter Architect Email">
                                    <span class="text-danger is-invalid architect_email_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="architect_address">Architect Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="architect_address" id="architect_address" cols="30" rows="4"></textarea>
                                    <span class="text-danger is-invalid architect_address_err"></span>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" id="editSubmit">Submit</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="">
                                    <button id="addToTable" class="btn btn-primary">Add <i class="fa fa-plus"></i></button>
                                    <button id="btnCancel" class="btn btn-danger" style="display:none;">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Architect Name</th>
                                        <th>Architect No</th>
                                        <th>Architect Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($architects as $index => $architect)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $architect->architect_name }}</td>
                                            <td>{{ $architect->architect_mobile_no }}</td>
                                            <td>{{ $architect->architect_email }}</td>
                                            <td>
                                                <button class="edit-element btn text-secondary px-2 py-1" title="Edit Contractor" data-id="{{ $architect->id }}"><i data-feather="edit"></i></button>
                                                <button class="btn text-danger rem-element px-2 py-1" title="Delete Contractor" data-id="{{ $architect->id }}"><i data-feather="trash-2"></i> </button>
                                            </td>
                                        </tr>
                                    @endforeach
                            </table>
                        </div>
                    </div>
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
            url: '{{ route('architects.store') }}',
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
                            window.location.href = '{{ route('architects.index') }}';
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


<!-- Edit -->
<script>
    $("#buttons-datatables").on("click", ".edit-element", function(e) {
        e.preventDefault();
        var model_id = $(this).attr("data-id");
        var url = "{{ route('architects.edit', ":model_id") }}";

        $.ajax({
            url: url.replace(':model_id', model_id),
            type: 'GET',
            data: {
                '_token': "{{ csrf_token() }}"
            },
            success: function(data, textStatus, jqXHR) {
                editFormBehaviour();
                if (!data.error)
                {
                    $("#editForm input[name='edit_model_id']").val(data.architect.id);
                    $("#editForm input[name='architect_name']").val(data.architect.architect_name);
                    $("#editForm input[name='architect_mobile_no']").val(data.architect.architect_mobile_no);
                    $("#editForm input[name='architect_email']").val(data.architect.architect_email);
                    $("#editForm textarea[name='architect_address']").val(data.architect.architect_address);
                }
                else
                {
                    alert(data.error);
                }
            },
            error: function(error, jqXHR, textStatus, errorThrown) {
                alert("Some thing went wrong");
            },
        });
    });
</script>


<!-- Update -->
<script>
    $(document).ready(function() {
        $("#editForm").submit(function(e) {
            e.preventDefault();
            $("#editSubmit").prop('disabled', true);
            var formdata = new FormData(this);
            formdata.append('_method', 'PUT');
            var model_id = $('#edit_model_id').val();
            var url = "{{ route('architects.update', ":model_id") }}";
            //
            $.ajax({
                url: url.replace(':model_id', model_id),
                type: 'POST',
                data: formdata,
                contentType: false,
                processData: false,
                success: function(data)
                {
                    $("#editSubmit").prop('disabled', false);
                    if (!data.error2)
                        swal("Successful!", data.success, "success")
                            .then((action) => {
                                window.location.href = '{{ route('architects.index') }}';
                            });
                    else
                        swal("Error!", data.error2, "error");
                },
                statusCode: {
                    422: function(responseObject, textStatus, jqXHR) {
                        $("#editSubmit").prop('disabled', false);
                        resetErrors();
                        printErrMsg(responseObject.responseJSON.errors);
                    },
                    500: function(responseObject, textStatus, errorThrown) {
                        $("#editSubmit").prop('disabled', false);
                        swal("Error occured!", "Something went wrong please try again", "error");
                    }
                }
            });

        });
    });
</script>


<!-- Delete -->
<script>
    $("#buttons-datatables").on("click", ".rem-element", function(e) {
        e.preventDefault();
        swal({
            title: "Are you sure to delete this Architect?",
            // text: "Make sure if you have filled Vendor details before proceeding further",
            icon: "info",
            buttons: ["Cancel", "Confirm"]
        })
        .then((justTransfer) =>
        {
            if (justTransfer)
            {
                var model_id = $(this).attr("data-id");
                var url = "{{ route('architects.destroy', ":model_id") }}";

                $.ajax({
                    url: url.replace(':model_id', model_id),
                    type: 'POST',
                    data: {
                        '_method': "DELETE",
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function(data, textStatus, jqXHR) {
                        if (!data.error && !data.error2) {
                            swal("Success!", data.success, "success")
                                .then((action) => {
                                    window.location.reload();
                                });
                        } else {
                            if (data.error) {
                                swal("Error!", data.error, "error");
                            } else {
                                swal("Error!", data.error2, "error");
                            }
                        }
                    },
                    error: function(error, jqXHR, textStatus, errorThrown) {
                        swal("Error!", "Something went wrong", "error");
                    },
                });
            }
        });
    });
</script>
