<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-4">Test Comment (Vulnerable)</h2>
                    
                    <form method="POST" action="{{ route('test.comment') }}" class="mb-6">
                        @csrf
                        <textarea name="comment" placeholder="Enter your comment..." 
                                  class="w-full border-gray-300 rounded-md shadow-sm"
                                  rows="4"></textarea>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-2">Submit</button>
                    </form>

                    @if(isset($comment))
                        <div class="mt-4">
                            <h3 class="text-xl font-semibold mb-2">Your Comment:</h3>
                            <div class="p-4 bg-gray-100 rounded-md">
                                {!! $comment !!}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
