<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoomMate Dashboard - EasyColoc</title>
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
            background-color: #f1f5f9;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .float-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 antialiased">

    <nav class="glass-effect fixed top-0 w-full z-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="/" class="flex items-center space-x-2 hover:opacity-80 transition">
                    <div class="w-8 h-8 gradient-bg rounded-lg flex items-center justify-center">
                        <i data-lucide="home" class="w-5 h-5 text-white"></i>
                    </div>
                    <span
                        class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600">EasyColoc</span>
                </a>

                <div class="flex items-center space-x-4">
                    @if($colocation)
                        <form method="POST" action="{{ route('leave.accommodation') }}">
                            @csrf
                            <input name="owner_id" value="{{ $colocation->members_id }}" type="hidden">
                            <button type="submit" onclick="return confirm('Are you sure?')"
                                class="px-4 py-2 rounded-xl bg-red-500 text-white text-sm font-semibold hover:bg-red-600 transition-all hover:scale-105">
                                Leave Home
                            </button>
                        </form>
                    @endif

                    <div class="relative">
                        <button id="notifBtn"
                            class="p-2 text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition">
                            <i data-lucide="bell" class="w-6 h-6"></i>
                            <span
                                class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                        </button>
                        <div id="notifDropdown"
                            class="absolute right-0 mt-3 w-72 bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden hidden transform origin-top transition-all">
                            <div class="p-4 font-semibold border-b">Notifications</div>
                            <ul class="divide-y text-sm">
                                <li class="p-4 hover:bg-slate-50 cursor-pointer">Check your latest balances.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="relative" id="userDropdownContainer">
                        <button onclick="toggleUserDropdown()"
                            class="flex items-center gap-3 pl-4 border-l border-slate-200 group">
                            <div
                                class="w-9 h-9 rounded-full bg-indigo-500 text-white flex items-center justify-center font-semibold text-sm">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="hidden sm:block text-left">
                                <p class="text-sm font-semibold text-slate-700 group-hover:text-indigo-600">
                                    {{ auth()->user()->name }}
                                </p>
                                <p class="text-xs text-slate-400 text-left">Account</p>
                            </div>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400"></i>
                        </button>

                        <div id="userDropdownMenu"
                            class="hidden absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50">
                            <div class="px-4 py-3 border-b border-slate-100">
                                <p class="text-sm font-semibold">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-slate-500 truncate">{{ auth()->user()->email }}</p>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-all">
                                    <i data-lucide="log-out" class="w-4 h-4 mr-3"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-24 pb-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-8">

        @if($colocation)
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-2xl p-8 shadow-lg">
                <h1 class="text-3xl font-bold">Welcome to {{ $colocation->name }}</h1>
                <p class="opacity-90 mt-1">Everything looks good today.</p>
            </div>
        @else
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100">
                <h1 class="text-2xl font-bold text-slate-800">Welcome {{ auth()->user()->name }}</h1>
                <p class="text-slate-500 mt-2">You are not part of any shared home yet.</p>
                <div class="mt-6 flex gap-4">
                    <button onclick="openModal('createColocModal')"
                        class="px-6 py-3 gradient-bg text-white rounded-xl font-semibold shadow-lg hover:scale-105 transition">Create
                        Home</button>
                    <button onclick="openModal('joinModal')"
                        class="px-6 py-3 bg-white border border-slate-200 text-slate-700 rounded-xl font-semibold hover:bg-slate-50 transition">Join
                        with Token</button>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-yellow-100 rounded-xl"><i data-lucide="star" class="w-6 h-6 text-yellow-600"></i>
                    </div>
                    <span class="text-xs font-medium text-slate-500 bg-slate-100 px-2 py-1 rounded-full">Global</span>
                </div>
                <p class="text-sm text-slate-500 mb-1">Reputation Score</p>
                <p class="text-2xl font-bold text-slate-900">0</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-purple-100 rounded-xl"><i data-lucide="shopping-cart"
                            class="w-6 h-6 text-purple-600"></i></div>
                    <span class="text-xs font-medium text-primary-600 bg-primary-50 px-2 py-1 rounded-full">Month</span>
                </div>
                <p class="text-sm text-slate-500 mb-1">Total Expenses</p>
                <p class="text-2xl font-bold text-slate-900">{{ number_format($expenses->sum('amount') ?? 0, 2) }} MAD
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 card-hover">
                <div class="flex items-center justify-between mb-6">
                    <div class="p-3 bg-indigo-100 rounded-xl"><i data-lucide="users"
                            class="w-6 h-6 text-indigo-600"></i></div>
                    <h3 class="font-bold text-slate-800">Member Balances</h3>
                </div>

                <div class="space-y-4">
                    @forelse($sum as $sam)
                        <div class="bg-red-50 border border-red-100 p-4 rounded-xl">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h1 class="font-semibold text-slate-900">{{ $sam->member_name }}</h1>
                                    <p class="text-xs text-slate-500 mt-1">Needs to pay for
                                        <strong>{{ $sam->expense_title }}</strong>
                                    </p>
                                    <p class="text-xs text-slate-500">To <strong>{{ $sam->expense_creator }}</strong></p>
                                </div>
                                <p class="font-bold text-red-600">{{ number_format($sam->total_owed, 2) }} MAD</p>
                            </div>

                            @if($sam->zz == auth()->user()->id)
                                <form method="POST" action="{{ route('pay.expense') }}">
                                    @csrf
                                    <input type="hidden" name="payment_id" value="{{ $sam->payment_id }}">
                                    <button type="submit"
                                        class="mt-3 w-full py-2 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 transition shadow-md font-medium">
                                        Pay Now
                                    </button>
                                </form>
                            @endif
                        </div>
                    @empty
                        <p class="text-center text-slate-400 text-sm py-4">All debts are cleared! 🚀</p>
                    @endforelse
                </div>
            </div>

            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden card-hover">
                    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-primary-100 rounded-lg"><i data-lucide="receipt"
                                    class="w-5 h-5 text-primary-600"></i></div>
                            <h3 class="font-bold text-slate-900 text-lg">Recent History</h3>
                        </div>
                        <button onclick="openModal('expenseModal')"
                            class="inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm rounded-lg hover:bg-primary-700 transition shadow-md">
                            <i data-lucide="plus" class="w-4 h-4 mr-2"></i> Add Expense
                        </button>
                    </div>

                    <div class="p-6">
                        @forelse($expenses as $expense)
                            <div
                                class="flex justify-between items-center p-4 mb-3 bg-slate-50 rounded-xl border border-slate-100 hover:border-indigo-200 transition-all">
                                <div>
                                    <p class="font-semibold text-slate-900">{{ $expense->title }}</p>
                                    <p class="text-xs text-slate-500">Paid by {{ $expense->name }} •
                                        {{ $expense->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                <p class="font-bold text-indigo-600">{{ number_format($expense->amount, 2) }} MAD</p>
                            </div>
                        @empty
                            <div class="text-center py-10">
                                <i data-lucide="receipt" class="w-12 h-12 text-slate-300 mx-auto mb-3"></i>
                                <p class="text-slate-500">No expenses found.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="bg-gradient-to-br from-indigo-600 to-purple-700 text-white rounded-2xl p-6 shadow-xl">
                    <h2 class="text-xl font-bold mb-4">Home Members</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach($members as $membership)
                            <div
                                class="flex items-center justify-between bg-white/10 px-4 py-3 rounded-xl backdrop-blur-sm">
                                <span class="font-medium">{{ $membership->name }}</span>
                                <span
                                    class="px-3 py-1 text-[10px] font-bold uppercase rounded-full {{ $membership->role === 'Owner' ? 'bg-emerald-400 text-white' : 'bg-white/20 text-white' }}">
                                    {{ $membership->role }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="expenseModal" class="fixed inset-0 z-[60] hidden">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('expenseModal')"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6">
                <h2 class="text-xl font-bold mb-4">Add New Expense</h2>
                <form method="POST" action="{{ route('expenses.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Title</label>
                        <input type="text" name="title" required
                            class="w-full px-4 py-2 border rounded-xl outline-none focus:ring-2 focus:ring-indigo-500"
                            placeholder="e.g. Electricity">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Amount (MAD)</label>
                        <input type="number" step="0.01" name="amount" required
                            class="w-full px-4 py-2 border rounded-xl outline-none focus:ring-2 focus:ring-indigo-500"
                            placeholder="0.00">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select name="category_id" class="w-full px-4 py-2 border rounded-xl" required>
                            <option value="">Select Category</option>

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-3 pt-4">
                        <button type="button" onclick="closeModal('expenseModal')"
                            class="flex-1 py-2 text-slate-500 font-medium">Cancel</button>
                        <button type="submit"
                            class="flex-1 py-2 gradient-bg text-white rounded-xl font-bold">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        // Dropdown Toggle
        function toggleUserDropdown() {
            document.getElementById('userDropdownMenu').classList.toggle('hidden');
        }

        const notifBtn = document.getElementById('notifBtn');
        if (notifBtn) {
            notifBtn.onclick = () => document.getElementById('notifDropdown').classList.toggle('hidden');
        }

        // Modal Controls
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }
        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        // Close when clicking outside
        window.onclick = function (event) {
            if (!event.target.closest('#userDropdownContainer')) {
                document.getElementById('userDropdownMenu').classList.add('hidden');
            }
        }
    </script>
</body>

</html>