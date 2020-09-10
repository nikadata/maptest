@extends('layouts.master')

@section('content')
<div class="row">
      <div class="medium-12 large-12 columns">
        <h4>Sub districts</h4>
        <div class="medium-2  columns"><a class="btn btn-outline-success" href="{{ route('new_county') }}">ADD NEW SUB-DISTRICT</a></div>
        <br>
        <table class="table table-sm">
          <thead>
            <tr>
              <th scope="col">Sub district</th>
              <th scope="col">Description</th>
              <th scope="col">Belongs to District</th>
              <th scope="col">Source</th>
              <th scope="col">Source 2</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $counties as $county )

              <tr>
                <td><strong>{{ $county->county_name}}</strong> </td>
                <td> {{ $county->county_description}}</td>
                <td>{{ $county->district_name }}</td>
                <td>{{ $county->s1_name }}</td>
                <td>{{ $county->s2_name }}</td>
                <td>
                <a class="btn btn-primary btn-sm" href="{{ route('show_county', ['county_id'=>$county->id ]) }}">EDIT <i class="far fa-edit"></i></a>
                @can('isAdmin')
                <a class="btn btn-danger btn-sm" href="{{ route('del_county', ['county_id'=>$county->id ]) }}">ERASE <i class="far fa-trash-alt"></i></a>
                @endcan
                </td>
              </tr>

              @endforeach

            </tbody>
        </table>


      </div>
    </div>
@endsection
