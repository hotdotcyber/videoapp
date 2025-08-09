<div>
<div class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Create an Account</h2>
    <form wire:submit.prevent="register" class="space-y-4">
      @csrf
      <div>
        <label class="block text-sm font-medium text-gray-700">Full Name</label>
        <input type="text" wire:model.defer=name class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
      </div>
      <span class="text-red-600 p-2">
      @error('name')
        {{$message}}
      @enderror
      </span>

      <div>
         <label class="block text-sm font-medium text-gray-700">Channel Name</label>
        <input type="text" wire:model.defer=channel_name class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
      </div>
      <span class="text-red-600 p-2">
      @error('channel_name')
        {{$message}}
      @enderror
      </span>
      <div>
        <label class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" wire:model.defer=email class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
      </div>

         <span class="text-red-600 p-2">
      @error('email')
        {{$message}}
      @enderror
      </span>
      <div>
        <label class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" wire:model.defer=password class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
      </div>
         <span class="text-red-600 p-2">
      @error('password')
        {{$message}}
      @enderror
      </span>
      <div>
        <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
        <input type="password" wire:model.defer="password_confirmation" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
      </div>
      <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700 transition duration-300">
        Register
      </button>
    </form>
    <p class="text-sm text-center text-gray-600 mt-4">
      Already have an account? <a href="{{route('auth.login')}}" class="text-blue-600 hover:underline">Login here</a>
    </p>
  </div>
   @livewire('floating1')
</div>
</div>
