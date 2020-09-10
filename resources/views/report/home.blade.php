

<div class="container">
  <div class="row">
    <div class="col">
      <h1 class="display-4">Maprom database</h1>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="jumbotron">
        <h2 class="display-4"><strong>{{$roms}}/{{$romstotal}}</strong></h2>
        <p class="lead">Romani Households/Total Rom individuals</p>
        <h2 class="display-4">{{$household_records}}/{{$total}}</h2>
        <p class="lead">Households/Total individuals</p>

      </div>


    </div>
    <div class="col">
      <div class="jumbotron">
        <h3 class="display-5">{{$ext_stats}} %</h3>
        <p class="lead">Extended households</p>
        <h3 class="display-5">{{$single_stats}} %</h3>
        <p class="lead">Single households</p>
        <h3 class="display-5">{{$avg}}</h3>
        <p class="lead">Average householdssize</p>
        <h3 class="display-5">{{$avg_min}} to {{$avg_max}}</h3>
        <p class="lead">Range householdssize</p>
        <h3 class="display-5">{{$oldest}} yrs</h3>
        <p class="lead">Oldest Rom</p>

      </div>
    </div>
<!-- Third column -->
    <div class="col">
      <div class="jumbotron">
        <h3 class="display-5">{{$district_records}}</h3>
        <p class="lead">Districts</p>
        <h3 class="display-5">{{$county_records}}</h3>
        <p class="lead">Sub-districts</p>
        <h3 class="display-5">{{$village_records}}</h3>
        <p class="lead">Villages</p>
        <h3 class="display-5">{{$village_roms}}</h3>
        <p class="lead">Villages with Roms</p>
        <h3 class="display-5">{{$village_nroms}}</h3>
        <p class="lead">Villages without Roms</p>

      </div>
    </div>
    <!-- Fourth column -->
        <div class="col">
          <div class="jumbotron">
            <h3 class="display-5">{{$social_records}}</h3>
            <p class="lead">Social Classes</p>
            <h3 class="display-5">{{$skill_records}}</h3>
            <p class="lead">Jobs</p>
            <h3 class="display-5">{{$source_records}}</h3>
            <p class="lead">Sources</p>
          </div>
        </div>
<!--End row -->
    </div>
<!-- End container -->
</div>
