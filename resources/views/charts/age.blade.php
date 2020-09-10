@extends('layouts.open_master')

@section('content')
@include('layouts.partials.general',['roms'=>$roms])
<h1>Age distribution pyramid</h1>
  <div>{!! $menbar->container() !!}</div>
<script src=//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js charset=utf-8></script>
 {!! $menbar->script() !!}
<p>Table data click <a href="{{ route('table_age') }}">here!</a></p>
@endsection
