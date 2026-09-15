<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::orderBy('city')->get();
        return view('admin.locations', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'city' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);

        Location::create($request->only(['city', 'name']));

        return redirect()->back()->with('success', 'Lokasi penempatan berhasil ditambahkan.');
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->back()->with('success', 'Lokasi penempatan berhasil dihapus.');
    }
}