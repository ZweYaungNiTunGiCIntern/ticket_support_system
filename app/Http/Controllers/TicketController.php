<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\Label;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
    { if (Auth::user()->role == 0) {
        $tickets = Ticket::all();
        return view('ticket.index', compact('tickets'));
    }
    elseif(Auth::user()->role == 1) {
        $tickets = Ticket::where('agent_id', Auth::user()->id)
            ->orWhere('agent_id', Auth::user()->id)
            ->all();
        return view('ticket.index', compact('tickets'));
    }
    $tickets = Ticket::where('user_id', Auth::user()->id)->get();
    return view('ticket.index', compact('tickets'));


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

        $request->validate([
            'title' => 'required',
            'message' => 'required',
            'priority' => 'required',
            'image' => 'required',
            // At least one category must be selected
     // Ensure all selected categories exist
            // Add validation rules for other fields if needed
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $newName = "gallery_" . uniqid() . "." . $image->extension();
            $image->storeAs("public/gallery", $newName);
        } else {
            $newName = null; // If no file was uploaded
        }


        $ticket = new ticket();
        $ticket->user_id = auth()->id();
        $ticket->agent_id= $request->agent_id;
        $ticket->title= $request->title;
        $ticket->message= $request->message;
        $ticket->priority = $request->priority;
        $ticket->image = $newName;
        //$ticket->categories()->attach($request->category_ids);
        $ticket->save();
       // $ticket->category_id=$request->category_id;
        if ($request->has('category_id')){
            $ticket->categories()->attach($request->category_id);
        }


       // $ticket->label_id=$request->label_id;
        if ($request->has('label_id')) {
            $ticket->labels()->attach($request->label_id);
        }
        return redirect()->route('ticket.index')->with('success', 'New ticket successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
            return view('ticket.detail',compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        $categories = Category::all();
        $labels = Label::all();
        $users = User::where('role','1')->get();
        return view('ticket.edit',compact('ticket','categories','labels','users'));
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
        $request->validate([
            'title' => 'required',
            'message' => 'required',
            'priority' => 'required',

            // At least one category must be selected
     // Ensure all selected categories exist
            // Add validation rules for other fields if needed
        ]);

        $oldImage = $ticket->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $newName = "gallery_" . uniqid() . "." . $image->extension();
            $image->storeAs("public/gallery", $newName);
        } else {
            $newName = $oldImage; // If no file was uploaded
        }
        $ticket->title= $request->title;
        $ticket->agent_id = $request->agent_id;
        $ticket->message= $request->message;
        $ticket->priority = $request->priority;
        $ticket->image = $newName;
        //$ticket->categories()->attach($request->category_ids);
        $ticket->save();
        if ($request->hasFile('image') && $oldImage) {
            Storage::delete("public/gallery/{$oldImage}");
        }
       // $ticket->category_id=$request->category_id;
        if ($request->has('category_id')){
            $ticket->categories()->attach($request->category_id);
        }
       // $ticket->label_id=$request->label_id;
        if ($request->has('label_id')) {
            $ticket->labels()->attach($request->label_id);
        }

        return redirect()->route('ticket.index')->with('success','Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $comment = Comment::findOrFail($commentId);
        $ticket = $comment->ticket;

        // Check if the authenticated user is the creator of the ticket
        if ($ticket->createdByUser(Auth::id())) {
            // Delete the comment
            $comment->delete();
            return redirect()->back()->with('success', 'Comment deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
        }
    }
}
