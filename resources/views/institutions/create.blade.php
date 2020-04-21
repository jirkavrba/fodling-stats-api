@extends('layout.master')

@section('main')
    <section class="section">
        <div class="row">
            <div class="col s12 m8 offset-m2 l6 offset-l3">
                <h4 class="center-align">Add a new institution</h4>

                <div class="card-panel">
                    <form action="{{ route('institutions.store') }}" method="post">
                        @csrf
                        <div class="input-field">
                            <label for="name">Institution name</label>
                            <input type="text" name="name" id="name" required>
                        </div>
                        <div class="input-field">
                            <label for="logo">Institution logo (URL)</label>
                            <input type="text" name="logo" id="logo" required>
                        </div>
                        <div>
                            <label for="color">Institution color</label>
                            <br>
                            <input type="color" class="btn" name="color" id="color" required>
                        </div>

                        <div class="input-field">
                            <button class="btn btn-lg">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
