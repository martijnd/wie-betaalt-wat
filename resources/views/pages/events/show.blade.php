<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center px-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Event: {{ $event->title }}
            </h2>
            <a class="px-4 py-2 border border-gray-300 rounded-lg"
                href="{{ route('events.expenses.create', $event->id) }}">
                Add an expense
            </a>
        </div>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($event->ended_at)
                        <h2>Closed at {{ $event->ended_at?->format('d-m-Y') }}</h2>
                    @endif

                    <div class="flex justify-between items-center">
                        <h2 class="mb-2 font-semibold text-xl">Expenses</h2>
                        <a href="{{ route('events.show.result', $event->id) }}">Results</a>
                    </div>
                    <div>

                        @if ($event->expenses->count() === 0)
                            <em>No expenses.</em>
                        @else
                            <div class="divide-y">
                                <div class="grid grid-cols-12 my-2">
                                    <div class="col-span-2 font-semibold">Payer</div>
                                    <div class="col-span-2 font-semibold">Title</div>
                                    <div class="col-span-2 font-semibold">Amount</div>
                                    <div class="col-span-2 font-semibold">Date</div>
                                    <div class="col-span-4 font-semibold">Participants</div>
                                </div>
                                @foreach ($event->expenses as $expense)
                                    <div class="grid grid-cols-12 py-8 text-sm">
                                        <div class="col-span-2">{{ $expense->payer->name }}</div>
                                        <div class="col-span-2">{{ $expense->title }}</div>
                                        <div class="col-span-2">€
                                            {{ number_format($expense->amount / 100, 2, ',', '.') }}</div>
                                        <div class="col-span-2">{{ $expense->created_at->format('d-m-y') }}</div>
                                        <div class="col-span-4">{{ $expense->users->map->name->join(', ') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>