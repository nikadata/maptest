@extends('layouts.master')

@section('content')
    <div class="form-row">
      <div class="col">
        <h4>{{ $modify == 1 ? 'Modify District' : 'New District' }}</h4>
      </div>
        <form action="{{ $modify == 1 ? route('update_district', ['district_id'=> $district_id ]) : route('create_district') }}" method="post">
          {{ csrf_field() }}
      </div>
      <div class="form-row">
          <div class="col">
            <label>District</label>
            <input name="district_name" class="form-control form-control-sm" type="text" value="{{ old('district_name') ? old('district_name'): $district_name }}">
            <small class="text-danger">{{ $errors->first('district_name') }}</small>
          </div>
          <div class="col">
            <label>Head town</label>
            <input name="district_description" class="form-control form-control-sm" type="text" value="{{ old('district_description') ? old('district_description'): $district_description }}">
            <small class="text-danger">{{ $errors->first('district_description') }}</small>
          </div>
          <!-- -->
          <div class="col">
            <label>Country</label>
            <select name="district_country_id" class="form-control form-control-sm">
              @if( $modify==1)
              <option value="{{ $district_country_id }}">{{ $district_country_name }}</option>
              @endif
              @foreach( $countries as $country)
                        <option value="{{ $country->id }}" >{{ $country->country_name }}</option>

              @endforeach

                        </select>
          </div>


          <div class="col">
            <br>
            <input value="SAVE" class="btn btn-primary btn-lg" type="submit">
          </div>
        </form>
      </div>

@endsection
