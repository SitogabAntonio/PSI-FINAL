<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use RealRashid\SweetAlert\Facades\Alert;

class EventSuperAdminController extends Controller
{
    public function getViewEventSuperAdmin()
    {
        $pagination = Event::paginate(10)->withQueryString();
        $eventsuperadmin = Event::latest()->filter(request(['search']))->paginate(10)->withQueryString();
        return view('modules.admin.eventSuperAdmin.main', compact('eventsuperadmin', 'pagination'));
    }

    public function deleteEventSuperAdmin($id)
    {
        $data = Event::find($id);
        $data->delete();
        return redirect('/event/superadmin')->with('success', 'Event telah dihapus!');
    }
}
