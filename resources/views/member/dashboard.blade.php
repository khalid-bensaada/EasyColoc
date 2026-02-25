<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - EasyColoc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-900 antialiased">
    @php
        $user = auth()->user();

        $userName = $user->name;
        $initial = strtoupper(substr($userName, 0, 1));

        $isAdmin = false;
        if ($user) {
            $isAdmin = $user->role?->name === 'Admin';
        }

        $current = 'dashboard';
    @endphp

    <div class="min-h-screen flex">

        {{-- SIDEBAR --}}
        <aside class="w-[270px] bg-white border-r border-slate-200 px-4 py-5 flex flex-col">
            {{-- Logo --}}
            <div class="flex items-center gap-3 px-2 mb-8">
                <div
                    class="w-10 h-10 rounded-2xl bg-indigo-600 text-white flex items-center justify-center font-extrabold tracking-tight shadow-sm">
                    E
                </div>
                <div>
                    <div class="text-base font-semibold text-slate-900 leading-tight">EasyColoc</div>
                    <div class="text-xs text-slate-500 leading-tight">Member Area</div>
                </div>
            </div>

            {{-- Nav --}}
            <nav class="space-y-1">
                <a href="" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition
              bg-indigo-50 text-indigo-700 ">
                    <span class="w-8 h-8 rounded-lg flex items-center justify-center
          bg-indigo-100">
                        🏠
                    </span>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('member.colocations.index') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition
              text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span class="w-8 h-8 rounded-lg flex items-center justify-center
               bg-slate-100 group-hover:bg-slate-200">
                        👥
                    </span>
                    <span>Colocations</span>
                </a>

                @if ($isAdmin)
                    <a href="{{ route('admin.dashboard') }}"
                        class="group flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition text-slate-600 hover:bg-slate-100 hover:text-slate-900">
                        <span
                            class="w-8 h-8 rounded-lg flex items-center justify-center bg-slate-100 group-hover:bg-slate-200">
                            🛡️
                        </span>
                        <span>Admin</span>
                    </a>
                @endif

                <a href="{{ route('profile.edit') }}"
                    class="group flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition text-slate-600 hover:bg-slate-100 hover:text-slate-900">
                    <span
                        class="w-8 h-8 rounded-lg flex items-center justify-center bg-slate-100 group-hover:bg-slate-200">
                        👤
                    </span>
                    <span>Profile</span>
                </a>
            </nav>

            {{-- Reputation card --}}
            <div class="mt-auto pt-6">
                <div class="rounded-2xl bg-slate-900 text-white p-4 shadow-sm">
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="text-[11px] uppercase tracking-wider text-slate-300">Votre réputation</div>
                            <div class="text-2xl font-extrabold mt-1">+0 points</div>
                        </div>
                        <div class="text-xs px-2 py-1 rounded-full bg-slate-700 text-slate-200">
                            Beta
                        </div>
                    </div>

                    <div class="h-2 bg-slate-700 rounded-full mt-4 overflow-hidden">
                        <div class="h-full w-1/3 bg-green-400"></div>
                    </div>
                    <div class="text-[11px] text-slate-300 mt-2">
                        Improve by paying on time.
                    </div>
                </div>
            </div>
        </aside>

        {{-- MAIN --}}
        <main class="flex-1 px-6 py-6">
            {{-- Top bar --}}
            <div class="flex items-center justify-between gap-4 mb-8">
                <div>
                    <div class="text-xs text-slate-500 mb-1">EasyColoc / Member</div>
                    <h1 class="text-2xl font-semibold tracking-tight">Dashboard</h1>
                    <p class="text-sm text-slate-500 mt-1">Your stats overview</p>
                </div>

                <div class="flex items-center gap-3">
                    <span
                        class="hidden sm:inline-flex items-center gap-2 text-xs font-medium text-emerald-700 bg-emerald-50 px-3 py-1.5 rounded-full border border-emerald-100">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        Online
                    </span>

                    <div
                        class="flex items-center gap-3 bg-white border border-slate-200 px-3 py-2 rounded-2xl shadow-sm">
                        <div class="text-right leading-tight">
                            <div class="text-sm font-semibold uppercase">{{ $userName }}</div>
                            <div class="text-xs text-slate-500">{{ $isAdmin ? 'ADMIN' : 'MEMBER' }}</div>
                        </div>

                        <div
                            class="w-10 h-10 rounded-full bg-slate-900 text-white flex items-center justify-center font-bold">
                            {{ $initial }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-slate-500">My colocations</div>
                        <div
                            class="w-9 h-9 rounded-xl bg-indigo-50 flex items-center justify-center border border-indigo-100">
                            🏠</div>
                    </div>
                    <div class="text-3xl font-bold mt-3">0</div>
                    <div class="text-xs text-slate-500 mt-1">Active homes you joined/created</div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-slate-500">Total expenses</div>
                        <div
                            class="w-9 h-9 rounded-xl bg-indigo-50 flex items-center justify-center border border-indigo-100">
                            🧾</div>
                    </div>
                    <div class="text-3xl font-bold mt-3">0</div>
                    <div class="text-xs text-slate-500 mt-1">Expenses created in your colocations</div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-slate-500">Balance</div>
                        <div
                            class="w-9 h-9 rounded-xl bg-indigo-50 flex items-center justify-center border border-indigo-100">
                            ⚖️</div>
                    </div>
                    <div class="text-3xl font-bold mt-3">0 DH</div>
                    <div class="text-xs text-slate-500 mt-1">What you owe / what you should receive</div>
                </div>
            </div>


        </main>
    </div>

</body>

</html>