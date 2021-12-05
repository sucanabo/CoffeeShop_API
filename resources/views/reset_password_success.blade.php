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
            @if( $message == 'Success')
                <div class="form-container">
                    <p class="title-success">
                        Password has changed.
                        <br>
                        Please sign in on app.
                    </p>
                    <svg width="72" height="72" viewBox="0 0 72 72" xmlns="http://www.w3.org/2000/svg">
                        <g fill="none" fill-rule="evenodd">
                          <circle cx="36" cy="36" r="36" fill="#F7BF4F"></circle>
                          <path d="M53.184 27.77L31.762 49.192 18.279 36.32" stroke="#FFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="6"></path>
                        </g>
                      </svg>
                </div>
             @else
                <p>{{$message}}</p>
            @endif
        </section>
    <footer><p class="copy-right">Copyright © Koffeeholic All rights reserved.</p></footer>
</body>

</html>