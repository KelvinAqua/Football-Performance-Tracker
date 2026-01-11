<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CountryController extends Controller
{
    public function index()
    {
        // Call the REST Countries API
        $response = Http::get(
            'https://restcountries.com/v3.1/all?fields=name'
        );

        // If API fails, return empty array
        if (! $response->successful()) {
            return response()->json([], 500);
        }

        // Extract country names
        $countries = collect($response->json())
            ->map(function ($country) {
                return $country['name']['common'] ?? null;
            })
            ->filter()
            ->unique()
            ->sort()
            ->values();

        return response()->json($countries);
    }
}
