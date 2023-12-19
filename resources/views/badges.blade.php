<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <body style="background-color:rgb(203, 244, 253)">
    <link rel="stylesheet" type="text/css" href="{{ url('/main.css') }}" />
    <title>Document</title>
</head>
<body>
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
        @endif
        
    </div>
    <br>
    <h1>Ustvari znamke</h1>
    <form action="/create-badge" method="POST">
        @csrf
        <input class="box" style="width:20%" type="file" name="slika" value="">
        <br><br>
        <input class="box" style="width:20%" type="text" name="pogoj" placeholder="pogoj">
        <br><br>
        <input class="box" style="width:20%" type="text" name="ponovitev" placeholder="ponovitve">
        <br><br>
        <input class="box" style="width:20%" type="text" name="badgeCount" placeholder="število obveznih odgovorov">
        <br><br>
        <input class="box" style="width:20%" type="text" name="points" placeholder="število točk">
        <br><br>
        <button>Shrani znamko</button>
    </form>
    <br>

    <form action="/addPic" method="post" enctype="multipart/form-data">
        @csrf
        Izberite sliko za badge: 
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
      </form>
      <br>
    <div>
        <h2>Vse znamke</h2>
        @foreach($badges as $badge)
        <img src="/uploads/<?php echo $badge['slika']?>" alt='Badge picture' width='30px' height='30px' style="border-radius:50%; border:2px solid rgb(60, 120, 70)" >
        {{$badge['pogoj'] }}
        {{$badge['ponovitev']}}
        {{$badge['points']}}
        {{$badge['id']}}
        <a href="/edit-badge/{{$badge->id}}">Edit</a>
        <br>
        @endforeach
    </div>
    <br>
    <h2>Vse dodeljene znamke</h2>

    @foreach($users as $user)
    {{$user->name}}
    <br><br>
    @foreach($connections as $connection)
    @if($user->id == $connection->userId)
    @foreach($badges as $badge)
    @if($connection->BadgeId == $badge->id)
    <?php
    $userBadges[]=$badge;
    ?>
    @if(!in_array($badge, $uniqueBadges))
    <?php
    array_push($uniqueBadges, $badge);
    ?>
    
    @endif
    @endif
    @endforeach
    @endif
    @endforeach
    @endforeach
    @foreach($uniqueBadges as $uniqueBadge)
    <?php $count = count(array_keys($userBadges, $uniqueBadge)) ?>
    @if($count/$uniqueBadge['badgeCount'] >= 1)
    {{$uniqueBadge['pogoj']." #".(round($count/$uniqueBadge['badgeCount']))}}
    <?php $name=$uniqueBadge['slika'];?>
    <img src="/uploads/<?php echo $name?>" alt='Badge picture' width='30px' height='30px' style="border-radius:50%; border:2px solid rgb(60, <?php echo (round($count/$uniqueBadge['badgeCount'])*20)?>, 111)"><br>
    @endif
    @endforeach
    
    
</body>
</html>