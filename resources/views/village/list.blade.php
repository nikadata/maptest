@extends('layouts.master')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
<a href="{{ route('village') }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-backward"></i></a>
<table id="example" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
        <th>Nr.</th>
        <th>Name</th>
        <th>Total</th>
        <th>Village</th>
        <th data-toggle="tooltip" data-placement="top" title="Percentage area compared to the village">Land%</th>
        <th data-toggle="tooltip" data-placement="top" title="Percentage crops compared to the village">Crops%</th>
        <th data-toggle="tooltip" data-placement="top" title="Percentage fruit compared to the village">Fruit%</th>
        <th data-toggle="tooltip" data-placement="top" title="Percentage livestock compared to the village">L.stock%</th>
      <!--  <th>Linked</th> -->
        <th>Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach( $households as $household )
   <tr>
     <td>{{ $household->number }}</td>
     <td>{{ $household->name}}</td>
     <td>{{ $household->household_count }}</td>
     <td>{{$household->village_name}}</td>
     @if($household->household_land==0 || $household->village_land==0)
     <td>0%</td>
     @else  <td>{{round(($household->household_land/$household->village_land)*100,2)}}%</td>
     @endif
     @if($household->household_crops==0 || $household->village_crops==0)
     <td>0%</td>
     @else   <td>{{round(($household->household_crops/$household->village_crops)*100,2)}}%</td>
     @endif
     @if($household->householdsum_fruit==0 || $household->villagesum_fruit==0)
     <td>0%</td>
     @else <td>{{round(($household->householdsum_fruit/$household->villagesum_fruit)*100,2)}}%</td>
     @endif
     @if($household->household_livestock==0 || $household->village_livestock==0)
     <td>0%</td>
     @else <td>{{round(($household->household_livestock/$household->village_livestock)*100,2)}}%</td>
     @endif
     <!--
     /*
     @if($household->linked==1)
       <td><i class="fas fa-link"></i></td>
     @else <td></td>
     @endif
     */
   -->
     <td class="text-center">
       <a href="{{ route('household_detail', ['household_id'=>$household->household_id ]) }}" class="btn btn-outline-success btn-sm"><i class="fas fa-eye"></i></a>
       <a href="{{ route('show_household', ['household_id'=>$household->household_id ]) }}" class="btn btn-outline-primary btn-sm"><i class="far fa-edit"></i></a>
       <a href="{{ route('relate', ['household_id'=>$household->household_id ]) }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-link"></i></a>
     </td>
  </tr>
   @endforeach
  </tbody>
  </table>


   <script>
     $(document).ready(function() {
      $('#example').DataTable();
      } );
      $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
      </script>
@endsection
