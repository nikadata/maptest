@extends('layouts.master')

@section('content')
<div class="form-row">
      <div class="col">
        <h4>{{ $modify == 1 ? 'Modify Village' : 'New Village' }}</h4>
      </div>
      </div>
        <form action="{{ $modify == 1 ? route('update_village', ['village_id'=> $village_id ]) : route('create_village') }}" method="post">
          {{ csrf_field() }}


          <div class="form-group">
            <label for="household" class="text-primary">Household data</label>
            <div class="form-row">
              <div class="col-sm-2 pb-3">
                <label>Village name</label>
                <input name="village_name" class="form-control form-control-sm" type="text" value="{{ old('village_name') ? old('village_name'): $village_name }}">
                <small class="text-danger">{{ $errors->first('village_name') }}</small>
              </div>
              <div class="col-sm-4 pb-3">
                <label>Comment</label>
                <input class="form-control form-control-sm" name="comment" type="text" value="{{ old('comment') ? old('comment'): $comment }}">
                <small class="text-danger">{{ $errors->first('comment') }}</small>
              </div>
              <div class="col-sm-1 pb-3">
                <label>Households</label>
                <input name="households" class="form-control form-control-sm" type="number" value="{{ old('households') ? old('households'): $households }}" required>
                <small class="text-danger">{{ $errors->first('households') }}</small>
              </div>
              <div class="col-sm-1 pb-3">
                <label>People</label>
                <input name="people" class="form-control form-control-sm" type="number" value="{{ old('people') ? old('people'): $people }}" required>
                <small class="text-danger">{{ $errors->first('people') }}</small>
              </div>
            </div>
          <div class="form-row">
              <div class="col-sm-1 pb-3">
                <label>Țigan</label>
                <input name="gypsy" class="form-control form-control-sm" type="number" value="{{ old('gypsy') ? old('gypsy'): $gypsy }}" required>
                <small class="text-danger">{{ $errors->first('gypsy') }}</small>
              </div>
              <div class="col-sm-1 pb-3">
                <label>Rudar</label>
                <input name="rudar" class="form-control form-control-sm" type="number" value="{{ old('rudar') ? old('rudar'): $rudar }}" required>
                <small class="text-danger">{{ $errors->first('rudar') }}</small>
              </div>
              <div class="col-sm-1 pb-3">
                <label>Romanian</label>
                <input name="romanian" class="form-control form-control-sm" type="number" value="{{ old('romanian') ? old('romanian'): $romanian }}" required>
                <small class="text-danger">{{ $errors->first('romanian') }}</small>
              </div>
              <div class="col-sm-1 pb-3">
                <label>Jewish</label>
                <input name="jewish" class="form-control form-control-sm" type="number" value="{{ old('jewish') ? old('jewish'): $jewish }}" required>
                <small class="text-danger">{{ $errors->first('jewish') }}</small>
              </div>
              <div class="col-sm-1 pb-3">
                <label>Serbian</label>
                <input name="serbian" class="form-control form-control-sm" type="number" value="{{ old('serbian') ? old('serbian'): $serbian }}" required>
                <small class="text-danger">{{ $errors->first('serbian') }}</small>
              </div>
              <div class="col-sm-1 pb-3">
                <label>Armenian</label>
                <input name="armenian" class="form-control form-control-sm" type="number" value="{{ old('armenian') ? old('armenian'): $armenian }}" required>
                <small class="text-danger">{{ $errors->first('armenian') }}</small>
              </div>
              <div class="col-sm-1 pb-3">
                <label>Ardelean</label>
                <input name="ardelean" class="form-control form-control-sm" type="number" value="{{ old('ardelean') ? old('ardelean'): $ardelean }}" required>
                <small class="text-danger">{{ $errors->first('ardelean') }}</small>
              </div>
              <div class="col-sm-1 pb-3">
                <label>German</label>
                <input name="german" class="form-control form-control-sm" type="number" value="{{ old('german') ? old('german'): $german }}" required>
                <small class="text-danger">{{ $errors->first('german') }}</small>
              </div>
              <div class="col-sm-1 pb-3">
                <label>Russian</label>
                <input name="russian" class="form-control form-control-sm" type="number" value="{{ old('russian') ? old('russian'): $russian }}" required>
                <small class="text-danger">{{ $errors->first('russian') }}</small>
              </div>
              <div class="col-sm-1 pb-3">
                <label>Turk</label>
                <input name="turk" class="form-control form-control-sm" type="number" value="{{ old('turk') ? old('turk'): $turk }}" required>
                <small class="text-danger">{{ $errors->first('turk') }}</small>
              </div>
            </div>
          </div>
          <div class="form-group">
          <label for="fiscal" class="text-primary">Fiscal category</label>
            <div class="form-row">
              <div class="col-sm-1 pb-3">
                <label>Tax payers</label>
                <input name="tax_payer" class="form-control form-control-sm" type="number" value="{{ old('tax_payer') ? old('tax_payer'): $tax_payer }}" required>
                <small class="text-danger">{{ $errors->first('tax_payer') }}</small>
              </div>
              <div class="col-sm-2 pb-3">
                <label>Exempt from taxes</label>
                <input name="exempt_tax" class="form-control form-control-sm" type="number" value="{{ old('exempt_tax') ? old('exempt_tax'): $exempt_tax }}" required>
                <small class="text-danger">{{ $errors->first('exempt_tax') }}</small>
              </div>
            </div>
        </div>
          <div class="form-group">
          <label for="social" class="text-primary">Social category</label>
          <div class="form-row">
            <div class="col-sm-1 pb-3">
              <label>Landowner</label>
              <input name="landowner" class="form-control form-control-sm" type="number" value="{{ old('landowner') ? old('landowner'): $landowner }}" required>
              <small class="text-danger">{{ $errors->first('landowner') }}</small>
            </div>
            <div class="col-sm-1 pb-3">
              <label>Renter</label>
              <input name="renter" class="form-control form-control-sm" type="number" value="{{ old('renter') ? old('renter'): $renter }}" required>
              <small class="text-danger">{{ $errors->first('renter') }}</small>
            </div>
            <div class="col-sm-1 pb-3">
              <label>Craftsman</label>
              <input name="craftsman" class="form-control form-control-sm" type="number" value="{{ old('craftsman') ? old('craftsman'): $craftsman }}" required>
              <small class="text-danger">{{ $errors->first('craftsman') }}</small>
            </div>
          </div>
        </div>
        <!--Trade/occupation -->

      <!-- End trade occupation -->
        <div class="form-group">
        <label for="pastoral" class="text-primary">Pastoral category</label>
        <div class="form-row">
          <!-- Javascript -->
          <!-- Church -->
          <div class="col-2">
          <input type="hidden" name="has_church" value=0>
          <label>Church</label>
          <br>
          <button type="button" name="churchadd" class="btn btn-outline-primary btn-sm churchadd">Add Church <i class="fas fa-church"></i></button>
          <table class="table table-sm" id="church_table">
          @if($modify==1 and $has_church==1)
            @foreach( $churches as $church)
            <tr>
                <input type="hidden" name="has_church" value=1>
                <input type="hidden" name="add_church" value=0>
                <input type="hidden" name="dcount" value=0>
                <input type="hidden" name="church_id[]" value="{{ $church->id }}">
                <td><input class="form-control form-control-sm" name="church_name[]" type="text" value="{{ old('church') ? old('church'): $church->church_name }}" required></td>
                <td><small class="text-danger">{{ $errors->first('church') }}</small></td>
              <tr>

              @endforeach
            @else
            <input type="hidden" name="dcount" value=1>
          @endif
          </table>
          </div>
          <!-- end  -->
          <!-- Priest -->
          <div class="col-2">
          <input type="hidden" name="has_priest" value=0>
          <label>Priest</label>
          <br>
          <button type="button" name="priestadd" class="btn btn-outline-primary btn-sm priestadd">Add priest <i class="fas fa-male"></i></button>
          <table class="table table-sm" id="priest_table">
          @if($modify==1 and $has_priest==1)
            @foreach( $priests as $priest)
            <tr>
                <input type="hidden" name="has_priest" value=1>
                <input type="hidden" name="add_priest" value=0>
                <input type="hidden" name="ecount" value=0>
                <input type="hidden" name="priest_id[]" value="{{ $priest->id }}">
                <td><input class="form-control form-control-sm" name="priest_name[]" type="text" value="{{ old('priest') ? old('priest'): $priest->priest_name }}" required></td>
                <td><small class="text-danger">{{ $errors->first('priest') }}</small></td>
              <tr>

              @endforeach
            @else
            <input type="hidden" name="ecount" value=1>
          @endif
          </table>
          </div>
          <!-- end  -->
          <!-- Deacon -->
          <div class="col-2">
          <input type="hidden" name="has_deacon" value=0>
          <label>Deacon</label>
          <br>
          <button type="button" name="deaconadd" class="btn btn-outline-primary btn-sm deaconadd">Add deacon <i class="fas fa-male"></i></button>
          <table class="table table-sm" id="deacon_table">
          @if($modify==1 and $has_deacon==1)
            @foreach( $deacons as $deacon)
            <tr>
                <input type="hidden" name="has_deacon" value=1>
                <input type="hidden" name="add_deacon" value=0>
                <input type="hidden" name="fcount" value=0>
                <input type="hidden" name="deacon_id[]" value="{{ $deacon->id }}">
                <td><input class="form-control form-control-sm" name="deacon_name[]" type="text" value="{{ old('deacon') ? old('deacon'): $deacon->deacon_name }}" required></td>
                <td><small class="text-danger">{{ $errors->first('deacon') }}</small></td>
              <tr>

              @endforeach
            @else
            <input type="hidden" name="fcount" value=1>
          @endif
          </table>
          </div>
          <!-- end  -->
          <!-- Singer -->
          <div class="col-2">
          <input type="hidden" name="has_singer" value=0>
          <label>Singer</label>
          <br>
          <button type="button" name="singeradd" class="btn btn-outline-primary btn-sm singeradd">Add singer <i class="fas fa-male"></i></button>
          <table class="table table-sm" id="singer_table">
          @if($modify==1 and $has_singer==1)
            @foreach( $singers as $singer)
            <tr>
                <input type="hidden" name="has_singer" value=1>
                <input type="hidden" name="add_singer" value=0>
                <input type="hidden" name="gcount" value=0>
                <input type="hidden" name="singer_id[]" value="{{ $singer->id }}">
                <td><input class="form-control form-control-sm" name="singer_name[]" type="text" value="{{ old('singer') ? old('singer'): $singer->singer_name }}" required></td>
                <td><small class="text-danger">{{ $errors->first('singer') }}</small></td>
              <tr>

              @endforeach
            @else
            <input type="hidden" name="gcount" value=1>
          @endif
          </table>
          </div>
          <!-- end  -->
          <!-- Sexton -->
          <div class="col-2">
          <input type="hidden" name="has_sexton" value=0>
          <label>Sexton</label>
          <br>
          <button type="button" name="sextonadd" class="btn btn-outline-primary btn-sm sextonadd">Add sexton <i class="fas fa-male"></i></button>
          <table class="table table-sm" id="sexton_table">
          @if($modify==1 and $has_sexton==1)
            @foreach( $sextons as $sexton)
            <tr>
                <input type="hidden" name="has_sexton" value=1>
                <input type="hidden" name="add_sexton" value=0>
                <input type="hidden" name="hcount" value=0>
                <input type="hidden" name="sexton_id[]" value="{{ $sexton->id }}">
                <td><input class="form-control form-control-sm" name="sexton_name[]" type="text" value="{{ old('sexton') ? old('sexton'): $sexton->sexton_name }}" required></td>
                <td><small class="text-danger">{{ $errors->first('sexton') }}</small></td>
              <tr>

              @endforeach
            @else
            <input type="hidden" name="hcount" value=1>
          @endif
          </table>
          </div>
          <!-- end  -->
        </div>
      </div>
      <div class="form-group">
      <label for="pastoral" class="text-primary">Educational category</label>
      <div class="form-row">
        <!-- Javascript -->
        <!-- School -->
        <div class="col-2">
        <input type="hidden" name="has_school" value=0>
        <label>School</label>
        <br>
        <button type="button" name="schooladd" class="btn btn-outline-primary btn-sm schooladd">Add school <i class="fas fa-male"></i></button>
        <table class="table table-sm" id="school_table">
        @if($modify==1 and $has_school==1)
          @foreach( $schools as $school)
          <tr>
              <input type="hidden" name="has_school" value=1>
              <input type="hidden" name="add_school" value=0>
              <input type="hidden" name="icount" value=0>
              <input type="hidden" name="school_id[]" value="{{ $school->id }}">
              <td><input class="form-control form-control-sm" name="school_name[]" type="text" value="{{ old('school') ? old('school'): $school->school_name }}" required></td>
              <td><small class="text-danger">{{ $errors->first('school') }}</small></td>
            <tr>

            @endforeach
          @else
          <input type="hidden" name="icount" value=1>
        @endif
        </table>
        </div>
        <!-- end  -->
        <!-- Teacher -->
        <div class="col-2">
        <input type="hidden" name="has_teacher" value=0>
        <label>Teacher</label>
        <br>
        <button type="button" name="teacheradd" class="btn btn-outline-primary btn-sm teacheradd">Add teacher <i class="fas fa-male"></i></button>
        <table class="table table-sm" id="teacher_table">
        @if($modify==1 and $has_teacher==1)
          @foreach( $teachers as $teacher)
          <tr>
              <input type="hidden" name="has_teacher" value=1>
              <input type="hidden" name="add_teacher" value=0>
              <input type="hidden" name="jcount" value=0>
              <input type="hidden" name="teacher_id[]" value="{{ $teacher->id }}">
              <td><input class="form-control form-control-sm" name="teacher_name[]" type="text" value="{{ old('teacher') ? old('teacher'): $teacher->teacher_name }}" required></td>
              <td><small class="text-danger">{{ $errors->first('teacher') }}</small></td>
            <tr>

            @endforeach
          @else
          <input type="hidden" name="jcount" value=1>
        @endif
        </table>
        </div>
        <!-- end  -->
        <!-- Deacon (School) -->
        <div class="col-2">
        <input type="hidden" name="has_sdeacon" value=0>
        <label>Deacon</label>
        <br>
        <button type="button" name="sdeaconadd" class="btn btn-outline-primary btn-sm sdeaconadd">Add deacon <i class="fas fa-male"></i></button>
        <table class="table table-sm" id="sdeacon_table">
        @if($modify==1 and $has_sdeacon==1)
          @foreach( $sdeacons as $sdeacon)
          <tr>
              <input type="hidden" name="has_sdeacon" value=1>
              <input type="hidden" name="add_sdeacon" value=0>
              <input type="hidden" name="kcount" value=0>
              <input type="hidden" name="sdeacon_id[]" value="{{ $sdeacon->id }}">
              <td><input class="form-control form-control-sm" name="sdeacon_name[]" type="text" value="{{ old('sdeacon') ? old('sdeacon'): $sdeacon->sdeacon_name }}" required></td>
              <td><small class="text-danger">{{ $errors->first('sdeacon') }}</small></td>
            <tr>

            @endforeach
          @else
          <input type="hidden" name="kcount" value=1>
        @endif
        </table>
        </div>
        <!-- end  -->
      </div>
    </div>
    <!-- Illness -->
    <div class="form-group">
    <label for="land" class="text-primary">Illness</label>
      <div class="form-row">
          <div class="col-1">
            <label>Physical</label>
            <input name="physical" class="form-control form-control-sm" type="number" value="{{ old('physical') ? old('physical'): $physical }}" required>
            <small class="text-danger">{{ $errors->first('physical') }}</small>
          </div>
          <div class="col-1">
            <label>Mental</label>
            <input name="mental" class="form-control form-control-sm" type="number" value="{{ old('mental') ? old('mental'): $mental }}" required>
            <small class="text-danger">{{ $errors->first('mental') }}</small>
          </div>
          <div class="col-1">
            <label>Disabilities</label>
            <input name="disabilities" class="form-control form-control-sm" type="number" value="{{ old('disabilities') ? old('disabilities'): $disabilities }}" required>
            <small class="text-danger">{{ $errors->first('disabilities') }}</small>
          </div>
        </div>
      </div>
    <!-- Illness end -->

        <div class="form-group">
        <label for="land" class="text-primary">Land data</label>
          <div class="form-row">
              <div class="col">
                <label>Land</label>
                <input name="land" class="form-control form-control-sm" type="number" value="{{ old('land') ? old('land'): $land }}" required>
                <small class="text-danger">{{ $errors->first('land') }}</small>
              </div>
              <div class="col">
                <label>Wheat</label>
                <input name="wheat" class="form-control form-control-sm" type="number" value="{{ old('wheat') ? old('wheat'): $wheat }}" required>
                <small class="text-danger">{{ $errors->first('wheat') }}</small>
              </div>
              <div class="col">
                <label>Corn</label>
                <input name="corn" class="form-control form-control-sm" type="number" value="{{ old('corn') ? old('corn'): $corn }}" required>
                <small class="text-danger">{{ $errors->first('corn') }}</small>
              </div>
              <div class="col">
                <label>Hay</label>
                <input name="fennel" class="form-control form-control-sm" type="number" value="{{ old('fennel') ? old('fennel'): $fennel }}" required>
                <small class="text-danger">{{ $errors->first('fennel') }}</small>
              </div>
              <div class="col">
                <label>Barley</label>
                <input name="barley" class="form-control form-control-sm" type="number" value="{{ old('barley') ? old('barley'): $barley }}" required>
                <small class="text-danger">{{ $errors->first('barley') }}</small>
              </div>
              <div class="col">
                <label>Oats</label>
                <input name="oats" class="form-control form-control-sm" type="number" value="{{ old('oats') ? old('oats'): $oats }}" required>
                <small class="text-danger">{{ $errors->first('oats') }}</small>
              </div>
              <div class="col">
                <label>Millet</label>
                <input name="millet" class="form-control form-control-sm" type="number" value="{{ old('millet') ? old('millet'): $millet }}" required>
                <small class="text-danger">{{ $errors->first('millet') }}</small>
              </div>
            </div>
            <div class="form-row">
              <div class="col-sm-1 pb-3">
                <label>$Fruittrees</label>
                <input class="form-control form-control-sm" name="fruittrees" type="number" value="{{ old('fruittrees') ? old('fruittrees'): $fruittrees }}">
                <small class="text-danger">{{ $errors->first('fruittrees') }}</small>
              </div>
              <div class="col">
                <label>Plumtrees</label>
                <input name="plumtrees" class="form-control form-control-sm" type="number" value="{{ old('plumtrees') ? old('plumtrees'): $plumtrees }}" required>
                <small class="text-danger">{{ $errors->first('plumtrees') }}</small>
              </div>
              <div class="col">
                <label>Mulberrytrees</label>
                <input name="mulberrytrees" class="form-control form-control-sm" type="number" value="{{ old('mulberrytrees') ? old('mulberrytrees'): $mulberrytrees }}" required>
                <small class="text-danger">{{ $errors->first('mulberrytrees') }}</small>
              </div>
              <div class="col-sm-3 pb-3">
                <label>Vineyard</label>
                <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="vineyardopt" value="Rows" checked>Rows
                </label>
              </div>
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="vineyardopt" value="Acres">Acres
                  <small class="text-danger">{{ $errors->first('vineyardopt') }}</small>
                </label>
              </div>
                <input class="form-control form-control-sm" name="vineyards" type="number" value="{{ old('vineyards') ? old('vineyards'): $vineyards }}">
                <small class="text-danger">{{ $errors->first('vineyards') }}</small>
              </div>
              <div class="col">
                <label>Apples</label>
                <input name="apples" class="form-control form-control-sm" type="number" value="{{ old('apples') ? old('apples'): $apples }}" required>
                <small class="text-danger">{{ $errors->first('apples') }}</small>
              </div>
              <div class="col">
                <label>Pears</label>
                <input name="pears" class="form-control form-control-sm" type="number" value="{{ old('pears') ? old('pears'): $pears }}" required>
                <small class="text-danger">{{ $errors->first('pears') }}</small>
              </div>
              <div class="col">
                <label>Nuts</label>
                <input name="nuts" class="form-control form-control-sm" type="number" value="{{ old('nuts') ? old('nuts'): $nuts }}" required>
                <small class="text-danger">{{ $errors->first('nuts') }}</small>
              </div>
              <div class="col">
                <label>Cherries</label>
                <input name="cherries" class="form-control form-control-sm" type="number" value="{{ old('cherries') ? old('cherries'): $cherries }}" required>
                <small class="text-danger">{{ $errors->first('cherries') }}</small>
              </div>
              <div class="col">
                <label>Sour cherries</label>
                <input name="sourcherries" class="form-control form-control-sm" type="number" value="{{ old('sourcherries') ? old('sourcherries'): $sourcherries }}" required>
                <small class="text-danger">{{ $errors->first('sourcherries') }}</small>
              </div>
            </div>
          </div>
          <div class="form-group">
          <label for="livestock" class="text-primary">Livestock data</label>
          <div class="form-row">
              <div class="col">
                <label>Horses</label>
                <input name="horses" class="form-control form-control-sm" type="number" value="{{ old('horses') ? old('horses'): $horses }}" required>
                <small class="text-danger">{{ $errors->first('horses') }}</small>
              </div>
              <div class="col">
                <label>Oxen</label>
                <input name="bulls" class="form-control form-control-sm" type="number" value="{{ old('bulls') ? old('bulls'): $bulls }}" required>
                <small class="text-danger">{{ $errors->first('bulls') }}</small>
              </div>
              <div class="col">
                <label>Cows</label>
                <input name="cows" class="form-control form-control-sm" type="number" value="{{ old('cows') ? old('cows'): $cows }}" required>
                <small class="text-danger">{{ $errors->first('cows') }}</small>
              </div>
              <div class="col">
                <label>Sheep</label>
                <input name="sheep" class="form-control form-control-sm" type="number" value="{{ old('sheep') ? old('sheep'): $sheep }}" required>
                <small class="text-danger">{{ $errors->first('sheep') }}</small>
              </div>
              <div class="col">
                <label>Goats</label>
                <input name="goats" class="form-control form-control-sm" type="number" value="{{ old('goats') ? old('goats'): $goats }}" required>
                <small class="text-danger">{{ $errors->first('goats') }}</small>
              </div>
              <div class="col">
                <label>Pigs</label>
                <input name="pigs" class="form-control form-control-sm" type="number" value="{{ old('pigs') ? old('pigs'): $pigs }}" required>
                <small class="text-danger">{{ $errors->first('pigs') }}</small>
              </div>
              <div class="col">
                <label>Buffalos</label>
                <input name="buffalos" class="form-control form-control-sm" type="number" value="{{ old('buffalos') ? old('buffalos'): $buffalos }}" required>
                <small class="text-danger">{{ $errors->first('buffalos') }}</small>
              </div>
              <div class="col">
                <label>Donkeys</label>
                <input name="donkeys" class="form-control form-control-sm" type="number" value="{{ old('donkeys') ? old('donkeys'): $donkeys }}" required>
                <small class="text-danger">{{ $errors->first('donkeys') }}</small>
              </div>
              <div class="col">
                <label>Mules</label>
                <input name="mules" class="form-control form-control-sm" type="number" value="{{ old('mules') ? old('mules'): $mules }}" required>
                <small class="text-danger">{{ $errors->first('mules') }}</small>
              </div>
              <div class="col">
                <label>Hives</label>
                <input name="hives" class="form-control form-control-sm" type="number" value="{{ old('hives') ? old('hives'): $hives }}" required>
                <small class="text-danger">{{ $errors->first('hives') }}</small>
              </div>
            </div>
            </div>
            <div class="form-group">
            <label for="Sub" class="text-primary">Belongs to sub-district</label>
            <div class="form-row">
              <div class="col">
                <label>Sub-district</label>
                <select class="form-control form-control-sm" name="village_county_id">
                  @if( $modify==1)
                  <option value="{{ $village_county_id }}">{{ $village_county_name }}</option>
                  @endif
                  @foreach( $counties as $county)
                            <option value="{{ $county->id }}" >{{ $county->county_name }}</option>

                  @endforeach

                            </select>
              </div>


              <div class="col">
                  <br>
                <input value="SAVE" class="btn btn-primary btn-lg" type="submit">
              </div>
            </div>
          </div>
          </form>

          <script>
          $(document).ready(function(){

              $(document).on('click', '.churchadd', function(){
                var html = '';
                html += '<tr>';
                html += '<input type="hidden" name="has_church" value=1>';
                html += '<input type="hidden" name="add_church" value=1>';
                html += '<td><input type="text" name="church_name[]" class="form-control form-control-sm" placeholder="Church Name" required></td>';
                html += '<td><button type="button" name="churchremove" class="btn btn-outline-danger btn-sm churchremove"><i class="fas fa-church"></i><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
                $('#church_table').append(html);
                });

                $(document).on('click', '.churchremove', function(){
                 $(this).closest('tr').remove();
                 });

                 $(document).on('click', '.priestadd', function(){
                   var html = '';
                   html += '<tr>';
                   html += '<input type="hidden" name="has_priest" value=1>';
                   html += '<input type="hidden" name="add_priest" value=1>';
                   html += '<td><input type="text" name="priest_name[]" class="form-control form-control-sm" placeholder="priest Name" required></td>';
                   html += '<td><button type="button" name="priestremove" class="btn btn-outline-danger btn-sm priestremove"><i class="fas fa-male"></i></i><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
                   $('#priest_table').append(html);
                   });

                   $(document).on('click', '.priestremove', function(){
                    $(this).closest('tr').remove();
                    });

                    $(document).on('click', '.deaconadd', function(){
                      var html = '';
                      html += '<tr>';
                      html += '<input type="hidden" name="has_deacon" value=1>';
                      html += '<input type="hidden" name="add_deacon" value=1>';
                      html += '<td><input type="text" name="deacon_name[]" class="form-control form-control-sm" placeholder="deacon Name" required></td>';
                      html += '<td><button type="button" name="deaconremove" class="btn btn-outline-danger btn-sm deaconremove"><i class="fas fa-male"></i></i><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
                      $('#deacon_table').append(html);
                      });

                      $(document).on('click', '.singerremove', function(){
                       $(this).closest('tr').remove();
                       });
                       $(document).on('click', '.singeradd', function(){
                         var html = '';
                         html += '<tr>';
                         html += '<input type="hidden" name="has_singer" value=1>';
                         html += '<input type="hidden" name="add_singer" value=1>';
                         html += '<td><input type="text" name="singer_name[]" class="form-control form-control-sm" placeholder="singer Name" required></td>';
                         html += '<td><button type="button" name="singerremove" class="btn btn-outline-danger btn-sm singerremove"><i class="fas fa-male"></i></i><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
                         $('#singer_table').append(html);
                         });

                         $(document).on('click', '.singerremove', function(){
                          $(this).closest('tr').remove();
                          });
                          $(document).on('click', '.singerremove', function(){
                           $(this).closest('tr').remove();
                           });
                           $(document).on('click', '.sextonadd', function(){
                             var html = '';
                             html += '<tr>';
                             html += '<input type="hidden" name="has_sexton" value=1>';
                             html += '<input type="hidden" name="add_sexton" value=1>';
                             html += '<td><input type="text" name="sexton_name[]" class="form-control form-control-sm" placeholder="sexton Name" required></td>';
                             html += '<td><button type="button" name="sextonremove" class="btn btn-outline-danger btn-sm sextonremove"><i class="fas fa-male"></i></i><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
                             $('#sexton_table').append(html);
                             });

                             $(document).on('click', '.sextonremove', function(){
                              $(this).closest('tr').remove();
                              });
                              $(document).on('click', '.schooladd', function(){
                                var html = '';
                                html += '<tr>';
                                html += '<input type="hidden" name="has_school" value=1>';
                                html += '<input type="hidden" name="add_school" value=1>';
                                html += '<td><input type="text" name="school_name[]" class="form-control form-control-sm" placeholder="School Name" required></td>';
                                html += '<td><button type="button" name="schoolremove" class="btn btn-outline-danger btn-sm schoolremove"><i class="fas fa-male"></i></i><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
                                $('#school_table').append(html);
                                });

                                $(document).on('click', '.schoolremove', function(){
                                 $(this).closest('tr').remove();
                                 });
                                 $(document).on('click', '.teacheradd', function(){
                                   var html = '';
                                   html += '<tr>';
                                   html += '<input type="hidden" name="has_teacher" value=1>';
                                   html += '<input type="hidden" name="add_teacher" value=1>';
                                   html += '<td><input type="text" name="teacher_name[]" class="form-control form-control-sm" placeholder="teacher Name" required></td>';
                                   html += '<td><button type="button" name="teacherremove" class="btn btn-outline-danger btn-sm teacherremove"><i class="fas fa-male"></i></i><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
                                   $('#teacher_table').append(html);
                                   });

                                   $(document).on('click', '.teacherremove', function(){
                                    $(this).closest('tr').remove();
                                    });
                                    $(document).on('click', '.sdeaconadd', function(){
                                      var html = '';
                                      html += '<tr>';
                                      html += '<input type="hidden" name="has_sdeacon" value=1>';
                                      html += '<input type="hidden" name="add_sdeacon" value=1>';
                                      html += '<td><input type="text" name="sdeacon_name[]" class="form-control form-control-sm" placeholder="sdeacon Name" required></td>';
                                      html += '<td><button type="button" name="sdeaconremove" class="btn btn-outline-danger btn-sm sdeaconremove"><i class="fas fa-male"></i></i><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
                                      $('#sdeacon_table').append(html);
                                      });

                                      $(document).on('click', '.sdeaconremove', function(){
                                       $(this).closest('tr').remove();
                                       });


              });
              </script>
@endsection
