<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QueueTakeController extends Controller
{
    public function index(): View
    {
        return view('queue.pages.take', [
            'title' => 'Ambil Antrian'
        ]);
    }

    public function store(Request $request)
    {
        $last = Queue::whereDate('created_at', today())
            ->orderBy('number', 'desc')
            ->first();

        $nextNumber = $last ? $last->number + 1 : 1;

        $queue = Queue::create([
            'number' => $nextNumber,
            'status' => 'waiting',
        ]);

        return response()->json([
            'success' => true,
            'queue' => $queue
        ]);
    }

    public function nextNumber()
    {
        $last = Queue::whereDate('created_at', today())
            ->orderBy('number', 'desc')
            ->first();

        $next = $last ? $last->number + 1 : 1;

        return response()->json(['next' => $next]);
    }
}
