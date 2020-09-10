@extends('layouts.master')

@section('content')
<h2>Roms per village</h2><small>[{{$now}}]</small>
<table id="example" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      <th>Village name</th>
      <th>Number</th>
    </tr>

  @foreach( $villages as $village )
  <tbody>
    <tr>
        <td>{{ $village->village_name }}</td><td>{{ $village->roms_count }}</td>
    </tr>
    @endforeach
    <tr><td>Total:</td><td>{{$total}}</td></tr>
   </tbody>

 </table>
 <p>Download table <a href="{{route('export_table_rom')}}">here!</a>
@endsection
