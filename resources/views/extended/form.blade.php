@extends('layouts.master')

@section('content')
<div class="form-row">
  <div class="col">
        <h4>{{ $modify == 1 ? 'Modify Extended family' : 'New Extended family' }}</h4>
      </div>
        <form action="{{ $modify == 1 ? route('update_extended', ['extended_id'=> $extended->id ]) : route('create_extended') }}" method="post">
          {{ csrf_field() }}
</div>
        <div class="form-row">
            <div class="col">
            <label>Extended Family Tag</label>
            <input name="extended_name" class="form-control form-control-sm" type="text" value="{{ old('$extended->type') ? old('$extended->type'): $extended->type }}">
            <small class="text-danger">{{ $errors->first('extended_name') }}</small>
          </div>
          <div class="col">
            <label>Description</label>
            <input name="extended_description" class="form-control form-control-sm" type="text" value="{{ old('$extended->extended_description') ? old('$extended->extended_description'): $extended->extended_description }}">
            <small class="text-danger">{{ $errors->first('extended_description') }}</small>
          </div>
          <div class="col">
            <br>
            <input value="SAVE" class="btn btn-primary btn-lg" type="submit">
          </div>
        </form>
      </div>

@endsection
