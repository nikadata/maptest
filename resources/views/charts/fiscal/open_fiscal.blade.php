@extends('layouts.open_master')

@section('content')
@include('layouts.partials.general',['roms'=>$roms])
<h3>Roms fiscal data </h3><small>[{{$now}}]</small>
<div>{!! $rom_fiscal->container() !!}</div>
<script src=//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js charset=utf-8></script>
 {!! $rom_fiscal->script() !!}
@endsection
