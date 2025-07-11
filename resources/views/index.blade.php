<!-- resources/views/donuts/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donut List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    // Auto-refresh every 3 minutes (180,000 ms)
    setInterval(() => {
        window.location.reload();
    }, 180000);
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-6xl mx-auto">
        <h1 class="text-4xl font-bold text-center mb-6 text-purple-700">🍩 Donuts Catalog</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif


        {{-- <div class="flex justify-end mb-4">
            <a href="/fetch" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded">
                🔄 Fetch New Data
            </a>
        </div> --}}

        <form method="GET" action="/" class="mb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <input
                type="text"
                name="search"
                placeholder="Search by name, batter, or topping..."
                value="{{ $search }}"
                class="px-4 py-2 border rounded w-full sm:w-auto"
            />
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                🔍 Search
            </button>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($donuts as $donut)
                <div class="bg-white p-4 rounded-xl shadow-md hover:shadow-lg transition" x-data="{ showBatters: false, showToppings: false }">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $donut->name }}</h2>
                    <p class="text-sm text-gray-500">Type: {{ $donut->type }}</p>
                    <p class="text-sm text-gray-500">PPU: ${{ number_format($donut->ppu, 2) }}</p>

                    <!-- Batters collapsible -->
                    <div class="mt-3">
                        <button @click="showBatters = !showBatters" class="text-blue-600 hover:underline font-medium">
                            🍮 Batters ({{ $donut->batters->count() }})
                        </button>
                        <ul x-show="showBatters" x-transition class="list-disc list-inside text-gray-600 text-sm mt-1">
                            @foreach($donut->batters as $batter)
                                <li>{{ $batter->type }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Toppings collapsible -->
                    <div class="mt-3">
                        <button @click="showToppings = !showToppings" class="text-green-600 hover:underline font-medium">
                            🍫 Toppings ({{ $donut->toppings->count() }})
                        </button>
                        <ul x-show="showToppings" x-transition class="list-disc list-inside text-gray-600 text-sm mt-1">
                            @foreach($donut->toppings as $topping)
                                <li>{{ $topping->type }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-6">
            {{ $donuts->appends(['search' => $search])->links() }}
        </div>
    </div>

</body>
</html>
