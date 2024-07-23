<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showForm()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $data = $request->only('name', 'email', 'message');

        Mail::to('hello@example.com')->send(new ContactMessageReceived($data));

        ContactMessage::create($data);

        return redirect()->route('contact.form')->with('success', 'Message sent successfully!');
    }
     /**
     * Display a listing of the contact messages.
     */
    public function index()
    {
        $title = 'List of Messages';
        $messages = ContactMessage::all();
        $unreadMessages = ContactMessage::where('is_read', false)->get();
        $unreadCount = $unreadMessages->count();
    
        return view('dashboard.messages', [
            'title' => $title,
            'messages' => $messages,
            'unreadCount' => $unreadCount,
            'unreadMessages' => $unreadMessages
        ]);
    }
    /**
     * Display a specific contact message.
     */
    public function show($id)
    {
        $title = 'List of Messages';
        $message = ContactMessage::findOrFail($id);
        $message->is_read = true;
        $message->save();
        return view('dashboard.showmessage', ['title' => $title,'data' => $message]);
    }
   
    /**
     * Delete a contact message.
     */
    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();
        return redirect()->route('dashboard.messages')->with('success', 'Message deleted successfully!');
    }

}
