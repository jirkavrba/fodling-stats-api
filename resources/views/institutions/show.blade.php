@extends('layout.master')

@section('main')
    <section class="section">
        <div class="row">
            <div class="col s12 m8 offset-m2 l6 offset-l3">
                <div class="center-align">
                    <img src="{{ $institution->logo }}" alt="logo" class="circle" width="64px" height="64px">
                    <h4 class="center-align" style="color: {{ $institution->color }}">{{ $institution->name }}</h4>
                </div>

                <div class="row">
                    <div class="col s12 center-align">
                        <a href="{{ route('institutions.edit', $institution) }}" class="btn btn-lg">Edit this
                            institution</a>
                        <a href="{{ route('institutions.teams.create', $institution) }}" class="btn btn-lg">Add a new team</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-content">
                        <div class="card-title center-align">Teams registered under {{ $institution->name }}</div>

                        @empty($teams->all())
                            <div class="center-align">
                                <div class="chip">This institutions has no registered teams yet</div>
                            </div>
                        @else
                            <div class="collection">
                                @foreach($teams as $team)
                                    <a href="#!" class="collection-item">{{ $team->name }}</a>
                                @endforeach
                            </div>
                        @endempty
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
