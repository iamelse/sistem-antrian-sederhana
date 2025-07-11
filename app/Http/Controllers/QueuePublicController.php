<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QueuePublicController extends Controller
{
    public function index(): View
    {
        return view('queue.pages.index', [
            'title' => 'Antrian'
        ]);
    }

    public function liveInfo()
    {
        $current = Queue::where('status', 'called')->latest()->first();
        $next = Queue::where('status', 'waiting')->orderBy('number')->first();

        return response()->json([
            'current' => $current ? $current->number : null,
            'next' => $next ? $next->number : null,
        ]);
    }
}
