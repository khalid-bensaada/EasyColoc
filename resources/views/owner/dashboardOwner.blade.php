<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Owner Dashboard - RoomieSync</title>
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
                        class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Dashboard</a>
                    <a href="#"
                        class="border-transparent text-gray-500 hover:text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors">Expenses</a>
                    <a href="#"
                        class="border-transparent text-gray-500 hover:text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors">Roommates</a>
                    <a href="#"
                        class="border-transparent text-gray-500 hover:text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors">Categories</a>
                </div>
                <div class="flex items-center gap-4">
                    <span
                        class="hidden sm:inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-purple-100 text-purple-700 border border-purple-200 uppercase tracking-wider">
                        Home Owner
                    </span>
                    <div
                        class="h-8 w-8 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 border-2 border-white shadow-sm cursor-pointer">
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">The Sunny Loft</h1>
                <p class="text-gray-500 mt-1">Welcome back, Alex. Here is the financial status of your home.</p>
            </div>
            <div class="flex items-center gap-3">
                <button
                    class="px-4 py-2 bg-white border border-gray-200 text-gray-700 text-sm font-bold rounded-xl hover:bg-gray-50 shadow-sm transition-colors">
                    Invite Member
                </button>
                <button
                    class="px-4 py-2 bg-indigo-600 text-white text-sm font-bold rounded-xl hover:bg-indigo-700 shadow-sm transition-all transform hover:-translate-y-0.5 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Expense
                </button>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm relative overflow-hidden">
                <p class="text-sm font-medium text-gray-500 mb-1">Total House Spending</p>
                <h2 class="text-4xl font-extrabold text-gray-900">$1,250.00</h2>
                <p class="text-sm text-gray-500 mt-2">Current Month</p>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm relative overflow-hidden">
                <p class="text-sm font-medium text-gray-500 mb-1">Your Balance</p>
                <h2 class="text-4xl font-extrabold text-green-600">+$20.00</h2>
                <p class="text-sm text-gray-500 mt-2">You are owed money</p>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm relative overflow-hidden">
                <p class="text-sm font-medium text-gray-500 mb-1">Active Roommates</p>
                <h2 class="text-4xl font-extrabold text-indigo-600">3</h2>
                <p class="text-sm text-gray-500 mt-2">All members active</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-900">Who Owes Whom</h3>
                <span class="bg-indigo-100 text-indigo-700 py-1 px-3 rounded-full text-xs font-semibold">Live
                    Balances</span>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div
                    class="flex items-center justify-between p-4 rounded-xl border border-gray-100 bg-white shadow-sm hover:border-indigo-200 transition-colors">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center font-bold text-orange-600">
                            MK</div>
                        <div>
                            <p class="text-gray-900 font-medium"><span class="font-bold">Mike</span> owes you</p>
                            <p class="text-xs text-gray-500">For overall balance</p>
                        </div>
                    </div>
                    <span class="text-xl font-bold text-green-600">$20.00</span>
                </div>

                <div
                    class="flex items-center justify-between p-4 rounded-xl border border-gray-100 bg-white shadow-sm hover:border-indigo-200 transition-colors">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center font-bold text-blue-600">
                            SJ</div>
                        <div>
                            <p class="text-gray-900 font-medium"><span class="font-bold">Sarah</span> owes Mike</p>
                            <p class="text-xs text-gray-500">For overall balance</p>
                        </div>
                    </div>
                    <span class="text-xl font-bold text-gray-900">$45.00</span>
                </div>
            </div>
        </div>

    </main>
</body>

</html>