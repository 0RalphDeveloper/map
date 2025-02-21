<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div style="text-align: center;">
    <h1 >PLANT SCHEDULER CREATE</h1>

            @if(session('error'))
                <div>
                    {{ session('error') }}
                </div>
            @endif

            @if(session()->has('success'))
                {{session()->get('success')}}
                @endif

                <form action="{{route('createstore')}}" method = POST enctype="multipart/form-data">
                    @csrf

                    <div>
                        <label for="username">Username: </label>
                        <input type="text" name="username">
                        @error('username')
                        <span>{{$message}}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="email">Email: </label>
                        <input type="text" name="email">
                        @error('email')
                        <span>{{$message}}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="password">Password: </label>
                        <input type="text" name="password">
                        @error('password')
                        <span>{{$message}}</span>
                        @enderror
                    </div>

                    <div>
                        <input type="submit" name="submit" value="Submit">
                    </div>

        </form>
</div>
</body>
</html>