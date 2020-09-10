@extends('layouts.master')

@section('content')
<div class="col-md-10 offset-md-1">
                   <span class="anchor" id="formComplex"></span>

                   <h3>{{ $modify == 1 ? 'Modify Household' : 'New Household' }}</h3>
                   <form action="{{ $modify == 1 ? route('update_household', ['household_id'=> $household_id ]) : route('create_household') }}" method="post">
                       {{ csrf_field() }}
                     <!-- First row -->
                   <!-- form complex example -->
                   <div class="form-row mt-4">

                       <div class="col-sm-1 pb-3">
                         <label>No.</label>
                         <input class="form-control form-control-sm" type="text" name="number" value="{{ old('number') ? old('number'): $number }}">
                         <small class="text-danger">{{ $errors->first('number') }}</small>
                       </div>
                       <div class="col-sm-4 pb-3">
                         <label>Household</label>
                         <input class="form-control form-control-sm" name="name" type="text" value="{{ old('name') ? old('name'): $name }}">
                         <div class="text-danger">{{ $errors->first('name') }}</div>
                       </div>
                       <div class="col-sm-2 pb-3">
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
                       <div class="col-sm-1 pb-3">
                         <label>Age</label>
                         <input class="form-control form-control-sm" name="age" type="number" value="{{ old('age') ? old('age'): $age }}">
                         <small class="text-danger">{{ $errors->first('age') }}</small>
                       </div>
                       <div class="col-sm-2 pb-3">
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
                       <div class="col-sm-2 pb-3">
                         <label>Extended family</label>
                         <select class="form-control form-control-sm" name="extended">
                           @if( $modify==1)
                           <option value="{{ $extended_id }}">{{ $extended->type }}</option>
                           @endif
                           @foreach( $extendeds as $extended)
                             <option value="{{ $extended->id }}" >{{ $extended->type }}</option>
                           @endforeach
                         </select>
                       </div>

                       <div class="col-sm-2 pb-3">
                         <label>Civilstatus</label>
                         <select class="form-control form-control-sm" name="civilstatus" id="civilstatus">
                           @if( $modify==1)
                           <option value="{{ $civilstatus }}">{{ $civilstatus }}</option>
                           @endif
                           @foreach( $titles as $title)
                             <option value="{{ $title }}" >{{ $title }}</option>
                           @endforeach
                         </select>
                       </div>
                       <!-- Wife -->
                       @if($civstatus==1 && $wife==1)
                       <div class="col-sm-3 pb-3">
                         <label>Wife/Partner's name</label>
                           @foreach( $wifes as $wife)
                         <input type="hidden" name="wife" value=1>
                         <input type="hidden" name="add_wife" value=0>
                         <input type="hidden" name="wife_id" value="{{ $wife->id }}">
                         <input class="form-control form-control-sm" name="wife_name" type="text" value="{{ old('wife') ? old('wife'): $wife->wife_name }}" required>
                         <small class="text-danger">{{ $errors->first('wife') }}</small>
                       </div>
                       <!-- Wifes gender -->
                       <div class="col-sm-2 pb-3">
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
                       <div class="col-sm-1 pb-3">
                         <label>Wife's age</label>
                         <input class="form-control form-control-sm" name="wife_age" type="number" value="{{ old('wage') ? old('wage'): $wife->wife_age }}">
                         <small class="text-danger">{{ $errors->first('wage') }}</small>
                         @endforeach
                         </div>
                       @else
                       <div class="col">
                       <label>Wife</label>
                       <br>
                       <button type="button" name="wifeadd" class="btn btn-outline-primary btn-sm wifeadd">Add Wife <i class="fas fa-user-plus"></i></button>
                       <table class="table table-sm" id="wife_table">
                       </table>
                       </div>
                   @endif

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
                               <th scope="row">Living</th>
                              </tr>
                               @foreach( $childrens as $children)
                               <input type="hidden" name="has_children" value=1>
                               <input type="hidden" name="add_flag" value=0>
                               <input type="hidden" name="dcount" value=0>
                               <input type="hidden" name="child_id[]" value="{{ $children->id}}">
                               <tr>
                                 <td><input type="text" name="child_name[]" value="{{ $children->child_name }}" class="form-control form-control-sm"></td>
                                 <td><input type="number" name="child_age[]" value="{{ $children->child_age }}" class="form-control form-control-sm"></td>
                                 <td><select name="child_gender[]" class="form-control form-control-sm" required><option value="{{ $children->child_gender }}">{{ $children->child_gender }}</option><option value="Male">Male</option><option value="Female">Female</option></select></td>
                                 <td><select name="child_place[]" class="form-control form-control-sm" required><option value="{{ $children->child_place }}">{{ $children->child_place }}</option><option value="inhousehold">inhousehold</option><option value="outhousehold">other household</option></select></td>
                               </tr>
                               @endforeach
                             @else
                               <input type="hidden" name="dcount" value=1>
                             @endif
                            </table>
                        </div>
                    </div>
                </div>
          
            <!--/row-->

        <br><br><br><br>

        </div>
        <!--/col-->
    </div>
    <!--/row-->
    <hr>
    <p class="text-center">The End.<br>
        <a class="small text-info d-inline-block" href="https://www.codeply.com/bootstrap-4-examples">More Bootstrap 4 Examples</a>
    </p>

</div>
<div class="col">
  <br>
<input class="btn btn-primary btn-lg" value="SAVE"  type="submit">
</div>

</form>

<script>
$(document).ready(function(){
  $(document).on('click', '.add', function(){
      var html = '';
      html += '<tr>';
      html += '<input type="hidden" name="has_children" value=1>';
      html += '<input type="hidden" name="add_flag" value=1>';
      html += '<td><input type="text" name="child_name[]" class="form-control form-control-sm" placeholder="Child Name"></td>';
      html += '<td><input type="number" name="child_age[]" class="form-control form-control-sm"  placeholder="Age" size="2" required></td>';
      html += '<td><select name="child_gender[]" class="form-control form-control-sm" required><option value="">Gender</option><option value="Male">Male</option><option value="Female">Female</option></select></td>';
      html += '<td><select name="child_place[]" class="form-control form-control-sm" required><option value="">Living in</option><option value="inhousehold">inhousehold</option><option value="outhousehold">Other</option></select></td>';
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
      html += '<td><select name="wife_gender" class="form-control form-control-sm" required><option value="">Gender</option><option value="Male">Male</option><option value="Female">Female</option></select></td>';
      html += '<td><input type="text" name="wife_age"  class="form-control form-control-sm" placeholder="Age" size="2" required></td>';
      html += '<td><button type="button" name="wiferemove" class="btn btn-outline-danger btn-sm wiferemove"><i class="fas fa-user-times"></i><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
      $('#wife_table').append(html);
      });

      $(document).on('click', '.wiferemove', function(){
       $(this).closest('tr').remove();
       });

    });
    </script>

@endsection
