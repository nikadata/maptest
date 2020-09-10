
<h2>Roms per skills(jobs)</h2><small>[{{$now}}]</small>
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
        <td>{{ $skill->skillcat_name }}</td><td>{{ $skill->skillcat_number }}</td><td>{{ $skill->skillcat_pr}} %</td>
    </tr>
     @endforeach

   </tbody>

 </table>
