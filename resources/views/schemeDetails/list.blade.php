<x-admin.layout>
    <x-slot name="title">Scheme Details List</x-slot>
    <x-slot name="heading">Scheme Details List</x-slot>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Scheme Name</th>
                                    <th>Developer Name</th>
                                    <th>Architect Name</th>
                                    <th>Slum Developer Name</th>
                                    <th>Amount To Pay</th>
                                    <th>Paid Amount</th>
                                    <th>Balance Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($scheme_detail_lists as $index => $list)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $list->name_of_scheme }}</td>
                                        <td>{{ $list->developer_name }}</td>
                                        <td>{{ $list->architect_name }}</td>
                                        <td>{{ $list->name_of_slum_developer }}</td>
                                        <td>{{ $list->amount_to_pay }}</td>
                                        <td>{{ $list->paid_amount }}</td>
                                        <td>{{ $list->amount_to_pay - $list->paid_amount }}</td>
                                        <td>
                                            <a href="{{ route('view.form', $list->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('edit.form', $list->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>

