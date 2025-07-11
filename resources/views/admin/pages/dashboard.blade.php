@extends('admin.layouts.main')

@section('content')
    <!-- Main Content -->
    <main class="pt-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold">{{ $pageTitle ?? 'Dashboard' }}</h1>
                <p class="text-sm text-gray-500">{{ $pageSubtitle ?? 'Welcome to your dashboard' }}</p>
            </div>
        </div>
    </main>
@endsection
