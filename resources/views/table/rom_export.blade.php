Number<h2>Roms per village</h2><small>[{{$now}}]</small>
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
