<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex p-2">
                    <a href="{{ route('admin.roles.index') }}"
                       class="px-4 py-2 bg-green-700 hover:text-gray-500 text-slate-100 rounded-md">Role Index</a>
                </div>
                <div class="flex flex-col">
                    <div>User name: {{ $user->name }}</div>
                    <div>User email: {{ $user->email }}</div>
                </div>
                <div class="mt-6 p-2">
                    <h2 class="text-2xl font-semibold">Role</h2>
                    <div class="flex space-x-2 mt-4 p-2">
                        @if($user->roles)
                            @foreach($user->roles as $user_role)
                                <form
                                    class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md"
                                    method="POST"
                                    action="{{ route('admin.users.roles.remove', [$user->id, $user_role->id]) }}"
                                    onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">{{$user_role->name}}</button>
                                </form>
                            @endforeach
                        @endif
                    </div>
                    <div class="mt-6">
                        <form method="POST" action="{{ route('admin.users.roles', $user->id) }}">
                            @csrf
                            <div class="sm:col-span-6">
                                <label for="role" class="block text-sm font-medium text-gray-700">
                                    Role </label>
                                <select id="role" name="role" autocomplete="permission-name"
                                        class="mt-1 block w-full py-2 px-3 border">
                                    @foreach($roles as $role)
                                        <option value="{{$role->name}}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="sm:col-span-6 pt-5">
                                <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md">
                                    Assign
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mt-6 p-2">
                    <h2 class="text-2xl font-semibold">Permissions</h2>
                    <div class="flex space-x-2 mt-4 p-2">
                        @if($user->permissions)
                            @foreach($user->permissions as $user_permission)
                                <form
                                    class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md"
                                    method="POST"
                                    action="{{ route('admin.users.permissions.revoke', [$user->id, $user_permission->id]) }}"
                                    onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">{{$user_permission->name}}</button>
                                </form>
                            @endforeach
                        @endif
                    </div>
                    <div class="mt-6">
                        <form method="POST" action="{{ route('admin.users.permissions', $user->id) }}">
                            @csrf
                            <div class="sm:col-span-6">
                                <label for="permission" class="block text-sm font-medium text-gray-700">
                                    Role </label>
                                <select id="permission" name="permission" autocomplete="permission-name"
                                        class="mt-1 block w-full py-2 px-3 border">
                                    @foreach($permissions as $permission)
                                        <option value="{{$permission->name}}">{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                                @error('permission') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="sm:col-span-6 pt-5">
                                <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md">
                                    Assign
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
