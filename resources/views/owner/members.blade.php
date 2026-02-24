<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Roommates - RoomieSync</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 antialiased selection:bg-indigo-500 selection:text-white pb-12">

    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-2">
                    <div
                        class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold text-xl">
                        R</div>
                    <span class="text-xl font-bold tracking-tight text-gray-900">RoomieSync</span>
                </div>
                <div class="hidden sm:flex sm:space-x-8 ml-8 w-full">
                    <a href="#"
                        class="border-transparent text-gray-500 hover:text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Dashboard</a>
                    <a href="#"
                        class="border-transparent text-gray-500 hover:text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Expenses</a>
                    <a href="#"
                        class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Roommates</a>
                    <a href="#"
                        class="border-transparent text-gray-500 hover:text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Categories</a>
                </div>
            </div>
        </div>
    </nav>

    <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Roommates</h1>
                <p class="text-gray-500 mt-1">Invite new people or manage current members of The Sunny Loft.</p>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <div class="bg-gradient-to-r from-indigo-600 to-purple-700 rounded-3xl shadow-lg p-1 overflow-hidden relative">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10">
            </div>

            <div
                class="bg-white rounded-[1.4rem] p-6 sm:p-8 relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex-1">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 text-xs font-bold uppercase tracking-wider mb-3 border border-indigo-100">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Grow your home
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">Invite a Roommate</h2>
                    <p class="text-gray-500 text-sm mt-1">Send this unique link or token to a roommate. They will be
                        added to this home automatically when they register.</p>
                </div>

                <div
                    class="w-full md:w-auto flex-shrink-0 bg-gray-50 p-4 rounded-2xl border border-gray-200 shadow-inner">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Invite
                        Token</label>
                    <div class="flex items-center gap-2">
                        <code
                            class="px-4 py-2.5 bg-white border border-gray-300 rounded-xl text-lg font-mono font-bold text-indigo-600 shadow-sm w-full md:w-48 text-center tracking-widest">
                            X79-B2Q
                        </code>
                        <button
                            class="p-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition-colors shadow-sm focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            title="Copy to clipboard">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </button>
                    </div>
                    <button
                        class="w-full mt-3 py-2 text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors text-center">
                        Or send via Email
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-900">Current Members</h3>
                <span class="bg-gray-200 text-gray-700 py-1 px-3 rounded-full text-xs font-semibold">3 Active</span>
            </div>

            <ul class="divide-y divide-gray-100">
                <li class="p-6 flex flex-col sm:flex-row sm:items-center gap-4 hover:bg-gray-50/50 transition-colors">
                    <div class="relative">
                        <div
                            class="w-14 h-14 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold text-xl shadow-md border-2 border-white">
                            Y</div>
                        <div
                            class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 border-2 border-white rounded-full">
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2">
                            <p class="text-lg font-bold text-gray-900">You <span
                                    class="text-gray-400 font-normal text-sm">(Owner)</span></p>
                            <span
                                class="px-2 py-0.5 rounded text-[10px] font-bold bg-indigo-100 text-indigo-700 uppercase tracking-wider">Admin</span>
                        </div>
                        <p class="text-sm text-gray-500">Joined Jan 15, 2026</p>
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="text-right">
                            <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Reputation</p>
                            <span
                                class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-sm font-bold bg-green-100 text-green-700">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                                        clip-rule="evenodd" />
                                </svg>
                                +5
                            </span>
                        </div>
                        <div class="w-24"></div>
                    </div>
                </li>

                <li class="p-6 flex flex-col sm:flex-row sm:items-center gap-4 hover:bg-gray-50/50 transition-colors">
                    <div class="relative">
                        <div
                            class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-xl shadow-sm border-2 border-white">
                            SJ</div>
                        <div
                            class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 border-2 border-white rounded-full">
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-lg font-bold text-gray-900">Sarah Jenkins</p>
                        <p class="text-sm text-gray-500">sarah@example.com</p>
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="text-right hidden sm:block">
                            <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Reputation</p>
                            <span
                                class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-sm font-bold bg-green-100 text-green-700">+2</span>
                        </div>
                        <button
                            class="w-full sm:w-24 px-4 py-2 border border-red-200 text-red-600 bg-red-50 hover:bg-red-100 hover:border-red-300 rounded-xl text-sm font-bold transition-colors shadow-sm focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Remove
                        </button>
                    </div>
                </li>

                <li class="p-6 flex flex-col sm:flex-row sm:items-center gap-4 hover:bg-gray-50/50 transition-colors">
                    <div class="relative">
                        <div
                            class="w-14 h-14 rounded-full bg-orange-100 flex items-center justify-center text-orange-700 font-bold text-xl shadow-sm border-2 border-white">
                            MK</div>
                        <div
                            class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 border-2 border-white rounded-full">
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-lg font-bold text-gray-900">Mike K.</p>
                        <p class="text-sm text-gray-500">mike@example.com</p>
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="text-right hidden sm:block">
                            <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Reputation</p>
                            <span
                                class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-sm font-bold bg-gray-100 text-gray-600">0</span>
                        </div>
                        <button
                            class="w-full sm:w-24 px-4 py-2 border border-red-200 text-red-600 bg-red-50 hover:bg-red-100 hover:border-red-300 rounded-xl text-sm font-bold transition-colors shadow-sm focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Remove
                        </button>
                    </div>
                </li>
            </ul>
        </div>
    </main>

</body>

</html>