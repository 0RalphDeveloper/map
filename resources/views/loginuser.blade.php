<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <div style="text-align: center;">
            <h1>PLANT SCHEDULER LOGIN</h1>
            <BR></BR>
            @if(session()->has('success'))
            {{session()->get('success')}}
            @endif
            
        @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
        @endif


            <form action="{{route('loginuser')}}" method = POST enctype="multipart/form-data">
                @csrf


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
    </div>
</body>
</html>


