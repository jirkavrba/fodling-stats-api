@extends('layout.master')

@section('main')
    <section class="section">
        <div class="row">
            <div class="col s12 m8 offset-m2 l6 offset-l3">
                <h4 class="center-align">Edit team {{ $team->name }}</h4>


                <div class="card-panel red white-text">
                    Changing the team folding ID will reset its score history
                </div>

                <div class="card-panel">
                    <form action="{{ route('institutions.teams.update', [$institution, $team]) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="input-field">
                            <label for="name">Team name</label>
                            <input type="text" name="name" id="name" required value="{{ $team->name }}">
                        </div>

                        <div class="input-field">
                            <label for="folding_id">Team folding ID</label>
                            <input type="number" name="folding_id" id="folding_id" required
                                   value="{{ $team->folding_id }}">
                        </div>

                        <div class="input-field">
                            <select name="type" id="type" required>
                                <option value="team">Team</option>
                                <option value="donor" @if($team->type === 'donor') selected @endif>Single donor</option>
                            </select>
                            <label for="type">Team type</label>
                        </div>

                        <div class="input-field">
                            <button class="btn btn-lg">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col s12 m8 offset-m2 l6 offset-l3">
                <h4 class="center-align">Remove team</h4>

                <div class="card-panel">
                    <form action="{{ route('institutions.teams.destroy', [$institution, $team]) }}" method="post">
                        @csrf
                        @method('delete')
                        <div class="input-field">
                            <label for="name">Type in <b>{{ $team->name }}</b> for confirmation</label>
                            <input type="text" name="name" id="name" required>
                        </div>
                        <div class="input-field">
                            <button class="btn btn-lg red">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems, {});
        });
    </script>
@endsection
