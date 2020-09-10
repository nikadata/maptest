
<div class="container">
  <div class="row">
    <div class="col">
      <h1 class="display-4">Maprom database</h1>
      <!--
      <p class="font-weight-light">Please note! The database is under development - data entered will be erased during a rollback!</p>
    -->
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="jumbotron">
        <h1 class="display-3"><strong>{{$roms}}/{{$romstotal}}</strong></h1>
        <p class="lead">Romani Households/Total Roms</p>
        <h1 class="display-3">{{$household_records}}/{{$total}}</h1>
        <p class="lead">Households/Total</p>
          <a class="btn btn-primary btn-lg" href="{{ route('new_household') }}" role="button">Add +</a>

      </div>

      <div class="card border-primary mb-3" style="max-width: 18rem;padding-left:1rem;padding-top:0.5rem">
        <table class="card-title small">
          <tr>
          <td>Version:</td><td> {{ $version }}</td>
          </tr>
        </table>
      </div>

    </div>
    <div class="col">
      <div class="jumbotron">
        <h1 class="display-5">{{$district_records}}</h1>
        <p class="lead">Districts</p>
        <h1 class="display-5">{{$county_records}}</h1>
        <p class="lead">Sub-districts</p>
        <h1 class="display-5">{{$oldest}} yrs</h1>
        <p class="lead">Oldest Rom</p>
        <h1 class="display-5">{{$youngest}} yrs</h1>
        <p class="lead">Youngest Rom</p>
      </div>
    </div>
<!-- Third column -->
    <div class="col">
      <div class="jumbotron">
        <h1 class="display-5">{{$village_records}}</h1>
        <p class="lead">Villages</p>
        <h1 class="display-5">{{$village_roms}}</h1>
        <p class="lead">Villages with Roms</p>
        <h1 class="display-5">{{$village_nroms}}</h1>
        <p class="lead">Villages without Roms</p>

      </div>
    </div>
    <!-- Fourth column -->
        <div class="col">
          <div class="jumbotron">
            <h1 class="display-5">{{$social_records}}</h1>
            <p class="lead">Social Classes</p>
            <h1 class="display-5">{{$skill_records}}</h1>
            <p class="lead">Jobs</p>
            <h1 class="display-5">{{$source_records}}</h1>
            <p class="lead">Sources</p>
          </div>
        </div>
<!--End row -->
    </div>
<!-- End container -->
</div>
