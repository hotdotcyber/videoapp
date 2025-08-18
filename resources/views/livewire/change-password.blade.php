<div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    @if (session()->has('message'))
        <div class="mb-4 p-3 text-green-700 bg-green-100 rounded">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="changePassword">
        <!-- Current Password -->
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300">Current Password</label>
            <input type="password" wire:model="current_password"
                class="w-full px-3 py-2 border rounded">
            @error('current_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- New Password -->
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300">New Password</label>
            <input type="password" wire:model="new_password"
                class="w-full px-3 py-2 border rounded">
            @error('new_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300">Confirm New Password</label>
            <input type="password" wire:model="new_password_confirmation"
                class="w-full px-3 py-2 border rounded">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
            Change Password
        </button>
    </form>
</div>
