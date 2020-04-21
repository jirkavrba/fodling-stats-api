@extends('layout.master')

@section('main')
    <section class="section">
        <div class="row">
            <div class="col s12 m8 offset-m2 l6 offset-l3">
                <h4 class="center-align">Add a new team to {{ $institution->name }}</h4>

                <div class="card-panel">
                    <form action="{{ route('institutions.teams.store', $institution) }}" method="post">
                        @csrf
                        <div class="input-field">
                            <label for="name">Team name</label>
                            <input type="text" name="name" id="name" required>
                        </div>
                        <div class="input-field">
                            <label for="folding_id">Team folding ID</label>
                            <input type="number" name="folding_id" id="folding_id" required>
                        </div>

                        <div class="input-field">
                            <select name="type" id="type" required>
                                <option value="team" selected>Team</option>
                                <option value="donor">Single donor</option>
                            </select>
                            <label for="type">Team type</label>
                        </div>

                        <div class="input-field">
                            <button class="btn btn-lg">Submit</button>
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
