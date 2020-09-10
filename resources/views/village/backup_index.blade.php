@extends('layouts.master')

@section('content')
<div class="form-row">
  <div class="col">
      <h4>Villages</h4>
        <div class="medium-2  columns"><a class="btn btn-outline-success" href="{{ route('new_village') }}">ADD NEW VILLAGE</a></div>
        <br>
        @foreach( $villages as $village )
        <div class="card">
          <div class="card-header">
          <strong>  {{ $village->village_name}}</strong>
          </div>
        <table class="table table-bordered table-sm">

          <thead>
              <tr class="d-flex">
                <td class="col-2">Sub-district</td><td class="col-2">Romani households</td><td class="col-1">Roms</td><td class="col-1">Land</td>
                <td class="col-1">Fruittrees</td><td class="col-1">Livestock</td>

              </tr>
          </thead>
          <tbody>
              <tr class="d-flex">
                <td class="col-2">{{ $village->county_name }}</td>
                <td class="col-2">{{$village->rom_households_count}}</td>
                <td class="col-1">{{$village->roms_count}}</td>
                <td class="col-1">{{$village->village_land}}</td>
                <td class="col-1">{{$village->villagesum_fruit}}</td>
                <td class="col-1">{{$village->village_livestock}}</td>
                
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


            </tbody>
        </table>
  </div>
  <br>
  @endforeach
      </div>
    </div>
@endsection
