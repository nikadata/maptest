@extends('layouts.master')

@section('content')
<div class="form-row">
      <div class="col">
        <h4>{{ $modify == 1 ? 'Modify group relations' : 'Group relations' }} <i class="fas fa-link"></i></h4>
        <table class="table table-striped table-bordered">
          <thead>
           <tr>
               <th>Number</th>
               <th>Name</th>
               <th><i class="fas fa-link"></i></th>
               <th>Number</th>
               <th>Name</th>
               <th>Relation</th>
           </tr>
       </thead>
       <tbody>
            <tr>

                <td>{{$number}}</td>
                <td>{{$name}}</td>
                <td><i class="fas fa-link"></i></td>
                @if( $linked==1)
                    @foreach($links as $link)
                      @if ($var < 1)
                        {{ $var++ }}
                      @else
                        <tr><td></td><td></td><td><i class="fas fa-link"></i></td>
                      @endif
                          <td>{{$link->number}}</td>
                          <td>{{$link->name}}</td>
                          <td>{{$relations[$k]}}</td>
                        </tr>
                    {{$k++}}
                    @endforeach
                @endif
            </tr>
         </tbody>
        </table>
      </div>
  </div>
  <a href="{{ route('households') }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-backward"></i> BACK</a>
  <br><br>
  <label>Group <strong>{{$number}}</strong> {{$name}} to </label>
  <form action="{{ route('link', ['household_id'=> $household_id ]) }}" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="group_to" value={{$household_id}}>
  <div class="form-row">
      <div class="col-2" >
      <select class="form-control form-control-sm" name="rel_id">
        @foreach ($alls as $all)
        <option value="{{$all->id}}">{{$all->number}} {{$all->name}}</option>
        @endforeach
      </select>
    </div>
      <div class="col-2" >
      <select class="form-control form-control-sm" name="rel_type">
        @foreach ($grouptypes as $type)
        <option value="{{$type->type}}">{{$type->type}}</option>
        @endforeach
      </select>
    </div>
      <br>
      <button type="submit" name="reladd" class="btn btn-outline-primary btn-sm reladd">Add <i class="fas fa-link"></i></button>
      </form>

    </div>




@endsection
