@extends('layouts.open_master')

@section('content')
@include('layouts.partials.general',['roms'=>$roms])
<h1>Size of Romani households per village</h1>
  <div>{!! $village_roms->container() !!}</div>
<script src=//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js charset=utf-8></script>
 {!! $village_roms->script() !!}
<div class="btn-group btn-group-sm float-right mt-2" role="group" aria-label="MaxMin">
  <button type="button" class="btn btn-primary">Max</button>
  <button type="button" class="btn btn-outline-primary">Village: {{$maxs->village_name}}</button>
  <button type="button" class="btn btn-outline-primary">Average size: {{round($maxs->avg)}}</button>
  <button type="button" class="btn btn-danger">Min</button>
  <button type="button" class="btn btn-outline-danger">Village: {{$min->village_name}}</button>
  <button type="button" class="btn btn-outline-danger">Average size: {{round($min->avg)}}</button>
</div>
<h3>Roms average household size per village </h3>
<table id="example" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      <th>Village name</th>
      <th>Average household size</th>
    </tr>
</thead>
  <tbody>
    @foreach( $villages as $village )
    <tr>
        <td>{{ $village->village_name }}</td><td>{{ round($village->avg) }}</td>
    </tr>
    @endforeach
   </tbody>

 </table>
 <p>Download table <a href="{{route('export_table_roms')}}">here!</a>
@endsection
