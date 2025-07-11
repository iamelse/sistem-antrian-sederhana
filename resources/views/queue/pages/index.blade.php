@extends('queue.layouts.main')

@section('content')
    <main class="flex items-center justify-center min-h-screen px-4 bg-gray-100">
        <div class="w-full max-w-2xl text-center space-y-10">
            <!-- Judul -->
            <div>
                <h1 class="text-3xl font-bold mb-2">Selamat Datang</h1>
                <p class="text-gray-600">Pantau antrian secara langsung</p>
            </div>

            <!-- Info Antrian -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="bg-white shadow rounded-lg p-6">
                    <p class="text-gray-600 mb-2">Nomor Antrian Saat Ini</p>
                    <div id="current-number" class="text-5xl font-bold text-blue-600">--</div>
                </div>

                <div class="bg-white shadow rounded-lg p-6">
                    <p class="text-gray-600 mb-2">Nomor Selanjutnya</p>
                    <div id="next-number" class="text-5xl font-bold text-green-600">--</div>
                </div>
            </div>

            <!-- Dummy YouTube Video -->
            <div class="w-full aspect-w-16 aspect-h-9">
                <iframe
                    class="w-full h-full rounded-lg shadow"
                    src="https://www.youtube.com/embed/A0tKGpKOU4Y?rel=0&autoplay=1&mute=1&loop=1&playlist=A0tKGpKOU4Y"
                    title="Informasi Layanan"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const currentNumberEl = document.getElementById('current-number');
            const nextNumberEl = document.getElementById('next-number');

            const updateQueueInfo = () => {
                fetch("{{ url('/queue/live-info') }}")
                    .then(res => res.json())
                    .then(data => {
                        currentNumberEl.textContent = data.current ?? '--';
                        nextNumberEl.textContent = data.next ?? '--';
                    })
                    .catch(() => {
                        currentNumberEl.textContent = '--';
                        nextNumberEl.textContent = '--';
                    });
            };

            updateQueueInfo();
            setInterval(updateQueueInfo, 1000); // update setiap detik
        });
    </script>
@endsection
