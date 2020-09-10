@extends('layouts.master')

@section('content')
<div class="row">
      <div class="medium-12 large-12 columns">
        <h4>Households</h4>
        <div class="medium-2  columns"><a class="btn btn-outline-success" href="{{ route('new_household') }}">ADD NEW HOUSEHOLD</a>
        <!--<a class="btn btn-outline-success" href="{{ route('export') }}">EXPORT DATA TO EXCEL</a></div>
        -->
        </div>
        <br>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">Number</th>
              <th scope="col">Household</th>
              <th scope="col">Created</th>
              <th scope="col">Updated</th>
            </tr>
          </thead>
          <tbody>
              @foreach( $households as $household )

              <tr>
                <td>{{ $household->number }}<a class="btn btn-light show" href="{{ route('household_detail', ['household_id'=>$household->id ]) }}"><i class="far fa-plus-square"></i></a></td>
                <td>{{ $household->name}} </td>
                <td>{{ $household->created_at}} </td>
                <td>{{ $household->updated_at}} </td>

                <td>
                  <a class="btn btn-primary btn-sm" href="{{ route('show_household', ['household_id'=>$household->id ]) }}">EDIT <i class="far fa-edit"></i></a>
                <!--  <a class="hollow button warning" href="{{ route('check_room', ['household_id'=>$household->id ]) }}">BOOK A ROOM</a> -->

                </td>
              </tr>

              @endforeach

            </tbody>
        </table>
    </div>
        <table class="table table-striped">
    <tbody>
    <tr><th>Household data</th></tr>
    <tr><td>Name:</td><td> {{$household->name }}</td><td>Civil status:</td><td> {{$household->civilstatus }}</td></tr>
    <tr><td>Gender:</td><td> {{$household->gender }}</td><td>Wife's name:</td><td> {{$household->wife}}</td></tr>
    <tr><td>Age:</td><td> {{$household->age }}</td><td>Wife's age:</td><td> {{$household->wage}}</td></tr>
    <tr><td>Nationality:</td><td> {{$household->nationality}}</td></tr>
    <tr><td>Skill:</td><td> {{$household->skill_name}}</td></tr>
    <tr><td>Fiscal:</td><td> {{$household->fiscal}}</td></tr>
    <tr><td>Social class:</td><td> {{$household->social_name}}</td></tr>
    <tr><td>Belongs to village:</td><td> {{$household->village_name}}</td></tr>
    <tr><td>Illness:</td><td> {{$household->illness}}</td></tr>
    <tr><td>Servants:</td><td> {{$household->servant}}</td></tr>
    <tr><th>Household children</th></tr>
    @if ($household->children==1)
    @foreach( $childrens as $children )
    <tr>
    <td>Child name: {{$children->child_name}}</td>
    <td>Child age: {{$children->child_age}}</td>
    <td>Child gender: {{$children->child_gender}}</td>
    </tr>
    @endforeach
      @else
      <tr><td>No children registered<td></tr>
    @endif
    <tr><th>Household land</th></tr>
    <tr><td >Cultivated land:</td><td> {{$household->land}} acres</td></tr>
    <tr><td>Crops:</td><td> {{$household->crops}}</td></tr>
    <tr><th>Household livestock</th></tr>
    <tr><td>Horses:</td><td> {{$household->horses}}</td></tr>
    <tr><td>Bulls:</td><td> {{$household->bulls}}</td></tr>
    <tr><td>Cows:</td><td> {{ $household->cows}}</td></tr>
    <tr><td>Sheep:</td><td> {{$household->sheep}}</td></tr>
    <tr><td>Goats:</td><td> {{ $household->goats}}</td></tr>
    <tr><td>Pigs:</td><td> {{ $household->pigs }}</td></tr>
    <tr><td>Buffalos:</td><td> {{ $household->buffalos }}</td></tr>
    <tr><td>Donkeys:</td><td> {{ $household->donkeys }}</td></tr>
    <tr><td>Mules:</td><td> {{ $household->mules }}</td></tr>
    <tr><td>Hives:</td><td> {{$household->hives}}</td></tr>
    <tr><td>Plumtrees:</td><td> {{$household->plumtrees}}</td></tr>
    <tr><td>Mulberrytrees:</td><td> {{$household->mulberrytrees}}</td></tr>
    <tr><td>Vineyards:</td><td> {{$household->vineyards}}</td></tr>
    <tr><td>Fruitrees:</td><td> {{$household->fruittrees}}</td></tr>

  </tbody>
</table>
<a class="btn btn-primary btn-sm" href="{{ route('households') }}">BACK <i class="fas fa-chevron-left"></i></a>

    </div>
@endsection
