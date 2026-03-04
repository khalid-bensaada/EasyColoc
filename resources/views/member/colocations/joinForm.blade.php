<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Colocation - EasyColoc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 min-h-screen flex flex-col items-center justify-center p-6">

    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <h2 class="text-indigo-600 font-bold text-2xl tracking-tight">EasyColoc</h2>
        </div>

        <div class="bg-white rounded-[2rem] border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden">
            <div class="p-8">
                <div class="mb-8 text-center">
                    <h1 class="text-2xl font-bold text-slate-900">Ready to join?</h1>
                    <p class="text-slate-500 text-sm mt-2">Enter your invitation token to access the shared home.</p>
                </div>

                <form action="{{ route('member.colocations.join') }}" method="POST">
                    @csrf

                    <div class="space-y-5">
                        <div>
                            <label for="token"
                                class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2 ml-1">
                                Invitation Token
                            </label>
                            <div class="relative">
                                <input type="text" name="token" id="token" placeholder="XXXX-XXXX-XXXX"
                                    value="{{ old('token', request('token')) }}"
                                    class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition-all placeholder:text-slate-300 font-mono text-xl text-center uppercase tracking-widest"
                                    required autofocus>
                            </div>

                            @error('token')
                                <p class="mt-3 text-sm text-red-500 flex items-center justify-center gap-1 font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full bg-slate-900 text-white font-semibold py-4 rounded-2xl hover:bg-indigo-600 shadow-lg shadow-slate-200 transition-all transform active:scale-[0.98]">
                            Enter Colocation
                        </button>

                        <div class="text-center pt-2">
                            <a href="{{ route('member.colocations.index') }}"
                                class="text-sm text-slate-400 hover:text-slate-600 transition-colors font-medium">
                                ← Nevermind, go back
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-indigo-50/50 p-6 border-t border-slate-100 flex items-start gap-4">
                <div class="bg-white p-2 rounded-lg shadow-sm border border-indigo-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </div>
                <div>
                    <p class="text-[11px] leading-relaxed text-indigo-900/70">
                        <strong>Missing a token?</strong> Check your email inbox (and spam) for the invitation link sent
                        by your roommate.
                    </p>
                </div>
            </div>
        </div>

        <p class="mt-8 text-center text-slate-400 text-xs uppercase tracking-widest font-bold">
            &copy; 2026 EasyColoc Platform
        </p>
    </div>

</body>

</html>