@extends('layouts.guest')

@section('content')
<div class="w-full max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-6 text-center">Admin Login</h2>

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-sm mb-1">Email</label>
            <input type="email" name="email" class="w-full border px-3 py-2 rounded" required autofocus>
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm mb-1">Password</label>
            <input type="password" name="password" class="w-full border px-3 py-2 rounded" required>
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Login</button>
    </form>
</div>
@endsection
