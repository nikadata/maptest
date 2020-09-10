@extends('layouts.master')

@section('content')
<div class="form-row">
      <div class="col">
        <h4>{{ $modify == 1 ? 'Modify Household' : 'New Household' }}</h4>
      </div>
    </div>
      <form action="{{ $modify == 1 ? route('update_household', ['household_id'=> $household_id ]) : route('create_household') }}" method="post">
          {{ csrf_field() }}
        <!-- First row -->
        <div class="form-group">
          <label for="household" class="text-primary">Household data</label>

        <div class="form-row">
          <div class="col-1">
            <label><strong>House Nr.</strong></label>
            <input class="form-control form-control-sm" type="text" name="number" value="{{ old('number') ? old('number'): $number }}">
            <small class="text-danger">{{ $errors->first('number') }}</small>
          </div>
          @if( $modify == 1)
          <div class="col-1">
            <span class="border border-success">
            <label>Db id:</label>
            {{ $household_id }}</span>
          </div>
          @endif
        </div>
        <div class="form-row">
            <div class="col-5">
            <label>Head of Household</label>
            <input class="form-control form-control-sm" name="name" type="text" value="{{ old('name') ? old('name'): $name }}">
            <div class="text-danger">{{ $errors->first('name') }}</div>
            </div>
            <div class="col-2">
            <label>Name</label>
            <input class="form-control form-control-sm" name="fname" type="text" value="{{ old('fname') ? old('fname'): $fname }}">
            <div class="text-danger">{{ $errors->first('fname') }}</div>
            </div>
            <div class="col-2">
            <label>Surname</label>
            <input class="form-control form-control-sm" name="surname" type="text" value="{{ old('surname') ? old('surname'): $surname }}">
            <div class="text-danger">{{ $errors->first('surname') }}</div>
            </div>
            <div class="col-2">
            <label>Nickname</label>
            <input class="form-control form-control-sm" name="nickname" type="text" value="{{ old('nickname') ? old('nickname'): $nickname }}">
            <div class="text-danger">{{ $errors->first('nickname') }}</div>
            </div>
            <div class="col">
            <label>Gender</label>
            <select class="form-control form-control-sm" name="gen">
              @if( $modify==1)
              <option value="{{ $gen }}">{{ $gen }}</option>
              @endif
              @foreach( $genders as $gender)
                <option value="{{ $gender }}" >{{ $gender }}</option>
              @endforeach
            </select>
            </div>
            <!-- Linear appelations -->
            <div class="col-2">
            <label>Family related name</label>
            <select class="form-control form-control-sm" name="family">
              @if( $modify==1)
              <option value="{{ $family }}">{{ $family }}</option>
              @endif
              @foreach( $familys as $family)
                <option value="{{ $family }}" >{{ $family }}</option>
              @endforeach
            </select>
            </div>
            <!-- end linear appelations -->
            <div class="col-1">
            <label>Age</label>
            <input class="form-control form-control-sm" name="age" type="number" value="{{ old('age') ? old('age'): $age }}">
            <small class="text-danger">{{ $errors->first('age') }}</small>
            </div>
            <div class="col-3">
            <label>Nationality</label>
            <select class="form-control form-control-sm" name="nationality">
              @if( $modify==1)
              <option value="{{ $nationality }}">{{ $nationality }}</option>
              @endif
              @foreach( $nations as $nation)
                <option value="{{ $nation }}" >{{ $nation }}</option>
              @endforeach
            </select>
            </div>
          </div>
      </div>
            <!--Second row -->
            <div class="form-row">

            <div class="col-2">
            <label>Civilstatus</label>
            <select class="form-control form-control-sm" name="civilstatus" id="civilstatus" required>
              @if( $modify==1)
              <option value="{{ $civilstatus }}">{{ $civilstatus }}</option>
              @else
              <option value="" selected disabled hidden>Choose here</option>
              @endif
              @foreach( $titles as $title)
                <option value="{{ $title }}" >{{ $title }}</option>
              @endforeach
            </select>
            <small class="text-danger">{{ $errors->first('civilstatus') }}</small>
            </div>
            <!-- Wife -->
            @if($civstatus==1 && $wife==1)
                <div class="col-2">
                  <label>Wife/Partner's name</label>
                    @foreach( $wifes as $wife)
                  <input type="hidden" name="wife" value=1>
                  <input type="hidden" name="add_wife" value=0>
                  <input type="hidden" name="wife_id" value="{{ $wife->id }}">
                  <input class="form-control form-control-sm" name="wife_name" type="text" value="{{ old('wife_name') ? old('wife_name'): $wife->wife_name }}" required>
                  <small class="text-danger">{{ $errors->first('wife_name') }}</small>
                </div>
                <!-- Wifes gender -->
                <div class="col-2">
                  <label>Wife's gender</label>
                  <select class="form-control form-control-sm" name="wife_gender">
                    @if( $modify==1)
                      <option value="{{ $wife->wife_gender }}">{{ $wife->wife_gender }}</option>
                    @endif
                    @foreach( $genders as $gender)
                      <option value="{{ $gender }}" >{{ $gender }}</option>
                    @endforeach
                  </select>
                </div>

            <!-- End Wifes gender -->
                <div class="col-1">
                <label>Wife's age</label>
                <input class="form-control form-control-sm" name="wife_age" type="number" value="{{ old('wife_age') ? old('wife_age'): $wife->wife_age }}" required>
                <small class="text-danger">{{ $errors->first('wife_age') }}</small>
                </div>
                <!-- Wife nationality -->
                <div class="col-2">
                  <label>Wife's nationality</label>
                  <select class="form-control form-control-sm" name="wife_nation">
                    @if( $modify==1)
                      <option value="{{ $wife->wife_nation }}">{{ $wife->wife_nation }}</option>
                    @endif
                    @foreach( $nations as $nation)
                      <option value="{{ $nation }}" >{{ $nation }}</option>
                    @endforeach
                  </select>
                </div>
                <!-- end wife nationality -->
                @endforeach

              @else
                <div class="col" >
                <label>Wife</label>
                <br>
                <button type="button" name="wifeadd" class="btn btn-outline-primary btn-sm wifeadd">Add Wife <i class="fas fa-user-plus"></i></button>
                <table class="table table-sm" id="wife_table">
                </table>
                </div>
            @endif
          </div>
          <div class="form-row">

            <!-- Children -->
            <div class="col" >
              <input type="hidden" name="has_children" value=0>
              <label>Children</label>
                <br>
              <button type="button" name="add" class="btn btn-outline-primary btn-sm add">Add Children <i class="fas fa-user-plus"></i></button>
              <!--  <div class="table"> -->
                 <!--<span id="error"></span>-->
                 <table class="table table-sm" id="item_table">
                  @if ($modify==1 and $has_children==1)

                   <tr>
                    <th scope="row">Child Name</th>
                    <th scope="row">Age</th>
                    <th scope="row">Gender</th>
                    <!--<th scope="row">Living</th>-->
                   </tr>
                    @foreach( $childrens as $children)
                    <input type="hidden" name="has_children" value=1>
                    <input type="hidden" name="add_flag" value=0>
                    <input type="hidden" name="dcount" value=0>
                    <input type="hidden" name="child_id[]" value="{{ $children->id}}">
                    <tr>
                      <td><input type="text" name="child_name[]" value="{{ $children->child_name }}" class="form-control form-control-sm" required></td>
                      <td><input type="number" name="child_age[]" value="{{ $children->child_age }}" class="form-control form-control-sm" required></td>
                      <td><select name="child_gender[]" class="form-control form-control-sm" required><option value="{{ $children->child_gender }}">{{ $children->child_gender }}</option><option value="Male">Male</option><option value="Female">Female</option></select></td>
                    <!--  <td><select name="child_place[]" class="form-control form-control-sm" required><option value="{{ $children->child_place }}">{{ $children->child_place }}</option><option value="inhousehold">inhousehold</option><option value="outhousehold">other household</option></select></td>
                    -->
                    </tr>
                    @endforeach
                  @else
                    <input type="hidden" name="dcount" value=1>
                  @endif
                 </table>
                <!--</div>-->
             </div>
          </div>
          <!-- Co-residents -->
          <div class="form-row">
            <div class="col-3">
            <label>Extended family</label>
              <select class="form-control form-control-sm extended" name="extended">
              @if( $modify==1)
              <option value="{{ $extended_id }}">{{ $extended->type }}</option>
              @endif
              @foreach( $extendeds as $extended)
                <option value="{{ $extended->id }}" >{{ $extended->type }}</option>
              @endforeach
            </select>
            </div>
          </div>
            <div class="form-row">
            <div class="col-12" >
              <input type="hidden" name="has_coresident" value=0>
              <label>Co-residents</label>
              <!-- For button -->
              <table class="table table-sm" id="extended_table">
              </table>
              <!--For co-resident form-->
               <table class="table table-sm" id="resident_table">

              @if ($modify==1 and $coresident==1)
                <p id="has_resident">Resident</p>
                <tr>
                 <td scope="row">Resident category</td>
                 <td scope="row">Resident Name</td>
                 <td scope="row">Resident Gender</td>
                 <td scope="row">Age</td>
                 <td scope="row">Civilstatus</td>
                 <td scope="row">Nationality</td>
                 <td scope="row">Class</td>
                 <td scope="row">Job</td>
                 <td scope="row">Second Job</td>
                 <td scope="row">Fiscal</td>
                 <td scope="row">Illness</td>
                </tr>
                 @foreach( $coresidents as $resident)
                 <input type="hidden" name="has_resident" value=1>
                 <input type="hidden" name="add_resident" value=0>
                 <input type="hidden" name="residentcount" value=0>
                 <input type="hidden" name="resident_id[]" value="{{ $resident->id}}">
                 <tr><td>
                   <select name="resident_cat[]" class="form-control form-control-sm" required><option value="{{ $resident->resident_cat }}">{{ $resident->resident_cat }}</option><option value="Aunt">Aunt</option><option value="Brother-in-law">Brother-in-law</option><option value="Child">Child</option><option value="Cousin">Cousin</option><option value="Daughter-in-law">Daughter-in-law</option><option value="Grandparent">Grandparent</option>
                     <option value="Grandson">Grandson</option><option value="Greatgrandparent">Greatgrandparent</option><option value="Nephew">Nephew</option><option value="Parent">Parent</option><option value="Parent-in-law">Parent-in-law</option><option value="Servant">Servant</option><option value="Sibling">Sibling</option>
                     <option value="Sister-in-law">Sister-in-law</option><option value="Son-in-law">Son-in-law</option><option value="Uncle">Uncle</option><option value="Non-relative">Non-relative</option>
                   </select>
                 </td>
                   <td><input type="text" name="resident_name[]" value="{{ $resident->resident_name }}" class="form-control form-control-sm" required></td>
                   <td><select name="resident_gender[]" class="form-control form-control-sm" required><option value="{{ $resident->resident_gender }}">{{ $resident->resident_gender }}</option><option value="Male">Male</option><option value="Female">Female</option></select> </td>
                   <td><input type="number" name="resident_age[]" value="{{ $resident->resident_age }}" class="form-control form-control-sm" required></td>
                   <!-- -->
                   <td><select name="resident_civil[]" class="form-control form-control-sm" required><option value="{{ $resident->resident_civil }}">{{ $resident->resident_civil }}</option><option value="Bachelor">Bachelor</option><option value="Co-habiting">Co-habiting</option><option value="Divorced">Divorced</option><option value="Married">Married</option><option value="Mixed marriages">Mixed marriages</option><option value="Single">Single</option>
                     <option value="Widow">Widow</option>
                     </td>
                   <!-- -->
                   <td><select name="resident_nation[]" class="form-control form-control-sm" required><option value="{{ $resident->resident_nation }}">{{ $resident->resident_nation }}</option><option value="Țigan">Țigan</option><option value="Rudar">Rudar</option><option value="Russian">Russian</option><option value="Romanian">Romanian</option><option value="Jewish">Jewish</option>
                     <option value="Serbian">Serbian</option><option value="Țigan Ungurean">Țigan Ungurean</option><option value="Albanez/Arnăuțean">Albanez/Arnăuțean</option><option value="Bulgarian">Bulgarian</option>
                   <option value="Căldărar">Căldărar</option><option value="Ciurar">Ciurar</option><option value="Fierar">Fierar</option><option value="Greek">Greek</option><option value="Inar">Inar</option><option value="Hungarian">Hungarian</option><option value="Lăieș/Lăieț">Lăieș/Lăieț</option>
                   <option value="Moldovean">Moldovean</option>
                   <option value="Netot">Netot</option><option value="Oltean">Oltean</option>
                   <option value="Ungurean">Ungurean</option><option value="Ursar">Ursar</option><option value="Vătraş">Vătraş</option><option value="Zavragiu">Zavragiu</option><option value="Zlătar">Zlătar</option></select>
                 </td>
                 <td>
                   <select name="resident_class[]" class="form-control form-control-sm" required><option value="{{$resident->resident_class}}">{{$resident->resident_class}}</option><option value="Arendaș">Arendaș</option><option value="Aurar">Aurar</option><option value="Clăcaș">Clăcaș</option><option value="Craftsman">Craftsman</option><option value="Domestic/servant">Domestic/servant</option>
                     <option value="Estate administrator">Estate administrator</option><option value="Exempted">Exempted</option><option value="Landowner">Landowner</option><option value="Not specified">Not specified</option><option value="Not yet included">Not yet included</option><option value="Tenant">Tenant</option>
                   </select>
                 </td>
                   <td>
                     <select name="resident_job[]" class="form-control form-control-sm" required><option value="{{$resident->resident_job}}">{{$resident->resident_job}}</option><option value="Achari">Achari</option><option value="Arendaș">Arendaș</option><option value="Bag maker">Bag maker</option><option value="Baker">Baker</option><option value="Barber">Barber</option>
                       <option value="Bear tamer">Bear tamer</option><option value="Blacksmith">Blacksmith</option><option value="Bootmaker">Bootmaker</option><option value="Bricklayer">Bricklayer</option><option value="Brickmaker">Brickmaker</option><option value="Buffalo caretaker">Buffalo caretaker</option><option value="Căldărar">Căldărar</option>
                       <option value="Carpenter">Carpenter</option><option value="Cartman">Cartman</option><option value="Cattle seller">Cattle seller</option>
                       <option value="Church singer">Church singer</option><option value="Coachman">Coachman</option><option value="Cobza player">Cobza player</option>
                   <option value="Comb maker">Comb maker</option><option value="Cook">Cook</option><option value="Cowherd">Cowherd</option><option value="Daily laborer">Daily laborer</option><option value="Domestic/servant">Domestic/servant</option><option value="Drum player">Drum player</option><option value="Estate caretaker">Estate caretaker</option>
                   <option value="Farmer">Farmer</option><option value="Farrier">Farrier</option><option value="Forester">Forester</option><option value="Gold panner">Gold panner</option>
                   <option value="Grocer">Grocer</option><option value="Innkeeper">Innkeeper</option><option value="Innkeeper and grocer">Innkeeper and grocer</option><option value="Ispravnic">Ispravnic</option><option value="Knife maker">Knife maker</option><option value="Landowner">Landowner</option><option value="Landrywoman">Landrywoman</option>
                   <option value="Lăutar">Lăutar</option><option value="Lock maker">Lock maker</option><option value="Logofețel">Logofețel</option><option value="Merchant">Merchant</option>
                   <option value="Miller">Miller</option><option value="None">None</option><option value="Nurse">Nurse</option><option value="Official">Official</option><option value="Ploughman">Ploughman</option><option value="Priest">Priest</option><option value="Producer of brandy">Producer of brandy</option>
                   <option value="Quilt maker">Quilt maker</option><option value="Rudar">Rudar</option><option value="Schoolmaster">Schoolmaster</option><option value="Sexton">Sexton</option><option value="Shepard">Shepard</option><option value="Shoemaker">Shoemaker</option><option value="Sieve maker">Sieve maker</option><option value="Soap maker">Soap maker</option>
                   <option value="Spader">Spader</option><option value="Spinner">Spinner</option><option value="Spoon maker">Spoon maker</option><option value="Strainer maker">Strainer maker</option><option value="Stufegiu">Stufegiu</option><option value="Swine herd">Swine herd</option><option value="Tailor">Tailor</option><option value="Tinsmith">Tinsmith</option>
                   <option value="Vădrar">Vădrar</option><option value="Vătaf">Vătaf</option><option value="Violin player">Violin player</option><option value="Weaver">Weaver</option><option value="Weigher">Weigher</option><option value="Wheelwright">Wheelwright</option><option value="Woolcard worker">Woolcard worker</option>
                   <option value="Zlătar">Zlătar</option></select></td>
                   <td>
                     <select name="resident_second_job[]" class="form-control form-control-sm" required><option value="{{$resident->resident_second_job}}">{{$resident->resident_second_job}}</option><option value="Achari">Achari</option><option value="Arendaș">Arendaș</option><option value="Bag maker">Bag maker</option><option value="Baker">Baker</option><option value="Barber">Barber</option>
                       <option value="Bear tamer">Bear tamer</option><option value="Blacksmith">Blacksmith</option><option value="Bootmaker">Bootmaker</option><option value="Bricklayer">Bricklayer</option><option value="Brickmaker">Brickmaker</option><option value="Buffalo caretaker">Buffalo caretaker</option><option value="Căldărar">Căldărar</option>
                       <option value="Carpenter">Carpenter</option><option value="Cartman">Cartman</option><option value="Cattle seller">Cattle seller</option>
                       <option value="Church singer">Church singer</option><option value="Coachman">Coachman</option><option value="Cobza player">Cobza player</option>
                   <option value="Comb maker">Comb maker</option><option value="Cook">Cook</option><option value="Cowherd">Cowherd</option><option value="Daily laborer">Daily laborer</option><option value="Domestic/servant">Domestic/servant</option><option value="Drum player">Drum player</option><option value="Estate caretaker">Estate caretaker</option>
                   <option value="Farmer">Farmer</option><option value="Farrier">Farrier</option><option value="Forester">Forester</option><option value="Gold panner">Gold panner</option>
                   <option value="Grocer">Grocer</option><option value="Innkeeper">Innkeeper</option><option value="Innkeeper and grocer">Innkeeper and grocer</option><option value="Ispravnic">Ispravnic</option><option value="Knife maker">Knife maker</option><option value="Landowner">Landowner</option><option value="Landrywoman">Landrywoman</option>
                   <option value="Lăutar">Lăutar</option><option value="Lock maker">Lock maker</option><option value="Logofețel">Logofețel</option><option value="Merchant">Merchant</option>
                   <option value="Miller">Miller</option><option value="None">None</option><option value="Nurse">Nurse</option><option value="Official">Official</option><option value="Ploughman">Ploughman</option><option value="Priest">Priest</option><option value="Producer of brandy">Producer of brandy</option>
                   <option value="Quilt maker">Quilt maker</option><option value="Rudar">Rudar</option><option value="Schoolmaster">Schoolmaster</option><option value="Sexton">Sexton</option><option value="Shoemaker">Shoemaker</option><option value="Sieve maker">Sieve maker</option><option value="Soap maker">Soap maker</option>
                   <option value="Spader">Spader</option><option value="Spinner">Spinner</option><option value="Spoon maker">Spoon maker</option><option value="Strainer maker">Strainer maker</option><option value="Swine herd">Swine herd</option><option value="Tailor">Tailor</option><option value="Tinsmith">Tinsmith</option>
                   <option value="Vădrar">Vădrar</option><option value="Vătaf">Vătaf</option><option value="Violin player">Violin player</option><option value="Weaver">Weaver</option><option value="Weigher">Weigher</option><option value="Wheelwright">Wheelwright</option><option value="Woolcard worker">Woolcard worker</option>
                   <option value="Zlătar">Zlătar</option></select></td>
                 <!-- -->
                 <td>
                 <select name="resident_fiscal[]" class="form-control form-control-sm" required><option value="{{$resident->resident_fiscal}}">{{$resident->resident_fiscal}}</option><option value="">Fiscal</option><option value="Boyar slave">Boyar slave</option><option value="Exempt from taxes">Exempt from taxes</option><option value="Monastery slave">Monastery slave</option><option value="Not yet included">Not yet included</option><option value="Princely slave">Princely slave</option>
                 <option value="Ransomed by himself">Ransomed by himself</option><option value="Ransomed by the village">Ransomed by the village</option><option value="Tax payer">Tax payer</option></td>
                 <td><select name="resident_illness[]" class="form-control form-control-sm" required><option value="{{ $resident->resident_illness }}">{{ $resident->resident_illness }}</option><option value="None">None</option><option value="Physical illness">Physical</option><option value="Mental illness">Mental</option><option value="Disabilities">Disabilities</option></td>
                 <!-- -->
                 </tr>
                  @if ($coresident_spouse==1)
                    @foreach( $coresident_spouses as $spouse)
                      @if ( $resident->id==$spouse->coresident_id )
                        <tr>
                          <td><strong>Spouse-></strong></td>
                          <input type="hidden" name="resident_has_spouse" value=1>
                          <input type="hidden" name="resident_add_spouse" value=0>
                          <input type="hidden" name="spousecount" value=0>
                          <input type="hidden" name="spouse_id[]" value="{{ $spouse->id}}">
                          <td><input type="text" name="spouse_name[]" class="form-control form-control-sm" placeholder="spouses Name" value="{{ $spouse->spouse_name }}" required></td>
                          <td><select name="spouse_gender[]" class="form-control form-control-sm" required><option value="{{ $spouse->spouse_gender }}">{{ $spouse->spouse_gender }}</option><option value="Male">Male</option><option value="Female">Female</option></select> </td>
                          <td><input type="number" name="spouse_age[]"  class="form-control form-control-sm" placeholder="Age" size="2" value="{{ $spouse->spouse_age }}" required> </td>
                          <td><select name="spouse_nation[]" class="form-control form-control-sm" required><option value="{{ $spouse->spouse_nation }}">{{ $spouse->spouse_nation }}</option><option value="Țigan">Țigan</option><option value="Rudar">Rudar</option><option value="Russian">Russian</option><option value="Romanian">Romanian</option><option value="Jewish">Jewish</option>
                            <option value="Serbian">Serbian</option><option value="Țigan Ungurean">Țigan Ungurean</option><option value="Albanez/Arnăuțean">Albanez/Arnăuțean</option><option value="Bulgarian">Bulgarian</option>
                          <option value="Căldărar">Căldărar</option><option value="Ciurar">Ciurar</option><option value="Fierar">Fierar</option><option value="Greek">Greek</option><option value="Inar">Inar</option><option value="Hungarian">Hungarian</option><option value="Lăieș/Lăieț">Lăieș/Lăieț</option>
                          <option value="Moldovean">Moldovean</option><option value="Netot">Netot</option><option value="None">None</option><option value="Oltean">Oltean</option>
                          <option value="Ungurean">Ungurean</option><option value="Ursar">Ursar</option><option value="Vătraş">Vătraş</option><option value="Zavragiu">Zavragiu</option><option value="Zlătar">Zlătar</option></select> </td>
                          <td><select name="spouse_job[]" class="form-control form-control-sm" required><option value="{{ $spouse->spouse_job }}">{{ $spouse->spouse_job }}</option><option value="Achari">Achari</option><option value="Arendaș">Arendaș</option><option value="Bag maker">Bag maker</option><option value="Baker">Baker</option><option value="Barber">Barber</option>
                            <option value="Bear tamer">Bear tamer</option><option value="Blacksmith">Blacksmith</option><option value="Bootmaker">Bootmaker</option><option value="Bricklayer">Bricklayer</option><option value="Brickmaker">Brickmaker</option><option value="Buffalo caretaker">Buffalo caretaker</option><option value="Căldărar">Căldărar</option>
                            <option value="Carpenter">Carpenter</option><option value="Cartman">Cartman</option><option value="Cattle seller">Cattle seller</option>
                            <option value="Church singer">Church singer</option><option value="Coachman">Coachman</option><option value="Cobza player">Cobza player</option>
                        <option value="Comb maker">Comb maker</option><option value="Cook">Cook</option><option value="Cowherd">Cowherd</option><option value="Daily laborer">Daily laborer</option><option value="Domestic/servant">Domestic/servant</option><option value="Drum player">Drum player</option><option value="Estate caretaker">Estate caretaker</option>
                        <option value="Farmer">Farmer</option><option value="Farrier">Farrier</option><option value="Forester">Forester</option><option value="Gold panner">Gold panner</option>
                        <option value="Grocer">Grocer</option><option value="Innkeeper">Innkeeper</option><option value="Innkeeper and grocer">Innkeeper and grocer</option><option value="Ispravnic">Ispravnic</option><option value="Knife maker">Knife maker</option><option value="Landowner">Landowner</option><option value="Landrywoman">Landrywoman</option>
                        <option value="Lăutar">Lăutar</option><option value="Lock maker">Lock maker</option><option value="Logofețel">Logofețel</option><option value="Merchant">Merchant</option>
                        <option value="Miller">Miller</option><option value="None">None</option><option value="Nurse">Nurse</option><option value="Official">Official</option><option value="Ploughman">Ploughman</option><option value="Priest">Priest</option><option value="Producer of brandy">Producer of brandy</option>
                        <option value="Quilt maker">Quilt maker</option><option value="Rudar">Rudar</option><option value="Schoolmaster">Schoolmaster</option><option value="Sexton">Sexton</option><option value="Shepard">Shepard</option><option value="Shoemaker">Shoemaker</option><option value="Sieve maker">Sieve maker</option><option value="Soap maker">Soap maker</option>
                        <option value="Spader">Spader</option><option value="Spinner">Spinner</option><option value="Spoon maker">Spoon maker</option><option value="Strainer maker">Strainer maker</option><option value="Swine herd">Swine herd</option><option value="Tailor">Tailor</option><option value="Tinsmith">Tinsmith</option>
                        <option value="Vădrar">Vădrar</option><option value="Vătaf">Vătaf</option><option value="Violin player">Violin player</option><option value="Weaver">Weaver</option><option value="Weigher">Weigher</option><option value="Wheelwright">Wheelwright</option><option value="Woolcard worker">Woolcard worker</option>
                        <option value="Zlătar">Zlătar</option></select></td>
                          <td><select name="spouse_illness[]" class="form-control form-control-sm" required><option value="{{ $spouse->spouse_illness }}">{{ $spouse->spouse_illness }}</option><option value="None">None</option><option value="Physical illness">Physical</option><option value="Mental illness">Mental</option><option value="Disabilities">Disabilities</option></td>
                        </tr>
                        @endif
                      @endforeach
                  @else
                      <input type="hidden" name="spousecount" value=1>
                  @endif

                  <!-- Coresident children -->
                  @if ($coresident_child==1)
                    @foreach( $coresident_children as $residentchild)
                      @if ( $resident->id==$residentchild->coresident_id )
                        <tr>
                          <td><strong>Child-></strong></td>
                          <input type="hidden" name="resident_has_child" value=1>
                          <input type="hidden" name="resident_add_child" value=0>
                          <input type="hidden" name="childcount" value=0>
                          <input type="hidden" name="resident_child_id[]" value="{{ $residentchild->id}}">
                          <td><input type="text" name="resident_child_name[]" class="form-control form-control-sm" placeholder="Childs Name" value="{{ $residentchild->child_name }}" required></td>
                          <td><select name="resident_child_gender[]" class="form-control form-control-sm" required><option value="{{ $residentchild->child_gender }}">{{ $residentchild->child_gender }}</option><option value="Male">Male</option><option value="Female">Female</option></select> </td>
                          <td><input type="number" name="resident_child_age[]"  class="form-control form-control-sm" placeholder="Age" size="2" value="{{ $residentchild->child_age }}" required> </td>
                          <td><select name="resident_child_nation[]" class="form-control form-control-sm" required><option value="{{ $residentchild->child_nation }}">{{ $residentchild->child_nation }}</option><option value="Țigan">Țigan</option><option value="Rudar">Rudar</option><option value="Russian">Russian</option><option value="Romanian">Romanian</option><option value="Jewish">Jewish</option>
                            <option value="Serbian">Serbian</option><option value="Țigan Ungurean">Țigan Ungurean</option><option value="Albanez/Arnăuțean">Albanez/Arnăuțean</option><option value="Bulgarian">Bulgarian</option>
                          <option value="Căldărar">Căldărar</option><option value="Ciurar">Ciurar</option><option value="Fierar">Fierar</option><option value="Greek">Greek</option><option value="Inar">Inar</option><option value="Hungarian">Hungarian</option><option value="Lăieș/Lăieț">Lăieș/Lăieț</option>
                          <option value="Moldovean">Moldovean</option><option value="Netot">Netot</option><option value="None">None</option><option value="Oltean">Oltean</option>
                          <option value="Ungurean">Ungurean</option><option value="Ursar">Ursar</option><option value="Vătraş">Vătraş</option><option value="Zavragiu">Zavragiu</option><option value="Zlătar">Zlătar</option></select> </td>
                          <td><select name="resident_child_illness[]" class="form-control form-control-sm" required><option value="{{ $residentchild->child_illness }}">{{ $residentchild->child_illness }}</option><option value="None">None</option><option value="Physical illness">Physical</option><option value="Mental illness">Mental</option><option value="Disabilities">Disabilities</option></td>
                        </tr>
                        @endif
                      @endforeach
                  @endif
                  <!-- end -->
                 @endforeach
                 <tr><td>
                 <button type="button" name="resident" class="btn btn-outline-primary btn-sm resident">Add Co-resident<i class="fas fa-user-plus"></i></button>
               </td></tr>
              @else
                <p id="has_not"><strong>No co-residents registered</strong></p>
                <input type="hidden" name="residentcount" value=1>
                <input type="hidden" name="spousecount" value=1>
                <input type="hidden" name="childcount" value=1>
              @endif

            </table>

         </div>
       </div>
       <!-- End co-residents -->
          <!-- Third row -->
          <div class="form-group">
            <label for="household" class="text-primary">Fiscal category</label>
          <div class="form-row">
            <div class="col">
            <label>Fiscal</label>
            <select class="form-control form-control-sm" name="fiscal">
              @if( $modify==1)
              <option value="{{ $fiscal }}">{{ $fiscal }}</option>
              @endif
              @foreach( $fiscalvalues as $fiscalvalue)
                <option value="{{ $fiscalvalue }}" >{{ $fiscalvalue }}</option>
              @endforeach
            </select>
            </div>
            <div class="col-sm-3 pb-3">
              <label>Fiscal comment</label>
              <input class="form-control form-control-sm" name="fiscalcomment" type="text" value="{{ old('fiscalcomment') ? old('fiscalcomment'): $fiscalcomment }}">
              <small class="text-danger">{{ $errors->first('fiscalcomment') }}</small>
            </div>
            <div class="col">
            <label>Belongs to Village</label>
            <select class="form-control form-control-sm" name="village">
              @if( $modify==1)
              <option value="{{ $village_id }}">{{ $village->village_name }}</option>
              @endif
              @foreach( $villages as $village)
                <option value="{{ $village->id }}" >{{ $village->village_name }}</option>
              @endforeach
            </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="household" class="text-primary">Social category</label>
        <div class="form-row">
            <div class="col-3">
            <label>Social Class</label>
            <select class="form-control form-control-sm" name="socialclass">
              @if( $modify==1)
              <option value="{{ $social_id }}">{{ $social->social_name }}</option>
              @endif
              @foreach( $socials as $social)
              <option value="{{ $social->id }}" >{{ $social->social_name }}</option>
              @endforeach
            </select>
          </div>
            <div class="col-2">
            <label>Job</label>
            <select class="form-control form-control-sm" name="skill" id="skill_one">
              @if( $modify==1)
              <option value="{{ $skill_id }}">{{ $skill->skill_name }}</option>
              @endif
              <option value=18 >None</option>
              @foreach( $skills as $skill)
              <option value="{{ $skill->id }}" >{{ $skill->skill_name }}</option>
              @endforeach
            </select>
            </div>
            <!-- Second skill/job-->
            <div class="col-2">
            <label>Second Job</label>
            <select class="form-control form-control-sm" name="second_skill" id="skill_two">
              @if( $modify==1)
              <option value="{{ $second_skill_id }}">{{ $second_skill->skill_name }}</option>
              @endif
              <option value=18 >None</option>
              @foreach( $skills as $skill)
              <option value="{{ $skill->id }}" >{{ $skill->skill_name }}</option>
              @endforeach
            </select>
            </div>
            <!-- -->
            <div class="col-1">
              <label>Servant</label>
              <select class="form-control form-control-sm" name="servant">
                @if( $modify==1)
                <option value="{{ $servant }}">{{ $servant }}</option>
                @endif
                  <option value="no">No</option>
                  <option value="yes">Yes</option>
              </select>

            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="Illness" class="text-primary">Illness</label>
        <div class="form-row">
          <div class="col-2">
          <label>Illness</label>
          <select class="form-control form-control-sm" name="ill">
            @if( $modify==1)
            <option value="{{ $ill }}">{{ $ill }}</option>
            @endif
            @foreach( $illnes as $illne)
              <option value="{{ $illne }}" >{{ $illne }}</option>
            @endforeach
          </select>
          </div>
          <div class="col-sm-2 pb-3">
            <label>Diagnosis(formal)</label>
            <input class="form-control form-control-sm" name="diagnosis" type="text" value="{{ old('diagnosis') ? old('diagnosis'): $diagnosis }}">
            <small class="text-danger">{{ $errors->first('diagnosis') }}</small>
          </div>
          <div class="col-sm-2 pb-3">
            <label>Diagnosis(informal)</label>
            <input class="form-control form-control-sm" name="inf_diagnosis" type="text" value="{{ old('inf_diagnosis') ? old('inf_diagnosis'): $inf_diagnosis }}">
            <small class="text-danger">{{ $errors->first('inf_diagnosis') }}</small>
          </div>
        </div>
      </div>
          <!-- Fift row -->
          <div class="form-group">
            <label for="household" class="text-primary">Land data</label>
          <div class="form-row">
            <div class="col-sm-1 pb-3">
              <label>Land acres</label>
              <input class="form-control form-control-sm" name="clandn" type="number" value="{{ old('clandn') ? old('clandn'): $clandn }}">
              <small class="text-danger">{{ $errors->first('clandn') }}</small>
            </div>
            <div class="col-sm-1 pb-3">
              <label>Wheat</label>
              <input class="form-control form-control-sm" name="wheat" type="number" value="{{ old('wheat') ? old('wheat'): $wheat }}">
              <small class="text-danger">{{ $errors->first('wheat') }}</small>
            </div>
            <div class="col-sm-1 pb-3">
              <label>Corn</label>
              <input class="form-control form-control-sm" name="corn" type="number" value="{{ old('corn') ? old('corn'): $corn }}">
              <small class="text-danger">{{ $errors->first('corn') }}</small>
            </div>
            <div class="col-sm-1 pb-3">
              <label>Hay</label>
              <input class="form-control form-control-sm" name="fennel" type="number" value="{{ old('fennel') ? old('fennel'): $fennel }}">
              <small class="text-danger">{{ $errors->first('fennel') }}</small>
            </div>
            <div class="col-sm-1 pb-3">
              <label>Barley</label>
              <input class="form-control form-control-sm" name="barley" type="number" value="{{ old('barley') ? old('barley'): $barley }}">
              <small class="text-danger">{{ $errors->first('barley') }}</small>
            </div>
            <div class="col-sm-1 pb-3">
              <label>Oats</label>
              <input class="form-control form-control-sm" name="oats" type="number" value="{{ old('oats') ? old('oats'): $oats }}">
              <small class="text-danger">{{ $errors->first('oats') }}</small>
            </div>
            <div class="col-sm-1 pb-3">
              <label>Millet</label>
              <input class="form-control form-control-sm" name="millet" type="number" value="{{ old('millet') ? old('millet'): $millet }}">
              <small class="text-danger">{{ $errors->first('millet') }}</small>
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
              </label>
            </div>
              <input class="form-control form-control-sm" name="vineyards" type="number" value="{{ old('vineyards') ? old('vineyards'): $vineyards }}">
              <small class="text-danger">{{ $errors->first('vineyards') }}</small>
            </div>
          </div>
            <!-- Fift row -->
            <div class="form-row">
              <div class="col-sm-1 pb-3">
                <label>$Fruittrees</label>
                <input class="form-control form-control-sm" name="fruittrees" type="number" value="{{ old('fruittrees') ? old('fruittrees'): $fruittrees }}">
                <small class="text-danger">{{ $errors->first('fruittrees') }}</small>
              </div>
            <div class="col-sm-1 pb-3">
              <label>Plums</label>
              <input class="form-control form-control-sm" name="plumtrees" type="number" value="{{ old('plumtrees') ? old('plumtrees'): $plumtrees }}">
              <small class="text-danger">{{ $errors->first('plumtrees') }}</small>
            </div>
            <div class="col-sm-1 pb-3">
              <label>Mulberries</label>
              <input class="form-control form-control-sm" name="mulberrytrees" type="number" value="{{ old('mulberrytrees') ? old('mulberrytrees'): $mulberrytrees }}">
              <small class="text-danger">{{ $errors->first('mulberrytrees') }}</small>
            </div>

            <div class="col-sm-1 pb-3">
              <label>Apples</label>
              <input class="form-control form-control-sm" name="apples" type="number" value="{{ old('apples') ? old('apples'): $apples }}">
              <small class="text-danger">{{ $errors->first('apples') }}</small>
            </div>
            <div class="col-sm-1 pb-3">
              <label>Pears</label>
              <input class="form-control form-control-sm" name="pears" type="number" value="{{ old('pears') ? old('pears'): $pears }}">
              <small class="text-danger">{{ $errors->first('pears') }}</small>
            </div>
            <div class="col-sm-1 pb-3">
              <label>Nuts</label>
              <input class="form-control form-control-sm" name="nuts" type="number" value="{{ old('nuts') ? old('nuts'): $nuts }}">
              <small class="text-danger">{{ $errors->first('nuts') }}</small>
            </div>
            <div class="col-sm-1 pb-3">
              <label>Cherries</label>
              <input class="form-control form-control-sm" name="cherries" type="number" value="{{ old('cherries') ? old('cherries'): $cherries }}">
              <small class="text-danger">{{ $errors->first('cherries') }}</small>
            </div>
            <div class="col-sm-1 pb-3">
              <label>Sourcherries</label>
              <input class="form-control form-control-sm" name="sourcherries" type="number" value="{{ old('sourcherries') ? old('sourcherries'): $sourcherries }}">
              <small class="text-danger">{{ $errors->first('sourcherries') }}</small>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="household" class="text-primary">Livestock</label>
          <div class="form-row">
            <div class="col-sm-1 pb-3">
              <label>Horses</label>
              <input class="form-control form-control-sm" name="horses" type="number" value="{{ old('horses') ? old('horses'): $horses }}">
              <small class="text-danger">{{ $errors->first('horses') }}</small>
            </div>
            <div class="col-sm-1 pb-3">
              <label>Oxen</label>
              <input class="form-control form-control-sm" name="bulls" type="number" value="{{ old('bulls') ? old('bulls'): $bulls }}">
              <small class="text-danger">{{ $errors->first('bulls') }}</small>
            </div>
            <div class="col-sm-1 pb-3">
              <label>Cows</label>
              <input class="form-control form-control-sm" name="cows" type="number" value="{{ old('cows') ? old('cows'): $cows }}">
              <small class="text-danger">{{ $errors->first('cows') }}</small>
            </div>
            <div class="col-sm-1 pb-3">
              <label>Sheep</label>
              <input class="form-control form-control-sm" name="sheep" type="number" value="{{ old('sheep') ? old('sheep'): $sheep }}">
              <small class="text-danger">{{ $errors->first('sheep') }}</small>
            </div>
            <div class="col-sm-1 pb-3">
              <label>Goats</label>
              <input class="form-control form-control-sm" name="goats" type="number" value="{{ old('goats') ? old('goats'): $goats }}">
              <small class="text-danger">{{ $errors->first('goats') }}</small>
            </div>
            <div class="col-sm-1 pb-3">
              <label>Pigs</label>
              <input class="form-control form-control-sm" name="pigs" type="number" value="{{ old('pigs') ? old('pigs'): $pigs }}">
              <small class="text-danger">{{ $errors->first('pigs') }}</small>
            </div>
            <div class="col-sm-1 pb-3">
              <label>Buffalos</label>
              <input class="form-control form-control-sm" name="buffalos" type="number" value="{{ old('buffalos') ? old('buffalos'): $buffalos }}">
              <small class="text-danger">{{ $errors->first('buffalos') }}</small>
            </div>
            <div class="col-sm-1 pb-3">
              <label>Donkeys</label>
              <input class="form-control form-control-sm" name="donkeys" type="number" value="{{ old('donkeys') ? old('donkeys'): $donkeys }}">
              <small class="text-danger">{{ $errors->first('donkeys') }}</small>
            </div>
            <div class="col-sm-1 pb-3">
              <label>Mules</label>
              <input class="form-control form-control-sm" name="mules" type="number" value="{{ old('mules') ? old('mules'): $mules }}">
              <small class="text-danger">{{ $errors->first('mules') }}</small>
            </div>
            <div class="col-sm-1 pb-3">
              <label>Hives</label>
              <input class="form-control form-control-sm" name="hives" type="number" value="{{ old('hives') ? old('hives'): $hives }}">
              <small class="text-danger">{{ $errors->first('hives') }}</small>
            </div>
          </div>
        </div>
        <div class="form-group">
        <!--  <label for="household" class="text-primary">Source and additional notes</label>-->
          <label for="household" class="text-primary">Additional notes</label>
          <div class="form-row">
              <div class="col-sm-5 pb-3">
                <label>Comments</label>
                <textarea rows="4" cols="50" class="form-control form-control-sm" name="comment">{{ old('comment') ? old('comment'): $comment }}</textarea>
                <small class="text-danger">{{ $errors->first('comment') }}</small>
              </div>
            <div class="col">
              <br>
            <input class="btn btn-primary btn-lg" value="SAVE"  type="submit">
            </div>
          </div>
        </div>
        </form>


        <script>
        $(document).ready(function(){
          var x=0;
          var y=0;

          $(document).on('change','.extended', function(){

            var html = '';
            html += '<tr>';
            if (y==0){
            html += '<td><button type="button" name="resident" class="btn btn-outline-primary btn-sm resident">Add Co-resident<i class="fas fa-user-plus"></i></button></td>';
            }
            html +='</tr>';
            y=y+1;
            //document.getElementById("has_not").innerHTML = "Specify if possible ";
            $('#extended_table').append(html);
          });
          $(document).on('click', '.resident', function(){
            x=x+1;
            var html = '';
            if (x<2){
              html += '<tr><td scope="row">Resident</td><td scope="row">Category</td><td scope="row">Name</td><td scope="row">Gender</td>';
              html += '<td scope="row">Age</td><td scope="row">Civilstatus</td><td scope="row">Nationality</td><td scope="row">Class</td>';
              html += '<td scope="row">Job</td><td scope="row">Second Job</td><td scope="row">Fiscal</td><td scope="row">Illness</td></tr>';
            }
            html += '<tr>';
            html += '<td>'+x+'</td>';
            html += '<input type="hidden" name="has_resident" value=1>';
            html += '<input type="hidden" name="add_resident" value=1>';
            html += '<input type="hidden" name="inref_resident" value='+x+'>';
            html += '<td><select name="resident_cat[]" class="form-control form-control-sm" required><option value="">Relative type</option><option value="Aunt">Aunt</option><option value="Brother-in-law">Brother-in-law</option><option value="Child">Child</option>';
            html += '<option value="Cousin">Cousin</option><option value="Daughter-in-law">Daughter-in-law</option><option value="Grandparent">Grandparent</option><option value="Grandson">Grandson</option>';
            html += '<option value="Greatgrandparent">Greatgrandparent</option><option value="Nephew">Nephew</option><option value="Parent">Parent</option><option value="Parent-in-law">Parent-in-law</option>';
            html += '<option value="Servant">Servant</option><option value="Sibling">Sibling</option><option value="Sister-in-law">Sister-in-law</option><option value="Son-in-law">Son-in-law</option><option value="Uncle">Uncle</option><option value="Non-relative">Non-relative</option>';
            html += '<td><input type="text" name="resident_name[]" class="form-control form-control-sm" placeholder="Resident Name" required></td>';
            html += '<td><select name="resident_gender[]" class="form-control form-control-sm" required><option value="">Gender</option><option value="Male" selected>Male</option><option value="Female">Female</option></select></td>';
            html += '<td><input type="number" name="resident_age[]"  class="form-control form-control-sm" placeholder="Age" size="2" required></td>';
            html += '<td><select name="resident_civil[]" class="form-control form-control-sm" required><option value="">Civilstatus</option><option value="Bachelor">Bachelor</option><option value="Co-habiting">Co-habiting</option><option value="Divorced">Divorced</option><option value="Married">Married</option><option value="Mixed marriages">Mixed marriages</option><option value="Single">Single</option><option value="Widow">Widow</option></td>';
            html += '<td><select name="resident_nation[]" class="form-control form-control-sm" required><option value="None">None</option><option value="Țigan">Țigan</option><option value="Rudar">Rudar</option><option value="Russian">Russian</option><option value="Romanian">Romanian</option><option value="Jewish">Jewish</option><option value="Serbian">Serbian</option><option value="Țigan Ungurean">Țigan Ungurean</option>';
            html += '<option value="Albanez/Arnăuțean">Albanez/Arnăuțean</option><option value="Bulgarian">Bulgarian</option>';
            html += '<option value="Căldărar">Căldărar</option><option value="Ciurar">Ciurar</option><option value="Fierar">Fierar</option><option value="Greek">Greek</option><option value="Inar">Inar</option><option value="Hungarian">Hungarian</option><option value="Lăieș/Lăieț">Lăieș/Lăieț</option><option value="Moldovean">Moldovean</option><option value="Netot">Netot</option><option value="Oltean">Oltean</option>';
            html += '<option value="Ungurean">Ungurean</option><option value="Ursar">Ursar</option><option value="Vătraş">Vătraş</option><option value="Zavragiu">Zavragiu</option><option value="Zlătar">Zlătar</option></select></td>';
            html += '<td><select name="resident_class[]" class="form-control form-control-sm" required><option value="">Social Class</option><option value="Arendaș">Arendaș</option><option value="Aurar">Aurar</option><option value="Clăcaș">Clăcaș</option><option value="Craftsman">Craftsman</option><option value="Domestic/servant">Domestic/Servant</option><option value="Estate administrator">Estate administrator</option>';
            html += '<option value="Exempted">Exempted</option><option value="Landowner">Landowner</option><option value="Not specified">Not specified</option><option value="Not yet included">Not yet included</option><option value="Tenant">Tenant</option>';
            html += '</select></td>';

            html += '<td><select name="resident_job[]" class="form-control form-control-sm" required><option value="None">None</option><option value="Achari">Achari</option><option value="Arendaș">Arendaș</option><option value="Bag maker">Bag maker</option><option value="Baker">Baker</option><option value="Barber">Barber</option>';
            html += '<option value="Bear tamer">Bear tamer</option><option value="Blacksmith">Blacksmith</option><option value="Bootmaker">Bootmaker</option><option value="Bricklayer">Bricklayer</option><option value="Brickmaker">Brickmaker</option><option value="Buffalo caretaker">Buffalo caretaker</option><option value="Căldărar">Căldărar</option>';
            html += '<option value="Carpenter">Carpenter</option><option value="Cartman">Cartman</option><option value="Cattle seller">Cattle seller</option>';
            html += '<option value="Church singer">Church singer</option><option value="Coachman">Coachman</option><option value="Cobza player">Cobza player</option>';
            html += '<option value="Comb maker">Comb maker</option><option value="Cook">Cook</option><option value="Cowherd">Cowherd</option><option value="Daily laborer">Daily laborer</option><option value="Domestic/servant">Domestic/servant</option><option value="Drum player">Drum player</option><option value="Estate caretaker">Estate caretaker</option>';
            html += '<option value="Farmer">Farmer</option><option value="Farrier">Farrier</option><option value="Forester">Forester</option><option value="Gold panner">Gold panner</option>';
            html += '<option value="Grocer">Grocer</option><option value="Innkeeper">Innkeeper</option><option value="Innkeeper and grocer">Innkeeper and grocer</option><option value="Ispravnic">Ispravnic</option><option value="Knife maker">Knife maker</option><option value="Landowner">Landowner</option><option value="Landrywoman">Landrywoman</option>';
            html += '<option value="Lăutar">Lăutar</option><option value="Lock maker">Lock maker</option><option value="Logofețel">Logofețel</option><option value="Merchant">Merchant</option>';
            html += '<option value="Miller">Miller</option><option value="Nurse">Nurse</option><option value="Official">Official</option><option value="Ploughman">Ploughman</option><option value="Priest">Priest</option><option value="Producer of brandy">Producer of brandy</option>';
            html += '<option value="Quilt maker">Quilt maker</option><option value="Rudar">Rudar</option><option value="Schoolmaster">Schoolmaster</option><option value="Sexton">Sexton</option><option value="Shepard">Shepard</option><option value="Shoemaker">Shoemaker</option><option value="Sieve maker">Sieve maker</option><option value="Soap maker">Soap maker</option>';
            html += '<option value="Spader">Spader</option><option value="Spinner">Spinner</option><option value="Spoon maker">Spoon maker</option><option value="Strainer maker">Strainer maker</option><option value="Stufegiu">Stufegiu</option><option value="Swine herd">Swine herd</option><option value="Tailor">Tailor</option><option value="Tinsmith">Tinsmith</option>';
            html += '<option value="Vădrar">Vădrar</option><option value="Vătaf">Vătaf</option><option value="Violin player">Violin player</option><option value="Weaver">Weaver</option><option value="Weigher">Weigher</option><option value="Wheelwright">Wheelwright</option><option value="Woolcard worker">Woolcard worker</option>';
            html += '<option value="Zlătar">Zlătar</option></select></td>';

            html += '<td><select name="resident_second_job[]" class="form-control form-control-sm" required><option value="None">None</option><option value="Achari">Achari</option><option value="Arendaș">Arendaș</option><option value="Bag maker">Bag maker</option><option value="Baker">Baker</option><option value="Barber">Barber</option>';
            html += '<option value="Bear tamer">Bear tamer</option><option value="Blacksmith">Blacksmith</option><option value="Bootmaker">Bootmaker</option><option value="Bricklayer">Bricklayer</option><option value="Brickmaker">Brickmaker</option><option value="Buffalo caretaker">Buffalo caretaker</option><option value="Căldărar">Căldărar</option>';
            html += '<option value="Carpenter">Carpenter</option><option value="Cartman">Cartman</option><option value="Cattle seller">Cattle seller</option>';
            html += '<option value="Church singer">Church singer</option><option value="Coachman">Coachman</option><option value="Cobza player">Cobza player</option>';
            html += '<option value="Comb maker">Comb maker</option><option value="Cook">Cook</option><option value="Cowherd">Cowherd</option><option value="Daily laborer">Daily laborer</option><option value="Domestic/servant">Domestic/servant</option><option value="Drum player">Drum player</option><option value="Estate caretaker">Estate caretaker</option>';
            html += '<option value="Farmer">Farmer</option><option value="Farrier">Farrier</option><option value="Forester">Forester</option><option value="Gold panner">Gold panner</option>';
            html += '<option value="Grocer">Grocer</option><option value="Innkeeper">Innkeeper</option><option value="Innkeeper and grocer">Innkeeper and grocer</option><option value="Ispravnic">Ispravnic</option><option value="Knife maker">Knife maker</option><option value="Landowner">Landowner</option><option value="Landrywoman">Landrywoman</option>';
            html += '<option value="Lăutar">Lăutar</option><option value="Lock maker">Lock maker</option><option value="Logofețel">Logofețel</option><option value="Merchant">Merchant</option>';
            html += '<option value="Miller">Miller</option><option value="Nurse">Nurse</option><option value="Official">Official</option><option value="Ploughman">Ploughman</option><option value="Priest">Priest</option><option value="Producer of brandy">Producer of brandy</option>';
            html += '<option value="Quilt maker">Quilt maker</option><option value="Rudar">Rudar</option><option value="Schoolmaster">Schoolmaster</option><option value="Sexton">Sexton</option><option value="Shepard">Shepard</option><option value="Shoemaker">Shoemaker</option><option value="Sieve maker">Sieve maker</option><option value="Soap maker">Soap maker</option>';
            html += '<option value="Spader">Spader</option><option value="Spinner">Spinner</option><option value="Spoon maker">Spoon maker</option><option value="Strainer maker">Strainer maker</option><option value="Stufegiu">Stufegiu</option><option value="Swine herd">Swine herd</option><option value="Tailor">Tailor</option><option value="Tinsmith">Tinsmith</option>';
            html += '<option value="Vădrar">Vădrar</option><option value="Vătaf">Vătaf</option><option value="Violin player">Violin player</option><option value="Weaver">Weaver</option><option value="Weigher">Weigher</option><option value="Wheelwright">Wheelwright</option><option value="Woolcard worker">Woolcard worker</option>';
            html += '<option value="Zlătar">Zlătar</option></select></td>';

            html +='<td><select name="resident_fiscal[]" class="form-control form-control-sm" required><option value="">Fiscal</option><option value="Boyar slave">Boyar slave</option><option value="Exempt from taxes">Exempt from taxes</option><option value="Monastery slave">Monastery slave</option><option value="Not yet included">Not yet included</option><option value="Princely slave">Princely slave</option>';
            html +='<option value="Ransomed by himself">Ransomed by himself</option><option value="Ransomed by the village">Ransomed by the village</option><option value="Tax payer">Tax payer</option></td>';
            html +='<td><select name="resident_illness[]" class="form-control form-control-sm" required><option value="">Illness</option><option value="None">None</option><option value="Physical illness">Physical</option><option value="Mental illness">Mental</option><option value="Disabilities">Disabilities</option></td>';
            html +='<td><button type="button" name="resident_spouse" class="btn btn-outline-primary btn-sm resident_spouse">Add Spouse<i class="fas fa-user-plus"></i></button></td>';
            html +='<td><button type="button" name="resident_child" class="btn btn-outline-primary btn-sm resident_child">Add Child<i class="fas fa-user-plus"></i></button></td>';
            html += '<td><button type="button" name="resident_remove" class="btn btn-outline-danger btn-sm residentremove"><i class="fas fa-user-times"></i><span class="glyphicon glyphicon-minus"></span></button></td></tr>';

              $('#resident_table').append(html);
            });
            $(document).on('click', '.residentremove', function(){
             $(this).closest('tr').remove();
             });
            $(document).on('click', '.resident_spouse', function(){
              var html = '';
              html += '<tr>';
              html += '<td>'+x+'</td>';
              html += '<input type="hidden" name="resident_has_spouse" value=1>';
              html += '<input type="hidden" name="resident_add_spouse" value=1>';
              html += '<input type="hidden" name=""spousecount"" value=1>';
              html += '<td><input type="text" name="spouse_name[]" class="form-control form-control-sm" placeholder="spouses Name" required></td>';
              html += '<td><select name="spouse_gender[]" class="form-control form-control-sm" required><option value="">Gender</option><option value="Male">Male</option><option value="Female" selected>Female</option></select></td>';
              html += '<td><input type="number" name="spouse_age[]"  class="form-control form-control-sm" placeholder="Age" size="2" required></td>';
              html += '<td><select name="spouse_nation[]" class="form-control form-control-sm" required><option value="None">None</option><option value="Țigan">Țigan</option><option value="Rudar">Rudar</option><option value="Russian">Russian</option><option value="Romanian">Romanian</option><option value="Jewish">Jewish</option><option value="Serbian">Serbian</option><option value="Țigan Ungurean">Țigan Ungurean</option>';
              html += '<option value="Albanez/Arnăuțean">Albanez/Arnăuțean</option><option value="Bulgarian">Bulgarian</option>';
              html += '<option value="Căldărar">Căldărar</option><option value="Ciurar">Ciurar</option><option value="Fierar">Fierar</option><option value="Greek">Greek</option><option value="Inar">Inar</option><option value="Hungarian">Hungarian</option><option value="Lăieș/Lăieț">Lăieș/Lăieț</option><option value="Moldovean">Moldovean</option><option value="Netot">Netot</option><option value="Oltean">Oltean</option>';
              html += '<option value="Ungurean">Ungurean</option><option value="Ursar">Ursar</option><option value="Vătraş">Vătraş</option><option value="Zavragiu">Zavragiu</option><option value="Zlătar">Zlătar</option></select></td>';
              html += '<td><select name="spouse_job[]" class="form-control form-control-sm" required><option value="">Job</option><option value="Achari">Achari</option><option value="Arendaș">Arendaș</option><option value="Bag maker">Bag maker</option><option value="Baker">Baker</option><option value="Barber">Barber</option>';
              html += '<option value="Bear tamer">Bear tamer</option><option value="Blacksmith">Blacksmith</option><option value="Bootmaker">Bootmaker</option><option value="Bricklayer">Bricklayer</option><option value="Brickmaker">Brickmaker</option><option value="Buffalo caretaker">Buffalo caretaker</option><option value="Căldărar">Căldărar</option>';
              html += '<option value="Carpenter">Carpenter</option><option value="Cartman">Cartman</option><option value="Cattle seller">Cattle seller</option>';
              html += '<option value="Church singer">Church singer</option><option value="Coachman">Coachman</option><option value="Cobza player">Cobza player</option>';
              html += '<option value="Comb maker">Comb maker</option><option value="Cook">Cook</option><option value="Cowherd">Cowherd</option><option value="Daily laborer">Daily laborer</option><option value="Domestic/servant">Domestic/servant</option><option value="Drum player">Drum player</option><option value="Estate caretaker">Estate caretaker</option>';
              html += '<option value="Farmer">Farmer</option><option value="Farrier">Farrier</option><option value="Forester">Forester</option><option value="Gold panner">Gold panner</option>';
              html += '<option value="Grocer">Grocer</option><option value="Innkeeper">Innkeeper</option><option value="Innkeeper and grocer">Innkeeper and grocer</option><option value="Ispravnic">Ispravnic</option><option value="Knife maker">Knife maker</option><option value="Landowner">Landowner</option><option value="Landrywoman">Landrywoman</option>';
              html += '<option value="Lăutar">Lăutar</option><option value="Lock maker">Lock maker</option><option value="Logofețel">Logofețel</option><option value="Merchant">Merchant</option>';
              html += '<option value="Miller">Miller</option><option value="None">None</option><option value="Nurse">Nurse</option><option value="Official">Official</option><option value="Ploughman">Ploughman</option><option value="Priest">Priest</option><option value="Producer of brandy">Producer of brandy</option>';
              html += '<option value="Quilt maker">Quilt maker</option><option value="Rudar">Rudar</option><option value="Schoolmaster">Schoolmaster</option><option value="Sexton">Sexton</option><option value="Shepard">Shepard</option><option value="Shoemaker">Shoemaker</option><option value="Sieve maker">Sieve maker</option><option value="Soap maker">Soap maker</option>';
              html += '<option value="Spader">Spader</option><option value="Spinner">Spinner</option><option value="Spoon maker">Spoon maker</option><option value="Strainer maker">Strainer maker</option><option value="Swine herd">Swine herd</option><option value="Tailor">Tailor</option><option value="Tinsmith">Tinsmith</option>';
              html += '<option value="Vădrar">Vădrar</option><option value="Vătaf">Vătaf</option><option value="Violin player">Violin player</option><option value="Weaver">Weaver</option><option value="Weigher">Weigher</option><option value="Wheelwright">Wheelwright</option><option value="Woolcard worker">Woolcard worker</option>';
              html += '<option value="Zlătar">Zlătar</option></select></td>';
              html +='<td><select name="spouse_illness[]" class="form-control form-control-sm" required><option value="">Illness</option><option value="None">None</option><option value="Physical illness">Physical</option><option value="Mental illness">Mental</option><option value="Disabilities">Disabilities</option></td>';
              html += '<td><button type="button" name="spouseremove" class="btn btn-outline-danger btn-sm spouseremove"><i class="fas fa-user-times"></i><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
              $('#resident_table').append(html);
             });
             $(document).on('click', '.spouseremove', function(){
              $(this).closest('tr').remove();
              });
              $(document).on('click', '.resident_child', function(){
                  var html = '';
                  html += '<tr><td>('+x+')Child</td>';
                  html += '<input type="hidden" name="resident_has_child" value=1>';
                  html += '<input type="hidden" name="resident_add_child" value=1>';
                  html += '<td><input type="text" name="resident_child_name[]" class="form-control form-control-sm" placeholder="Child Name"></td>';
                  html += '<td><select name="resident_child_gender[]" class="form-control form-control-sm" required><option value="">Gender</option><option value="Male">Male</option><option value="Female">Female</option></select></td>';
                  html += '<td><input type="number" name="resident_child_age[]" class="form-control form-control-sm"  placeholder="Age" size="2" required></td>';
                  html += '<td><select name="resident_child_nation[]" class="form-control form-control-sm" required><option value="None">None</option><option value="Țigan">Țigan</option><option value="Rudar">Rudar</option><option value="Russian">Russian</option><option value="Romanian">Romanian</option><option value="Jewish">Jewish</option><option value="Serbian">Serbian</option><option value="Țigan Ungurean">Țigan Ungurean</option>';
                  html += '<option value="Albanez/Arnăuțean">Albanez/Arnăuțean</option><option value="Bulgarian">Bulgarian</option>';
                  html += '<option value="Căldărar">Căldărar</option><option value="Ciurar">Ciurar</option><option value="Fierar">Fierar</option><option value="Greek">Greek</option><option value="Inar">Inar</option><option value="Hungarian">Hungarian</option><option value="Lăieș/Lăieț">Lăieș/Lăieț</option><option value="Moldovean">Moldovean</option><option value="Netot">Netot</option><option value="Oltean">Oltean</option>';
                  html += '<option value="Ungurean">Ungurean</option><option value="Ursar">Ursar</option><option value="Vătraş">Vătraş</option><option value="Zavragiu">Zavragiu</option><option value="Zlătar">Zlătar</option></select></td>';
                  html +='<td><select name="resident_child_illness[]" class="form-control form-control-sm" required><option value="">Illness</option><option value="None">None</option><option value="Physical illness">Physical</option><option value="Mental illness">Mental</option><option value="Disabilities">Disabilities</option></td>';
                  html += '<td><button type="button" name="resident_child_remove" class="btn btn-outline-danger btn-sm resident_child_remove"><i class="fas fa-user-times"></i><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
                  $('#resident_table').append(html);
                 });

                 $(document).on('click', '.resident_child_remove', function(){
                  $(this).closest('tr').remove();
                  });
          $(document).on('click', '.add', function(){
              var html = '';
              html += '<tr>';
              html += '<input type="hidden" name="has_children" value=1>';
              html += '<input type="hidden" name="add_flag" value=1>';
              html += '<td><input type="text" name="child_name[]" class="form-control form-control-sm" placeholder="Child Name"></td>';
              html += '<td><input type="number" name="child_age[]" class="form-control form-control-sm"  placeholder="Age" size="2" required></td>';
              html += '<td><select name="child_gender[]" class="form-control form-control-sm" required><option value="">Gender</option><option value="Male">Male</option><option value="Female">Female</option></select></td>';
              //html += '<td><select name="child_place[]" class="form-control form-control-sm" required><option value="">Living in</option><option value="inhousehold">inhousehold</option><option value="outhousehold">Other</option></select></td>';
              html += '<td><button type="button" name="remove" class="btn btn-outline-danger btn-sm remove"><i class="fas fa-user-times"></i><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
              $('#item_table').append(html);
             });

             $(document).on('click', '.remove', function(){
              $(this).closest('tr').remove();
              });

            $(document).on('click', '.wifeadd', function(){
              var html = '';
              html += '<tr>';
              html += '<input type="hidden" name="wife" value=1>';
              html += '<input type="hidden" name="add_wife" value=1>';
              html += '<td><input type="text" name="wife_name" class="form-control form-control-sm" placeholder="Wifes Name" required></td>';
              html += '<td><select name="wife_gender" class="form-control form-control-sm" required><option value="">Gender</option><option value="Male">Male</option><option value="Female" selected>Female</option></select></td>';
              html += '<td><input type="text" name="wife_age"  class="form-control form-control-sm" placeholder="Age" size="2" required></td>';
              html += '<td><select name="wife_nation" class="form-control form-control-sm" required><option value="Țigan">Nationality: Țigan</option><option value="Albanez/Arnăuțean">Albanez/Arnăuțean</option><option value="Bulgarian">Bulgarian</option><option value="Căldărar">Căldărar</option><option value="Ciurar">Ciurar</option><option value="Fierar">Fierar</option><option value="Greek">Greek</option>';
              html += '<option value="Hungarian">Hungarian</option><option value="Inar">Inar</option><option value="Jewish">Jewish</option><option value="Lăieș/Lăieț">Lăieș/Lăieț</option><option value="Moldovean">Moldovean</option>';
              html += '<option value="Netot">Netot</option><option value="Oltean">Oltean</option><option value="Romanian">Romanian</option><option value="Rudar">Rudar</option><option value="Serbian">Serbian</option><option value="Țigan Ungurean">Țigan Ungurean</option>';
              html += '<option value="Ungurean">Ungurean</option><option value="Ursar">Ursar</option><option value="Vătraş">Vătraş</option><option value="Zavragiu">Zavragiu</option><option value="Zlătar">Zlătar</option></select></td>';
              html += '<td><button type="button" name="wiferemove" class="btn btn-outline-danger btn-sm wiferemove"><i class="fas fa-user-times"></i><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
              $('#wife_table').append(html);
              });

              $(document).on('click', '.wiferemove', function(){
               $(this).closest('tr').remove();
               });

            });
            </script>



@endsection
