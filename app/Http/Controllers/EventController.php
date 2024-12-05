<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EventController extends Controller
{
    public function getViewEvent()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userId = auth()->user()->id;
        return view('modules.admin.event.main', [
            "event" => Event::where('user_id', $userId)
                ->latest()
                ->filter(request(['search']))
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    public function createEvent()
    {
        return view('modules.admin.event.create', [
            'active' => 'createevent',
            'title' => 'Tambah Event',
            'catproduct' => Event::all(),
        ]);
    }
    public function saveCreateEvent(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus masuk untuk menambahkan event.']);
        }

        $validatedData = $request->validate([
            'event_name' => 'required',
            'event_description' => 'required',
            'event_location' => 'required',
            'event_start_date' => 'required|date',
            'event_end_date' => 'required|date|after_or_equal:event_start_date',
            'event_image' => 'required|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        $image = $request->file('event_image');
        $imageData = file_get_contents($image->getRealPath());
        $base64Image = base64_encode($imageData);

        $event_save = new Event();
        $event_save->event_name = $request->event_name;
        $event_save->event_description = $request->event_description;
        $event_save->event_location = $request->event_location;
        $event_save->event_start_date = $request->event_start_date;
        $event_save->event_end_date = $request->event_end_date;
        $event_save->event_image = $base64Image;
        $event_save->user_id = auth()->user()->id;

        $event_save->save();
        Alert::success('Berhasil', 'Event telah ditambahkan!');
        return redirect('/event')->with('success', 'Event telah ditambahkan!');
    }

    public function saveUpdateEvent(Request $request, $id)
    {
        $validatedData = $request->validate([
            'event_name' => 'required',
            'event_description' => 'required',
            'event_location' => 'required',
            'event_start_date' => 'required|date',
            'event_end_date' => 'required|date|after_or_equal:event_start_date',
            'event_image' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        $event_save_update = Event::find($id);
        if (!$event_save_update) {
            return redirect('/event')->withErrors(['error' => 'Event tidak ditemukan.']);
        }

        $event_save_update->event_name = $request->input('event_name');
        $event_save_update->event_description = $request->input('event_description');
        $event_save_update->event_location = $request->input('event_location');
        $event_save_update->event_start_date = $request->input('event_start_date');
        $event_save_update->event_end_date = $request->input('event_end_date');

        if ($request->hasFile('event_image')) {
            $image = $request->file('event_image');
            $imageData = file_get_contents($image->getRealPath());
            $base64Image = base64_encode($imageData);
            $event_save_update->event_image = $base64Image;
        }

        $event_save_update->save();
        Alert::success('Berhasil', 'Event telah diubah!');
        return redirect('/event')->with('success', 'Event telah diubah!');
    }

    public function deleteEvent($id)
    {
        $data = Event::find($id);
        $data->delete();
        return redirect('/event')->with('success', 'Event telah dihapus!');
    }
}
