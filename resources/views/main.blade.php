<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
        <link href="/css/styles.min.css" rel="stylesheet">

        <!-- Styles -->

    </head>
    <body style="height: 100vh;">
    <div>
        <nav class="navbar navbar-light navbar-expand-md navigation-clean">
            <div class="container"><a class="navbar-brand" href="#">Weer Vergelijken</a><button class="navbar-toggler" data-toggle="collapse"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button></div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xl-6" style="padding: 57px;padding-bottom: 0px;height: 91vh;"><img class="rounded-circle" style="margin-right: auto;margin-left: auto;height: 135px;display: block;" src="/img/252035.png">
                    <form style="margin-top: 0;padding: 0px;text-align: center;">
                        <div class="form-group" style="margin: 0px;margin-top: 157px;"><input class="form-control" type="text" placeholder="Plaats 1" style="text-align: center;"><input class="form-control" type="text" placeholder="Plaats 2" style="text-align: center;"><button class="btn btn-primary" type="submit"
                                style="padding: 9px;margin: 68px;height: 49px;width: 108px;margin-top: 19px;" formaction="#weer">Vergelijken&nbsp;</button></div>
                    </form>
                </div>
                <div class="col col-md-6 col-xl-6" id="weer">
                    <div class="row" style="padding: 0px;height: 600px;">
                        <div class="col-12" style="width: 240px;">
                            <h3 class="text-center">Resultaten</h3>
                        </div>
                        <div class="col" style="margin-top: 50px;margin-bottom: 100px;background-color: rgba(255,5,5,0);">
                            <h4 style="color: rgb(52,130,208);">Gorredijk</h4>
                            <p>&gt; 20°<br></p>
                            <p>&gt; Zonnig</p>
                        </div>
                        <div class="col" style="margin-top: 50px;height: 128px;background-color: rgba(0,148,255,0);">
                            <h4 style="color: rgb(255,10,10);">Heerenveen</h4>
                            <p>&gt; 10°<br></p>
                            <p style="height: 116;">&gt; Regen</p>
                        </div>
                        <div class="col">
                            <h3 class="text-center">Grafiek</h3>
                            <div style="height: 100&amp;;"><canvas data-bs-chart="{&quot;type&quot;:&quot;line&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;00:00&quot;,&quot;04:00&quot;,&quot;08:00&quot;,&quot;12:00&quot;,&quot;16:00&quot;,&quot;20:00&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Gorredijk&quot;,&quot;fill&quot;:true,&quot;data&quot;:[&quot;11&quot;,&quot;13&quot;,&quot;23&quot;,&quot;18&quot;,&quot;20&quot;,&quot;20&quot;],&quot;backgroundColor&quot;:&quot;rgba(0,71,255,0.1)&quot;,&quot;borderColor&quot;:&quot;#0486ff&quot;},{&quot;label&quot;:&quot;Heerenveen&quot;,&quot;fill&quot;:true,&quot;data&quot;:[&quot;11&quot;,&quot;32&quot;,&quot;34&quot;,&quot;18&quot;,&quot;19&quot;,&quot;10&quot;],&quot;backgroundColor&quot;:&quot;rgba(255,0,0,0.07)&quot;,&quot;borderColor&quot;:&quot;#ff0000&quot;}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:true,&quot;legend&quot;:{&quot;display&quot;:false},&quot;title&quot;:{}}}"></canvas></div>
                        </div>
                    </div>
                </div>
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
