<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href='img/bookingcare-apple-touch-icon.png'>
    <title>Login | BookingCare</title>
</head>

<body>
    <style>
        body {}

        .login-container {
            width: 260px;
            margin: 100px auto 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 20px 30px 20px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.11), 0 2px 2px rgba(0, 0, 0, 0.11), 0 4px 4px rgba(0, 0, 0, 0.11), 0 6px 8px rgba(0, 0, 0, 0.11), 0 8px 16px rgba(0, 0, 0, 0.11);
        }

        .login-container a {
            width: 150px;
            height: 60px;
        }

        .login-container a img {
            width: 100%;
            height: 100%;
        }

        h1 {
            font-size: 20px;
            color: rgb(76, 76, 76) !important;
            margin: 15px 0;
            font-weight: 500;
        }

        label {
            display: block;
            font-size: 16px;
        }

        input {
            display: block;
            background-color: #fff !important;
            border-color: #bbb;
            width: 96%;
            height: 36px;
            margin: 12px 0 8px 0;
            padding: 0 2%;
            border-radius: 5px;
            border: 1px solid #bbb;
        }

        input:-webkit-autofill,
        input:-webkit-autofill:focus {
            transition: background-color 600000s 0s, color 600000s 0s;
        }


        form a {
            color: #777;
            text-decoration: underline;
        }

        form button {
            margin-top: 25px;
            background-color: #49BCE2;
            text-align: center;
            color: white;
            width: 100%;
            border: none;
            border-radius: 5px;
            padding: 10px 0;
            font-size: 16px;
        }
    </style>
    <div class="login-container">
        <a href=""><img src="img/logo.svg" alt=""></a>
        <h1>Hello, who’s this?</h1>
        <form action='/login' method="POST">
            {{ csrf_field() }}
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p style="color: red">{{ $error }}</p>
                @endforeach
            @endif
            @if (Session::has('error'))
                <p style="color: red">{{ Session::get('error') }}</p>
            @endif
            <label for="email">Email</label>
            <input type="email" placeholder="bruce@wayne.com" name="email">
            @error('email')
                <p style="color: red">{{ $message }}</p>
            @enderror
            <label for="password">Password</label>
            <input type="password" placeholder="At least 8 character" name="password">
            @error('password')
                <p style="color: red">{{ $message }}</p>
            @enderror
            <a href="">Forgot password?</a>
            <button type="submit">Login to BookingCare</button>
        </form>
    </div>
</body>

</html>
