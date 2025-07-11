@extends('admin.layouts.main')

@section('content')
    <main class="pt-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold">Panel Antrian</h1>
                <p class="text-sm text-gray-500">Kelola antrian secara real-time</p>
            </div>
        </div>

        <!-- Current Queue -->
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h2 class="text-lg font-semibold mb-2">Nomor Antrian Saat Ini</h2>
            <div id="current-number" class="text-6xl text-blue-500 font-bold">--</div>
        </div>

        <!-- Controls -->
        <div class="flex flex-wrap gap-3 mb-6">
            <button id="prev-btn" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                Sebelumnya
            </button>
            <button id="next-btn" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                Berikutnya
            </button>
        </div>

        <!-- Queue List -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4">Daftar Antrian Menunggu</h2>
            <div id="queue-list" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                <div class="text-gray-400 italic col-span-full">Memuat...</div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const updateQueue = () => {
                fetch("{{ url('admin/queue/list') }}")
                    .then(res => res.json())
                    .then(data => {
                        const current = data.find(q => q.status === 'called');
                        document.getElementById("current-number").textContent = current ? current.number : '--';

                        const waiting = data.filter(q => q.status === 'waiting');
                        const list = waiting.map(q => `
                        <div class="border-2 border-blue-600 text-blue-700 rounded-lg p-4 text-center text-3xl font-bold bg-blue-50 shadow-sm">
                            ${q.number}
                        </div>
                    `).join('');

                        document.getElementById("queue-list").innerHTML = list || `
                        <div class="text-gray-400 italic col-span-full">Tidak ada antrian.</div>
                    `;
                    });
            };

            const postAction = (endpoint) => {
                fetch(`{{ url('admin/queue') }}/${endpoint}`, {
                    method: "POST",
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                }).then(() => updateQueue());
            };

            document.getElementById("prev-btn").addEventListener("click", () => postAction("prev"));
            document.getElementById("next-btn").addEventListener("click", () => postAction("next"));

            updateQueue();
            setInterval(updateQueue, 1000);
        });
    </script>
@endsection
