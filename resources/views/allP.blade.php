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


<br><br>
    <h1 style="text-align: center">Vse naloge</h1>
    <br>    
    @foreach($posts as $post)
    @foreach($posts as $test)
    @if ($post->id == $test->parentPost && $test->user == auth()->user())
    <?php
    $foo = True;
    break;
    ?>
    @else
    <?php
    $foo = False;
    ?>
    @endif
    @endforeach



    @if ($post->parentPost == NULL)
    @if($foo == False)
    <div class="post" style="padding: 10px; margin: 10px">
        <h3>{{$post['title']}} - {{$post->user->name}}</h3>
        {{'Stevilo ur ucenja: '}}
        {{$post['ure']}}
        {{'| Stevilo vaj fitnesa: '}}
        {{$post['fit']}}
        <br><br>
        {{$post['check']}}
        <br><br>
        {{$post['body']}}
        <p><a href="/odgovori-post/{{$post->id}}">Odgovori</a></p>
    </div>

    @else

    <div class="postDone" style="padding: 10px; margin: 10px">
        <h3>{{$post['title']}} - {{$post->user->name}}</h3>


        @if($post->badgeConnection != NULL)
        <?php //echo $post->badgeConnection->pogoj ?>
        
        @endif

        {{'Stevilo ur ucenja: '}}
        {{$post['ure']}}
        {{'| Stevilo vaj fitnesa: '}}
        {{$post['fit']}}
        <br><br>
        {{$post['check']}}
        <br><br>
        {{$post['body']}}
        <p><a href="/odgovori-post/{{$post->id}}">Odgovori</a></p>
        @foreach($connections as $connection)
        <?php $allPostId=[];
        array_push($allPostId, $connection->PostId);
        $uniquePostId = array_unique($allPostId)
        ?>
        @endforeach
        @foreach($badges as $badge)
        @if($badge->id == $post->badgeConnection && count(array_keys($uniquePostId, $post->id)) < 1)
        <form action="/create-connection" method="POST">
            @csrf
            <input type="hidden" name="userId" value={{auth()->user()->id}}>
            <input type="hidden" name="BadgeId" value={{$post->badgeConnection}}>
            <Input type="hidden" name="TeacherId" value={{$post->user_id}}>
            <input type="hidden" name="PostId" value={{$post->id}}>
            <button>Vzemi značko</button>
        </form>
        @endif
        @endforeach

    </div>
    @endif
    @endif
    @endforeach
</div>
</body>
</html>
