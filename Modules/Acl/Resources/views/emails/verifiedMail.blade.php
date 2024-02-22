<!DOCTYPE html>
<html>
<head>
    <title>{{ $details['title'] }}</title>
</head>
<body>
<h1>{{ $details['title'] }}</h1>
<p>{{ $details['body'] }}</p>
<a href="{{ $details['link'] }}">{{$custom[strtolower('verified_here')]??""}}</a>

<p>{{$custom[strtolower('Thank_you')]??"lang not found"}}</p>
</body>
</html>
