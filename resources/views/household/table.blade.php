@extends('layouts.master')

@section('content')
<div>
<a class="btn btn-primary btn-lg" href="{{ route('new_household') }}" role="button">Add +</a>
<a class="btn btn-outline-primary btn-sm" href="{{ route('households') }}" role="button">Change view</a>
</div>
<br>
  @foreach( $households as $household )
    <div class="card">
        <h5 class="card-header">| {{ $household->number }} | {{ $household->name}}
          <span class="badge badge-secondary">{{ $household->household_count }}</span>
          @if($household->linked==1)<i class="fas fa-link"></i>
          @endif
        </h5>
        <div class="card-body">
          <a href="{{ route('household_detail', ['household_id'=>$household->id ]) }}" class="btn btn-success">VIEW <i class="fas fa-eye"></i></i></a>
          <a href="{{ route('show_household', ['household_id'=>$household->id ]) }}" class="btn btn-primary">EDIT <i class="far fa-edit"></i></a>
          <a href="{{ route('relate', ['household_id'=>$household->id ]) }}" class="btn btn-secondary">GROUP <i class="fas fa-link"></i></a>
        </div>
    </div>
  @endforeach


@endsection
