@extends('layouts.open_master')

@section('content')
@include('layouts.partials.general',['roms'=>$roms])
<h3>Roms social data </h3><small>[{{$now}}]</small>
<div>{!! $rom_social->container() !!}</div>
<script src=//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js charset=utf-8></script>
 {!! $rom_social->script() !!}
@endsection
