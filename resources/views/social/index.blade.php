@extends('layouts.master')

@section('content')
<div class="row">
      <div class="medium-12 large-12 columns">
        <h4>Social Classes</h4>

        <div class="medium-2  columns"><a class="btn btn-outline-success" href="{{ route('new_social') }}">ADD NEW SOCIALCLASS</a></div>
        <br>
        <table class="table table-sm">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Social Class</th>
              <th scope="col">Description</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $socials as $social )
              <tr>
                <td>{{ $social->id }}</td>
                <td>{{ $social->social_name }} </td>
                <td> {{ $social->social_description}}</td>
                <td>
                  <a class="btn btn-primary btn-sm" href="{{ route('show_social', ['social_id'=>$social->id ]) }}">EDIT <i class="far fa-edit"></i></a>
                  @can('isAdmin')
                  <a class="btn btn-danger btn-sm" href="{{ route('del_social', ['social_id'=>$social->id ]) }}">ERASE <i class="far fa-trash-alt"></i></a>
                  @endcan
                </td>
              </tr>
              @endforeach

            </tbody>
        </table>


      </div>
    </div>
@endsection
