@extends('layouts.master')

@section('content')
  @foreach( $households as $household )
    <div class="card">
        <h4 class="card-header">{{ $household->number }} | {{ $household->name}} <span class="badge badge-secondary"> {{ $household->household_count }}</span></h4>
        <div class="card-body">
          <a href="{{ route('list') }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-backward"></i> BACK</a>
          <a href="{{ route('show_household', ['household_id'=>$household->id ]) }}" class="btn btn-outline-primary btn-sm">EDIT <i class="far fa-edit"></i></a>
              <span class="border border-success"> Db ref. id: {{ $household->id }} </span>  Last updated at: {{$household->updated_at}}
        </div>
    </div>
  @endforeach
  <!---->
<div class="card">
  <h5 class="card-header">Household data</h5>
  <div class="card-body">
    <table class="table table-striped">
      <tr><td><strong>Head of household:</strong></td><td> {{$household->name }}</td><td><strong>Civil status:</strong></td><td> {{$household->civilstatus }}</td><td><strong>Gender:</strong></td><td> {{$household->gender }}</td><td><strong>Age:</strong></td><td> {{$household->age }}</td><td><strong>Nationality:</strong></td><td>{{$household->nationality}}</td></tr>
      <tr><td><strong>First name:</strong></td><td>{{$household->fname}}</td><td><strong>Surname:</strong></td><td>{{$household->surname}}</td><td><strong>Nickname:</strong></td><td>{{$household->nickname}}</td></tr>
      <!-- Wife -->
      @if ($household->wife==1)
      @foreach( $wifes as $wife )
      <tr><td><strong>Wife's name:</strong></td><td>{{$wife->wife_name}}</td><td><strong>Civil status:</strong></td><td> {{$wife->wife_status }}</td><td><strong>Wife's gender:</strong></td><td> {{$wife->wife_gender}}</td><td><strong>Wife's age:</strong></td><td> {{$wife->wife_age}}</td></tr>
      @endforeach

      @elseif($household->wife==0)
        <tr><td>No Wife registered</td></tr>
      @endif

      <tr><td><strong>Job:</strong></td><td> {{$household->skill_name}}</td></tr>
      <tr><td><strong>Fiscal:</strong></td><td> {{$household->fiscal}}</td><td>Comment:</td><td>{{$household->fiscalcomment}}</td></tr>
      <tr><td><strong>Social class:</strong></td><td> {{$household->social_name}}</td></tr>
      <tr><td><strong>Belongs to village:</strong></td><td> {{$household->village_name}}</td></tr>
      <tr><td><strong>Illness:</strong></td><td> {{$household->illness}}</td><td>{{$household->diagnosis}}</td><td>{{$household->inf_diagnosis}}</td></tr>
      <tr><td><strong>Servants:</strong></td><td> {{$household->servant}}</td></tr>
    </table>
    </div>
  </div>
  <!-- Second card -->
  <div class="card">
    <h5 class="card-header">Children</h5>
    <div class="card-body">
      <table class="table table-striped">
        @if ($household->children==1)
            @foreach( $childrens as $children )
            <tr>
            <td><strong>Child name:</strong> {{$children->child_name}}</td>
            <td><strong>Child age:</strong> {{$children->child_age}}</td>
            <td><strong>Child gender:</strong> {{$children->child_gender}}</td>
            <td><strong>Living:</strong> {{$children->child_place}}</td>
            </tr>
            @endforeach
        @elseif($household->children==0)
          <tr><td>No children registered<td></tr>
        @endif
      </table>
      </div>
    </div>
    <!-- Third card -->
    <div class="card">
      <h5 class="card-header">Extended family situation</h5>
      <div class="card-body">
        <table class="table table-striped">
          <tr><td>{{$extended->type}}</td></tr>
            @if ($household->coresident==1)
            @foreach( $coresidents as $resident)
            <tr>
            <td><strong>Category:</strong> {{ $resident->resident_cat }}</td>
            <td><strong>Name:</strong> {{ $resident->resident_name }}</td>
            <td><strong>Gender:</strong> {{ $resident->resident_gender }}</td>
            <td><strong>Age:</strong> {{ $resident->resident_age }}</td>
            <td><strong>Nationality:</strong> {{ $resident->resident_nation }}</td>
            <td><strong>Social class:</strong> {{ $resident->resident_class }}</td>
            <td><strong>Job:</strong> {{ $resident->resident_job }}</td>
            </tr>
              @if ($household->coresident_spouse==1)
                @foreach( $coresident_spouses as $spouse)
                  @if ( $resident->id==$spouse->coresident_id )
                <tr>
                  <td></td>
                  <td><strong>Spouse-></strong></td>
                  <td><strong>Name:</strong> {{ $spouse->spouse_name }}</td>
                  <td><strong>Gender:</strong> {{ $spouse->spouse_gender }}</td>
                  <td><strong>Age:</strong> {{ $spouse->spouse_age }}</td>
                  <td><strong>Nationality:</strong> {{ $spouse->spouse_nation }}</td>
                </tr>
                  @endif
                @endforeach
              @endif
              <!--Co-resident Children -->
              @if ($household->coresident_child==1)
                @foreach( $coresident_children as $child)
                  @if ( $resident->id==$child->coresident_id )
                <tr>
                  <td></td>
                  <td><strong>Child-></strong></td>
                  <td><strong>Name:</strong> {{ $child->child_name }}</td>
                  <td><strong>Gender:</strong> {{ $child->child_gender }}</td>
                  <td><strong>Age:</strong> {{ $child->child_age }}</td>
                  <td><strong>Nationality:</strong> {{ $child->child_nation }}</td>
                </tr>
                  @endif
                @endforeach
              @endif
              <!-- end -->
            @endforeach
        @elseif($household->coresident==0)
          <tr><td>No coresidents registered<td></tr>
        @endif
        </table>
        </div>
      </div>
      <!-- Fourth card -->
      <div class="card">
        <h5 class="card-header">Land</h5>
        <div class="card-body">
          <table class="table table-striped">
            <tr><td><strong>Cultivated land:</strong></td><td>{{$household->land}} acres</td></tr>
            <tr><td>Wheat:</td><td>{{$household->wheat}}</td></tr>
            <tr><td>Corn:</td><td>{{$household->corn}}</td></tr>
            <tr><td>Hay:</td><td>{{$household->fennel}}</td></tr>
            <tr><td>Barley:</td><td>{{$household->barley}}</td></tr>
            <tr><td>Oats:</td><td>{{$household->oats}}</td></tr>
            <tr><td>Millet:</td><td>{{$household->millet}}</td></tr>
            <tr><td><strong>Fruittrees(in total):</strong></td><td>{{$household->fruittrees}}</td></tr>
            <tr><td>Plumtrees:</td><td>{{$household->plumtrees}}</td></tr>
            <tr><td>Mulberrytrees:</td><td>{{$household->mulberrytrees}}</td></tr>
            <tr><td>Vineyards({{$household->vineyardopt}}):</td><td>{{$household->vineyards}}</td></tr>
            <tr><td>Apple trees:</td><td>{{$household->apples}}</td></tr>
            <tr><td>Pear trees:</td><td>{{$household->pears}}</td></tr>
            <tr><td>Nut trees:</td><td>{{$household->nuts}}</td></tr>
            <tr><td>Cherry trees:</td><td>{{$household->cherries}}</td></tr>
            <tr><td>Sour cherry trees:</td><td>{{$household->sourcherries}}</td></tr>
          </table>
          </div>
        </div>
        <!-- Fift card -->
        <div class="card">
          <h5 class="card-header">Livestock</h5>
          <div class="card-body">
            <table class="table table-striped">
              <tr><td><strong>Horses:</strong></td><td>{{$household->horses}}</td></tr>
              <tr><td><strong>Oxen:</strong></td><td>{{$household->bulls}}</td></tr>
              <tr><td><strong>Cows:</strong></td><td>{{$household->cows}}</td></tr>
              <tr><td><strong>Sheep:</strong></td><td>{{$household->sheep}}</td></tr>
              <tr><td><strong>Goats:</strong></td><td>{{$household->goats}}</td></tr>
              <tr><td><strong>Pigs:</strong></td><td>{{$household->pigs}}</td></tr>
              <tr><td><strong>Buffalos:</strong></td><td>{{$household->buffalos }}</td></tr>
              <tr><td><strong>Donkeys:</strong></td><td>{{ $household->donkeys }}</td></tr>
              <tr><td><strong>Mules:</strong></td><td>{{$household->mules}}</td></tr>
              <tr><td><strong>Hives:</strong></td><td>{{$household->hives}}</td></tr>
            </table>
            </div>
          </div>
          <!-- Sixt card -->
          <div class="card">
            <h5 class="card-header">Comments</h5>
            <div class="card-body">
              {{$household->comment}}
            </div>
          </div>
<div>
  <a href="{{ route('households') }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-backward"></i> BACK</a>
</div>
@endsection
