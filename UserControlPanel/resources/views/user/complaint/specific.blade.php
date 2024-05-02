
@include('admin.newsidebar')

<div class="container mx-auto px-4 sm:px-6 lg:px-8 mt-6">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Panasz Részletei <!-- Complaint Details -->
            </h3>
        </div>
        @include('errorhandling')
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 grid grid-cols-1 sm:grid-cols-2 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Panasz Azonosítója <!-- Complaint ID -->
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                        {{ $complaint->id }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 grid grid-cols-1 sm:grid-cols-2 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Beküldte <!-- Submitted By -->
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                        {{ $complaint->complained_by }} <!-- Complainant ID -->
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 grid grid-cols-1 sm:grid-cols-2 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Panaszra Tett Személy<!-- Complained Against -->
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                        <a href="{{ url('characters/edit', $complaint->complained_against) }}">{{ $complaint->complained_against }}</a>
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 grid grid-cols-1 sm:grid-cols-2 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Panasz Leírása <!-- Description of Complaint -->
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                        {{ $complaint->description }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 grid grid-cols-1 sm:grid-cols-2 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Állapot <!-- Status -->
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                        @if($complaint->status === 1)
                            Elfogadva <!-- Accepted -->
                        @elseif($complaint->status === 0)
                            Elutasítva <!-- Rejected -->
                        @else
                            Függőben <!-- Pending -->
                        @endif
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 grid grid-cols-1 sm:grid-cols-2 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Kezelve <!-- Handled By -->
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                        {{$handledby}} <!-- Handler ID or 'None' -->
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 grid grid-cols-1 sm:grid-cols-2 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Döntés Oka <!-- Reason for Decision -->
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                        {{ $complaint->resolution ?? 'Nincs megadott ok' }} <!-- No reason provided -->
                    </dd>
                </div>
                @if ($complaint->status === null and Auth()->user()->adminlevel >= 3) <!-- Check if the status is pending -->
                <div class="px-4 py-5 flex justify-end space-x-2">
                    <!-- Accept button form -->
                    <form action="{{ url('complaint/accept', $complaint->id) }}" method="POST" id="acceptForm">
                        @csrf
                        <input type="hidden" name="resolution" id="resolution-accept">
                        <button type="button" onclick="handleDecision('accept')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Elfogadás <!-- Accept -->
                        </button>
                    </form>

                    <!-- Reject button form -->
                    <form action="{{ url('complaint/reject', $complaint->id) }}" method="POST" id="rejectForm">
                        @csrf
                        <input type="hidden" name="resolution" id="resolution-reject">
                        <button type="button" onclick="handleDecision('reject')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Elutasítás <!-- Reject -->
                        </button>
                    </form>
                </div>
                @endif
            </dl>
        </div>
    </div>
</div>
<script>
    function handleDecision(decisionType) {
        const resolution = prompt("Kérjük, adja meg a döntés indokát:"); // Prompt for resolution
        if (!resolution) return; // Exit if no resolution is provided

        if (decisionType === 'accept') {
            document.getElementById('resolution-accept').value = resolution;
            document.getElementById('acceptForm').submit(); // Submit the accept form
        } else {
            document.getElementById('resolution-reject').value = resolution;
            document.getElementById('rejectForm').submit(); // Submit the reject form
        }
    }
</script>
