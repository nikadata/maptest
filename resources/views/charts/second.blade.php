@extends('layouts.master')

@section('content')
<h1>Land per Village</h1>
  <div>{!! $village_land->container() !!}</div>
<script src=//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js charset=utf-8></script>
 {!! $village_land->script() !!}

@endsection
