<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PickupLead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $query = PickupLead::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $leads = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.leads.index', compact('leads'));
    }

    public function show(PickupLead $lead)
    {
        return view('admin.leads.show', compact('lead'));
    }

    public function updateStatus(Request $request, PickupLead $lead)
    {
        $request->validate([
            'status' => 'required|in:new,processing,completed,canceled',
        ]);

        $lead->update(['status' => $request->status]);

        return back()->with('success', 'Статус оновлено');
    }

    public function updateNotes(Request $request, PickupLead $lead)
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:5000',
        ]);

        $lead->update(['admin_notes' => $request->admin_notes]);

        return back()->with('success', 'Нотатки оновлено');
    }
}
