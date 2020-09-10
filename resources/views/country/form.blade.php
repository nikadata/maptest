@extends('layouts.master')

@section('content')
<div class="form-row">
      <div class="col">
        <h4>{{ $modify == 1 ? 'Modify Country' : 'New Country' }}</h4>
      </div>
    </div>
        <form action="{{ $modify == 1 ? route('update_country', ['country_id'=> $country->id ]) : route('create_country') }}" method="post">
          {{ csrf_field() }}
        <div class="form-row">
          <div class="col">
            <label>Country</label>
            <input name="country_name" class="form-control form-control-sm" type="text" value="{{ old('$country->country_name') ? old('$country->country_name'): $country->country_name }}">
            <small class="text-danger">{{ $errors->first('country_name') }}</small>
          </div>
          <div class="col">
            <label>Population</label>
            <input name="country_population" class="form-control form-control-sm" type="text" value="{{ old('$country->country_population') ? old('$country->country_population'): $country->country_population }}">
            <small class="text-danger">{{ $errors->first('country_population') }}</small>
          </div>
          <div class="col">
            <label>Description</label>
            <input name="country_description" class="form-control form-control-sm" type="text" value="{{ old('$country->country_description') ? old('$country->country_description'): $country->country_description }}">
            <small class="text-danger">{{ $errors->first('country_description') }}</small>
          </div>
          <div class="col">
            <br>
            <input value="SAVE" class="btn btn-primary btn-lg" type="submit">
          </div>
        </div>
        </form>

@endsection
