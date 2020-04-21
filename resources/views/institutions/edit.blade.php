@extends('layout.master')

@section('main')
    <section class="section">
        <div class="row">
            <div class="col s12 m8 offset-m2 l6 offset-l3">
                <h4 class="center-align">Edit institution</h4>

                <div class="card-panel">
                    <form action="{{ route('institutions.update', $institution) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="input-field">
                            <label for="name">Institution name</label>
                            <input type="text" name="name" id="name" required value="{{ $institution->name }}">
                        </div>
                        <div class="input-field">
                            <label for="logo">Institution logo (URL)</label>
                            <input type="text" name="logo" id="logo" required value="{{ $institution->logo }}">
                        </div>
                        <div>
                            <label for="color">Institution color</label>
                            <br>
                            <input type="color" class="btn" name="color" id="color" required
                                   value="{{ $institution->color }}">
                        </div>

                        <div class="input-field">
                            <button class="btn btn-lg">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col s12 m8 offset-m2 l6 offset-l3">
                <h4 class="center-align">Remove institution</h4>

                <div class="card-panel">
                    <form action="{{ route('institutions.destroy', $institution) }}" method="post">
                        @csrf
                        @method('delete')
                        <div class="input-field">
                            <label for="name">Type in <b>{{ $institution->name }}</b> for confirmation</label>
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
@endsection
