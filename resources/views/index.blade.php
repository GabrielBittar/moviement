<!DOCTYPE html>
<html>
<head>
    <title>MovieMent</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        ::selection{
            background-color: #8680EB;
        }
        
        body{
            background-color: #07051F;
        }

        h1{
            font-family: 'Roboto', sans-serif;
            font-size: 3em;
            font-weight: bold;
            margin: 0;
            color: #D7D4F8;
            letter-spacing: 1px;
            text-align: center;
            justify-content: center;
            align-items: center;
        }

        h2{
            font-family: 'Roboto', sans-serif;
            font-size: 2em;
            font-weight: bold;
            color: #D7D4F8;
            margin: 0;
            letter-spacing: 1px;
            text-align: center;
            justify-content: center;
            align-items: center;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .movie {
            width: 200px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            transition: transform 0.3s;
            background-color: #faf9ff;
        }

        .movie img {
            width: 100%;
            height: auto;
        }

        .movie:hover {
            transform: scale(1.05);
        }

        .movie-title {
            text-align: center;
            font-size: 1.1em;
            padding: 10px;
        }
    </style>
</head>
<body>
    <header class="header">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <form action="{{ route('movies.search') }}" method="GET">
            <input type="text" name="query" placeholder="Search for movies..." required>
            <button type="submit">Search</button>
        </form>
    </header>
    
    <h1><span style="color:#E3496B">Movie</span>Ment</h1>
    <h2>Moving your passion for movies.</h2>

    <div class="container">
        @foreach($movies['results'] as $movie)
            <div class="movie">
                <img src="{{ 'https://image.tmdb.org/t/p/original/' . ($movie['poster_path'] ?? 'default.jpg') }}" alt="{{ $movie['title'] ?? 'No Title' }}">
                <div class="movie-title">{{ $movie['title'] ?? 'No Title' }}</div>
            </div>
        @endforeach
    </div>
</body>
</html>