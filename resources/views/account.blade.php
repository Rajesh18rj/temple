@extends('layouts.master')

@section('content')

    <div class="mx-auto max-w-4xl">

        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">
                My Account
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                View your account information.
            </p>
        </div>

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 bg-slate-50/50 px-6 py-5">
                <h2 class="text-sm font-bold text-slate-800">
                    Account Information
                </h2>

                <p class="mt-1 text-xs text-slate-400">
                    Your administrator account details
                </p>
            </div>

            <div class="p-6">

                <div class="flex items-center gap-4">

                    <div class="flex h-14 w-14 items-center justify-center
                            rounded-2xl
                            bg-gradient-to-br from-indigo-600
                            via-violet-600 to-fuchsia-500
                            text-lg font-bold text-white shadow-md">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>

                    <div>
                        <h3 class="text-base font-bold text-slate-800">
                            {{ auth()->user()->name }}
                        </h3>

                        <p class="mt-0.5 text-sm text-slate-500">
                            {{ auth()->user()->email }}
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
