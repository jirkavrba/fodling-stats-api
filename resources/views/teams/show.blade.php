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
                        <a href="{{ route('institutions.teams.edit', [$institution, $team]) }}" class="btn btn-lg">Edit
                            this
                            team</a>
                        <a href="https://stats.foldingathome.org/{{ $team->type }}/{{ $team->folding_id }}"
                           target="_blank" class="btn btn-lg">View team at folding</a>
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
                            <canvas id="chart"></canvas>

                            <link rel="stylesheet"
                                  href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
                            <script>
                                (function () {
                                    const context = document.getElementById('chart').getContext('2d');
                                    const chart = new Chart(context, {
                                        type: 'line',
                                        data: {
                                            labels: [
                                                @foreach ($team->results as $score)
                                                    "{{ $score->datetime }}",
                                                @endforeach
                                            ],
                                            datasets: [
                                                {
                                                    label: "{{ $team->name }}",
                                                    data: [
                                                        @foreach ($team->results as $score)
                                                            {{ $score->score }},
                                                        @endforeach
                                                    ],
                                                    fill: false,
                                                    borderColor: "{{ $team->institution->color }}"
                                                }
                                            ],
                                        }
                                })
                                    ;
                                })()
                            </script>
                        @endempty
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
