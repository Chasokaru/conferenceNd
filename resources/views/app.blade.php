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
        .btn, .btn-logout {
            width: 100px;
            background-color: #a6530e;
            color: #000000;
            border-color: #7c4a0a;
            display: flex;
            align-items: center;
            justify-content: center; /* Center text horizontally */
            text-decoration: none; /* Remove underline from links */
            padding: 5px; /* Add padding for better click area */
        }
        .btn:hover, .btn-logout:hover {
            background-color: #a6530e; /* Same background color on hover */
            color: #000000; /* Same text color on hover */
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
    </style>
</head>
<body>
<nav>
    <ul>
        @if(auth()->check())
            <li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-logout">Logout</button>
                </form>
            </li>
        @else
            <li>
                <a href="{{ route('login') }}" class="btn">Login</a>
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
