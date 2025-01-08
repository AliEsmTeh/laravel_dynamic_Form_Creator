<?php

namespace App\Http\Controllers;

use App\Models\Fields;
use App\Models\FieldTypes;
use App\Models\Form;
use Illuminate\Http\Request;
use function Sodium\add;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forms = Form::where('archive', false)->get();
        return view('form.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('form.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Form::create($request->all());
        return redirect()->route('form.index')->with('success', 'form created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Form $form)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Form $form)
    {
        $form_fields = Fields::where('form_id', $form->id)->get();
        $fieldTypes = FieldTypes::all();
        return view('form.edit', compact('form', 'form_fields', 'fieldTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Form $form, Fields $fields)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $form_fields = $fields->where('form_id', $form->id)->get();

        if ($form_fields->count() >= 1) {
            $form->archive = true;
            $form->save();


            $newForm = Form::create([
                'name' => $form->name,
                'description' => $form->description,
            ]);

            $data = [];

            foreach ($request->fields as $field) {

                $data[] = [
                    'form_id' => $newForm->id,
                    'label' => $field['label'],
                    'key' => $field['key'],
                    'options' => isset($field['options']) ? json_encode($field['options']) : null,
                    'field_type_id' => FieldTypes::where('name', $field['type'])->first()->id,
                    'placeholder' => $field['placeholder'] ?? null,
                    'required' => isset($field['required']) && (bool)$field['required'],
                    'sequence' => $field['sequence'] ?? null,
                ];

            }

            $fields->insert($data);

        } else {
            $data = [];
            foreach ($request->fields as $field) {
                $data[] = [
                    'form_id' => $form->id,
                    'label' => $field['label'],
                    'key' => $field['key'],
                    'options' => isset($field['options']) ? json_encode($field['options']) : null,
                    'field_type_id' => FieldTypes::where('name', $field['type'])->first()->id,
                    'placeholder' => $field['placeholder'] ?? null,
                    'required' => isset($field['required']) && (bool)$field['required'],
                    'sequence' => $field['sequence'] ?? null,
                ];
            }

            $fields::insert($data);
        }

        return redirect()->route('form.index')->with('success', 'فرم با موفقیت به‌روزرسانی شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Form $form)
    {
        $form->delete();
        return redirect()->route('field_types.index')->with('success', 'Field Type deleted successfully.');
    }


    public function generateForm($formId)
    {
        $form = Form::where('id', $formId)->first();
        $fields = Fields::where('form_id', $formId)->orderby('sequence')->get();
        return view('form.generate', compact('form', 'fields'));
    }
}
