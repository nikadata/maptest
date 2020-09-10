@extends('layouts.master')

@section('content')
<h1>Roms per village</h1>
  <div>{!! $village_rom->container() !!}</div>
<script src=//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js charset=utf-8></script>
 {!! $village_rom->script() !!}

@endsection
