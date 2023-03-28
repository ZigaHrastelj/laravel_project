<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form action="/edit-post/{{$post->id}}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="title" value="{{$post->title}}">
        <input type="text" name="ure" value="{{$post->ure}}">
        <input type="text" name="fit" value="{{$post->fit}}">
        <div class="radio">
            <br>
            <input type="radio" name="check" value="option1"> #prost_dan<br>
            <input type="radio" name="check" value="option2"> #pocitnice<br>
            <input type="radio" name="check" value="option3"> #ucenje<br>
            <br>
          </div>
        <textarea name="body">{{$post->body}}</textarea>
        <button>Save Changes</button>
    </form>
</body>
</html>