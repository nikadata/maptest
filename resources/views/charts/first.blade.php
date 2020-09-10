@extends('layouts.master')

@section('content')
<h1>Households per Village</h1>
  <div>{!! $count_households->container() !!}</div>
<script src=//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js charset=utf-8></script>
 {!! $count_households->script() !!}

@endsection
