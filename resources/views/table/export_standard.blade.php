
<h2>Standard population table</h2><small>[{{$now}}]</small>
<table id="example" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      <th>Age</th>
      <th>Male</th>
      <th>Female</th>
    </tr>
  </thead>

  <tbody>
    @foreach( $graphs as $graph )
    <tr>
        <td>{{ $graph->age }}</td><td>{{ $graph->male }}</td><td>{{ $graph->female }}</td>
    </tr>
     @endforeach
   </tbody>
 </table>
