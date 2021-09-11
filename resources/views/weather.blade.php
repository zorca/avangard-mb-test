<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <title>Weather</title>
</head>
<body>
    <div class="mt-16">
        <div class="container mx-auto">
            <div class="max-w-lg mx-auto bg-blue bg-no-repeat bg-cover" style="background-image:url('/images/bg-weather.jpg')">
                <div class="text-white p-8">
                    <h1 class="text-center text-4xl font-bold">Погода в городе {{ $cityInfo['name'] }}</h1>
                    <hr class="my-4" />
                    <div class="text-center text-4xl font-bold">Температура: {{ $weatherTemperature }}°</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
