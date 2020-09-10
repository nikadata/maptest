@extends('layouts.open_master')

@section('content')
@include('layouts.partials.general',['roms'=>$roms])
<h1>Roms per village</h1>
  <div>{!! $village_rom->container() !!}</div>
<script src=//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js charset=utf-8></script>
 {!! $village_rom->script() !!}
<div class="btn-group btn-group-sm float-right mt-2" role="group" aria-label="MaxMin">
  <button type="button" class="btn btn-primary">Max</button>
  <button type="button" class="btn btn-outline-primary">Village: {{$maxs->village_name}}</button>
  <button type="button" class="btn btn-outline-primary">Roms: {{$maxs->roms_count}}</button>
  <button type="button" class="btn btn-danger">Min</button>
  <button type="button" class="btn btn-outline-danger">Village: {{$min->village_name}}</button>
  <button type="button" class="btn btn-outline-danger">Roms:
    @if($min->roms_count ==NULL)
    0
    @else
    {{$min->roms_count}}
    @endif
    </button>
</div>

<table id="example" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      <th>Village name</th>
      <th>Number</th>
    </tr>
  </thead>

  <tbody>
    @foreach( $villages as $village )
    <tr>
        <td>{{ $village->village_name }}</td><td>{{ $village->roms_count }}</td>
    </tr>
     @endforeach
     <tr><td><strong>Total:</strong></td><td><strong>{{$total}}</strong></td></tr>
   </tbody>

 </table>
 <p>Download table <a href="{{route('export_table_rom')}}">here!</a>
@endsection
