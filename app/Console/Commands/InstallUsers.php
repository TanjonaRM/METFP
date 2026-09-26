<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallUsers extends Command
{
    protected $signature = 'install:users';
    protected $description = 'Installe le module Comptes admin (CRUD complet en modal)';

    public function handle(): int
    {
        $this->info("Installation du module Comptes admin");
        $this->newLine();

        $files = $this->getFiles();
        $count = 0;

        foreach ($files as $path => $content) {
            $fullPath = base_path($path);
            $dir = dirname($fullPath);

            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            File::put($fullPath, $content);
            $size = strlen($content);
            $this->line("  OK  {$path} ({$size} car.)");
            $count++;
        }

        $this->newLine();
        $this->info("Nettoyage des caches...");
        $this->call('optimize:clear');

        $this->newLine();
        $this->info("SUCCES : {$count} fichier(s) installe(s) !");
        return self::SUCCESS;
    }

    protected function getFiles(): array
    {
        return [

            // =====================================================
            // 1. STORE USER REQUEST
            // =====================================================
            'app/Http/Requests/User/StoreUserRequest.php' => <<<'PHP'
<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check() && auth('admin')->user()->role === 'super_admin';
    }

    public function rules(): array
    {
        return [
            'nom'      => 'required|string|max:100',
            'prenom'   => 'required|string|max:100',
            'email'    => 'required|email|max:150|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:super_admin,admin,gestionnaire',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique'       => 'Cet email est déjà utilisé.',
            'password.min'       => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'role.in'            => 'Le rôle doit être : super_admin, admin ou gestionnaire.',
        ];
    }
}
PHP,

            // =====================================================
            // 2. UPDATE USER REQUEST
            // =====================================================
            'app/Http/Requests/User/UpdateUserRequest.php' => <<<'PHP'
<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        $id = $this->route('user');

        return [
            'nom'      => 'required|string|max:100',
            'prenom'   => 'required|string|max:100',
            'email'    => ['required', 'email', 'max:150', Rule::unique('admins', 'email')->ignore($id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role'     => 'required|in:super_admin,admin,gestionnaire',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'Cet email est déjà utilisé.',
        ];
    }
}
PHP,

            // =====================================================
            // 3. CONTROLLER (CRUD en AJAX + modal)
            // =====================================================
            'app/Http/Controllers/Admin/UserController.php' => <<<'PHP'
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Infrastructure\Persistence\Eloquent\Models\AdminModel;

class UserController extends Controller
{
    /**
     * Liste des utilisateurs
     */
    public function index(Request $request)
    {
        $users = AdminModel::query()
            ->when($request->filled('search'), function ($q) use ($request) {
                $s = $request->search;
                $q->where(function ($qq) use ($s) {
                    $qq->where('nom', 'like', "%{$s}%")
                       ->orWhere('prenom', 'like', "%{$s}%")
                       ->orWhere('email', 'like', "%{$s}%");
                });
            })
            ->when($request->filled('role'), fn($q) => $q->where('role', $request->role))
            ->orderBy('nom')
            ->paginate(15)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Formulaire de création (AJAX pour modal)
     */
    public function create()
    {
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'html' => view('admin.users.partials.form')->render(),
            ]);
        }

        return view('admin.users.create');
    }

    /**
     * Enregistrer un nouvel utilisateur
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        AdminModel::create($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'  => true,
                'message'  => 'Compte admin créé.',
                'redirect' => route('admin.users.index'),
            ]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'Compte admin créé.');
    }

    /**
     * Afficher un utilisateur (AJAX pour modal show)
     */
    public function show(int $id)
    {
        $user = AdminModel::findOrFail($id);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'html' => view('admin.users.partials.show', compact('user'))->render(),
            ]);
        }

        return view('admin.users.show', compact('user'));
    }

    /**
     * Formulaire d'édition (AJAX pour modal)
     */
    public function edit(int $id)
    {
        $user = AdminModel::findOrFail($id);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'html' => view('admin.users.partials.form', compact('user'))->render(),
            ]);
        }

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Mettre à jour un utilisateur
     */
    public function update(UpdateUserRequest $request, int $id)
    {
        $user = AdminModel::findOrFail($id);
        $validated = $request->validated();

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'  => true,
                'message'  => 'Compte admin mis à jour.',
                'redirect' => route('admin.users.index'),
            ]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'Compte admin mis à jour.');
    }

    /**
     * Supprimer un utilisateur (form classique, pas AJAX)
     */
    public function destroy(int $id)
    {
        $user = AdminModel::findOrFail($id);

        if (auth('admin')->id() === $user->id) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Compte admin supprimé.');
    }
}
PHP,

            // =====================================================
            // 4. INDEX VIEW (3 MODALS : Create / Edit / Show)
            // =====================================================
            'resources/views/admin/users/index.blade.php' => <<<'BLADE'
