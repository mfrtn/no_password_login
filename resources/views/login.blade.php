<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>

<body>
    <div class="container">

        <form method="POST" class="form-signin">
            @csrf

            <h2 class="form-signin-heading">Please Sign in</h2>
            <label for="inputEmail" class="sr-only">Email Address</label>

            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address"
                required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>

        @error('email')
            <p>
                {{ $message }}
            </p>
        @enderror

    </div> <!-- /container -->
</body>

</html>
