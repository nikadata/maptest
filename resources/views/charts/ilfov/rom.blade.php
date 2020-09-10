@extends('layouts.open_master')

@section('content')
@include('layouts.partials.general',['roms'=>$roms])
@include('layouts.partials.ilfov',['roms'=>$roms])
<h3>Ilfov: Roms per village</h3><small>[{{$now}}]</small>
  <div>{!! $village_rom->container() !!}</div>
<script src=//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js charset=utf-8></script>
 {!! $village_rom->script() !!}
<div class="btn-group btn-group-sm float-right mt-2" role="group" aria-label="MaxMin">
  <button type="button" class="btn btn-primary">Max</button>
  <button type="button" class="btn btn-outline-primary">Village: {{$maxs->village_name}}</button>
  <button type="button" class="btn btn-outline-primary">Roms: {{$maxs->roms}}</button>
  <button type="button" class="btn btn-danger">Min</button>
  <button type="button" class="btn btn-outline-danger">Village: {{$min->village_name}}</button>
  <button type="button" class="btn btn-outline-danger">Roms:
    @if($min->roms ==NULL)
    0
    @else
    {{$min->roms}}
    @endif
    </button>
</div>

<table id="example" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      <th>Village</th>
      <th>Number of Households</th>
      <th>Avg. Size of Household</th>
      <th>Number of Rom.H</th>
      <th>Households %</th>
      <th>Number of Roms</th>
    </tr>
  </thead>

  <tbody>
    @foreach( $villages as $village )
    <tr>
        <td>{{ $village->village_name }}</td><td>{{ $village->households }}</td><td>{{ round($village->households_avg) }}</td><td>{{ $village->romhouseholds }}</td>
        <td>
        <div class="progress">
          <div class="progress-bar" role="progressbar" style="width: {{ $village->romhouseholds_percent*100}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{ $village->romhouseholds_percent* 100}}%</div>
        </div>
        {{ $village->romhouseholds_percent*100}} %</td>

        <td>{{ $village->roms }}</td>
    </tr>
     @endforeach
     <tr><td><strong>Total:</strong></td><td><strong>{{ $ilfov_households }}</strong></td><td><strong>{{ round($ilfov_households_avg_total) }}</strong></td><td><strong>{{ $ilfov_roms }}</strong></td><td><strong>{{ round($ilfov_households_percent * 100) }} %</strong></td><td><strong>{{$total}}</strong></td></tr>
   </tbody>

 </table>

@endsection
