@extends('layouts.master')

@section('content')
    <div class="min-h-screen bg-slate-50 p-4 sm:p-6 lg:p-8">

        {{-- Page Header --}}
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">City Master</h1>
                <p class="mt-1 text-sm text-slate-500">
                    Manage cities used in temple receipts.
                </p>
            </div>

            <a href="{{ route('cities.create') }}"
               class="inline-flex items-center justify-center gap-2 rounded-lg bg-violet-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-violet-700">
                <i class="fa-solid fa-plus"></i>
                Add City
            </a>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-4 flex items-center gap-2 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- Error Message --}}
        @if(session('error'))
            <div class="mb-4 flex items-center gap-2 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <i class="fa-solid fa-circle-exclamation"></i>
                {{ session('error') }}
            </div>
        @endif

        {{-- City Table Card --}}
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            {{-- Table Header and Per-Page Dropdown --}}
            <div class="flex flex-col gap-4 border-b border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <h2 class="font-semibold text-slate-800">Cities</h2>
                    <p class="mt-1 text-xs text-slate-500">
                        Total: {{ $cities->total() }} cities
                    </p>
                </div>

                <form method="GET"
                      action="{{ route('cities.index') }}"
                      class="flex items-center gap-2">

                    <label for="per_page" class="whitespace-nowrap text-sm font-medium text-slate-600">
                        Show
                    </label>

                    <select name="per_page"
                            id="per_page"
                            onchange="this.form.submit()"
                            class="rounded-lg border pr-8 border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                        @foreach([10, 25, 50, 100] as $size)
                            <option value="{{ $size }}"
                                {{ (int) ($perPage ?? request('per_page', 10)) === $size ? 'selected' : '' }}>
                                {{ $size }}
                            </option>
                        @endforeach

                    </select>

                    <span class="whitespace-nowrap text-sm text-slate-500">
                        per page
                    </span>
                </form>

            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">

                    <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                    <tr>
                        <th class="px-5 py-3 font-semibold">#</th>
                        <th class="px-5 py-3 font-semibold">City Name</th>
                        <th class="px-5 py-3 font-semibold">Created At</th>
                        <th class="px-5 py-3 text-center font-semibold">Actions</th>
                    </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                    @forelse($cities as $city)
                        <tr class="transition hover:bg-slate-50">

                            {{-- Serial Number --}}
                            <td class="px-5 py-4 text-slate-500">
                                {{ $cities->firstItem() + $loop->index }}
                            </td>

                            {{-- City Name --}}
                            <td class="px-5 py-4 font-medium text-slate-800">
                                {{ $city->name }}
                            </td>

                            {{-- Created Date --}}
                            <td class="px-5 py-4 text-slate-500">
                                {{ $city->created_at?->format('d M Y') ?? '-' }}
                            </td>

                            {{-- Actions --}}
                            <td class="whitespace-nowrap px-4 py-5">
                                <div class="flex items-center justify-center gap-2">

                                    {{-- Edit Button --}}
                                    <a href="{{ route('cities.edit', $city->id) }}"
                                       class="inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-3.5 py-1.5 text-sm font-medium text-slate-700 transition hover:border-indigo-300 hover:bg-indigo-50 hover:text-indigo-600">
                                        <i class="fa-regular fa-pen-to-square text-sm"></i>
                                        Edit
                                    </a>

                                    {{-- Delete Button --}}
                                    <form action="{{ route('cities.destroy', $city->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this city?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="inline-flex items-center gap-2 rounded-lg border border-red-200 bg-white px-3.5 py-1.5 text-sm font-medium text-red-500 transition hover:border-red-300 hover:bg-red-50">
                                            <i class="fa-regular fa-trash-can text-sm"></i>
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fa-solid fa-city mb-3 text-3xl text-slate-300"></i>

                                    <p class="font-medium text-slate-600">
                                        No cities found
                                    </p>

                                    <p class="mt-1 text-sm text-slate-400">
                                        Add your first city to get started.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>

            {{-- Table Footer --}}
            @if($cities->total() > 0)
                <div class="flex flex-col gap-3 border-t border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                    <p class="text-sm text-slate-500">
                        Showing
                        <span class="font-medium text-slate-700">{{ $cities->firstItem() }}</span>
                        to
                        <span class="font-medium text-slate-700">{{ $cities->lastItem() }}</span>
                        of
                        <span class="font-medium text-slate-700">{{ $cities->total() }}</span>
                        cities
                    </p>

                    @if($cities->hasPages())
                        <div>
                            {{ $cities->onEachSide(1)->links('pagination.receipts') }}
                        </div>
                    @endif

                </div>
            @endif

        </div>
    </div>
@endsection
