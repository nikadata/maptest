@extends('layouts.master')

@section('content')
<div class="row">
      <div class="medium-12 large-12 columns">
        <h4>Sources</h4>

        <div class="medium-2  columns"><a class="btn btn-outline-success" href="{{ route('new_source') }}">ADD NEW SOURCE</a></div>
        <br>
        <table class="table table-sm">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Source Name</th>
              <th scope="col">Description</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $sources as $source )
              <tr>
                <td>{{ $source->id }}</td>
                <td>{{ $source->source_name }} </td>
                <td> {{ $source->source_description}}</td>
                <td>
                  <a class="btn btn-primary btn-sm" href="{{ route('show_source', ['source_id'=>$source->id ]) }}">EDIT <i class="far fa-edit"></i></a>

                </td>
              </tr>
              @endforeach

            </tbody>
        </table>


      </div>
    </div>
@endsection
