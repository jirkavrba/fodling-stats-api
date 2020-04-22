@extends('layout.master')

@section('main')
    <section class="section">
        <div class="row">
            <div class="col s12 m8 offset-m2 l6 offset-l3">
                <div class="center-align">
                    <img src="{{ $institution->logo }}" alt="logo" class="circle" width="64px" height="64px">
                    <h5 class="center-align" style="color: {{ $institution->color }}">{{ $institution->name }}</h5>
                    <h4 class="center-align" style="color: {{ $institution->color }}">{{ $team->name }}</h4>

                    <div class="row">
                        <div class="col s12">
                            <div class="chip large">{{ strtoupper($team->type) }}</div>
                            <div class="chip large">{{ $team->folding_id }}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 center-align">
                        <a href="{{ route('institutions.teams.edit', [$institution, $team]) }}" class="btn btn-lg">Edit this
                            team</a>
                        <a href="https://stats.foldingathome.org/{{ $team->type }}/{{ $team->folding_id }}" target="_blank" class="btn btn-lg">View team at folding</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-content">
                        <div class="card-title center-align">Score history of {{ $institution->name }}</div>
                        @empty($results->all())
                            <div class="center-align">
                                <div class="chip">This team has no score results yet</div>
                            </div>
                        @else
                            <div class="collection">
                                @foreach($results as $result)
                                    <div class="collection-item">
                                        <div class="chip">{{ (new \Carbon\Carbon($result->datetime))->format('d.m.Y H:i') }}</div>
                                        <b>{{ $result->score }}</b>
                                    </div>
                                @endforeach
                            </div>
                        @endempty
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
