<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Queue;
use Carbon\Carbon;
use Illuminate\View\View;

class QueueController extends Controller
{
    public function index(): View
    {
        return view('admin.pages.queue', ['title' => 'Antrian']);
    }

    public function list()
    {
        return response()->json(
            Queue::whereDate('created_at', Carbon::today())
                ->orderBy('number')
                ->get()
        );
    }

    public function call()
    {
        Queue::whereDate('created_at', today())
            ->where('status', 'called')
            ->update(['status' => 'done']);

        $next = Queue::whereDate('created_at', today())
            ->where('status', 'waiting')
            ->orderBy('number')
            ->first();

        if ($next) {
            $next->update(['status' => 'called']);
            return response()->json(['success' => true, 'current' => $next->number]);
        }

        return response()->json(['success' => false, 'message' => 'Tidak ada antrian menunggu.']);
    }

    public function next()
    {
        Queue::where('status', 'called')->update(['status' => 'done']);

        return $this->call();
    }

    public function prev()
    {
        $current = Queue::whereDate('created_at', today())
            ->where('status', 'called')
            ->first();

        if ($current) {
            $current->update(['status' => 'waiting']);
        }

        $lastDone = Queue::whereDate('created_at', today())
            ->where('status', 'done')
            ->orderByDesc('updated_at')
            ->first();

        if ($lastDone) {
            $lastDone->update(['status' => 'called']);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Tidak ada antrian sebelumnya.']);
    }
}
