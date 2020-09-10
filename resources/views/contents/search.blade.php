@extends('layouts.datatables')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <br>
    <table id="user_table" class="table table-sm table-striped table-bordered" style="width:100%" data-order='[[ 0, "desc" ]]' data-page-length='10'>
        <thead>
        <tr>
            <th data-toggle="tooltip" data-placement="top" title="Unique (Maprom)database Id">Id.</th>
            <th data-toggle="tooltip" data-placement="top" title="Registered to House Nr.">House Nr.</th>
            <th data-toggle="tooltip" data-placement="top" title="Head of household">Name</th>
            <th data-toggle="tooltip" data-placement="top" title="Firstname of head">Firstname</th>
            <th data-toggle="tooltip" data-placement="top" title="Surname of head">Surname</th>
            <th data-toggle="tooltip" data-placement="top" title="Age of Household">Age</th>
            <th data-toggle="tooltip" data-placement="top" title="Civilstatus of Household">Civilstatus</th>
            <th data-toggle="tooltip" data-placement="top" title="Nationality of Household head">Nationality</th>
            <th data-toggle="tooltip" data-placement="top" title="Fiscal status of Household">Fiscal</th>
            <th data-toggle="tooltip" data-placement="top" title="View or edit registered data with action buttons">Action</th>
        </tr>
        </thead>
<tfoot>
<th>Id</th>
<th>House Nr.</th>
<th>Name</th>
<th>Firstname</th>
<th>Surname</th>
<th>Age</th>
<th>Civilstatus</th>
<th>Nationality</th>
<th>Fiscal</th>
<th></th>
</tfoot>
    </table>

    <script>
        $(document).ready(function(){

            $('#user_table').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url: "{{ route('search') }}",
                },
                columns:[
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'number',
                        name: 'number'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'fname',
                        name: 'fname'
                    },
                    {
                        data: 'surname',
                        name: 'surname'
                    },
                    {
                        data: 'age',
                        name: 'age'
                    },
                    {
                        data: 'civilstatus',
                        name: 'civilstatus'
                    },
                    {
                        data: 'nationality',
                        name: 'nationality'
                    },
                    {
                        data: 'fiscal',
                        name: 'fiscal'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ]
            });
        });
//
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#user_table tfoot th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );

            // DataTable
            var table = $('#user_table').DataTable();

            // Apply the search
            table.columns().every( function () {
                var that = this;

                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );

        } );

    </script>
@endsection