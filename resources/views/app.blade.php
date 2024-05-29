<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conferences</title>
    <style>
        body {
            background-color: #c1aeae; /* Grey background for the entire page */
            margin: 0; /* Remove default margin */
        }
        nav {
            background-color: #cba21b;
            padding: 10px;
        }
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        li {
            display: inline;
            margin-right: 10px;
        }
        table {
            width: 100%;
        }
        th, td {
            font-size: 14px;
        }
        .container {
            background-color: #ffffff; /* White background for the container */
            padding: 20px;
            margin: 20px auto; /* Center the container */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 1200px; /* Optional: limit the max width */
        }
        .btn-logout {
            width: 100px;
            background-color: #a6530e;
            color: #000000;
            border-color: #7c4a0a;
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
<nav>
    <ul>
        @if(auth()->check())
            <li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline; float: right; margin-top: 5px; margin-right: 10px;">
                    @csrf
                    <button type="submit" class="btn btn-logout">Logout</button>
                </form>
            </li>
        @endif
    </ul>
</nav>
<div class="container">
    @yield('content')
</div>
<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
</body>
</html>
