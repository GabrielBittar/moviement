<!DOCTYPE html>
<html>
<head>
    <title>MovieMent - search results</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>Search Results</h1>
    @if(isset($movies['error']))
        <p>Error: {{ $movies['error'] }}</p>
    @else
        <ul>
            @foreach($movies['results'] as $movie)
                <li>{{ $movie['title'] ?? 'No Title' }}</li>
                <li><img src="{{ 'https://image.tmdb.org/t/p/original/' . ($movie['poster_path'] ?? 'No Image') }}" alt="{{ $movie['title'] ?? 'No Title' }}"></li>
                <li>{{ $movie['overview'] ?? 'No Description' }}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>
