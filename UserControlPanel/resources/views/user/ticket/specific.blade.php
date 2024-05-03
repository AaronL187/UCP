@include('admin.newsidebar')

<div class="container mx-auto px-4 sm:px-6 lg:px-8 mt-6">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Jegy Részletei <!-- Ticket Details -->
            </h3>
        </div>
        @include('errorhandling')
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 grid grid-cols-1 sm:grid-cols-2 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Jegy Azonosítója <!-- Ticket ID -->
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                        {{ $ticket->id }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 grid grid-cols-1 sm:grid-cols-2 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Beküldte <!-- Submitted By -->
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                        {{ $submitter }} #({{ $ticket->ticket_by }})
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 grid grid-cols-1 sm:grid-cols-2 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Jegy Tartalma <!-- Ticket Content -->
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                        {{ $ticket->problem}}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 grid grid-cols-1 sm:grid-cols-2 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Állapot <!-- Status -->
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                        @if($ticket->status == '1')
                            Elfogadva <!-- Open -->
                        @elseif($ticket->status == '0')
                            Elutasítva <!-- Closed -->
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
                        {{ $handledby ?? 'Nincs kezelő' }} <!-- No handler -->
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 grid grid-cols-1 sm:grid-cols-2 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Döntés Oka <!-- Reason for Decision -->
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                        {{ $ticket->reason ?? 'Nincs megadott ok' }} <!-- No reason provided -->
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 grid grid-cols-1 sm:grid-cols-2 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Jutalom <!-- Reward Points -->
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                        {{ $ticket->reward ?? 'Nincs megadott jutalom' }} <!-- No reward provided -->
                    </dd>
                </div>
                @if ($ticket->status === null and Auth()->user()->adminlevel >= 3)  <!-- Check if the status is pending -->
                <div class="px-4 py-5 flex justify-end space-x-2">
                    <!-- Accept button form -->
                    <form action="{{ url('ticket/accept', $ticket->id) }}" method="POST" id="acceptForm">
                        @csrf
                        <input type="hidden" name="reason" id="reason-accept">
                        <input type="hidden" name="reward" id="reward">
                        <button type="button" onclick="handleDecision('accept')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Elfogadás
                        </button>
                    </form>

                    <!-- Reject button form -->
                    <form action="{{ url('ticket/reject', $ticket->id) }}" method="POST" id="rejectForm">
                        @csrf
                        <input type="hidden" name="reason" id="reason-reject">
                        <button type="button" onclick="handleDecision('reject')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Elutasítás
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
        const reason = prompt("Kérjük, adja meg a döntés indokát:"); // Prompt for reason
        if (!reason) return; // Exit if no reason is provided

        if (decisionType === 'accept') {
            const reward = prompt("Adja meg a jutalom pontok számát:"); // Prompt for reward points
            if (!reward) return; // Exit if no reward is provided

            document.getElementById('reason-accept').value = reason;
            document.getElementById('reward').value = reward;
            document.getElementById('acceptForm').submit(); // Submit the accept form
        } else {
            document.getElementById('reason-reject').value = reason;
            document.getElementById('rejectForm').submit(); // Submit the reject form
        }
    }
</script>
