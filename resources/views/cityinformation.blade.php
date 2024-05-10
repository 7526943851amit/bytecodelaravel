<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Information</title>
</head>
<body>
    <h1> amit sharma </h1>
    <h1>Current Weather Information for {{ $cityName }}, {{ $countryCode }}</h1>

    <p>Temperature: {{ $currentTemperature }}°C</p>
    <p>Weather: {{ $currentWeather }}</p>
</body>
</html>
