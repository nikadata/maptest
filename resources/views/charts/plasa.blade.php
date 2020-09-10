@extends('layouts.open_master')

@section('content')
@include('layouts.partials.general',['roms'=>$roms])
<h1>Households in Plasă villages</h1>
  <div>{!! $count_households->container() !!}</div>
<script src=//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js charset=utf-8></script>
 {!! $count_households->script() !!}
<div class="btn-group btn-group-sm float-right mt-2" role="group" aria-label="MaxMin">
  <button type="button" class="btn btn-primary">Number of Plai villages without Roms</button>
  <button type="button" class="btn btn-outline-primary"><strong>{{ $without_rom}}</strong> </button>
  <button type="button" class="btn btn-danger">Number of Plai villages with Roms</button>
  <button type="button" class="btn btn-outline-danger"><strong>{{ $rom_villages}}</strong> </button>

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