@extends('layouts.admin')
@section('title', 'Utilisateurs')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
    <div>
        <h1 class="font-display text-2xl font-bold text-slate-900">Utilisateurs</h1>
        <p class="text-sm text-slate-500 mt-1">Comptes administrateurs de l'application</p>
    </div>
    @if(auth('admin')->user()->role === 'super_admin')
        <button type="button" onclick="openCreateModal()" class="btn-primary">
            <span class="material-symbols-rounded text-lg">add</span>
            Nouveau compte
        </button>
    @endif
</div>

{{-- Filtres --}}
<div class="bg-white rounded-lg border-2 border-slate-300 p-4 mb-4">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-3">
        <div class="md:col-span-2">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Rechercher (nom, prénom, email)..."
                   class="w-full px-4 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-2 focus:ring-brand-100">
        </div>
        <select name="role" class="px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
            <option value="">Tous les rôles</option>
            <option value="super_admin" @selected(request('role') === 'super_admin')>Super Admin</option>
            <option value="admin" @selected(request('role') === 'admin')>Admin</option>
            <option value="gestionnaire" @selected(request('role') === 'gestionnaire')>Gestionnaire</option>
        </select>
        <div class="flex items-center gap-2">
            <button type="submit" class="btn-primary">Filtrer</button>
            <a href="{{ route('admin.users.index') }}" class="btn-secondary">Reset</a>
        </div>
    </form>
</div>

{{-- Tableau --}}
<div class="bg-white rounded-lg border-2 border-slate-300 overflow-hidden">
    <table class="table-modern">
        <thead>
            <tr>
                <th>Utilisateur</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Créé le</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-brand-700 flex items-center justify-center text-white font-bold text-sm">
                            {{ strtoupper(substr($user->prenom ?? 'A', 0, 1) . substr($user->nom ?? 'D', 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-semibold text-sm">{{ $user->prenom }} {{ $user->nom }}</div>
                            @if(auth('admin')->id() === $user->id)
                                <div class="text-[10px] text-brand-700 font-semibold">Vous</div>
                            @endif
                        </div>
                    </div>
                </td>
                <td class="text-sm">{{ $user->email }}</td>
                <td>
                    @if($user->role === 'super_admin')
                        <span class="badge-success">Super Admin</span>
                    @elseif($user->role === 'admin')
                        <span class="badge-info">Admin</span>
                    @else
                        <span class="badge-gray">Gestionnaire</span>
                    @endif
                </td>
                <td class="text-xs text-slate-500">
                    {{ $user->created_at?->format('d/m/Y') }}
                </td>
                <td>
                    <div class="flex items-center justify-end gap-1">
                        <button type="button" onclick="openShowModal({{ $user->id }})" class="w-8 h-8 rounded-md flex items-center justify-center text-slate-500 hover:bg-brand-50 hover:text-brand-700">
                            <span class="material-symbols-rounded text-lg">visibility</span>
                        </button>
                        <button type="button" onclick="openEditModal({{ $user->id }})" class="w-8 h-8 rounded-md flex items-center justify-center text-slate-500 hover:bg-brand-50 hover:text-brand-700">
                            <span class="material-symbols-rounded text-lg">edit</span>
                        </button>
                        @if(auth('admin')->id() !== $user->id)
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ce compte ?')">
                                @csrf @method('DELETE')
                                <button class="w-8 h-8 rounded-md flex items-center justify-center text-slate-500 hover:bg-red-50 hover:text-red-600">
                                    <span class="material-symbols-rounded text-lg">delete</span>
                                </button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-16 text-slate-400">Aucun utilisateur trouvé</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-4 py-3 border-t border-slate-200 flex justify-between items-center text-xs text-slate-500">
        <span>Total : {{ $users->total() ?? 0 }} utilisateurs</span>
        <div>{{ $users->links() }}</div>
    </div>
</div>

{{-- ========== MODAL CREATE ========== --}}
<div id="createModal" class="fixed inset-0 z-[9999] items-center justify-center p-4" style="display:none;">
    <div class="absolute inset-0 bg-black/50" onclick="closeCreateModal()"></div>
    <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-brand-700 flex items-center justify-center">
                    <span class="material-symbols-rounded text-white text-xl">person_add</span>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-900">Nouveau compte admin</h2>
                    <p class="text-xs text-slate-500">Créer un nouvel utilisateur</p>
                </div>
            </div>
            <button type="button" onclick="closeCreateModal()" class="w-9 h-9 rounded-md flex items-center justify-center text-slate-500 hover:bg-slate-100">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <form id="createForm" method="POST" action="{{ route('admin.users.store') }}" class="flex flex-col flex-1 min-h-0">
            @csrf
            <div id="createFormContent" class="flex-1 overflow-y-auto px-6 py-5">
                <div class="text-center py-12 text-slate-400">Chargement...</div>
            </div>
            <div class="px-6 py-4 border-t border-slate-200 flex justify-end gap-2 bg-slate-50 rounded-b-xl">
                <button type="button" onclick="closeCreateModal()" class="btn-secondary">Annuler</button>
                <button type="submit" class="btn-primary">
                    <span class="material-symbols-rounded text-lg">save</span>
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ========== MODAL EDIT ========== --}}
<div id="editModal" class="fixed inset-0 z-[9999] items-center justify-center p-4" style="display:none;">
    <div class="absolute inset-0 bg-black/50" onclick="closeEditModal()"></div>
    <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-brand-700 flex items-center justify-center">
                    <span class="material-symbols-rounded text-white text-xl">edit</span>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-900">Modifier le compte</h2>
                    <p class="text-xs text-slate-500">Mettre à jour les informations</p>
                </div>
            </div>
            <button type="button" onclick="closeEditModal()" class="w-9 h-9 rounded-md flex items-center justify-center text-slate-500 hover:bg-slate-100">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <form id="editForm" method="POST" class="flex flex-col flex-1 min-h-0">
            @csrf
            @method('PUT')
            <div id="editFormContent" class="flex-1 overflow-y-auto px-6 py-5">
                <div class="text-center py-12 text-slate-400">Chargement...</div>
            </div>
            <div class="px-6 py-4 border-t border-slate-200 flex justify-end gap-2 bg-slate-50 rounded-b-xl">
                <button type="button" onclick="closeEditModal()" class="btn-secondary">Annuler</button>
                <button type="submit" class="btn-primary">
                    <span class="material-symbols-rounded text-lg">save</span>
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ========== MODAL SHOW ========== --}}
<div id="showModal" class="fixed inset-0 z-[9999] items-center justify-center p-4" style="display:none;">
    <div class="absolute inset-0 bg-black/50" onclick="closeShowModal()"></div>
    <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-brand-700 flex items-center justify-center">
                    <span class="material-symbols-rounded text-white text-xl">visibility</span>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-900">Détail utilisateur</h2>
                    <p class="text-xs text-slate-500">Informations complètes</p>
                </div>
            </div>
            <button type="button" onclick="closeShowModal()" class="w-9 h-9 rounded-md flex items-center justify-center text-slate-500 hover:bg-slate-100">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <div id="showContent" class="flex-1 overflow-y-auto px-6 py-5">
            <div class="text-center py-12 text-slate-400">Chargement...</div>
        </div>
    </div>
