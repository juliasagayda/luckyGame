<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate your unique link to the secret lucky page</title>
    @vite('resources/css/app.css')
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="card p-8 w-96 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center mb-6">{{ session('message') }}</h2>
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('token'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-center">
                    <p class="font-bold text-xl mb-2">Your unique link is:</p>
                    <a href="{{ $link }}" class="text-blue-500 underline break-all hover:text-blue-700">
                         Сheck how lucky you are
                    </a>
                </div>
             @else

                <form action="{{ route('register') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-gray-700">Username:</label>
                        <input type="text" name="username" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-teal-500">
                    </div>

                    <div>
                        <label class="block text-gray-700">Phone number:</label>
                        <input 
                            type="tel" 
                            name="phonenumber" 
                            required 
                            pattern="^\+?[0-9\s()-]{7,15}$" 
                            title="{{ __('Please enter a valid phone number') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-teal-500"
                            value="{{ old('phonenumber') }}"
                        >
                        @error('phonenumber')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="w-full py-2 mt-4 bg-teal-500 text-white rounded hover:bg-teal-600 transition">
                        Register
                    </button>
                </form>
        @endif
    </div>

</body>
</html>
