<!DOCTYPE html>
<html>
<head>
    <title>Key Exchange Form</title>
</head>
<body>
    <h1>Diffie-Hellman Key Exchange</h1>
    <form method="POST" action="{{ route('generateKey') }}">
        @csrf
        <div style="margin: 10px">
            <label for="b">Bitte wählen sie Ihren geheimem Parameter b:</label>
            <input type="password" name="b" id="b" >

            @error('b')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        <div  style="margin: 10px">
            <label for="A">Was ist der öffentliche Teil des Schlüssels Ihres Partners?</label>
            <input type="number" name="A" id="A" >

            @error('A')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        <button type="submit">Generate Key</button>
    </form>
</body>
</html>
