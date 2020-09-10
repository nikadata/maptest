<!DOCTYPE html>
<html data-whatinput="keyboard" data-whatintent="keyboard" class=" whatinput-types-initial whatinput-types-keyboard"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
        <title>Maprom project</title>
      </head>
        <body>
      <table class="stack">
          <thead>
            <tr>
              <th width="200">{{ $today }}</th>
            </tr>

            <tr>

              <th width="75">Firstname</th>
              <th width="100">Lastname</th>
              <th width="100">Age</th>
              <th width="100">Nationality</th>
              <th width="100">Taxpayer</th>
              <th width="100">Village</th>
              <th width="100">Socialclass</th>
              <th width="100">Skill</th>
              <th width="100">Source</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $clients as $client )
              <tr>

                <td> {{ $client->name}} </td>
                <td> {{ $client->last_name}}</td>
                <td>{{ $client->age }}</td>
                <td>{{ $client->nationality }} </td>
                <td> {{ $client->taxpayer}} </td>
                <td> {{ $client->village_name}}</td>
                <td>{{ $client->social_name }}</td>
                <td> {{ $client->skill_name}}</td>
                <td>{{ $client->source_name }}</td>
              </tr>
              @endforeach

                      </tbody>
  </body>
</html>
