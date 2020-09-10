@extends('layouts.open_master')

@section('content')
@include('layouts.partials.general',['roms'=>$roms])
<h3>Roms per skills</h3><small>[{{$now}}]</small>
<div>{!! $rom_skills->container() !!}</div>
<script src=//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js charset=utf-8></script>
 {!! $rom_skills->script() !!}
<div class="btn-group btn-group-sm float-right mt-2" role="group" aria-label="MaxMin">
  <button type="button" class="btn btn-primary">Max</button>
  <button type="button" class="btn btn-outline-primary">Skill: {{$maxs->skill_name}}</button>
  <button type="button" class="btn btn-outline-primary">Number of Roms: {{$maxs->roms_count}}</button>
  <button type="button" class="btn btn-danger">Min</button>
  <button type="button" class="btn btn-outline-danger">Skill: {{$min->skill_name}}</button>
  <button type="button" class="btn btn-outline-danger">Number of Roms: {{$min->roms_count}}</button>
</div>
<table id="example" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      <th>Skill name</th>
      <th>Number</th>
    </tr>
  </thead>

  <tbody>
    @foreach( $skills as $skill )
    <tr>
      @if($skill->skill_name=='None')
      <td>Unemployed (None)</td><td>{{ $skill->roms_count }}</td>
      @else
        <td>{{ $skill->skill_name }}</td><td>{{ $skill->roms_count }}</td>
      @endif
    </tr>
     @endforeach

   </tbody>

 </table>
 <p>Download table <a href="{{route('export_table_skill')}}">here!</a>
@endsection
