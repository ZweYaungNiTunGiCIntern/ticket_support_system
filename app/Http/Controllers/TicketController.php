<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\Label;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets=Ticket::all();
        return view('ticket.index',compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $labels = Label::all();
        return view('ticket.create',compact('categories','labels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $newName = "gallery_" . uniqid() . "." . $image->extension();
            $image->storeAs("public/gallery", $newName);
        } else {
            $newName = null; // If no file was uploaded
        }


        $ticket = new ticket();
        $ticket->title= $request->title;
        $ticket->message= $request->message;
        $ticket->category_id=$request->category_id;

        $ticket->label_id=$request->label_id;
        $ticket->priority = $request->priority;
        $ticket->image = $newName;
        $ticket->categories()->attach($request->category_ids);
        $ticket->save();

        //return redirect()->route('ticket.index')->with('success', 'New ticket successfully added.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketRequest  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
