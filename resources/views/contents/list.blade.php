@extends('layouts.master')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="alert alert-primary">
        Latest 10 Household entries
    </div>
    <table  id ="example" class="table table-sm table-striped table-bordered" style="width:100%" >
        <thead>
        <tr>
            <th data-toggle="tooltip" data-placement="top" title="Unique (Maprom)database Id">Id.</th>
            <th data-toggle="tooltip" data-placement="top" title="Registered to House Nr.">House Nr.</th>
            <th data-toggle="tooltip" data-placement="top" title="Head of household">Name</th>
            <th data-toggle="tooltip" data-placement="top" title="Surname of Household">Surname</th>
            <th data-toggle="tooltip" data-placement="top" title="Gender of Household">Gender</th>
            <th data-toggle="tooltip" data-placement="top" title="Age of Household">Age</th>
            <th data-toggle="tooltip" data-placement="top" title="Civilstatus of Household">Civilstatus</th>
            <th data-toggle="tooltip" data-placement="top" title="Nationality of Household head">Nationality</th>
            <th data-toggle="tooltip" data-placement="top" title="Fiscal status of Household">Fiscal</th>
            <th data-toggle="tooltip" data-placement="top" title="View or edit registered data with action buttons">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach( $households as $household )
            <tr>
                <td>{{ $household->id }}</td>
                <td>{{ $household->number }}</td>
                <td><a href="{{ route('household_detail', ['household_id'=>$household->id ]) }}">{{ $household->name}}</a></td>
                <td>{{ $household->surname }}</td>
                <td>{{ $household->gender }}</td>
                <td>{{ $household->age }}</td>
                <td>{{ $household->civilstatus }}</td>
                <td>{{ $household->nationality }}</td>
                <td>{{ $household->fiscal }}</td>
                <td class="text-center">
                    <a href="{{ route('household_detail', ['household_id'=>$household->id ]) }}" class="btn btn-outline-success btn-sm"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('show_household', ['household_id'=>$household->id ]) }}" class="btn btn-outline-primary btn-sm"><i class="far fa-edit"></i></a>
                @can('isAdmin')
                    <a class="btn btn-danger btn-sm" href="{{ route('del_household', ['household_id'=>$household->id ]) }}"><i class="far fa-trash-alt"></i></a>
                 @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection