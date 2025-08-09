<div class="bg-gray-100 min-h-screen flex items-start justify-center pt-10 px-4">

  <div class="bg-white w-full max-w-sm p-6 sm:p-8 rounded-2xl shadow-lg">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login to Your Account</h2>

    <form wire:submit.prevent="userLogin" class="space-y-5">
      @csrf

      @if (session('status'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded text-sm">
          {{ session('status') }}
        </div>
      @endif

      @if (session('error'))
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded text-sm">
          {{ session('error') }}
        </div>
      @endif

      <div>
        <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
        <input
          type="email"
          id="email"
          wire:model.defer="email"
          required
          class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
        />
        <span class="text-red-600 text-sm">@error('email') {{$message}} @enderror</span>
      </div>

      <div>
        <label for="password" class="block mb-1 text-sm font-medium text-gray-700">Password</label>
        <input
          type="password"
          id="password"
          wire:model.defer="password"
          required
          class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
        />
        <span class="text-red-600 text-sm">@error('password') {{$message}} @enderror</span>
      </div>

      <div class="flex justify-between items-center text-sm">
        <label class="flex items-center">
          <input type="checkbox" class="mr-2"> Remember me
        </label>
        <a href="{{route('password.request')}}" class="text-blue-600 hover:underline">Forgot?</a>
      </div>

      <button
        type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-lg text-base font-semibold"
      >
        Login
      </button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-600">
      Don’t have an account?
      <a href="{{route('auth.register')}}" class="text-blue-600 hover:underline font-medium">Register</a>
    </p>

    @livewire('floating1')
  </div>
