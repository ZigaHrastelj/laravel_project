<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{ url('/main.css') }}" />
</head>
<body>
    <h1>Edit Badge</h1>
    <div class="header">
        <div style="float: right;">
            <form action="/logout" method="POST">
                @csrf
                <button>Odjava</button>
            </form>
        </div>
        <div  style="float: right; font-family: 'Lucida Sans';" >{{auth()->user()->name}}</div>
        <div style="float: right"><img src="/images/userImg.png" style="height: 140%;"></div>
        <div style="float: left;">
            <button class="btn">Zemljevid</button>
        </div>
        <div style="float: left;">
            @if(auth()->user()->option == 'Student')
            <form action="/allP" method="POST">
                @csrf
                <button class="btn">Vse naloge</button>
            </form>
            @endif
        </div>
        <div style="float: left;">
            <form action="/graph" method="POST">
                @csrf
                <button class="btn">Vaši podatki</button>
            </form>
        </div>
    
        @if (auth()->user()->option != 'Student')
        <div style="float: left">
        <form action="/allData" method="POST">
            @csrf
            <button class="btn">Vsi podatki</button>
        </form>
        </div>
        <div style="float: left">
        <form action="/badges" method="POST">
            @csrf
            <button class="btn">Ustvari/dodeli znamko</button>
        </form>
        </div>
        @endif
        </div>
    <form action="/edit-badge/{{$badge->id}}" method="POST">
        @csrf
        @method('PUT')
        <input type="file" name="slika" value="{{$badge->slika}}" />
        <input type="text" name="pogoj" value="{{$badge->pogoj}}">
        <input type="text" name="ponovitev" value="{{$badge->ponovitev}}">
        <input type="text" name="badgeCount" value="{{$badge->badgeCount}}">
        <button>Save Changes</button>
    </form>
</body>
</html>