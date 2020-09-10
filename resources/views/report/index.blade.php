@extends('layouts.open_master')

@section('content')
<div id="content">
  <div style="display:block;margin:0;" id="myDiv" class="animate-bottom">Updating statistics. Please wait!</div>
<div id="loader"></div>
</div>

<script>

function showPage() {
  document.getElementById("loader").style.display = "none";

}
$.get('/update_statistics', function(html){
    $('#content').html(html);

});
</script>
@endsection
