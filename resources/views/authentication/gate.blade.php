@extends('layout.master')

@section('main')
    <section class="section">
        <div class="row">
            <div class="col s12">
                <h1 class="center-align">Login</h1>
                <div class="row">
                    <div class="col s12 m6 offset-m3">
                        <div class="card-panel">
                            <form action="{{ route('authentication.login') }}" method="post">
                                @csrf
                                <div class="input-field">
                                    <label for="username">Username</label>
                                    <input id="username" type="text" name="username" required>
                                </div>
                                <div class="input-field">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" name="password" required>
                                </div>

                                <button class="btn btn-lg btn-block">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

