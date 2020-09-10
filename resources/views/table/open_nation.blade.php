@extends('layouts.open_master')

@section('content')
<h3>Roms per nationality</h3><small>[{{$now}}]</small>

<h5>Households</h5>
<table id="household" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      <th>Nationality</th>
      <th>Number</th>
    </tr>
  </thead>
  <tbody>
      @foreach( $nations as $nation )
      <tr>
        <td>{{ $nation->nationality }}</td><td>{{ $nation->count }}</td>
      </tr>
      @endforeach
  </tbody>
</table>
<h5>Wives (of Households)</h5>
<table id="wives" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      <th>Nationality</th>
      <th>Number</th>
    </tr>
  </thead>
    <tbody>
       @foreach( $wives as $wife )
      <tr>
         <td>{{ $wife->wife_nation }}</td><td>{{ $wife->count }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <h5>Children (of Households)</h5>
  <table id="children" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        <th>Nationality</th>
        <th>Number</th>
      </tr>
    </thead>
    <tbody>
      <tr>
  @foreach( $children as $child )
        <td>{{$child->nationality}}</td><td>{{ $child->count }}</td>
      </tr>
  @endforeach
    </tbody>
  </table>
  <h5>Coresidents</h5>
  <table id="coresidents" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        <th>Nationality</th>
        <th>Number</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        @foreach( $coresidents as $coresident )
        <td>{{ $coresident->resident_nation }}</td><td>{{ $coresident->count }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <h5>Coresidents Spouses</h5>
  <table id="coresidents" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        <th>Nationality</th>
        <th>Number</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        @foreach( $coresidents_s as $coresident )
        <td>{{ $coresident->spouse_nation }}</td><td>{{ $coresident->count }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <h5>Coresident Children</h5>
  <table id="coresidents" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        <th>Nationality</th>
        <th>Number</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        @foreach( $coresidents_c as $coresident )
        <td>{{ $coresident->child_nation }}</td><td>{{ $coresident->count }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <h5>Total</h5>
  <table id="total" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        <th>Nationality</th>
        <th>Number</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        @foreach($x as $i)
        <td>{{$i->name}}</td><td>{{$i->total}}</td>
      </tr>
      @endforeach
      <tr><td><b>Total:</td><td><b>{{$romstotal}}</b></td></tr>
    </tbody>
 </table>




 <p>Download table <a href="{{route('export_table_nation')}}">here!</a>
@endsection
