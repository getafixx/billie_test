<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormulaController extends Controller
{
    
    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('formula.create');
    }

    public function store(FormulaFormRequest $formulaFormRequest)
    {

        dd($formulaFormRequest->all());
        return redirect()
            ->action('CarController@create')
        ->with('errors', $errors)
        ->withInput();

        /*$contact = [];

        $contact['name'] = $request->get('name');
        $contact['email'] = $request->get('email');
        $contact['msg'] = $request->get('msg');

        // Mail delivery logic goes here

        flash('Your message has been sent!')->success();

        return redirect()->route('contact.create');*/
    }
}
