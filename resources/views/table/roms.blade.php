@extends('layouts.master')

@section('content')
<h3>Roms average size per village</h3><small>[{{$now}}]</small>
<table id="example" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      <th>Village name</th>
      <th>Average number</th>
    </tr>

  @foreach( $villages as $village )
  <tbody>
    <tr>
        <td>{{ $village->village_name }}</td><td>{{ $village->avg }}</td>
    </tr>
   </tbody>
   @endforeach
 </table>
 <p>Download table <a href="{{route('export_table_roms')}}">here!</a>
@endsection
