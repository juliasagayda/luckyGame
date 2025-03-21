<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lucky Game History</title>
    @vite('resources/css/app.css')
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="card p-8 w-[32rem] shadow-lg rounded-lg bg-white">
        <h2 class="text-2xl font-semibold text-center mb-6">Even | Odd Game History:</h2>

        @if($history && count($history) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="p-3 text-gray-600 font-semibold text-sm border-b">Date</th>
                            <th class="p-3 text-gray-600 font-semibold text-sm border-b">Number</th>
                            <th class="p-3 text-gray-600 font-semibold text-sm border-b">Result</th>
                            <th class="p-3 text-gray-600 font-semibold text-sm border-b">Win Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($history as $result)
                            <tr class="hover:bg-gray-100 transition">
                                <td class="p-3 text-gray-700 text-sm border-b">{{ $result->created_at->format('d-m-Y H:i:s') }}</td>
                                <td class="p-3 text-gray-700 text-sm border-b">{{ $result->number }}</td>
                                <td class="p-3 text-sm font-semibold border-b 
                                    {{ $result->result === 'Win' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $result->result }}
                                </td>
                                <td class="p-3 text-gray-700 text-sm border-b">${{ $result->win_amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center text-gray-600">No history available.</p>
        @endif

        <div class="mt-4 text-center">
            <a href="{{ route('page.show', ['token' => request()->route('token')]) }}" class="text-blue-500 hover:underline">
                Back to Lucky Page
            </a>
        </div>
    </div>

</body>
</html>
