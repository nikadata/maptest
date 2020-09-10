
<h3>Extended versus single family per district</h3><small>[{{$now}}]</small>

  <table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        <th>District name</th>
        <th>Single families</th>
        <th>Extended families</th>

</thead>
        </tr>
  <tbody>
    @foreach( $districts as $district )
      <tr>
          <td>{{ $district->district_name }}</td>
        <td>{{ $district->single_roms_household }}
          (
          @if ($district->single_roms_household==0 and $district->extended_roms_household==0)
          0 %)
          @else
          {{ ($district->single_roms_household/ ($district->single_roms_household + $district->extended_roms_household))*100 }}%
          )
          @endif
        </td>
        <td>{{ $district->extended_roms_household }}
          (
          @if ($district->single_roms_household==0 and $district->extended_roms_household==0)
          0 %)
          @else
          {{ ($district->extended_roms_household/ ($district->single_roms_household + $district->extended_roms_household))*100 }}%
          )
          @endif
        </td>



      </tr>
      @endforeach
     </tbody>

   </table>
