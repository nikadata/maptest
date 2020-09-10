@extends('layouts.master')

@section('content')
<div class="row">
  <!--<div class="medium-12 large-12 columns">-->
  <div class="col">
    <h4>Group Relations</h4>

    <br>
    <table class="table table-sm">
      <thead>
        <tr>
          <th scope="col">Household</th>
          <th scope="col">in relation with household</th>
          <th scope="col">Relation type</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach( $links as $link )
          <tr>
            <td>{{ $link->id }}</td>
            <td> {{ $link->group}}</td>
            <td> {{ $link->relation}}</td>
            <td>

            </td>
          </tr>
          @endforeach

        </tbody>
    </table>


  </div>





</div>
@endsection
