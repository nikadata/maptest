@extends('layouts.master')

@section('content')
<div class="row">
      <div class="medium-12 large-12 columns">
        <h4>Districts</h4>
        <div class="medium-2  columns"><a class="btn btn-outline-success" href="{{ route('new_district') }}">ADD NEW DISTRICT</a></div>
        <br>
        <table class="table table-sm">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Districts</th>
              <th scope="col">Head town</th>
              <th scope="col">Country</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $districts as $district )

              <tr>
                <td>{{ $district->id }}</td>
                <td>{{ $district->district_name}} </td>
                <td><small class="text-muted"> {{ $district->district_description}}</small></td>
                <td>{{ $district->country_name }}</td>
                <td>
                <a class="btn btn-primary btn-sm" href="{{ route('show_district', ['district_id'=>$district->id ]) }}">EDIT <i class="far fa-edit"></i></a>
                @can('isAdmin')
                <a class="btn btn-danger btn-sm" href="{{ route('del_district', ['district_id'=>$district->id ]) }}">ERASE <i class="far fa-trash-alt"></i></a>
                @endcan
                </td>
              </tr>

              @endforeach

            </tbody>
        </table>


      </div>
    </div>
@endsection
