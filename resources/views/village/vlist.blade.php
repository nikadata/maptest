@extends('layouts.master')

@section('content')
  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif
      <h4>Latest 10 Villages</h4>
        <div class="medium-2  columns"><a class="btn btn-outline-success" href="{{ route('new_village') }}">ADD NEW VILLAGE</a></div>
        <br>
        <table id="village" class="table-sm table-striped table-bordered table-sm" style="width:100%">
          <thead>
              <tr>
                <td>Village</td>
                <td>Sub-district</td>
                <td>Land</td>
                <td>Fruittrees</td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
          </thead>
          <tbody>
        @foreach( $villages as $village )
            <tr>
              <td><strong>{{ $village->village_name}}</strong></td>
              <td>{{ $village->county_name }}</td>
              <td>{{$village->land}}</td>
              <td>{{$village->fruittrees}}</td>
                <td>
                <a class="btn btn-primary btn-sm" href="{{ route('show_village', ['village_id'=>$village->id ]) }}">EDIT <i class="far fa-edit"></i></a>
              </td>
              <td>
              <a class="btn btn-success btn-sm" href="{{ route('list_village', ['village_id'=>$village->id ]) }}">HOUSEHOLDS <i class="fas fa-users"></i></a>
              </td>
                @can('isAdmin')
                <td>
                <a class="btn btn-danger btn-sm" href="{{ route('del_village', ['village_id'=>$village->id ]) }}">ERASE <i class="far fa-trash-alt"></i></a>
                @endcan
                </td>
              </tr>
        @endforeach
            </tbody>
        </table>

@endsection
