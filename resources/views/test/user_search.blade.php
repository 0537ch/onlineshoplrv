<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-4">Test User Search (Vulnerable)</h2>
                    
                    <form method="GET" action="{{ route('test.user_search') }}" class="mb-6">
                        <input type="text" name="q" placeholder="Search users..." 
                               class="border-gray-300 rounded-md shadow-sm"
                               value="{{ request('q') }}">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Search</button>
                    </form>

                    @if(isset($results))
                        <div class="mt-4">
                            <h3 class="text-xl font-semibold mb-2">Results:</h3>
                            @foreach($results as $user)
                                <div class="mb-4 p-4 border rounded">
                                    <p><strong>Name:</strong> {!! $user->name !!}</p>
                                    <p><strong>Email:</strong> {!! $user->email !!}</p>
                                    <p><strong>Credit Card:</strong> {!! $user->credit_card_number !!}</p>
                                    <p><strong>Phone:</strong> {!! $user->phone_number !!}</p>
                                    <p><strong>National ID:</strong> {!! $user->national_id !!}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
