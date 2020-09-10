@extends('layouts.master')

@section('content')
<div class="form-row">
    <div class="col">
        <h4>{{ $modify == 1 ? 'Modify Sub-district' : 'New Sub-district' }}</h4>
      </div>
        <form action="{{ $modify == 1 ? route('update_county', ['county_id'=> $county_id ]) : route('create_county') }}" method="post">
          {{ csrf_field() }}
</div>
        <div class="form-row">
          <div class="col">
            <label>Sub-district</label>
            <input name="county_name" class="form-control form-control-sm" type="text" value="{{ old('county_name') ? old('county_name'): $county_name }}">
            <small class="text-danger">{{ $errors->first('county_name') }}</small>
          </div>
          <div class="col">
            <label>Description</label>
            <input name="county_description" class="form-control form-control-sm" type="text" value="{{ old('county_description') ? old('county_description'): $county_description }}">
            <small class="text-danger">{{ $errors->first('county_description') }}</small>
          </div>
          <!-- -->
          <div class="col">
            <label>District</label>
            <select name="county_district_id" class="form-control form-control-sm">
              @if( $modify==1)
              <option value="{{ $county_district_id }}">{{ $county_district_name }}</option>
              @endif
              @foreach( $districts as $district)
                        <option value="{{ $district->id }}" >{{ $district->district_name }}</option>

              @endforeach

                        </select>
          </div>
          <div class="col-sm-2 pb-3">
            <label>Source</label>
            <select class="form-control form-control-sm" name="source">
              @if( $modify==1)
              <option value="{{ $source1_id }}">{{ $source1->source_name }}</option>
              @endif
              @foreach( $sources as $source)
              <option value="{{ $source->id }}" >{{ $source->source_name }}</option>
              @endforeach
            </select>
            </div>

          <div class="col-sm-2 pb-3">
            <label>Source 2</label>
            <select class="form-control form-control-sm" name="source2">
              @if( $modify==1)
                <option value="{{ $source2_id }}">{{ $source2->source_name }}</option>
              @endif
              @foreach( $sources as $source)
                <option value="{{ $source->id }}" >{{ $source->source_name }}</option>
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
