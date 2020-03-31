<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
        <link href="../css/styles.min.css" rel="stylesheet">

        <!-- Styles -->

    </head>
    <body style="height: 100vh;">
    <div>

        <nav class="navbar navbar-light navbar-expand-md navigation-clean">
            <div class="container"><a class="navbar-brand" href="#">Weer Vergelijken</a><button class="navbar-toggler" data-toggle="collapse"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button></div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xl-6" style="padding: 57px;padding-bottom: 0px;height: 91vh;"><img class="rounded-circle" style="margin-right: auto;margin-left: auto;height: 135px;display: block;" src="https://imageog.flaticon.com/icons/png/512/252/252035.png?size=1200x630f&pad=10,10,10,10&ext=png&bg=FFFFFFFF">
                    
                    
                    <form style="margin-top: 0;padding: 0px;text-align: center;" action="/" method="post">

                        <div class="form-group" style="margin: 0px;margin-top: 157px;">
                            @if($errors->any())
                            <div class="p-3 mb-2 bg-danger text-white">{{$errors->first()}}</div>
                            @endif
                            @csrf

                            <input class="form-control" type="text" name="plaats1" placeholder="Plaats 1" style="text-align: center;">
                            <input class="form-control" type="text" name="plaats2" placeholder="Plaats 2" style="text-align: center;">
                            <button class="btn btn-primary" type="submit" style="padding: 9px;margin: 68px;height: 49px;width: 108px;margin-top: 19px;">Vergelijken</button></div>
                    </form>
                </div>
                @isset($data)

                <div class="col col-md-6 col-xl-6" id="weer">
                    <div class="row" style="padding: 0px;height: 600px;">
                        <div class="col-12" style="width: 240px;">
                            <h3 class="text-center">Resultaten</h3>
                        </div>
                        @foreach($data['data'][1]['Recent'] as $location => $data)
                        <div class="col" style="margin-top: 50px;margin-bottom: 100px;background-color: rgba(255,5,5,0);">
                            <h4 style="color: rgb(52,130,208);">{{$location}}</h4>
                            <p>Temperatuur  {{$data['temp']}}<br></p>
                            <p>Kans op regen: {{$data['rainChance']}}%</p>
                            <p>Tijd: {{$data['dateTime']}}</p>
                        </div>
                       
                        @endforeach
                        <div class="col">
                            <h3 class="text-center">Grafiek</h3>
                            <div style="height: 100&amp;;"><canvas data-bs-chart=""></canvas></div>
                        </div>
                    </div>
                </div>

                @endisset
            </div>
        </div>
    </div>
    <div class="footer-basic">
        <footer>
            <p class="copyright">Weer Vergelijken © 2020</p>
        </footer>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="js/script.min.js"></script>

</body>
</html>
