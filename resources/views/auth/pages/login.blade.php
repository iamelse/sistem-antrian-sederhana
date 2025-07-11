@extends('auth.layouts.main')

@section('content')
    <h2 class="text-2xl font-bold text-center mb-6">Login</h2>

    @if(session('error'))
        <div class="mb-4 text-sm text-red-600 bg-red-100 p-2 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 text-sm text-red-600 bg-red-100 p-2 rounded">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('do.login') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" name="password" id="password" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold mt-4 py-2 px-4 rounded-md transition duration-300">
            Login
        </button>
    </form>
@endsection
