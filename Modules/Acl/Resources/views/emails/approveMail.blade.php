<!DOCTYPE html>
<html>
<head>
    <title>{{ $details['title'] }}</title>
</head>
<body>
<h1>{{ $details['title'] }}</h1>
<p>{{ $details['body'] }}</p>
@if($details['key'] != approveType()['wa'])
<a href="{{ $details['link'] }}">{{ $details['link_title'] }}</a>
@endif
<p>{{$custom[strtolower('Thank_you')]??"lang not found"}}</p>
</body>
</html>
