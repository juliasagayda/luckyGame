<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lucky Page</title>
    @vite('resources/css/app.css')
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="card p-8 w-[32rem] bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center mb-6">Even | Odd game:</h2>

        <!-- Rules Block -->
        <div class="bg-gray-100 border border-gray-300 text-gray-700 px-4 py-3 rounded mb-4 text-left shadow-md">
            <h3 class="text-lg font-bold mb-1">Rules:</h3>
                <span>If the random number is even - the result is <span class="font-bold text-green-600">Win</span>,
                 otherwise - <span class="font-bold text-red-600">Lose</span>.</span>
            <h3 class="text-lg font-bold mb-1">Win amount calculation:</h3>
            <ul class="list-disc list-inside ml-4">
                    <li>score is greater than 900 - 70%.</li>
                    <li>score is greater than 600 - 50%</li>
                    <li>score is greater than 300 - 30%</li>
                    <li>score is less than or equal to 300 - 10%</li>
            </ul>
        </div>

        @if(session('result'))
            <div class="{{ session('result') === 'Win' ? 'bg-green-50 border-green-300 text-green-800' 
            : 'bg-red-50 border-red-300 text-red-800' }} px-4 py-3 rounded mb-4 text-center shadow-md">
                <h3 class="text-xl font-bold mb-1">You are {{ session('result') }}</h3>
                <p class="text-lg">
                    Your score: <span class="font-semibold">{{ session('number') }}</span> |
                    Your winnings are: <span class="font-semibold">${{ session('win_amount') }}</span>
                </p>
            </div>
        @endif

        <div class="space-y-4 text-center">
            <form action="{{ route('page.generate', ['token' => $link->token]) }}" method="POST">
                @csrf
                <button class="w-full py-2 bg-teal-500 text-white rounded hover:bg-teal-600 transition">Generate New Link</button>
            </form>

            <form action="{{ route('page.deactivate', ['token' => $link->token]) }}" method="POST">
                @csrf
                <button class="w-full py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">Deactivate Link</button>
            </form>

            <form action="{{ route('page.lucky', ['token' => $link->token]) }}" method="POST">
                @csrf
                <button class="w-full py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600 transition">I'm Feeling Lucky</button>
            </form>

            <a href="{{ route('page.history', ['token' => $link->token]) }}" class="w-full py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition block text-center">History</a>
        </div>
    </div>

</body>
</html>
