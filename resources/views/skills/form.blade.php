@extends('layouts.master')

@section('content')
<div class="form-row">
  <div class="col">
        <h4>{{ $modify == 1 ? 'Modify Job Class' : 'New Job' }}</h4>
      </div>
    </div>
        <form action="{{ $modify == 1 ? route('update_skill', ['skill_id'=> $skill->id ]) : route('create_skill') }}" method="post">
          {{ csrf_field() }}
          <div class="form-row">
            <div class="col">
            <label>Jobs</label>
            <input name="skill_name" class="form-control form-control-sm" type="text" value="{{ old('$skill->skill_name') ? old('$skill->skill_name'): $skill->skill_name }}">
            <small class="text-danger">{{ $errors->first('skill_name') }}</small>
          </div>
          <div class="col">
            <label>Description</label>
            <input name="skill_description" class="form-control form-control-sm" type="text" value="{{ old('$skill->skill_description') ? old('$skill->skill_description'): $skill->skill_description }}">
            <small class="text-danger">{{ $errors->first('skill_description') }}</small>
          </div>
          <div class="col">
            <br>
            <input value="SAVE" class="btn btn-primary btn-lg" type="submit">
          </div>
        </form>
      </div>

@endsection
