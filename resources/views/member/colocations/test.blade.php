
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoomMate Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        },
                        success: {
                            500: '#10b981',
                            600: '#059669',
                        },
                        danger: {
                            500: '#ef4444',
                            600: '#dc2626',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .float-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        /* Dropdown animation */
        .dropdown-menu {
            transform-origin: top right;
            transition: all 0.2s ease-out;
        }

        .dropdown-menu.hidden {
            opacity: 0;
            transform: scale(0.95);
            pointer-events: none;
        }

        .dropdown-menu:not(.hidden) {
            opacity: 1;
            transform: scale(1);
            pointer-events: auto;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 antialiased">

    <!-- Top Navigation -->
    <nav class="glass-effect w-full z-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo - Links to Home -->
                <a href="/" class="flex items-center space-x-2 hover:opacity-80 transition">
                    <div class="w-8 h-8 gradient-bg rounded-lg flex items-center justify-center">
                        <i data-lucide="home" class="w-5 h-5 text-white"></i>
                    </div>
                    <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600">EasyColoc</span>
                </a>

                <!-- Right Side -->
                <div class="flex items-center space-x-4">
                    <button onclick="openModal('createColocModal')" class="hidden sm:inline-flex items-center px-4 py-2 gradient-bg text-white rounded-lg font-medium hover:opacity-90 transition shadow-md">
                        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                        New Home
                    </button>

                    <div class="relative inline-block">

                        <!-- Button -->
                        <button id="notifBtn"
                            class="relative p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition">

                            <!-- Bell SVG (no lucide needed) -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405C18.21 15.21 18 14.7 18 14.172V11a6 6 0 10-12 0v3.172c0 .528-.21 1.038-.595 1.423L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>

                            <!-- Red Dot -->
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                        </button>

                        <!-- Dropdown -->
                        <div id="notifDropdown"
                            class="absolute right-0 mt-3 w-72 bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden
                transform scale-y-0 origin-top transition-transform duration-300 ease-out">

                            <div class="p-4 font-semibold border-b">
                                Notifications
                            </div>

                            <ul class="divide-y">
                                <li class="p-4 hover:bg-gray-50 cursor-pointer">
                                    New user registered
                                </li>
                                <li class="p-4 hover:bg-gray-50 cursor-pointer">
                                    Payment received
                                </li>
                                <li class="p-4 hover:bg-gray-50 cursor-pointer">
                                    Reputation updated
                                </li>
                            </ul>

                        </div>
                    </div>

                    <!-- User Profile Dropdown -->
                    <div class="relative" id="userDropdown">
                        <button onclick="toggleDropdown()" class="flex items-center space-x-3 pl-3 border-l border-gray-200 hover:bg-gray-50 rounded-lg py-1 pr-1 transition">

                            <img src="https://i.pravatar.cc/150?img=11" alt="User" class="w-10 h-10 rounded-full border-2 border-primary-500 shadow-sm object-cover">
                            <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400 hidden sm:block"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="dropdownMenu" class="dropdown-menu hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-50">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm font-semibold text-gray-900">John Doe</p>
                                <p class="text-xs text-gray-500">john.doe@example.com</p>
                            </div>
                            <a href="#" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition">
                                <i data-lucide="user" class="w-4 h-4 mr-3 text-gray-400"></i>
                                Profile
                            </a>
                            <a href="#" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition">
                                <i data-lucide="settings" class="w-4 h-4 mr-3 text-gray-400"></i>
                                Settings
                            </a>
                            <div class="border-t border-gray-100 mt-1 pt-1">
                                <a href="#" class="flex items-center px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition">
                                    <i data-lucide="log-out" class="w-4 h-4 mr-3 text-red-500"></i>
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20 pb-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-8">
        @if($accommodation)
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 card-hover mb-8">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-blue-100 rounded-xl">
                    <i data-lucide="home" class="w-6 h-6 text-blue-600"></i>
                </div>
                <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded-full">

                </span>
            </div>

            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $accommodation->name }}</h3>
            <p class="text-gray-500 mb-4">{{ $accommodation->adress }}</p>

            <!-- 🔹 Local Token Area (ADDED) -->
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 mb-4">
                <p class="text-sm text-gray-500 mb-2">Home Invitation Token</p>
                <div class="flex items-center justify-between">
                    <span class="font-mono text-lg tracking-wider text-gray-900">
                        {{ $accommodation->local_token }}
                    </span>
                    <button
                        onclick="navigator.clipboard.writeText('{{ $accommodation->token }}'); showToast('Token copied!')"
                        class="px-3 py-1.5 text-sm bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                        Copy
                    </button>
                </div>
            </div>
            <!-- 🔹 END Token Area -->

            <div class="flex gap-3">
                <button onclick="openModal('joinModal')"
                    class="px-4 py-2 bg-white text-primary-600 border border-primary-200 rounded-xl font-medium hover:bg-gray-50 transition">
                    Invite Member
                </button>
            </div>
        </div>
        @else
        <!-- Welcome Banner -->
        

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 card-hover mb-8 text-center">
            <p class="text-gray-500">You have no active shared home. Create or join a home to see details here.</p>
        </div>
        @endif

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-yellow-100 rounded-xl">
                        <i data-lucide="star" class="w-6 h-6 text-yellow-600"></i>
                    </div>
                    <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded-full">Global</span>
                </div>
                <p class="text-sm text-gray-500 mb-1">My Reputation Score</p>
                <p class="text-2xl font-bold text-gray-900">0</p>

            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-purple-100 rounded-xl">
                        <i data-lucide="shopping-cart" class="w-6 h-6 text-purple-600"></i>
                    </div>
                    <span class="text-xs font-medium text-primary-600 bg-primary-50 px-2 py-1 rounded-full">February</span>
                </div>
                <p class="text-sm text-gray-500 mb-1">Total Expenses</p>
                <p class="text-2xl font-bold text-gray-900">$0.00</p>

            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-blue-100 rounded-xl">
                        <i data-lucide="users" class="w-6 h-6 text-blue-600"></i>
                    </div>
                    <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded-full">Total</span>
                </div>
                <p class="text-sm text-gray-500 mb-1">Active Members</p>
                <p class="text-2xl font-bold text-gray-900">{{$membershipscount}}</p>

            </div>

        </div>

        <!-- Main Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Recent Expenses -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden card-hover">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary-100 rounded-lg">
                            <i data-lucide="receipt" class="w-5 h-5 text-primary-600"></i>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg">Recent Expenses</h3>
                    </div>

                </div>

                @if($expenses)

                <div class="space-y-3">
                    @foreach($expenses as $expense)
                    <div class="flex justify-between items-center p-4 bg-white rounded-xl shadow-sm border">

                        <div>
                            <p class="font-medium text-gray-900">
                                {{ $expense->title }}
                            </p>
                            <p class="text-sm text-gray-500">
                                Added by {{ $expense->name }}
                            </p>
                        </div>

                        <div class="text-right">
                            <p class="font-semibold text-primary-600">
                                {{ number_format($expense->amount, 2) }} MAD
                            </p>
                        </div>

                    </div>
                    @endforeach
                </div>

                <!-- ✅ Added Button -->
                <div class="text-center mt-6">
                    <button onclick="openModal('expenseModal')"
                        class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition shadow-md">
                        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                        Add More Expenses
                    </button>
                </div>

                @else

                <!-- Your Empty State -->
                <div class="p-12 text-center">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 float-animation">
                        <i data-lucide="receipt" class="w-10 h-10 text-gray-400"></i>
                    </div>
                    <h4 class="text-lg font-medium text-gray-900 mb-2">No recent expenses</h4>
                    <p class="text-gray-500 mb-6 max-w-sm mx-auto">
                        Start adding expenses to see history and statistics here.
                    </p>
                    <button onclick="openModal('expenseModal')"
                        class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition shadow-md">
                        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                        Add Expense
                    </button>
                </div>

                @endif
            </div>

            <!-- Members Card -->
            <div class="bg-gradient-to-br from-indigo-600 to-purple-700 text-white rounded-2xl p-6 shadow-lg card-hover relative overflow-hidden">
                @if($accommodation)
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16 blur-2xl"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full -ml-12 -mb-12 blur-xl"></div>

                <div class="relative z-10">

                    <div class="flex justify-between items-center mb-6">
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <i data-lucide="users" class="w-6 h-6 text-white"></i>
                        </div>
                        <span class="text-xs bg-white/20 px-3 py-1 rounded-full font-medium border border-white/20">
                            aaa
                        </span>
                    </div>

                    <h3 class="font-bold text-xl mb-4">Home Members</h3>

                    <h2 class="font-bold mb-2 text-white">aaaa</h2>

                    <div class="space-y-3 max-h-60 overflow-y-auto pr-1">

                        <div class="flex justify-between items-center bg-white/10 px-4 py-3 rounded-xl backdrop-blur-sm">
                            <div>

                                <p class="font-semibold">aaaaa</p>
                                <p class="text-xs text-indigo-100">aaaa</p>
                            </div>

                            <div class="text-right">
                                <p class="font-bold text-red-300">
                                    Owes $aa
                                </p>

                                <p class="font-bold text-green-300">
                                    Gets $aa
                                </p>

                                <p class="font-bold text-white">
                                    aa
                                </p>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            @else
            <!-- ORIGINAL EMPTY STATE -->
            
            @endif
        </div>

        </div>

        <!-- Quick Actions Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 card-hover flex items-center gap-4 cursor-pointer group" onclick="openModal('joinModal')">
                <div class="p-3 bg-green-100 rounded-xl group-hover:bg-green-200 transition">
                    <i data-lucide="log-in" class="w-6 h-6 text-green-600"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-900 group-hover:text-primary-600 transition">Join a Home</h4>
                    <p class="text-sm text-gray-500">Use invitation token</p>
                </div>
                <i data-lucide="arrow-right" class="w-5 h-5 text-gray-400 ml-auto group-hover:text-primary-600 transition"></i>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 card-hover flex items-center gap-4 cursor-pointer group">
                <div class="p-3 bg-blue-100 rounded-xl group-hover:bg-blue-200 transition">
                    <i data-lucide="help-circle" class="w-6 h-6 text-blue-600"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-900 group-hover:text-primary-600 transition">Help Center</h4>
                    <p class="text-sm text-gray-500">Guides & FAQ</p>
                </div>
                <i data-lucide="arrow-right" class="w-5 h-5 text-gray-400 ml-auto group-hover:text-primary-600 transition"></i>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 card-hover flex items-center gap-4 cursor-pointer group">
                <div class="p-3 bg-purple-100 rounded-xl group-hover:bg-purple-200 transition">
                    <i data-lucide="mail" class="w-6 h-6 text-purple-600"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-900 group-hover:text-primary-600 transition">Contact Support</h4>
                    <p class="text-sm text-gray-500">Have a question?</p>
                </div>
                <i data-lucide="arrow-right" class="w-5 h-5 text-gray-400 ml-auto group-hover:text-primary-600 transition"></i>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 px-6 py-6">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-sm text-gray-500">© 2024 EasyColoc. All rights reserved.</p>
            <div class="flex items-center gap-6">
                <a href="#" class="text-sm text-gray-500 hover:text-primary-600 transition">Privacy</a>
                <a href="#" class="text-sm text-gray-500 hover:text-primary-600 transition">Terms</a>
                <a href="#" class="text-sm text-gray-500 hover:text-primary-600 transition">Contact</a>
            </div>
        </div>
    </footer>

    <!-- Create Shared Home Modal -->
    <div id="createColocModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm transition-opacity" onclick="closeModal('createColocModal')"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg transform transition-all scale-100 max-h-[90vh] overflow-y-auto">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center sticky top-0 bg-white z-10">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-indigo-100 rounded-lg">
                            <i data-lucide="home" class="w-5 h-5 text-indigo-600"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">New Shared Home</h2>
                    </div>
                    <button onclick="closeModal('createColocModal')" class="p-2 hover:bg-gray-100 rounded-lg transition">
                        <i data-lucide="x" class="w-5 h-5 text-gray-500"></i>
                    </button>
                </div>

                <form method="post" action=" {{ Route('Create.accommodation')}}" class="p-6 space-y-6" onsubmit="closeModal('createColocModal');">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Home Name <span class="text-red-500">*</span></label>
                        <input name="name" type="text" placeholder="e.g., Sunset Apartment" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Address <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <i data-lucide="map-pin" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5"></i>
                            <input name="adress" type="text" placeholder="123 Youcode, Safi, CP 46000" required
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition">
                        </div>
                    </div>

                    <div class="bg-blue-50 rounded-xl p-4 border border-blue-100">
                        <div class="flex items-start gap-3">
                            <i data-lucide="info" class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5"></i>
                            <p class="text-sm text-blue-800">By creating a shared home, you automatically become the Owner with full administrative rights.</p>
                        </div>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="button" onclick="closeModal('createColocModal')"
                            class="flex-1 px-4 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition">Cancel</button>
                        <button type="submit"
                            class="flex-1 px-4 py-3 gradient-bg text-white rounded-xl font-medium hover:opacity-90 transition shadow-lg">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Join with Token Modal -->
    <div id="joinModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm transition-opacity" onclick="closeModal('joinModal')"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all scale-100">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-green-100 rounded-lg">
                            <i data-lucide="log-in" class="w-5 h-5 text-green-600"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">Join a Home</h2>
                    </div>
                    <button onclick="closeModal('joinModal')" class="p-2 hover:bg-gray-100 rounded-lg transition">
                        <i data-lucide="x" class="w-5 h-5 text-gray-500"></i>
                    </button>
                </div>

                <form method="post" action="{{Route('join.home')}}" class="p-6 space-y-6" onsubmit=" closeModal('joinModal');">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Invitation Token <span class="text-red-500">*</span>
                        </label>
                        <input name="token" type="text" placeholder="Enter token" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none transition text-center text-lg">
                        <p class="text-xs text-gray-500 mt-2 text-center">
                            Enter the 12-character code sent by email
                        </p>
                    </div>

                    <div class="bg-yellow-50 rounded-xl p-4 border border-yellow-100">
                        <div class="flex items-start gap-3">
                            <i data-lucide="alert-circle" class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5"></i>
                            <div class="text-sm text-yellow-800">
                                <p class="font-medium mb-1">Important</p>
                                <p>You can only join one active shared home at a time.</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="closeModal('joinModal')"
                            class="flex-1 px-4 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition">Cancel</button>
                        <button type="submit"
                            class="flex-1 px-4 py-3 bg-green-600 text-white rounded-xl font-medium hover:bg-green-700 transition shadow-lg">Join</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Expense Modal -->
    <div id="expenseModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm transition-opacity" onclick="closeModal('expenseModal')"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg transform transition-all scale-100">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-purple-100 rounded-lg">
                            <i data-lucide="receipt" class="w-5 h-5 text-purple-600"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">New Expense</h2>
                    </div>
                    <button onclick="closeModal('expenseModal')" class="p-2 hover:bg-gray-100 rounded-lg transition">
                        <i data-lucide="x" class="w-5 h-5 text-gray-500"></i>
                    </button>
                </div>

                <form method="POST" action="{{Route('add.expenses')}}" class="p-6 space-y-6" onsubmit="closeModal('expenseModal');">
                    @csrf
                    @if($accommodation)
                    <input name="accommo_id" value="{{$accommodation->id}}" type="text" hidden>
                    @endif
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Title <span class="text-red-500">*</span></label>
                        <input name="title" type="text" placeholder="e.g., Grocery Shopping" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none transition">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Amount MAD<span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input name="amount" type="number" step="0.01" placeholder="0.00" required
                                    class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none transition">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                            <input type="date"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <div class="grid grid-cols-3 gap-2">
                            <label class="cursor-pointer">
                                <input value="1" type="radio" name="category" class="peer sr-only" checked>
                                <div class="p-3 rounded-xl border-2 border-gray-200 peer-checked:border-purple-500 peer-checked:bg-purple-50 text-center transition hover:border-purple-300">
                                    <i data-lucide="home" class="w-5 h-5 mx-auto mb-1 text-gray-600 peer-checked:text-purple-600"></i>
                                    <span class="text-xs font-medium">Rent</span>
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input value="1" type="radio" name="category" class="peer sr-only">
                                <div class="p-3 rounded-xl border-2 border-gray-200 peer-checked:border-purple-500 peer-checked:bg-purple-50 text-center transition hover:border-purple-300">
                                    <i data-lucide="shopping-cart" class="w-5 h-5 mx-auto mb-1 text-gray-600 peer-checked:text-purple-600"></i>
                                    <span class="text-xs font-medium">Groceries</span>
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input value="1" type="radio" name="category" class="peer sr-only">
                                <div class="p-3 rounded-xl border-2 border-gray-200 peer-checked:border-purple-500 peer-checked:bg-purple-50 text-center transition hover:border-purple-300">
                                    <i data-lucide="zap" class="w-5 h-5 mx-auto mb-1 text-gray-600 peer-checked:text-purple-600"></i>
                                    <span class="text-xs font-medium">Bills</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="button" onclick="closeModal('expenseModal')"
                            class="flex-1 px-4 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition">Cancel</button>
                        <button type="submit"
                            class="flex-1 px-4 py-3 bg-purple-600 text-white rounded-xl font-medium hover:bg-purple-700 transition shadow-lg">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed bottom-4 right-4 transform translate-y-20 opacity-0 transition-all duration-300 z-50">
        <div class="bg-gray-900 text-white px-6 py-3 rounded-xl shadow-lg flex items-center gap-3">
            <i data-lucide="check-circle" class="w-5 h-5 text-green-400"></i>
            <span id="toastMessage">Success</span>
        </div>
    </div>

    @if(session('success'))
    <div id="success-popup" class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 opacity-0 transition-opacity duration-500">
        {{session('success')}}
    </div>
    @endif

    @if(session('failure'))
    <div id="success-popup" class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 opacity-0 transition-opacity duration-500">
        {{session('failure')}}
    </div>
    @endif

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Dropdown toggle function
        function toggleDropdown() {
            const menu = document.getElementById('dropdownMenu');
            menu.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const menu = document.getElementById('dropdownMenu');

            if (!dropdown.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });

        // Modal functions
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Toast notification
        function showToast(message) {
            const toast = document.getElementById('toast');
            document.getElementById('toastMessage').textContent = message;
            toast.classList.remove('translate-y-20', 'opacity-0');
            setTimeout(() => {
                toast.classList.add('translate-y-20', 'opacity-0');
            }, 3000);
        }

        // Close modals on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeModal('createColocModal');
                closeModal('joinModal');
                closeModal('expenseModal');
                document.getElementById('dropdownMenu').classList.add('hidden');
            }
        });

        const btn = document.getElementById('notifBtn');
        const dropdown = document.getElementById('notifDropdown');

        btn.addEventListener('click', () => {
            dropdown.classList.toggle('scale-y-0');
        });

        // Close when clicking outside
        document.addEventListener('click', function(event) {
            if (!btn.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('scale-y-0');
            }
        });

        window.addEventListener('DOMContentLoaded', () => {
            const popup = document.getElementById('success-popup');

            // Show the popup
            popup.classList.remove('opacity-0');
            popup.classList.add('opacity-100');

            // Hide after 10 seconds
            setTimeout(() => {
                popup.classList.remove('opacity-100');
                popup.classList.add('opacity-0');
            }, 10000);
        });
    </script>
</body>

</html>