@extends('layouts.open_master')

@section('content')
@include('layouts.partials.general',['roms'=>$roms])
<h3>Socio-economic stratification Ilfov</h3><small>[{{$now}}]</small>
<div>{!! $rom_skills->container() !!}</div>
<script src=//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js charset=utf-8></script>
 {!! $rom_skills->script() !!}

<table id="example" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      <th>Skill category</th>
      <th>Number</th>
      <th>%</th>
    </tr>
  </thead>

  <tbody>
    @foreach( $skills as $skill )
    <tr>
        <td>{{ $skill->skillcat_name }}</td><td>{{ $skill->ilfov_skillcat_number }}</td><td>
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: {{ $skill->ilfov_skillcat_pr}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{ $skill->ilfov_skillcat_pr}}%</div>
          </div>
          {{ $skill->ilfov_skillcat_pr}} %</td>
    </tr>
     @endforeach

   </tbody>

 </table>

@endsection
