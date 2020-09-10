@extends('layouts.master')

@section('content')
<div id="content">
  <div style="display:block;margin:0;" id="myDiv" class="animate-bottom">Standby!</div>
<div id="loader"></div>
</div>

<script>

function showPage() {
  document.getElementById("loader").style.display = "none";

}
$.get('/load', function(html){
    $('#content').html(html);

});
</script>
@endsection
