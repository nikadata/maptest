@extends('layouts.datatables')

@section('content')
  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif

      <h4>Villages</h4>
        <div class="medium-2  columns"><a class="btn btn-outline-success" href="{{ route('new_village') }}">ADD NEW VILLAGE</a></div>
        <br>
        <table id="village" class="table-sm table-striped table-bordered table-sm" style="width:100%" >
          <thead>
              <tr>
                <td>Id</td>
                <td width="30%">Village</td>
                <td>Sub-district</td>
                <td>Households</td>
                <td>People</td>
                <td width="20%">Action</td>
              </tr>
          </thead>
          <tfoot>
          <th>Id</th>
          <th>Village</th>
          <th>Sub-district</th>
          <th>Households</th>
          <th>People</th>
          <th></th>
          </tfoot>
        </table>

        <script>
        $(document).ready( function () {
  $('#village').DataTable({
    processing: true,
    serverSide: true,
    ajax:{
      url: "{{ route('village_search') }}",
    },
    columns:[
      {
        data: 'id',
        name: 'id'
      },
      {
        data: 'village_name',
        name: 'village_name'
      },
      {
        data: 'county_name',
        name: 'county_name'
      },
      {
        data: 'households',
        name: 'households'
      },
      {
        data: 'people',
        name: 'people'
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
          $('#village tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
          } );

          // DataTable
          var table = $('#village').DataTable();

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
