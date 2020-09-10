
<h2>Roms per skills(jobs)</h2><small>[{{$now}}]</small>
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
        <td>{{ $skill->skill_name }}</td><td>{{ $skill->roms_count }}</td>
    </tr>
     @endforeach

   </tbody>

 </table>
