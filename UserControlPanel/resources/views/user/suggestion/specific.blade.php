@include('admin.newsidebar')

<div class="container mx-auto px-4 sm:px-6 lg:px-8 mt-6">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Javaslat Részletei <!-- Suggestion Details -->
            </h3>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 grid grid-cols-1 sm:grid-cols-2 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Javaslat Azonosítója <!-- Suggestion ID -->
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                        {{ $suggestion->id }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 grid grid-cols-1 sm:grid-cols-2 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Beküldte <!-- Submitted By -->
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                        {{$suggestor}} #({{$suggestorid}})
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 grid grid-cols-1 sm:grid-cols-2 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Javaslat Tartalma <!-- Suggestion Content -->
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                        {{ $suggestion->suggestion }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 grid grid-cols-1 sm:grid-cols-2 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Állapot <!-- Status -->
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                        @if($suggestion->status === 1)
                            Elfogadva <!-- Accepted -->
                        @elseif($suggestion->status === 0)
                            Elutasítva <!-- Rejected -->
                        @else
                            Függőben <!-- Pending -->
                        @endif
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 grid grid-cols-1 sm:grid-cols-2 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Kezelve <!-- Handled By -->
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                        {{$handledby}}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 grid grid-cols-1 sm:grid-cols-2 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Döntés Oka <!-- Reason for Decision -->
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                        {{ $suggestion->reason ?? 'Nincs megadott ok' }} <!-- No reason provided -->
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 grid grid-cols-1 sm:grid-cols-2 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Jutalom <!-- Reward -->
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                        {{ $suggestion->reward }} PrémiumPont <!-- Points -->
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</div>
