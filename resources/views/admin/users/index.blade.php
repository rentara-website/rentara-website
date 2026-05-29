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


    <div class="w-full max-w-md">
        <input
            type="text"
            id="user-search"
            placeholder="Cari nama, email, atau role..."
            class="w-full px-4 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20"
        >
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden mt-6">
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
                <tbody id="users-table-body" class="divide-y divide-gray-50 text-xs font-bold">
                    @include('admin.users.partials.rows', ['users' => $users])
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
