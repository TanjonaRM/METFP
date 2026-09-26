<nav class="bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <span class="material-symbols-outlined text-green-700">school</span>
            <span class="font-extrabold text-gray-800">SGFORMATEURS</span>
        </a>
        <div class="flex items-center gap-3">
            @auth('admin')
                <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-600 hover:text-green-700">Dashboard Admin</a>
            @endauth
            @auth('formateur')
                <a href="{{ route('formateur.dashboard') }}" class="text-sm text-gray-600 hover:text-green-700">Dashboard Formateur</a>
            @endauth
        </div>
    </div>
</nav>