<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Expense Categories - RoomieSync</title>
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
                        class="border-transparent text-gray-500 hover:text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Roommates</a>
                    <a href="#"
                        class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Categories</a>
                </div>
            </div>
        </div>
    </nav>

    <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Expense Categories</h1>
                <p class="text-gray-500 mt-1">Manage the categories your roommates can use when logging expenses.</p>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6 sm:p-8">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Create a New Category</h3>
            <form action="#" method="POST" class="flex flex-col sm:flex-row gap-4">
                @csrf
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <input type="text" name="name" required placeholder="e.g., Cleaning Supplies, Internet, Groceries"
                        class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white transition-all outline-none shadow-sm">
                </div>
                <button type="submit"
                    class="px-8 py-3.5 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 shadow-sm transition-all transform hover:-translate-y-0.5 whitespace-nowrap focus:ring-4 focus:ring-indigo-500/30">
                    Add Category
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

            <div
                class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow group flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="font-bold text-gray-900">Utilities</span>
                </div>
                <button
                    class="text-gray-300 hover:text-red-500 transition-colors p-2 rounded-lg hover:bg-red-50 opacity-100 lg:opacity-0 group-hover:opacity-100"
                    title="Delete Category">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>

            <div
                class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow group flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <span class="font-bold text-gray-900">Groceries</span>
                </div>
                <button
                    class="text-gray-300 hover:text-red-500 transition-colors p-2 rounded-lg hover:bg-red-50 opacity-100 lg:opacity-0 group-hover:opacity-100">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>

            <div
                class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow group flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <span class="font-bold text-gray-900">Rent</span>
                </div>
                <button
                    class="text-gray-300 hover:text-red-500 transition-colors p-2 rounded-lg hover:bg-red-50 opacity-100 lg:opacity-0 group-hover:opacity-100">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>

        </div>
    </main>

</body>

</html>