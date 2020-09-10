@extends('layouts.master')

@section('content')
<div class="form-row">
      <div class="col">
        <h4>{{ $modify == 1 ? 'Modify Household' : 'New Household' }}</h4>
      </div>
    </div>
      <form action="{{ $modify == 1 ? route('update_household', ['household_id'=> $household_id ]) : route('create_household') }}" method="post">
          {{ csrf_field() }}

        <div class="form-row">
          <div class="col">
            <label>House number</label>
            <input class="form-control" type="text" name="number" value="{{ old('number') ? old('number'): $number }}">
            <small class="is-invalid">{{ $errors->first('number') }}</small>
            </div>
            <div class="col-7">
            <label>Household</label>
            <input class="form-control" name="name" type="text" value="{{ old('name') ? old('name'): $name }}">
            <small class="is-invalid">{{ $errors->first('name') }}</small>
            </div>
            <div class="col">
            <label>Gender</label>
            <select class="custom-select" name="gen">
              @if( $modify==1)
              <option value="{{ $gen }}">{{ $gen }}</option>
              @endif
              @foreach( $genders as $gender)
                <option value="{{ $gender }}" >{{ $gender }}</option>
              @endforeach
            </select>
            </div>
            <div class="col">
            <label>Age</label>
            <input class="form-control" name="age" type="text" value="{{ old('age') ? old('age'): $age }}">
            <small class="is-invalid">{{ $errors->first('age') }}</small>
            </div>
          </div>
          <div class="form-row">
            <div class="col">

            <label>Nationality</label>
            <select class="custom-select" name="nationality">
              @if( $modify==1)
              <option value="{{ $nationality }}">{{ $nationality }}</option>
              @endif
              @foreach( $nations as $nation)
                <option value="{{ $nation }}" >{{ $nation }}</option>
              @endforeach
            </select>
            </div>

            <div class="col">
            <label>Civil status</label>
            <select class="custom-select" name="civilstatus">
              @if( $modify==1)
              <option value="{{ $civilstatus }}">{{ $civilstatus }}</option>
              @endif
              @foreach( $titles as $title)
                <option value="{{ $title }}" >{{ $title }}</option>
              @endforeach
            </select>
          </div>
            <div class="col">
            <label>Fiscal</label>
            <select class="custom-select" name="fiscal">
              @if( $modify==1)
              <option value="{{ $fiscal }}">{{ $fiscal }}</option>
              @endif
              @foreach( $fiscalvalues as $fiscalvalue)
                <option value="{{ $fiscalvalue }}" >{{ $fiscalvalue }}</option>
              @endforeach
            </select>
            </div>
            <div class="col">
            <label>Belongs to Village</label>
            <select class="custom-select" name="village">
              @if( $modify==1)
              <option value="{{ $village_id }}">{{ $village->village_name }}</option>
              @endif
              @foreach( $villages as $village)
                <option value="{{ $village->id }}" >{{ $village->village_name }}</option>
              @endforeach
            </select>
            </div>
          </div>
          <div class="form-row">
            <div class="col">
            <label>Social Class</label>
            <select class="custom-select" name="socialclass">
              @if( $modify==1)
              <option value="{{ $social_id }}">{{ $social->social_name }}</option>
              @endif
              @foreach( $socials as $social)
              <option value="{{ $social->id }}" >{{ $social->social_name }}</option>
              @endforeach
            </select>
          </div>
            <div class="col">
            <label>Skill</label>
            <select class="custom-select" name="skill">
              @if( $modify==1)
              <option value="{{ $skill_id }}">{{ $skill->skill_name }}</option>
              @endif
              @foreach( $skills as $skill)
              <option value="{{ $skill->id }}" >{{ $skill->skill_name }}</option>
              @endforeach
            </select>
            </div>
            <div class="col">
            <label>Illness</label>
            <select class="custom-select" name="ill">
              @if( $modify==1)
              <option value="{{ $ill }}">{{ $ill }}</option>
              @endif
              @foreach( $illnes as $illne)
                <option value="{{ $illne }}" >{{ $illne }}</option>
              @endforeach
            </select>
            </div>
          </div>
          <hr>
          <div class="form-row">
            <div class="col">
              <label>Land acres</label>
              <input class="form-control" name="clandn" type="number" value="{{ old('clandn') ? old('clandn'): $clandn }}">
              <small class="is-invalid">{{ $errors->first('clandn') }}</small>
            </div>
            <div class="col">
              <label>Crops</label>
              <input class="form-control" name="crops" type="text" value="{{ old('crops') ? old('crops'): $crops }}">
              <small class="is-invalid">{{ $errors->first('clandn') }}</small>
            </div>
          </div>
          <div class="form-row">
            <div class="col">
              <label>Horses</label>
              <input class="form-control" name="horses" type="number" value="{{ old('horses') ? old('horses'): $horses }}">
              <small class="is-invalid">{{ $errors->first('horses') }}</small>
            </div>
            <div class="col">
              <label>Bulls</label>
              <input class="form-control" name="bulls" type="number" value="{{ old('bulls') ? old('bulls'): $bulls }}">
              <small class="is-invalid">{{ $errors->first('bulls') }}</small>
            </div>
            <div class="col">
              <label>Cows</label>
              <input class="form-control" name="cows" type="number" value="{{ old('cows') ? old('cows'): $cows }}">
              <small class="is-invalid">{{ $errors->first('cows') }}</small>
            </div>
            <div class="col">
              <label>Sheep</label>
              <input class="form-control" name="sheep" type="number" value="{{ old('sheep') ? old('sheep'): $sheep }}">
              <small class="is-invalid">{{ $errors->first('sheep') }}</small>
            </div>
            <div class="col">
              <label>Goats</label>
              <input class="form-control" name="goats" type="number" value="{{ old('goats') ? old('goats'): $goats }}">
              <small class="is-invalid">{{ $errors->first('goats') }}</small>
            </div>
            <div class="col">
              <label>Pigs</label>
              <input class="form-control" name="pigs" type="number" value="{{ old('pigs') ? old('pigs'): $pigs }}">
              <small class="is-invalid">{{ $errors->first('pigs') }}</small>
            </div>
            <div class="col">
              <label>Buffalos</label>
              <input class="form-control" name="buffalos" type="number" value="{{ old('buffalos') ? old('buffalos'): $buffalos }}">
              <small class="is-invalid">{{ $errors->first('buffalos') }}</small>
            </div>
            <div class="col">
              <label>Donkeys</label>
              <input class="form-control" name="donkeys" type="number" value="{{ old('donkeys') ? old('donkeys'): $donkeys }}">
              <small class="is-invalid">{{ $errors->first('donkeys') }}</small>
            </div>
            <div class="col">
              <label>Mules</label>
              <input class="form-control" name="mules" type="number" value="{{ old('mules') ? old('mules'): $mules }}">
              <small class="is-invalid">{{ $errors->first('mules') }}</small>
            </div>
            <div class="col">
              <label>Hives</label>
              <input class="form-control" name="hives" type="number" value="{{ old('hives') ? old('hives'): $hives }}">
              <small class="is-invalid">{{ $errors->first('hives') }}</small>
            </div>
          </div>

          <div class="form-row">
            <div class="col">
              <label>Plumtrees</label>
              <input class="form-control" name="plumtrees" type="number" value="{{ old('plumtrees') ? old('plumtrees'): $plumtrees }}">
              <small class="is-invalid">{{ $errors->first('plumtrees') }}</small>
            </div>
            <div class="col">
              <label>Mulberrytrees</label>
              <input class="form-control" name="mulberrytrees" type="number" value="{{ old('mulberrytrees') ? old('mulberrytrees'): $mulberrytrees }}">
              <small class="is-invalid">{{ $errors->first('mulberrytrees') }}</small>
            </div>
            <div class="col">
              <label>Vineyard</label>
              <input class="form-control" name="vineyards" type="number" value="{{ old('vineyards') ? old('vineyards'): $vineyards }}">
              <small class="is-invalid">{{ $errors->first('vineyards') }}</small>
            </div>
            <div class="col">
              <label>Fruittrees</label>
              <input class="form-control" name="fruittrees" type="number" value="{{ old('fruittrees') ? old('fruittrees'): $fruittrees }}">
              <small class="is-invalid">{{ $errors->first('fruittrees') }}</small>
            </div>

            <div class="col">
              <label>Source</label>
              <select class="custom-select" name="source">
                @if( $modify==1)
                <option value="{{ $source_id }}">{{ $source->source_name }}</option>
                @endif
                @foreach( $sources as $source)
                <option value="{{ $source->id }}" >{{ $source->source_name }}</option>
                @endforeach
              </select>
              </div>

            <div class="col">
              <br>
            <input class="btn btn-primary btn-lg" value="SAVE"  type="submit">
            </div>
          </div>
        </form>

@endsection