</div>

<script>
    console.log('[OK] Script users chargé');

    // ========== CREATE ==========
    function openCreateModal() {
        console.log('[BLUE] CREATE');
        const modal = document.getElementById('createModal');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';

        fetch('{{ route("admin.users.create") }}', {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('createFormContent').innerHTML = data.html;
            console.log('[BOX] CREATE chargé');
        })
        .catch(err => {
            console.error(err);
            document.getElementById('createFormContent').innerHTML =
                '<div class="text-center py-12 text-red-500">Erreur</div>';
        });
    }

    function closeCreateModal() {
        document.getElementById('createModal').style.display = 'none';
        document.body.style.overflow = '';
    }

    // ========== EDIT ==========
    function openEditModal(id) {
        console.log('[BLUE] EDIT', id);
        const modal = document.getElementById('editModal');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';

        const form = document.getElementById('editForm');
        form.action = `/admin/users/${id}`;

        fetch(`/admin/users/${id}/edit`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('editFormContent').innerHTML = data.html;
            console.log('[BOX] EDIT chargé');
        })
        .catch(err => {
            console.error(err);
            document.getElementById('editFormContent').innerHTML =
                '<div class="text-center py-12 text-red-500">Erreur</div>';
        });
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
        document.body.style.overflow = '';
    }

    // ========== SHOW ==========
    function openShowModal(id) {
        console.log('[BLUE] SHOW', id);
        const modal = document.getElementById('showModal');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';

        fetch(`/admin/users/${id}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('showContent').innerHTML = data.html;
            console.log('[BOX] SHOW chargé');
        })
        .catch(err => {
            console.error(err);
            document.getElementById('showContent').innerHTML =
                '<div class="text-center py-12 text-red-500">Erreur</div>';
        });
    }

    function closeShowModal() {
        document.getElementById('showModal').style.display = 'none';
        document.body.style.overflow = '';
    }

    // ========== SOUMISSION AJAX ==========
    document.addEventListener('submit', function(e) {
        const form = e.target;
        if (form.id !== 'createForm' && form.id !== 'editForm') return;

        e.preventDefault();
        console.log('[EXPORT] Soumission AJAX', form.id);

        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="material-symbols-rounded text-lg animate-spin">progress_activity</span> Enregistrement...';

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: new FormData(form),
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                console.log('[OK] Succès');
                window.location.href = data.redirect || window.location.href;
            } else {
                alert(data.message || 'Erreur');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        })
        .catch(err => {
            console.error('[X]', err);
            alert('Erreur : ' + err.message);
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
    });

    // ========== ESCAPE ==========
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            closeCreateModal(); closeEditModal(); closeShowModal();
        }
    });

    // ========== EXPOSER LES FONCTIONS ==========
    window.openCreateModal = openCreateModal;
    window.closeCreateModal = closeCreateModal;
    window.openEditModal = openEditModal;
    window.closeEditModal = closeEditModal;
    window.openShowModal = openShowModal;
    window.closeShowModal = closeShowModal;
</script>

@endsection
BLADE,

            // =====================================================
            // 5. PARTIAL FORM (Create + Edit)
            // =====================================================
            'resources/views/admin/users/partials/form.blade.php' => <<<'BLADE'
<div class="space-y-5">

    {{-- Identité --}}
    <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
        <div class="flex items-center gap-2 pb-3 mb-4 border-b-2 border-slate-200">
            <span class="material-symbols-rounded text-brand-700 text-lg">person</span>
            <h3 class="text-sm font-bold text-brand-700 uppercase tracking-wide">Identité</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">Nom <span class="text-red-600">*</span></label>
                <input type="text" name="nom" value="{{ old('nom', $user->nom ?? '') }}"
                       class="w-full px-4 py-3 text-base border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100"
                       required>
                @error('nom') <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">Prénom <span class="text-red-600">*</span></label>
                <input type="text" name="prenom" value="{{ old('prenom', $user->prenom ?? '') }}"
                       class="w-full px-4 py-3 text-base border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100"
                       required>
                @error('prenom') <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    {{-- Compte --}}
    <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
        <div class="flex items-center gap-2 pb-3 mb-4 border-b-2 border-slate-200">
            <span class="material-symbols-rounded text-brand-700 text-lg">mail</span>
            <h3 class="text-sm font-bold text-brand-700 uppercase tracking-wide">Compte</h3>
        </div>

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">Email <span class="text-red-600">*</span></label>
                <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}"
                       class="w-full px-4 py-3 text-base border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100"
                       required>
                @error('email') <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">
                    Mot de passe {{ isset($user) ? '(laisser vide pour ne pas changer)' : '*' }}
                </label>
                <input type="password" name="password"
                       class="w-full px-4 py-3 text-base border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100"
                       {{ isset($user) ? '' : 'required' }}>
                @error('password') <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation"
                       class="w-full px-4 py-3 text-base border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">Rôle <span class="text-red-600">*</span></label>
                <select name="role" class="w-full px-4 py-3 text-base border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100" required>
                    <option value="admin" @selected(old('role', $user->role ?? 'admin') === 'admin')>Admin</option>
                    <option value="gestionnaire" @selected(old('role', $user->role ?? '') === 'gestionnaire')>Gestionnaire</option>
                    <option value="super_admin" @selected(old('role', $user->role ?? '') === 'super_admin')>Super Admin</option>
                </select>
                @error('role') <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

</div>
BLADE,

            // =====================================================
            // 6. PARTIAL SHOW
            // =====================================================
            'resources/views/admin/users/partials/show.blade.php' => <<<'BLADE'
<div class="space-y-4">

    <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 rounded-full bg-brand-700 flex items-center justify-center text-white font-bold text-2xl">
                {{ strtoupper(substr($user->prenom ?? 'A', 0, 1) . substr($user->nom ?? 'D', 0, 1)) }}
            </div>
            <div>
                <div class="font-bold text-lg text-slate-900">{{ $user->prenom }} {{ $user->nom }}</div>
                <div class="text-sm text-slate-500">{{ $user->email }}</div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div class="bg-white border-2 border-slate-300 rounded-lg p-4">
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-1">Rôle</div>
            @if($user->role === 'super_admin')
                <span class="badge-success">Super Admin</span>
            @elseif($user->role === 'admin')
                <span class="badge-info">Admin</span>
            @else
                <span class="badge-gray">Gestionnaire</span>
            @endif
        </div>

        <div class="bg-white border-2 border-slate-300 rounded-lg p-4">
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-1">Créé le</div>
            <div class="font-semibold text-slate-900">{{ $user->created_at?->format('d/m/Y à H:i') }}</div>
        </div>
    </div>

</div>
BLADE,
        ];
    }
}