<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    @auth 
    <p>Congrats you are logged in.</p>
    <form action="/logout" method="POST">
        @csrf
        <button>Log out</button>
    </form>

    <form action="/graph" method="POST">
        @csrf
        <button>Look at data</button>
    </form>

    <div style="border: 3px solid black;">
        <h2>Create a New Post</h2>
        <form action="/create-post" method="POST">
        @csrf
        <input type="text" name="title" placeholder="post title">
        <input type="text" name="ure" placeholder="stevilo ur ucenja">
        <input type="text" name="fit" placeholder="stevilo vaj fitnesa">
        <div class="radio"> 
            <br>
            <input type="radio" name="check" value="#prost_dan"> #prost_dan<br>
            <input type="radio" name="check" value="#pocitnice"> #pocitnice<br>
            <input type="radio" name="check" value="#ucenje"> #ucenje<br>
            <br>
          </div>
        <textarea name="body" placeholder="body content..."></textarea>
        <button>Save Post</button>
        </form>
    </div>

    <div style="border: 3px solid black;">
        <h2>All Posts</h2>
        @foreach($posts as $post)
        <div style="background-color: gray; padding: 10px; margin: 10px">
            <h3>{{$post['title']}} by {{$post->user->name}}</h3>
            {{'Stevilo ur ucenja: '}}
            {{$post['ure']}}
            {{'| Stevilo vaj fitnesa: '}}
            {{$post['fit']}}
            <br><br>
            {{$post['check']}}
            <br><br>
            {{$post['body']}}
            <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
            <form action="/delete-post/{{$post->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
        </div>
        @endforeach
    </div>

    @else 
    <div style="border: 3px solid black;">
        <h2>Register</h2>
        <form action="/register" method="POST">
            @csrf
            <input name="name" type="text" placeholder="name">
            <input name="email" type="text" placeholder="email">
            <input name="password" type="password" placeholder="password">
            <button>Register</button>
        </form>
    </div>
    <div style="border: 3px solid black;">
        <h2>Login</h2>
        <form action="/login" method="POST">
            @csrf
            <input name="loginname" type="text" placeholder="name">
            <input name="loginpassword" type="password" placeholder="password">
            <button>Log in</button>
        </form>
    </div>
    @endauth

</body>
</html>