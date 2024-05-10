<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; 
class apiController extends Controller
{
    function weather(){
        return view('weather');

    }
    public function searchWeather(Request $request)
    {
        $request->validate([
            'city' => 'required|string',
        ]);
    
        $apiKey = 'aa2a0e5a89a931cd28e359ba1eda96a1';
        $city = $request->input('city');
    
        
        if (strpos($city, ',') === false) {
            $city .= ',IN'; 
    
 
        $apiUrl = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey";
    
     
        $response = Http::get($apiUrl);
 
        if ($response->successful()) {
            $weatherData = $response->json();
    
            return view('cityinformation', [
                'cityName' => $weatherData['name'],
                'countryCode' => $weatherData['sys']['country'],
                'currentTemperature' => round($weatherData['main']['temp'] - 273.15), // Convert temperature to Celsius
                'currentWeather' => $weatherData['weather'][0]['main'],
            ]);
        } else {
            return back()->withErrors(['message' => 'Failed to fetch weather data.']);
        }
    }
}

public function livescore(){
    return view('livescores');
}
}
