
@extends('layouts.master')

@section('content')
    <div class="min-h-screen bg-slate-50 p-4 sm:p-6 lg:p-8">

        <div class="mb-6">
            <a href="{{ route('cities.index') }}" class="text-sm text-slate-500 hover:text-violet-600">
                ← Back to City Master
            </a>

            <h1 class="mt-3 text-2xl font-bold text-slate-800">Add City</h1>
            <p class="mt-1 text-sm text-slate-500">Enter the city name below.</p>
        </div>

        <div class="max-w-2xl overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
            <form action="{{ route('cities.store') }}" method="POST">
                @csrf

                <div class="space-y-2 p-5 sm:p-6">
                    <label for="name" class="block text-sm font-medium text-slate-700">
                        City Name <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Enter city name"
                        required
                        autofocus
                        class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-violet-400 focus:ring-2 focus:ring-violet-100">

                    @error('name')
                    <p class="text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3 border-t border-slate-200 bg-slate-50 px-5 py-4 sm:px-6">
                    <a href="{{ route('cities.index') }}"
                       class="rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100">
                        Cancel
                    </a>

                    <button type="submit"
                            class="rounded-lg bg-violet-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-violet-700">
                        Save City
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
