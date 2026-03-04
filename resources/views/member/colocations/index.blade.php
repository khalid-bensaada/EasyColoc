<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes colocations - EasyColoc</title>

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
                <a href="{{ route('dashboard') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition
               text-slate-600 hover:bg-slate-100 hover:text-slate-900">
                    <span class="w-8 h-8 rounded-lg flex items-center justify-center
               bg-slate-100 group-hover:bg-slate-200">
                        🏠
                    </span>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('member.colocations.index') }}"
                    class="group flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition bg-indigo-50 text-indigo-700">
                    <span class="w-8 h-8 rounded-lg flex items-center justify-center bg-indigo-100">
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
                            <div class="text-2xl font-extrabold mt-1">+{{ $user->reputation ?? 0 }} points</div>
                        </div>
                        <div class="text-xs px-2 py-1 rounded-full bg-slate-700 text-slate-200">
                            Beta
                        </div>
                    </div>

                    <div class="h-2 bg-slate-700 rounded-full mt-4 overflow-hidden">
                        <div class="h-full w-1/3 bg-green-400"></div>
                    </div>
                    <div class="text-[11px] text-slate-300 mt-2">
                        Keep it high by paying on time.
                    </div>
                </div>
            </div>
        </aside>

        {{-- MAIN --}}
        <main class="flex-1 px-6 py-6">

            {{-- HEADER --}}
            <div class="flex items-center justify-between gap-4 mb-8">
                <div>
                    <div class="text-xs text-slate-500 mb-1">EasyColoc / Member</div>
                    <h1 class="text-2xl font-semibold tracking-tight">Mes colocations</h1>
                    <p class="text-sm text-slate-500 mt-1">Create or manage your shared homes</p>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('member.colocations.joinForm') }}"
                        class="px-4 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 font-semibold hover:bg-slate-50 transition shadow-sm inline-block">
                        Rejoindre une colocation
                    </a>

                    <a href="{{ route('member.colocations.createForm') }}"
                        class="px-4 py-2 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition shadow-sm inline-block">
                        + Nouvelle colocation
                    </a>

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

            {{-- CONTENT --}}
            <section class="bg-white rounded-2xl border border-slate-200 shadow-sm">
                @if($colocations->isEmpty())

                    <div class="text-center py-24 text-slate-500">
                        <div
                            class="mx-auto w-14 h-14 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-3xl">
                            👥
                        </div>

                        <div class="mt-4 text-lg font-semibold text-slate-800">
                            Aucune colocation
                        </div>

                        <div class="text-sm mt-1">
                            Commencez par en créer une nouvelle.
                        </div>

                        <a href="{{ route('member.colocations.createForm') }}"
                            class="inline-block mt-6 px-5 py-2.5 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition shadow-sm">
                            + Nouvelle colocation
                        </a>
                    </div>

                @else

                    <div class="p-6 grid md:grid-cols-2 xl:grid-cols-3 gap-6">

                        @foreach($colocations as $colocation)

                            <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition">

                                <div class="flex items-start justify-between mb-4">
                                    <div>
                                        <h3 class="font-semibold text-lg text-slate-900">
                                            {{ $colocation->name }}
                                        </h3>

                                        <p class="text-sm text-slate-500 mt-1">
                                            {{ $colocation->description ?? 'No description available.' }}
                                        </p>
                                    </div>


                                </div>

                                <div class="text-xs text-slate-400 mb-4">
                                    Created {{ $colocation->created_at->diffForHumans() }}
                                </div>

                                <div class="flex items-center justify-between">
                                    <a href="{{ route('member.colocations.ownercoloc', $colocation->id) }}"
                                        class="text-indigo-600">
                                        View colocation →
                                    </a>
                                </div>
                                @if(auth()->id() === $colocation->owner_id && $colocation->status === 'active')

                                    <form method="POST" action="{{ route('colocation.cancel', $colocation->id) }}">
                                        @csrf

                                        <button type="submit"
                                            class="text-sm font-semibold text-red-600 hover:text-red-800 transition">
                                            Desactive
                                        </button>

                                    </form>

                                @endif

                            </div>

                        @endforeach

                    </div>

                @endif


            </section>

        </main>
    </div>
</body>

</html>