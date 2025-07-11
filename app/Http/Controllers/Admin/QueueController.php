<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Queue;
use Illuminate\View\View;

class QueueController extends Controller
{
    public function index(): View
    {
        return view('admin.pages.queue', ['title' => 'Antrian']);
    }

    public function list()
    {
        return response()->json(Queue::orderBy('number')->get());
    }

    public function call()
    {
        // Tandai yg sedang dipanggil sebagai done
        Queue::where('status', 'called')->update(['status' => 'done']);

        // Panggil antrian waiting pertama
        $next = Queue::where('status', 'waiting')->orderBy('number')->first();
        if ($next) {
            $next->update(['status' => 'called']);
            return response()->json(['success' => true, 'current' => $next->number]);
        }

        return response()->json(['success' => false, 'message' => 'Tidak ada antrian menunggu.']);
    }

    public function next()
    {
        // Tandai antrian yang sedang dipanggil sebagai done
        Queue::where('status', 'called')->update(['status' => 'done']);

        // Otomatis panggil antrian berikutnya
        return $this->call();
    }

    public function prev()
    {
        $current = Queue::where('status', 'called')->first();
        if ($current) {
            $current->update(['status' => 'waiting']);
        }

        $lastDone = Queue::where('status', 'done')->orderByDesc('updated_at')->first();
        if ($lastDone) {
            $lastDone->update(['status' => 'called']);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Tidak ada antrian sebelumnya.']);
    }
}
