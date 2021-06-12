<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <!-- Styles -->
        

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="container">
                

                <div class="mt-8 row">
                    @if(session('success_message'))
                    <div class="alert alert-success">{{session('success_message')}}</div>
                    @endif
                    @if(session('error_message'))
                    <div class="alert alert-danger"><strong>Error! </strong>{{session('error_message')}}</div>
                    @endif
                    <div class="col-md-12">
                        <strong>Note:</strong>
                        Each of the matrix elements should be seperated by a comma, example: 2, 3, 4
                    </div>
                    <hr>
                    <div class="col-md-4">
                        <form method="post" action="/matrix/add">
                            @csrf
                            <div class="form-group">
                                <label for="matrix_a">Matrix A</label>
                                <input id="matrix_a" type="text" name="matrix_a" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Add</button>
                        </form>
                        <strong>Elements of Matrix A: </strong> <br>
                        @if(session()->has('matrix_a'))
                        @json(session('matrix_a'))
                        @endif
                    </div>
                    <div class="col-md-4">
                        <form method="post" action="/matrix/add" class="form-inline">
                            @csrf
                                <label for="matrix_b">Matrix B</label>
                                <input id="matrix_b" type="text" name="matrix_b" class="form-control" style="dis">
                            <button type="submit" class="btn btn-primary mt-2">Add</button>

                        </form>
                        <strong>Elements of Matrix B: </strong> <br>
                        @if(session()->has('matrix_b'))
                        @json(session('matrix_b'))
                        @endif
                    </div>
                    @if(session('result'))
                    <div class="col-md-4">
                        <label><strong>Result:</strong></label> <br>
                        @json(session('result'))
                    </div>
                    @endif

                </div>
                <div class="row">
                    <div class="col-md-4 offset-4">
                        <form style="display: inline;" method="post" action="/matrix/clear">
                            @csrf
                            
                            <button type="submit" class="btn btn-secondary mt-2">Clear Matrices</button>
                        </form>
                        <form style="display: inline;" method="post" action="/matrix/multiplication">
                            @csrf
                            <button type="submit" class="btn btn-primary mt-2">Calculate</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
