@extends('layouts.master')

@section('content')
<div class="row">
      <div class="medium-12 large-12 columns">
        <h4>{{ $modify == 1 ? 'Modify Person' : 'New Person' }}</h4>
        <form action="{{ $modify == 1 ? route('update_client', ['client_id'=> $client_id ]) : route('create_client') }}" method="post">
          {{ csrf_field() }}

          <div class="medium-4  columns">
            <label>Name</label>
            <input name="name" type="text" value="{{ old('name') ? old('name'): $name }}">
            <small class="error">{{ $errors->first('name') }}</small>
          </div>
          <div class="medium-4  columns">
            <label>Last Name</label>
            <input name="last_name" type="text" value="{{ old('last_name') ? old('last_name'): $last_name }}">
            <small class="error">{{ $errors->first('last_name') }}</small>
          </div>
          <div class="medium-4  columns">
            <label>Age</label>
            <input name="age" type="text" value="{{ old('age') ? old('age'): $age }}">
            <small class="error">{{ $errors->first('age') }}</small>
          </div>
          <div class="medium-4  columns">
            <label>Nationality</label>
            <input name="nationality" type="text" value="{{ old('nationality') ? old('nationality'): $nationality }}">
            <small class="error">{{ $errors->first('nationality') }}</small>
          </div>
          <div class="medium-4  columns">
            <label>Marital status</label>
            <select name="maritalstatus">
              @if( $modify==1)
              <option value="{{ $maritalstatus }}">{{ $maritalstatus }}</option>
              @endif
              @foreach( $titles as $title)
                        <option value="{{ $title }}" >{{ $title }}.</option>

              @endforeach

                        </select>
          </div>
          <div class="medium-4  columns">
            <label>Taxpayer</label>
            <input name="taxpayer" type="text" value="{{ old('taxpayer') ? old('taxpayer'): $taxpayer }}">
            <small class="error">{{ $errors->first('taxpayer') }}</small>
          </div>
          <div class="medium-4  columns">
            <label>Belongs to Village</label>
            <select name="village">
              @if( $modify==1)
              <option value="{{ $village_id }}">{{ $village->village_name }}</option>
              @endif
              @foreach( $villages as $village)
                        <option value="{{ $village->id }}" >{{ $village->village_name }}</option>
              @endforeach
            </select>
          </div>
          <div class="medium-4  columns">
            <label>Social Class</label>
            <select name="socialclass">
              @if( $modify==1)
              <option value="{{ $social_id }}">{{ $social->social_name }}</option>
              @endif
              @foreach( $socials as $social)
              <option value="{{ $social->id }}" >{{ $social->social_name }}</option>
              @endforeach
            </select>
          </div>
          <div class="medium-4  columns">
            <label>Skill</label>
            <select name="skill">
              @if( $modify==1)
              <option value="{{ $skill_id }}">{{ $skill->skill_name }}</option>
              @endif
              @foreach( $skills as $skill)
              <option value="{{ $skill->id }}" >{{ $skill->skill_name }}</option>
              @endforeach
            </select>
          </div>
          <div class="medium-4  columns">
            <label>Source</label>
            <select name="source">
              @if( $modify==1)
              <option value="{{ $source_id }}">{{ $source->source_name }}</option>
              @endif
              @foreach( $sources as $source)
              <option value="{{ $source->id }}" >{{ $source->source_name }}</option>
              @endforeach
            </select>
          </div>
          <div class="medium-12  columns">
            <input value="SAVE" class="button success hollow" type="submit">
          </div>
        </form>
      </div>
    </div>
@endsection
