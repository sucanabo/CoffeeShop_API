<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Koffeeholic.com</title>
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>
<body>
    <header>
        <div class ="logo">
            <img src="{{URL::to('/img/koffeeholic_rounded.png')}}" alt="">
        </div>
    </header>
        <section class="main-body">
            @if($message == 'Success')
                <div class="form-container">
                    <form action="{{URL::to('/api/password/reset')}}" id="password-form" method="POST">
                        @csrf  
                        <label class="title" for="password">Please enter new password.</label>
                        <input type="password" id="password" placeholder="Password" minlength="6" maxlength="30" required="" name="password">
                        <input type="hidden" name="token" value="{{$token}}">
                        <input id="submit-password" type="submit" value="Confirm">
                    </form>
                </div>
            @else
                <p>{{$message}}</p>
            @endif
        </section>
    <footer><p class="copy-right">Copyright © Koffeeholic All rights reserved.</p></footer>
</body>

</html>