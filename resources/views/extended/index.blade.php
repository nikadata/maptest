@extends('layouts.master')

@section('content')
<div class="row">
      <div class="medium-12 large-12 columns">
        <h4>Extended family relations</h4>

        <div class="medium-2  columns"><a class="btn btn-outline-success" href="{{ route('new_extended') }}">ADD NEW EXTENDED RELATION</a></div>
        <br>
        <table class="table table-sm">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Type</th>
              <th scope="col">Description</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $extendeds as $extended )
              <tr>
                <td>{{ $extended->id }}</td>
                <td>{{ $extended->type }} </td>
                <td>{{ $extended->extended_description }} </td>
                <td>
                  <a class="btn btn-primary btn-sm" href="{{ route('show_extended', ['extended_id'=>$extended->id ]) }}">EDIT <i class="far fa-edit"></i></a>
                  @can('isAdmin')
                  <a class="btn btn-danger btn-sm" href="{{ route('del_extended', ['extended_id'=>$extended->id ]) }}">ERASE <i class="far fa-trash-alt"></i></a>
                  @endcan
                </td>
              </tr>
              @endforeach

            </tbody>
        </table>


      </div>
    </div>
@endsection
