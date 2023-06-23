<?php

namespace App\Http\Controllers\Admin;

use App\Models\Option;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropertyFormRequest;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
        return view('admin.properties.index', [
            'properties' => Property::orderBy('created
            _at', 'desc')->paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $property = new Property();
        $property->fill([
            'surface' => 40,
            'rooms' => 2,
            'bedrooms' => 1,
            'floor' => 0,
            'city' => 'Paris',
            'postal_code' => 75001,
            'sold' => false
        ]);

        return view('admin.properties.form', [
            'property' => $property,
            'options' => Option::pluck('name', 'id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyFormRequest $request)
    {
        $validatedData = $request->validated();
        $validatedOptions = $validatedData['options'] ?? [];
    
        $property = Property::create($validatedData);
        $property->options()->sync($validatedOptions);
    
        return to_route('admin.property.index')->with('success', 'Le bien a été créé');
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        return view ('admin.properties.form', [
            'property' => $property,
            'options' => Option::pluck('name', 'id')
        ]);
    }

/**
 * Update the specified resource in storage.
 */
public function update(PropertyFormRequest $request, Property $property)
{
    $validatedData = $request->validated();
    $validatedOptions = $validatedData['options'] ?? [];

    $property->update($validatedData);
    $property->options()->sync($validatedOptions);

    return redirect()->route('admin.property.index')->with('success', 'Le bien a été modifié');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return to_route('admin.property.index')->with('success', 'Le bien a été supprimé');
    }
}
