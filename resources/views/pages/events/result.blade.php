<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center px-4 text-gray-800 dark:text-white">
            <h2 class="font-semibold text-xl leading-tight">
                Result for {{ $event->title }}
            </h2>
            <div>
                <h2 class="mt-2 font-semibold text-xl">Created by</h2>
                {{ $event->creator->name }}
            </div>
        </div>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 dark:text-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if ($event->closed_at)
                        <h2>Closed at {{ $event->closed_at?->format('d-m-Y') }}</h2>
                    @endif

                    <h2 class="mt-2 font-semibold text-xl">Results</h2>
                    <div>
                        @if ($event->expenses->count() === 0)
                            <em>No expenses.</em>
                        @else
                            <div class="divide-y dark:divide-gray-600">
                                @foreach ($users as $user)
                                    <div class="grid grid-cols-12 py-8 text-sm">
                                        <div class="col-span-5">
                                            @if ($user->incoming)
                                                {{ $user->name }}
                                                gets €
                                                {{ number_format($user->incoming->sum('amount') / 100, 2, ',', '.') }}
                                            @elseif($user->outgoing)
                                                {{ $user->name }}
                                                pays €
                                                {{ number_format($user->outgoing->sum('amount') / 100, 2, ',', '.') }}
                                            @else
                                                Nothing to pay
                                            @endif
                                        </div>
                                        <div class="col-span-7">
                                            <ul>
                                                @foreach ($user->incoming ?? $user->outgoing as $transaction)
                                                    @if ($user->incoming)
                                                        <li>
                                                            <span class="font-bold">
                                                                €
                                                                {{ number_format($transaction['amount'] / 100, 2, ',', '.') }}
                                                            </span>
                                                            from
                                                            {{ $users->first(fn($user) => $user->id === $transaction['id'])->name }}
                                                        </li>
                                                    @else
                                                        <li>
                                                            <span class="font-bold">
                                                                €
                                                                {{ number_format($transaction['amount'] / 100, 2, ',', '.') }}
                                                            </span>
                                                            to
                                                            {{ $users->first(fn($user) => $user->id === $transaction['id'])->name }}
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
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
    </div>
</x-app-layout>
