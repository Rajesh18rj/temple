@extends('layouts.master')

@section('content')

    <div class="min-h-screen bg-slate-50 p-4 sm:p-6 lg:p-8">

        {{-- Page Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

            <div>
                <h1 class="text-2xl font-semibold text-slate-800">
                    Receipts
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    Manage temple receipts.
                </p>
            </div>

            {{-- New Receipt --}}
            <a href="{{ route('receipts.create') }}"
               class="inline-flex items-center justify-center gap-2
                  px-4 py-2.5
                  rounded-lg
                  bg-violet-600
                  text-white
                  text-sm
                  font-medium
                  hover:bg-violet-700
                  transition">

                <svg class="w-4 h-4"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 4v16m8-8H4"/>

                </svg>

                New Receipt

            </a>

        </div>


        {{-- Success Message --}}
        @if(session('success'))

            <div class="mb-5 rounded-lg
                    border border-emerald-200
                    bg-emerald-50
                    px-4 py-3">

                <div class="flex items-center gap-2">

                    <svg class="w-5 h-5 text-emerald-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M5 13l4 4L19 7"/>

                    </svg>

                    <p class="text-sm font-medium text-emerald-700">
                        {{ session('success') }}
                    </p>

                </div>

            </div>

        @endif


        {{-- Main Container --}}
        <div class="bg-white
                border border-slate-200
                rounded-xl
                shadow-sm
                overflow-hidden">


            {{-- Section Header --}}
            <div class="px-5 sm:px-6 py-4
                    border-b border-slate-200
                    flex flex-col sm:flex-row
                    sm:items-center
                    sm:justify-between
                    gap-3">

                <div>

                    <h2 class="text-base font-semibold text-slate-800">
                        Receipt List
                    </h2>

                    <p class="text-sm text-slate-500 mt-0.5">
                        View and manage temple receipts
                    </p>

                </div>


                {{-- Receipt Count --}}
                <div class="inline-flex items-center gap-2
                        px-3 py-1.5
                        rounded-lg
                        bg-slate-50
                        border border-slate-200
                        self-start sm:self-auto">

                    <span class="w-2 h-2 rounded-full bg-violet-500"></span>

                    <span class="text-xs font-medium text-slate-600">
                    {{ $receipts->count() }} Receipts
                </span>

                </div>

            </div>


            {{-- Table --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[750px]">

                    {{-- Table Header --}}
                    <thead class="bg-slate-50 border-b border-slate-200">

                    <tr>

                        <th class="px-5 py-3
                                   text-left
                                   text-xs
                                   font-semibold
                                   uppercase
                                   tracking-wide
                                   text-slate-500">
                            #
                        </th>

                        <th class="px-5 py-3
                                   text-left
                                   text-xs
                                   font-semibold
                                   uppercase
                                   tracking-wide
                                   text-slate-500">
                            Name
                        </th>

                        <th class="px-5 py-3
                                   text-left
                                   text-xs
                                   font-semibold
                                   uppercase
                                   tracking-wide
                                   text-slate-500">
                            Mobile
                        </th>

                        <th class="px-5 py-3
                                   text-left
                                   text-xs
                                   font-semibold
                                   uppercase
                                   tracking-wide
                                   text-slate-500">
                            Date
                        </th>

                        <th class="px-5 py-3
                                   text-right
                                   text-xs
                                   font-semibold
                                   uppercase
                                   tracking-wide
                                   text-slate-500">
                            Action
                        </th>

                    </tr>

                    </thead>


                    {{-- Table Body --}}
                    <tbody class="divide-y divide-slate-100">

                    @forelse($receipts as $receipt)

                        <tr class="hover:bg-slate-50 transition">


                            {{-- Number --}}
                            <td class="px-5 py-4
                                       text-sm
                                       text-slate-500">

                                {{ $loop->iteration }}

                            </td>


                            {{-- Name --}}
                            <td class="px-5 py-4">

                                <div>

                                    <p class="text-sm
                                              font-medium
                                              text-slate-800">

                                        {{ $receipt->name }}

                                    </p>

                                    <p class="text-xs
                                              text-slate-400
                                              mt-0.5">

                                        Receipt #{{ $receipt->id }}

                                    </p>

                                </div>

                            </td>


                            {{-- Mobile --}}
                            <td class="px-5 py-4">

                                @if($receipt->mobile)

                                    <span class="text-sm text-slate-600">
                                        {{ $receipt->mobile }}
                                    </span>

                                @else

                                    <span class="text-sm text-slate-400">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- Date --}}
                            <td class="px-5 py-4">

                                <span class="text-sm text-slate-600">

                                    {{ $receipt->date
                                        ? $receipt->date->format('d-m-Y')
                                        : '-' }}

                                </span>

                            </td>


                            {{-- Action --}}
                            {{-- Actions --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center justify-end gap-2">

                                    {{-- View --}}
                                    <a href="{{ route('receipts.view', $receipt) }}"
                                       class="inline-flex items-center gap-1.5
                  px-3 py-1.5
                  rounded-md
                  border border-violet-200
                  text-violet-600
                  text-xs
                  font-medium
                  hover:bg-violet-50
                  transition">

                                        <svg class="w-3.5 h-3.5"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="1.8"
                                                  d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6z"/>

                                            <circle cx="12"
                                                    cy="12"
                                                    r="2.5"
                                                    stroke-width="1.8"/>

                                        </svg>

                                        View

                                    </a>


                                    {{-- Edit --}}
                                    <a href="{{ route('receipts.edit', $receipt) }}"
                                       class="inline-flex items-center gap-1.5
                  px-3 py-1.5
                  rounded-md
                  border border-blue-200
                  text-blue-600
                  text-xs
                  font-medium
                  hover:bg-blue-50
                  transition">

                                        <svg class="w-3.5 h-3.5"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="1.8"
                                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>

                                        </svg>

                                        Edit

                                    </a>


                                    {{-- Delete --}}
                                    <form action="{{ route('receipts.destroy', $receipt) }}"
                                          method="POST"
                                          class="delete-form"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="inline-flex items-center gap-1.5
                           px-3 py-1.5
                           rounded-md
                           border border-red-200
                           text-red-600
                           text-xs
                           font-medium
                           hover:bg-red-50
                           transition">

                                            <svg class="w-3.5 h-3.5"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="1.8"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14"/>

                                            </svg>

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>
                        </tr>


                    @empty

                        {{-- Empty State --}}
                        <tr>

                            <td colspan="5"
                                class="px-5 py-12 text-center">

                                <div class="max-w-sm mx-auto">

                                    {{-- Empty Icon --}}
                                    <div class="w-12 h-12
                                                mx-auto mb-3
                                                rounded-full
                                                bg-slate-100
                                                flex items-center
                                                justify-center">

                                        <svg class="w-6 h-6 text-slate-400"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="1.5"
                                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>

                                        </svg>

                                    </div>


                                    <h3 class="text-base
                                               font-semibold
                                               text-slate-800">

                                        No receipts found

                                    </h3>


                                    <p class="text-sm
                                              text-slate-500
                                              mt-1">

                                        Create your first temple receipt
                                        to get started.

                                    </p>


                                    {{-- New Receipt --}}
                                    <a href="{{ route('receipts.create') }}"
                                       class="mt-4
                                              inline-flex
                                              items-center
                                              gap-2
                                              px-4 py-2
                                              rounded-lg
                                              bg-violet-600
                                              text-white
                                              text-sm
                                              font-medium
                                              hover:bg-violet-700
                                              transition">

                                        <svg class="w-4 h-4"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M12 4v16m8-8H4"/>

                                        </svg>

                                        New Receipt

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection
