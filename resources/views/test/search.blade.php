<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-4">Test Search (Vulnerable)</h2>
                    
                    <form method="GET" action="{{ route('test.search') }}" class="mb-6">
                        <input type="text" name="q" placeholder="Search products..." 
                               class="border-gray-300 rounded-md shadow-sm"
                               value="{{ request('q') }}">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Search</button>
                    </form>

                    @if(isset($sql))
                        <div class="mt-4 p-4 bg-gray-100 rounded">
                            <h3 class="text-lg font-semibold">SQL Query:</h3>
                            <pre class="mt-2">{{ $sql }}</pre>
                        </div>
                    @endif

                    @if(isset($error))
                        <div class="mt-4 p-4 bg-red-100 text-red-700 rounded">
                            <h3 class="text-lg font-semibold">Error:</h3>
                            <pre class="mt-2">{{ $error }}</pre>
                        </div>
                    @endif

                    @if(isset($results))
                        <div class="mt-4">
                            <h3 class="text-xl font-semibold mb-2">Results:</h3>
                            @foreach($results as $item)
                                <div class="mb-4 p-4 border rounded">
                                    @foreach((array)$item as $key => $value)
                                        <p><strong>{{ $key }}:</strong> {!! $value !!}</p>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
