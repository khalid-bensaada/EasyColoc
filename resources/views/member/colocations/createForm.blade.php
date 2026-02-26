<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle colocation - EasyColoc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-900 antialiased">

    <div class="min-h-screen flex">

        <aside class="w-[270px] bg-white border-r border-slate-200 px-4 py-5 flex flex-col">
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

            <nav class="space-y-1">
                <a href="{{ route('dashboard') }}"
                    class="group flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition text-slate-600 hover:bg-slate-100 hover:text-slate-900">
                    <span
                        class="w-8 h-8 rounded-lg flex items-center justify-center bg-slate-100 group-hover:bg-slate-200">🏠</span>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('member.colocations.index') }}"
                    class="group flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition bg-indigo-50 text-indigo-700">
                    <span class="w-8 h-8 rounded-lg flex items-center justify-center bg-indigo-100">👥</span>
                    <span>Colocations</span>
                </a>



                <a href="{{ route('profile.edit') }}"
                    class="group flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition text-slate-600 hover:bg-slate-100 hover:text-slate-900">
                    <span
                        class="w-8 h-8 rounded-lg flex items-center justify-center bg-slate-100 group-hover:bg-slate-200">👤</span>
                    <span>Profile</span>
                </a>
            </nav>

            <div class="mt-auto pt-6">
                <div class="rounded-2xl bg-slate-900 text-white p-4 shadow-sm">
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="text-[11px] uppercase tracking-wider text-slate-300">Votre réputation</div>
                            <div class="text-2xl font-extrabold mt-1">+{{ $user->reputation ?? 0 }} points</div>
                        </div>
                        <div class="text-xs px-2 py-1 rounded-full bg-slate-700 text-slate-200">Beta</div>
                    </div>
                    <div class="h-2 bg-slate-700 rounded-full mt-4 overflow-hidden">
                        <div class="h-full w-1/3 bg-green-400"></div>
                    </div>
                    <div class="text-[11px] text-slate-300 mt-2">Keep it high by paying on time.</div>
                </div>
            </div>
        </aside>


        <main class="flex-1 px-6 py-6">


            


            <section class="max-w-3xl">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-200">
                        <h2 class="font-semibold text-lg">Colocation details</h2>
                        <p class="text-sm text-slate-500 mt-1">Choose a name and create your shared home.</p>
                    </div>

                    <form method="POST" action="{{ route('colocation.store') }}" class="p-6 space-y-6">
                        @csrf

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Colocation name
                            </label>
                            <input type="text" name="name" placeholder="Example: COLOC 1"
                                class="w-full text-sm border border-slate-200 rounded-xl px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-200"
                                required />
                            <p class="text-xs text-slate-500 mt-2">
                                Tip: use something simple (city / house name).
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Description
                            </label>
                            <textarea name="description" rows="4"
                                placeholder="Short description about this colocation..."
                                class="w-full text-sm border border-slate-200 rounded-xl px-4 py-3 bg-white resize-none focus:outline-none focus:ring-2 focus:ring-indigo-200"></textarea>
                            <p class="text-xs text-slate-500 mt-2">
                                Optional: add some details about the house or members.
                            </p>
                        </div>

                        <div class="rounded-2xl border border-indigo-200 bg-indigo-50 p-4">
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-10 h-10 rounded-xl bg-white border border-indigo-200 flex items-center justify-center">
                                    🧠
                                </div>
                                <div class="text-sm text-indigo-900">
                                    <div class="font-semibold">What happens after creation?</div>
                                    <ul class="mt-2 space-y-1 text-indigo-800/90">
                                        <li>• You become the <span class="font-semibold">Owner</span> of this
                                            colocation.</li>
                                        <li>• You can invite members using a link/token (later).</li>
                                        <li>• You can start adding expenses right away.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-2">
                            <a href="{{ route('member.colocations.index') }}"
                                class="px-5 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-700 font-semibold hover:bg-slate-50 transition">
                                Cancel
                            </a>

                            <button type="submit"
                                class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition shadow-sm">
                                Create colocation
                            </button>
                        </div>
                    </form>
                </div>
            </section>

        </main>
    </div>
</body>

</html>