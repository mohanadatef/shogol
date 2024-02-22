<!DOCTYPE html>
<html>
<head>
    <title>{{ $details['title'][$user->lang] }}</title>
</head>
<body>
<h1>{{ $details['title'][$user->lang] }}</h1>
<p>{{ $details['description'][$user->lang] }}</p>


<p>{{$custom[strtolower('Thank_you')]??"lang not found"}}</p>
</body>
</html>
