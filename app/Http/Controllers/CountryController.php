<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CountryController extends Controller
{
    public function index()
    {
        $response = Http::get(
            'https://restcountries.com/v3.1/all?fields=name'
        );

        if (! $response->successful()) {
            return response()->json([], 500);
        }

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
