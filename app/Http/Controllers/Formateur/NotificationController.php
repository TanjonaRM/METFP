<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Liste des notifications du formateur connecté
     */
    public function index(Request $request)
    {
        $user = Auth::guard('formateur')->user();

        $query = Notification::query()
            ->where('user_id', $user->id)
            ->orWhereNull('user_id')  // notifications globales
            ->latest();

        if ($request->filled('statut')) {
            if ($request->statut === 'non_lues') {
                $query->where('lu', false);
            } elseif ($request->statut === 'lues') {
                $query->where('lu', true);
            }
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('titre', 'like', "%{$s}%")
                  ->orWhere('message', 'like', "%{$s}%");
            });
        }

        $notifications = $query->paginate(20)->withQueryString();

        $stats = [
            'total'    => Notification::where('user_id', $user->id)
                ->orWhereNull('user_id')->count(),
            'non_lues' => Notification::where('user_id', $user->id)
                ->orWhereNull('user_id')
                ->where('lu', false)->count(),
            'lues'     => Notification::where('user_id', $user->id)
                ->orWhereNull('user_id')
                ->where('lu', true)->count(),
        ];

        return view('formateur.notifications.index', compact('notifications', 'stats'));
    }

    /**
     * Marquer une notification comme lue
     */
    public function markAsRead(int $id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['lu' => true]);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Notification marquée comme lue.');
    }

    /**
     * Tout marquer comme lu
     */
    public function markAllAsRead()
    {
        $user = Auth::guard('formateur')->user();

        Notification::where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhereNull('user_id');
            })
            ->where('lu', false)
            ->update(['lu' => true]);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Toutes les notifications sont marquées comme lues.');
    }

    /**
     * Supprimer une notification
     */
    public function destroy(int $id)
    {
        Notification::findOrFail($id)->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Notification supprimée.');
    }
}