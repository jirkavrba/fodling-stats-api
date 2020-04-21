@extends('layout.master')

@section('main')
    <section class="section">
        <div class="card-panel teal lighten-5">
            The database currently contains a total of <b>{{ $institutions->count() }} institutions</b> with
            <b>{{ $teams }} registered teams.</b>
        </div>
    </section>
    <section class="section">
        <div class="row">
            <div class="col s12">
                <h4>Registered institutions</h4>
                <a class="btn btn-lg" href="{{ route('institutions.create') }}">Add a new institution</a>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
            </div>

            @foreach ($institutions as $institution)
                <div class="col s12 m6 l4">
                    <div class="card">
                        <div class="card-content">
                            <img class="circle right" src="{{ $institution->logo }}" alt="logo" width="64px" height="64px">
                            <p class="card-title">{{ $institution->name }}</p>
                            <div class="chip white-text" style="background-color: {{ $institution->color }}">{{ $institution->color }}</div>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('institutions.show', $institution) }}" class="black-text">Details</a>
                            <a href="{{ route('institutions.edit', $institution) }}" class="black-text">Edit</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
