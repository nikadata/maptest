@extends('layouts.master')

@section('content')
<div class="form-row">
  <div class="col">
        <h4>{{ $modify == 1 ? 'Modify Social Class' : 'New Social Class' }}</h4>
      </div>
        <form action="{{ $modify == 1 ? route('update_social', ['social_id'=> $social->id ]) : route('create_social') }}" method="post">
          {{ csrf_field() }}
</div>
        <div class="form-row">
            <div class="col">
            <label>Social Class</label>
            <input name="social_name" class="form-control form-control-sm" type="text" value="{{ old('$social->social_name') ? old('$social->social_name'): $social->social_name }}">
            <small class="text-danger">{{ $errors->first('social_name') }}</small>
          </div>
          <div class="col">
            <label>Description</label>
            <input name="social_description" class="form-control form-control-sm" type="text" value="{{ old('$social->social_description') ? old('$social->social_description'): $social->social_description }}">
            <small class="text-danger">{{ $errors->first('social_description') }}</small>
          </div>
          <div class="col">
            <br>
            <input value="SAVE" class="btn btn-primary btn-lg" type="submit">
          </div>
        </form>
      </div>

@endsection
