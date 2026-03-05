<!DOCTYPE html>
<html lang="en">

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
                        primary: { 50: '#eff6ff', 100: '#dbeafe', 500: '#3b82f6', 600: '#2563eb', 700: '#1d4ed8' },
                        success: { 500: '#10b981', 600: '#059669' },
                        danger: { 500: '#ef4444', 600: '#dc2626' }
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

<body class="bg-gray-50">


    @if($errors->any())
        <div
            class="fixed top-4 left-1/2 -translate-x-1/2 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-500">
            {{ $errors->first() }}
        </div>
    @endif

    <main class="pt-20 pb-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-8">

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 card-hover mb-8">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-blue-100 rounded-xl">
                    <i data-lucide="home" class="w-6 h-6 text-blue-600"></i>
                </div>
                <div class="text-right">
                    <h3 class="text-xl font-bold text-gray-900">{{ $colocation->name ?? 'No Active Home' }}</h3>
                    <p class="text-gray-500 text-sm">{{ $colocation->adress ?? 'Create a home to start' }}</p>
                </div>
            </div>

            @if($colocation)
                <div
                    class="bg-gray-50 p-4 rounded-xl border-2 border-dashed border-gray-200 flex justify-between items-center">
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-bold mb-1">Home Invitation Token</p>
                        <p id="tokenValue" class="text-xl font-mono font-bold text-gray-800 tracking-wider">
                            {{ $token ?? 'NO TOKEN' }}
                        </p>
                    </div>
                    <button onclick="copyToken()"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition">
                        Copy
                    </button>
                </div>

                <script>
                    function copyToken() {
                        const tokenText = document.getElementById('tokenValue').innerText;
                        if (tokenText !== 'NO TOKEN') {
                            navigator.clipboard.writeText(tokenText);
                            alert('Token copied: ' + tokenText);
                        }
                    }
                </script>
            @else
                <div class="flex gap-4">
                    <button onclick="openModal('createColocModal')"
                        class="flex-1 py-3 gradient-bg text-white rounded-xl font-bold">Create Home</button>
                    <button onclick="openModal('joinModal')"
                        class="flex-1 py-3 border border-gray-300 text-gray-700 rounded-xl font-bold">Join Home</button>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 card-hover">
                <p class="text-sm text-gray-500 mb-1">Total Expenses</p>
                <p class="text-2xl font-bold text-gray-900">{{ number_format($expenses->sum('amount'), 2) }} MAD</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 card-hover">
                <p class="text-sm text-gray-500 mb-1">Active Members</p>
                <p class="text-2xl font-bold text-gray-900">{{ $colocation ? $colocation->users->count() : 0 }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden card-hover">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <h3 class="font-bold text-gray-900 text-lg flex items-center gap-2">
                        <i data-lucide="receipt" class="w-5 h-5 text-primary-600"></i> Recent Expenses
                    </h3>
                    @if($colocation)
                        <button onclick="openModal('expenseModal')"
                            class="text-sm bg-primary-600 text-white px-3 py-1 rounded-lg">Add New</button>
                    @endif
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <tbody class="divide-y divide-gray-100">
                            @forelse($expenses as $expense)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <p class="font-medium text-gray-900">{{ $expense->title }}</p>
                                        <p class="text-xs text-gray-400">By {{ $expense->user->name }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-primary-600 font-bold">{{ $expense->amount }} MAD</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $expense->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="p-12 text-center">
                                        <div
                                            class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <i data-lucide="receipt" class="w-8 h-8 text-gray-300"></i>
                                        </div>
                                        <p class="text-gray-500">No expenses recorded yet.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-gradient-to-br from-indigo-600 to-purple-700 text-white rounded-2xl p-6 shadow-lg">
                <h3 class="font-bold text-xl mb-6">Home Members</h3>
                <div class="space-y-4">
                    @if($colocation)
                        @foreach($colocation->users as $member)
                            <div class="flex justify-between items-center bg-white/10 px-4 py-3 rounded-xl backdrop-blur-sm">
                                <div>
                                    <p class="font-semibold">{{ $member->name }}</p>
                                    <p class="text-xs text-indigo-100">{{ $member->pivot->role ?? 'Member' }}</p>
                                </div>
                                <i data-lucide="user" class="w-4 h-4 text-white/50"></i>
                            </div>
                        @endforeach
                    @else
                        <p class="text-indigo-100 text-sm">No members to show.</p>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <div id="createColocModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('createColocModal')"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6">
                <h2 class="text-xl font-bold mb-6">New Shared Home</h2>

            </div>
        </div>
    </div>

    <div id="expenseModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('expenseModal')"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6">
                <h2 class="text-xl font-bold mb-6">Add Expense</h2>
                <form method="POST" action="{{ route('expenses.store') }}" class="space-y-4">
                    @csrf
                    <input name="accommo_id" value="{{ $colocation->id ?? '' }}" type="hidden">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input name="title" type="text" required class="w-full px-4 py-2 border rounded-xl">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Amount (MAD)</label>
                            <input name="amount" type="number" step="0.01" required
                                class="w-full px-4 py-2 border rounded-xl">
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
                    </div>
                    <div class="flex gap-3 mt-4">
                        <button type="button" onclick="window.history.back()"
                            class="flex-1 py-3 bg-gray-100 text-gray-700 rounded-xl font-bold">
                            Cancel
                        </button>
                        <button type="submit" class="flex-[2] py-3 bg-purple-600 text-white rounded-xl font-bold">
                            Save Expense
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mt-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Invite a Roommate</h3>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('colocations.invite') }}" method="POST" class="flex gap-3">
            @csrf
            <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">

            <div class="flex-1">
                <input type="email" name="email" required placeholder="Enter roommate's email"
                    class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-purple-500 outline-none">
                @error('email')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                class="px-6 py-2 bg-purple-600 text-white rounded-xl font-bold hover:bg-purple-700 transition">
                Send Invite
            </button>
        </form>
    </div>
    <script>
        lucide.createIcons();
        function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
        function closeModal(id) { document.getElementById(id).classList.add('hidden'); }
        function copyToken() {
            const token = document.getElementById('invitationToken').innerText;
            navigator.clipboard.writeText(token);
            alert('Token Copied!');
        }
    </script>
</body>

</html>