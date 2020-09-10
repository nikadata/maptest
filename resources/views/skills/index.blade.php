@extends('layouts.master')

@section('content')
<div class="row">
      <div class="medium-12 large-12 columns">
        <h4>Jobs</h4>
        <div class="medium-2  columns"><a class="btn btn-outline-success" href="{{ route('new_skill') }}">ADD NEW JOB</a></div>
        <br>
        <table class="table table-sm">
          <thead>
            <tr>
              <th scope="col">Ref.Id</th>
              <th scope="col">Job</th>
              <th scope="col">Description</th>
              <th class="text-center" scope="col">Action</th>

            </tr>
          </thead>
          <tbody>
            @foreach( $skills as $skill )
              <tr>
                <td>{{ $skill->id }}</td>
                <td>{{ $skill->skill_name }} </td>
                <td> {{ $skill->skill_description}}</td>
                <td>
                  <a class="btn btn-primary btn-sm" href="{{ route('show_skill', ['skill_id'=>$skill->id ]) }}">EDIT <i class="far fa-edit"></i></a>
                  @can('isAdmin')
                  <a class="btn btn-danger btn-sm" href="{{ route('del_skill', ['skill_id'=>$skill->id ]) }}">ERASE <i class="far fa-trash-alt"></i></a>
                  @endcan
                </td>
              </tr>
              @endforeach

            </tbody>
        </table>


      </div>
    </div>
@endsection
