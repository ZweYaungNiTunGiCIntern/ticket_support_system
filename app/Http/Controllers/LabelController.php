<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Http\Requests\StoreLabelRequest;
use App\Http\Requests\UpdateLabelRequest;

class LabelController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labels = Label::all();
        return view('label.index',compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('label.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorelabelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorelabelRequest $request)
    {
        $label = new label();
        $label->name= $request->name;
        $label->save();
        return redirect()->route('label.index')->with('success', 'New label successfully added.');;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\label  $label
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $label = Label::findOrFail($id);
        return view('label.detail',compact('label'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\label  $label
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $label = Label::findOrFail($id);
        return view('label.edit',compact('label'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatelabelRequest  $request
     * @param  \App\Models\label  $label
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatelabelRequest $request, label $label)
    {

        $label->name = $request->name;
        $label->update();
        return redirect()->route('label.index')->with('update','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\label  $label
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $label = Label::findOrFail($id);
        if($label){
            $label->delete();

        }
        return redirect()->back()->with('delete','You have deleted one label');
    }
}
