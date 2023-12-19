<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <body style="background-color:rgb(203, 244, 253)">
    <link rel="stylesheet" type="text/css" href="{{ url('/main.css') }}" />
    <title>Document</title>
</head>
<body class="bodyOdgovori">
    <div class="header">
        <div style="float: right;">
            <form action="/logout" method="POST">
                @csrf
                <button>Odjava</button>
            </form>
        </div>
        <div  style="float: right; font-family: 'Lucida Sans';" >{{auth()->user()->name}}</div>
        <div style="float: right"><img src="/images/userImg.png" style="height: 140%;"></div>
        <a href="/" style="color: white; font-family: Lucida Sans; float: left; font-weight: bold; font-size: 20px; text-decoration: none">&nbsp; <-- &nbsp;</a>
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

    <div>
        <br><br><br>
        <h2>Odgovori</h2>
        <form action="/create-post" method="POST">
        @csrf
        <input type="text" name="title" placeholder="naslov">
        <br><br>
        <input type="text" name="ure" placeholder="stevilo ur ucenja">
        <br><br>
        <input type="text" name="fit" placeholder="stevilo vaj fitnesa">
        <br>
        <input type="text" name="check" placeholder="full name of image">

        <textarea name="body" placeholder="vsebina..."></textarea>

        <input type="hidden" name="parentPost" value={{$post->id}}>
        
        <button>Objavi</button>
        </form>
        <br>
    </div>
    
    <form action="/addPic" method="post" enctype="multipart/form-data">
        @csrf
        Izberite sliko za badge: 
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
      </form>


<div>
    <h1 style="text-align: center">Vsi odgovori</h1>

    @foreach($posts as $onepost)
    @if ($onepost->parentPost == $post->id)
    <div  class="postOdgovori" style="margin-left: 30px">
        
        <h3>{{$onepost['title']}} - {{$onepost->user->name}}</h3>
        {{'Stevilo ur ucenja: '}}
        {{$onepost['ure']}}
        {{'| Stevilo vaj fitnesa: '}}
        {{$onepost['fit']}} 
        <br><br>
        {{$onepost['body']}}
        <br><br>

        @php $a = './uploads'.'/'.$onepost['check'] @endphp
        @if(file_exists($a))
            <img src="/uploads/<?php echo $onepost['check']?>" width='30%' height='30%'><br>
        @endif

    </div>
    @endif
    @endforeach
    
</div>
</body>
</html>