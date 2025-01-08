<?php

namespace App\Http\Controllers;

use App\Models\FieldTypes;
use Illuminate\Http\Request;

class FieldTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $fieldTypes = FieldTypes::all();
        return view('field_types.index', compact('fieldTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('field_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_optional' => 'boolean',
        ]);

        FieldTypes::create($request->all());
        return redirect()->route('field_types.index')->with('success', 'Field Type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FieldTypes $fieldTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FieldTypes $fieldTypes)
    {
        return view('field_types.edit', compact('fieldTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FieldTypes $fieldTypes)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_optional' => 'boolean',
        ]);

        $fieldTypes->update($request->all());
        return redirect()->route('field_types.index')->with('success', 'Field Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FieldTypes $fieldTypes)
    {
        $fieldTypes->delete();
        return redirect()->route('field_types.index')->with('success', 'Field Type deleted successfully.');
    }
}
