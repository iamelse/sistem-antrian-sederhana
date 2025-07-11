@extends('queue.layouts.main')

@section('content')
    <main class="flex items-center justify-center min-h-screen px-4">
        <div class="w-full max-w-md text-center">
            <h1 class="text-2xl font-bold mb-6">Ambil Nomor Antrian</h1>

            <!-- Live Next Number -->
            <div class="mb-8">
                <p class="text-gray-600">Nomor Selanjutnya:</p>
                <div id="next-number" class="text-5xl font-bold text-blue-600">--</div>
            </div>

            <!-- Form Ambil -->
            <form id="queue-form">
                @csrf
                <button type="submit" id="take-btn" class="w-full bg-blue-600 text-white py-3 rounded-md text-lg font-semibold hover:bg-blue-700 transition">
                    Ambil Antrian
                </button>
            </form>
        </div>
    </main>

    {{-- Live Update Next Number --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const nextNumberEl = document.getElementById('next-number');

            const fetchNextNumber = () => {
                fetch("{{ url('/queue/next-number') }}")
                    .then(res => res.json())
                    .then(data => {
                        nextNumberEl.textContent = data.next ?? '--';
                    });
            };

            fetchNextNumber();
            setInterval(fetchNextNumber, 1000);

            const form = document.getElementById('queue-form');
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const btn = document.getElementById('take-btn');
                btn.disabled = true;
                btn.textContent = 'Memproses...';

                fetch("{{ route('queue.take.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({})
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            alert('Nomor Antrian Anda: ' + data.queue.number);
                            fetchNextNumber();
                        } else {
                            alert('Gagal mengambil antrian.');
                        }
                    })
                    .catch(() => {
                        alert('Terjadi kesalahan.');
                    })
                    .finally(() => {
                        btn.disabled = false;
                        btn.textContent = 'Ambil Antrian';
                    });
            });
        });
    </script>
@endsection
