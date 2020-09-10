@extends('layouts.master')

@section('content')
<div class="row">
      <div class="medium-12 large-12 columns">
        <h4>Countries</h4>
        <div class="medium-2  columns"><a class="btn btn-outline-success" href="{{ route('new_country') }}">ADD NEW COUNTRY</a></div>
        <!--
        <div class="medium-2  columns"><a class="button hollow success" href="{{ route('export') }}">EXPORT DATA TO EXCEL</a></div>
        -->
        <br>
        <table class="table table-sm">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Country</th>
              <th scope="col">Population</th>
              <th scope="col">Description</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $countries as $country )
              <tr>
                <td>{{ $country->id }}</td>
                <td>{{ $country->country_name}} </td>
                <td> {{ $country->country_population}}</td>
                <td> {{ $country->country_description}}</td>
                <td>
                  <a class="btn btn-primary btn-sm" href="{{ route('show_country', ['country_id'=>$country->id ]) }}">EDIT <i class="far fa-edit"></i></a>
                  @can('isAdmin')
                  <a class="btn btn-danger btn-sm" href="{{ route('del_country', ['country_id'=>$country->id ]) }}">ERASE <i class="far fa-trash-alt"></i></a>
                  @endcan
                </td>
              </tr>
              @endforeach

            </tbody>
        </table>


      </div>
    </div>
@endsection
