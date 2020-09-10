@extends('layouts.master')

@section('content')
<div class="form-row">
  <div class="col">
        <h4>{{ $modify == 1 ? 'Modify Source' : 'New Source' }}</h4>
      </div>
    </div>
        <form action="{{ $modify == 1 ? route('update_source', ['source_id'=> $source->id ]) : route('create_source') }}" method="post">
          {{ csrf_field() }}
          <div class="form-row">
            <div class="col">
            <label>Source</label>
            <input name="source_name" class="form-control form-control-sm" type="text" value="{{ old('$source->source_name') ? old('$source->source_name'): $source->source_name }}">
            <small class="text-danger">{{ $errors->first('source_name') }}</small>
          </div>
          <div class="col">
            <label>Description</label>
            <input name="source_description" class="form-control form-control-sm" type="text" value="{{ old('$source->source_description') ? old('$source->source_description'): $source->source_description }}">
            <small class="text-danger">{{ $errors->first('source_description') }}</small>
          </div>
          <div class="col">
            <br>
            <input value="SAVE" class="btn btn-primary btn-lg" type="submit">
          </div>
        </form>
      </div>
    </div>
@endsection
