@extends('admin.layout')

@section('admin_content')
<div class="space-y-6">
    
    <!-- Header -->
    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-black text-gray-900">User Directory</h1>
            <p class="text-gray-500 text-sm mt-1">Manage platform users, roles, and access controls.</p>
        </div>
        <div class="p-3 bg-blue-50 rounded-2xl text-[10px] font-bold text-[#0A4088] uppercase tracking-widest border border-blue-100">
            Total Users: {{ $users->total() }}
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                    <tr>
                        <th class="px-8 py-5">User</th>
                        <th class="px-8 py-5">Verified</th>
                        <th class="px-8 py-5">Joined At</th>
                        <th class="px-8 py-5">Role</th>
                        <th class="px-8 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-xs font-bold">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <img src="{{ Str::startsWith($user->avatar, 'http') ? $user->avatar : ($user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name)) }}" 
                                         class="w-10 h-10 rounded-full border-2 border-gray-50 object-cover">
                                    <div class="flex flex-col">
                                        <span class="text-gray-900">{{ $user->name }}</span>
                                        <span class="text-[10px] text-gray-400 font-medium normal-case">{{ $user->email }}</span>
                                    </div>
                                    @if($user->google_id)
                                        <span class="bg-blue-100 text-blue-600 px-1.5 py-0.5 rounded text-[8px] uppercase tracking-tighter" title="Google Account">G</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                @if($user->hasVerifiedEmail())
                                    <div class="flex items-center gap-2 text-green-500">
                                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                                        <span>Verified</span>
                                    </div>
                                @else
                                    <div class="flex items-center gap-2 text-gray-300">
                                        <i data-lucide="minus-circle" class="w-4 h-4"></i>
                                        <span>No</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-8 py-5 text-gray-400">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 rounded-full uppercase text-[10px] {{ $user->role === 'admin' ? 'bg-[#0A4088] text-white' : 'bg-gray-100 text-gray-500' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <form action="{{ route('admin.users.toggleRole', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Toggle Role">
                                            <i data-lucide="shield-check" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Delete">
                                            <i data-lucide="user-minus" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-10 text-center text-gray-400 italic">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-8 border-t border-gray-50">
            {{ $users->links() }}
        </div>
    </div>

</div>
@endsection
