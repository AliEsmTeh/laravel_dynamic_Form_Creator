<?php

namespace App\Http\Controllers;

use App\Models\Fields;
use App\Models\Form;
use App\Models\SubmitedForm;
use Illuminate\Http\Request;

class SubmitedFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forms = Form::where('archive', false)->get();
        return view('submited_forms.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'form_id' => 'required|exists:forms,id',
        ]);

        $formId = $request->input('form_id');


        $data = $request->except(['_token', 'form_id']);


        SubmitedForm::create([
            'form_id' => $formId,
            'data' => json_encode($data),

            // 'user_id' => auth()->id(),
        ]);

        return redirect()->route('submitForm.index')->with('success', 'form created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($formId)
    {
        $form = Form::where('id', $formId)->first();
        $fields = Fields::where('form_id', $formId)->orderby('sequence')->get();
        return view('submited_forms.fill', compact('form', 'fields'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubmitedForm $submitedForm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubmitedForm $submitedForm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubmitedForm $submitedForm)
    {
        //
    }

    /**
     * show submitted form with users
     */
    public function showSubmit($formId)
    {
        $forms =  SubmitedForm::where('form_id', $formId)->get()->toArray();
        return view('submited_forms.show_submit', compact('forms'));

    }
}
