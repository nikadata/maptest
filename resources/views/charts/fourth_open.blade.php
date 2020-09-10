@extends('layouts.open_master')

@section('content')
@include('layouts.partials.general',['roms'=>$roms])
<h1>Roms size per village</h1>
  <div>{!! $village_roms->container() !!}</div>
<script src=//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js charset=utf-8></script>
 {!! $village_roms->script() !!}

@endsection
