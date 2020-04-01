<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
        <link href="../css/styles.min.css" rel="stylesheet">

        <!-- Styles -->

    </head>
    <body style="height: 100vh;">
    <div>

        <nav class="navbar navbar-light navbar-expand-md navigation-clean">
            <div class="container"><a class="navbar-brand" href="#">Weer Vergelijken</a>
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
                            <h5 class="text-center">Resultaten</h5>
                        </div>
                        @foreach($data['data'][1]['Recent'] as $location => $d)
                        <div class="col " style="margin-right:1px; margin-bottom: 100px; background-color: rgba(255,5,5,0);">
                            <h4 style="color: rgb(52,130,208);">{{$location}}</h4>
                            <p>Temperatuur: {{$d['temp']}}&#8451;   <br></p>
                            <p>Kans op regen: {{$d['rainChance']}}%</p>
                            <p>Tijd van data: {{$d['dateTime']}}</p>
                        </div>
                       
                        @endforeach
                        <!-- Grafieken -->

                        <div class="row">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                              <li class="nav-item">
                                <a class="nav-link active" id="temp-tab" data-toggle="tab" href="#temp" role="tab" aria-controls="temp" aria-selected="true">Temperatuur</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Neerslag</a>
                              </li>
                                <li class="nav-item">
                                <a class="nav-link disabled" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">40 uur</a>
                              </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                              <div class="tab-pane fade show active" id="temp" role="tabpanel" aria-labelledby="temp-tab">
                                <div class="col ">
                                    <canvas id="myChart" width="400" height="400"></canvas>
                                    <script>
                                    var ctx = document.getElementById('myChart').getContext('2d');
                                    var myChart = new Chart(ctx, {
                                        type: 'line',
                                        data: 
                                        {

                                            labels: [
                                            @foreach($data['data'][0]['History']['40'] as $loc => $d)
                                                @foreach($data['data'][0]['History']['40'][$loc] as $labels)
                                                      '{{$labels['dateTime']}}',       
                                                @endforeach
                                                @break
                                            @endforeach
                                            ],
                                            datasets: [
                                            @foreach($data['data'][0]['History']['40'] as $location => $d)
                                            {
                                                label: "{{$location}}",
                                                data: 
                                                [
                                                @foreach($data['data'][0]['History']['40'][$location] as $hdata)
                                                {{$hdata['temp']}},
                                                @endforeach
                                                ],
                                                backgroundColor: [
                                                    '{{$data[0][$location]}} 0.2)',
                                                ],
                                                borderColor: [
                                                    '{{$data[0][$location]}} 1)',
                                                ],
                                                borderWidth: 1
                                            },
                                            @endforeach
                                            ]
                                        },
                                        options: {
                                            scales: {
                                                yAxes: [{
                                                    ticks: {
                                                        beginAtZero: true
                                                    },
                                                    scaleLabel: {
                                                        display: true,
                                                        fontSize: 14,
                                                        labelString: "Temperatuur in Celcius",
                                                    }   
                                                
                                                }],
                                                xAxes: [{
                                                    scaleLabel: {
                                                        display: true,
                                                        fontSize: 14,
                                                        labelString: "Tijdstempel",
                                                    }   
                                                
                                                }]
                                            },
                                            title: {
                                                display: true,
                                                text: 'Temperatuur gegevens'
                                            }
                                        }
                                    });
                                    </script>
                                </div>
                              </div>
                              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="col" style="width:400px; height: 400px;">
                                    <canvas id="myChart2" width="400" height="400"></canvas>
                                     <script>
                                    var ctx = document.getElementById('myChart2').getContext('2d');
                                    var myChart = new Chart(ctx, {
                                        type: 'line',
                                        data: 
                                        {

                                            labels: [
                                            @foreach($data['data'][0]['History']['40'] as $loc => $d)
                                                @foreach($data['data'][0]['History']['40'][$loc] as $labels)
                                                      '{{$labels['dateTime']}}',       
                                                @endforeach
                                                @break
                                            @endforeach
                                            ],
                                            datasets: [
                                            @foreach($data['data'][0]['History']['40'] as $location => $d)
                                            {
                                                label: "{{$location}}",
                                                data: 
                                                [
                                                @foreach($data['data'][0]['History']['40'][$location] as $hdata)
                                                {{$hdata['rainChance']}},
                                                @endforeach
                                                ],
                                                backgroundColor: [
                                                    '{{$data[0][$location]}} 0.2)',
                                                ],
                                                borderColor: [
                                                    '{{$data[0][$location]}} 1)',
                                                ],
                                                borderWidth: 1
                                            },
                                            @endforeach
                                            ]
                                        },
                                        options: {
                                            scales: {
                                                yAxes: [{
                                                    ticks: {
                                                        beginAtZero: true
                                                    },
                                                    scaleLabel: {
                                                        display: true,
                                                        fontSize: 14,
                                                        labelString: "Neerslagkans in %",
                                                    }   
                                                
                                                }],
                                                xAxes: [{
                                                    scaleLabel: {
                                                        display: true,
                                                        fontSize: 14,
                                                        labelString: "Tijdstempel",
                                                    }   
                                                
                                                }]
                                            },
                                            title: {
                                                display: true,
                                                text: 'Neerslag gegevens'
                                            }
                                        }
                                    });
                                    </script>                            
                                </div>
                              </div>

                            </div>
                           
                        </div>
                        <div class="row">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                              <li class="nav-item">
                                <a class="nav-link active" id="temp1-tab" data-toggle="tab" href="#temp1" role="tab" aria-controls="temp" aria-selected="true">Temperatuur</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="profile1-tab" data-toggle="tab" href="#profile1" role="tab" aria-controls="profile" aria-selected="false">Neerslag</a>
                              </li>
                                <li class="nav-item">
                                <a class="nav-link disabled" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">80 uur</a>
                              </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                              <div class="tab-pane fade show active" id="temp1" role="tabpanel" aria-labelledby="temp1-tab">
                                <div class="col ">
                                    <canvas id="myChart3" width="400" height="400"></canvas>
                                    <script>
                                    var ctx = document.getElementById('myChart3').getContext('2d');
                                    var myChart = new Chart(ctx, {
                                        type: 'line',
                                        data: 
                                        {

                                            labels: [
                                            @foreach($data['data'][0]['History']['80'] as $loc => $d)
                                                @foreach($data['data'][0]['History']['80'][$loc] as $labels)
                                                    @if($loop->index % 2 == 0)
                                                          '{{$labels['dateTime']}}',
                                                    @endif       
                                                @endforeach
                                                @break
                                            @endforeach
                                            ],
                                            datasets: [
                                            @foreach($data['data'][0]['History']['80'] as $location => $d)
                                                
                                                {
                                                    label: "{{$location}}",
                                                    data: 
                                                    [
                                                    @foreach($data['data'][0]['History']['80'][$location] as $hdata)
                                                    @if($loop->index % 2 == 0)
                                                    {{$hdata['temp']}},
                                                    @endif
                                                    @endforeach
                                                    ],
                                                    backgroundColor: [
                                                        '{{$data[0][$location]}} 0.2)',
                                                    ],
                                                    borderColor: [
                                                        '{{$data[0][$location]}} 1)',
                                                    ],
                                                    borderWidth: 1
                                                },
                                                
                                            @endforeach
                                            ]
                                        },
                                        options: {
                                            scales: {
                                                yAxes: [{
                                                    ticks: {
                                                        beginAtZero: true
                                                    },
                                                    scaleLabel: {
                                                        display: true,
                                                        fontSize: 14,
                                                        labelString: "Temperatuur in Celcius",
                                                    }   
                                                
                                                }],
                                                xAxes: [{
                                                    scaleLabel: {
                                                        display: true,
                                                        fontSize: 14,
                                                        labelString: "Tijdstempel",
                                                    }   
                                                
                                                }]
                                            },
                                            title: {
                                                display: true,
                                                text: 'Temperatuur gegevens'
                                            }
                                        }
                                    });
                                    </script>
                                </div>
                              </div>
                              <div class="tab-pane fade" id="profile1" role="tabpanel" aria-labelledby="profile1-tab">
                                <div class="col" style="width:400px; height: 400px;">
                                    <canvas id="myChart4" width="400" height="400"></canvas>
                                     <script>
                                    var ctx = document.getElementById('myChart4').getContext('2d');
                                    var myChart = new Chart(ctx, {
                                        type: 'line',
                                        data: 
                                        {

                                            labels: [
                                            @foreach($data['data'][0]['History']['80'] as $loc => $d)
                                                @foreach($data['data'][0]['History']['80'][$loc] as $labels)
                                                    @if($loop->index % 2 == 0)
                                                      '{{$labels['dateTime']}}',     
                                                    @endif
                                                @endforeach
                                                @break
                                            @endforeach
                                            ],
                                            datasets: [
                                            @foreach($data['data'][0]['History']['80'] as $location => $d)
                                                {
                                                    label: "{{$location}}",
                                                    data: 
                                                    [
                                                    @foreach($data['data'][0]['History']['80'][$location] as $hdata)
                                                        @if($loop->index % 2 == 0)
                                                        {{$hdata['rainChance']}},
                                                        @endif
                                                    @endforeach
                                                    ],
                                                    backgroundColor: [
                                                        '{{$data[0][$location]}} 0.2)',
                                                    ],
                                                    borderColor: [
                                                        '{{$data[0][$location]}} 1)',
                                                    ],
                                                    borderWidth: 1
                                                },
                                                
                                            @endforeach
                                            ]
                                        },
                                        options: {
                                            scales: {
                                                yAxes: [{
                                                    ticks: {
                                                        beginAtZero: true
                                                    },
                                                    scaleLabel: {
                                                        display: true,
                                                        fontSize: 14,
                                                        labelString: "Neerslagkans in %",
                                                    }   
                                                
                                                }],
                                                xAxes: [{
                                                    scaleLabel: {
                                                        display: true,
                                                        fontSize: 14,
                                                        labelString: "Tijdstempel",
                                                    }   
                                                
                                                }]
                                            },
                                            title: {
                                                display: true,
                                                text: 'Neerslag gegevens'
                                            }
                                        }
                                    });
                                    </script>                            
                                </div>
                              </div>

                            </div>
                           
                        </div>
                    </div>

                </div>
                @endisset
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="js/script.min.js"></script>

</body>
</html>
