@extends('layouts.master')

@section('content')
<div class="row">
      <div class="medium-12 large-12 columns">
        <h4>Households</h4>
        <div class="medium-2  columns"><a class="btn btn-outline-success" href="{{ route('new_client') }}">ADD NEW PERSON</a>
        <a class="btn btn-outline-success" href="{{ route('export') }}">EXPORT DATA TO EXCEL</a></div>
        <br>
        <table class="table table-sm">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Name</th>
              <th scope="col">Age</th>
              <th scope="col">Marital status</th>
              <th scope="col">Nationality</th>
              <th scope="col">Taxpayer</th>
              <th scope="col">Village</th>
              <th scope="col">Social class</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $clients as $client )
              <tr>
                <td>{{ $client->id }}</td>
                <td>{{ $client->name}} {{ $client->last_name}}</td>
                <td>{{ $client->age }}</td>
                <td>{{ $client->maritalstatus }}</td>
                <td>{{ $client->nationality }}</td>
                <td>{{ $client->taxpayer }}</td>
                <td>{{ $client->village_name }}</td>
                <td>{{ $client->social_name }}</td>
                <td>
                  <a class="btn btn-primary btn-sm" href="{{ route('show_client', ['client_id'=>$client->id ]) }}">EDIT</a>
                <!--  <a class="hollow button warning" href="{{ route('check_room', ['client_id'=>$client->id ]) }}">BOOK A ROOM</a> -->

                </td>
              </tr>
              @endforeach

            </tbody>
        </table>


      </div>
    </div>
@endsection
