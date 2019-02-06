<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
        <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>
                <div class="container">
                    <form action="{{ URL::route('score') }}" method="POST">
                        @csrf
                        <label>Enter Github Username</label>
                        <input type="text" name="username" />
                        <button type="submit">Check Score</button>
                    </form><br>
                    @if(isset($scores))
                    <h3>Score Table</h3>
                    <div class="table-responsive m-t-40">
                    <table id="score" class="display table table-hover table-striped table-bordered score">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Events</th>
                                <th>Point</th>
                                <th>Event Count</th>
                                <th>Total Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($scores as $key => $score)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $score['name'] }}</td>
                                <td>{{ $score['point'] }} </td>
                                <td>{{ $score['count'] }}</td>
                                <td>{{ $score['point'] * $score['count'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script>
                $(document).ready( function () {
                    $('#score').DataTable();
                } );
        </script>
    </body>
</html>
