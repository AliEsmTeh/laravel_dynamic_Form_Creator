<?php

namespace App\Http\Controllers;

use App\Models\Fields;
use App\Models\Form;
use Illuminate\Http\Request;

class FieldsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($formId)
    {

        $form = Form::findOrFail(((int)$formId));
        $fields = Fields::with('fieldTypes')->where('form_id', $formId)->get();
        return view('fields.index', compact('form', 'fields'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fields.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $formId)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'key' => 'required|string|max:255',
            'options' => 'nullable|json',
            'placeholder' => 'nullable|string|max:255',
            'required' => 'boolean',
            'sequence' => 'nullable|integer',
        ]);

        Fields::create([
            'form_id' => $formId,
            'label' => $request->label,
            'key' => $request->key,
            'options' => $request->options,
            'placeholder' => $request->placeholder,
            'required' => $request->required,
            'sequence' => $request->sequence,
        ]);

        return redirect()->route('fields.index', $formId)->with('success', 'Field created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fields $fields)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fields $fields)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fields $fields)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fields $fields)
    {
        //
    }
}
