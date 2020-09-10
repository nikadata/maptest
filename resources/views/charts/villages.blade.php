@extends('layouts.open_master')

@section('content')
@include('layouts.partials.general',['roms'=>$roms])
<h1>Households per Village</h1>

  <div>{!! $count_households->container() !!}</div>
<script src=//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js charset=utf-8></script>
 {!! $count_households->script() !!}
<div class="btn-group btn-group-sm float-right mt-2" role="group" aria-label="MaxMin">
  <button type="button" class="btn btn-primary">Max</button>
  <button type="button" class="btn btn-outline-primary">Village: {{$maxs->village_name}}</button>
  <button type="button" class="btn btn-outline-primary">Romani households: {{$maxs->rom_households_count}}</button>
  <button type="button" class="btn btn-danger">Min</button>
  <button type="button" class="btn btn-outline-danger">Village: {{$min->village_name}}</button>
  <button type="button" class="btn btn-outline-danger">Romani households:
    @if($min->rom_households_count ==NULL)
    0
    @else
    {{$min->rom_households_count}}</button>
    @endif
</div>
<table id="example" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      <th>Village</th>
      <th>Households</th>
      <th class="text-danger">Romani households</th>
      <th>Percent</th>
    </tr>
  </thead>

  <tbody>
    @foreach( $villages as $village )
    <tr>
        <td>{{ $village->village_name }}</td><td>{{ $village->households_count }}</td><td class="text-danger">{{ $village->rom_households_count }}</td>
        <td>
        @if($village->households_count==0)
          N/A
        @else
            {{ $village->rom_households_procent*100 }}%
            @endif
            </td>
    </tr>
     @endforeach

   </tbody>

 </table>
@endsection
