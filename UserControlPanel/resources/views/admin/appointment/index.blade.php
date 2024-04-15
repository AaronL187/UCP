<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <base href="/public">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>StudyRoom Admin</title>

    @include('admin.link')

</head>
<body>
<!-- partial:partials/_sidebar.html -->
@include('admin.newsidebar')
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<div class="container mt-5">
    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="text-center mb-4">
        <button id="togglePastAppointments" class="btn btn-info">Múltbeli időpontok megjelenítése</button>

        <div class="filter-dates-form mt-3">
            <input type="date" id="fromDate" class="form-control d-inline-block" placeholder="Ettől" />
            <input type="date" id="toDate" class="form-control d-inline-block" placeholder="Eddig" />
            <button id="filterDates" class="btn btn-primary">Szűrés</button>
            <button id="clearFilters" class="btn btn-secondary">Szűrők törlése</button>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Név</th>
                    <th>Neptun kód</th>
                    <th>Szoba</th>
                    <th>Ettől</th>
                    <th>Eddig</th>
                    <th>Módosítás</th>
                    <th>Törlés</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data as $appointment)
                    @php
                        $isPast = \Carbon\Carbon::parse($appointment->endtime)->isPast();
                    @endphp
                    <tr class="{{ $isPast ? 'past-appointment d-none' : '' }}">
                        <td>{{ $appointment->id }}</td>
                        <td>{{ $appointment->name }}</td>
                        <td>{{ $appointment->nk }}</td>
                        <td>{{$appointment->room}}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->starttime)->format('Y-m-d H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->endtime)->format('Y-m-d H:i') }}</td>
                        <td>
                            <a href="{{ url('appointment/edit', $appointment->id) }}" class="btn btn-success">Módosítás</a>
                        </td>
                        <td> <form action="{{ url('appointment/destroy', $appointment->id) }}" onsubmit="return confirm('Biztosan törlöd ezt az elemet?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Törlés</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Nincs megjeleníthető foglalás.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function togglePastAppointments() {
            var pastAppointments = document.querySelectorAll('.past-appointment');
            pastAppointments.forEach(function(row) {
                row.classList.toggle('d-none');
            });
        }

        function clearFilters() {
            document.getElementById('fromDate').value = '';
            document.getElementById('toDate').value = '';
            var appointments = document.querySelectorAll('tbody tr');
            appointments.forEach(function(row) {
                row.classList.remove('d-none');
            });
        }

        function filterAppointmentsByDate() {
            var fromDate = document.getElementById('fromDate').value;
            var toDate = document.getElementById('toDate').value;
            var appointments = document.querySelectorAll('tbody tr');

            appointments.forEach(function(row) {
                var startTime = new Date(row.children[3].textContent + 'Z');
                var endTime = new Date(row.children[4].textContent + 'Z');

                if (!fromDate && !toDate) {
                    row.classList.remove('d-none');
                } else if (startTime >= new Date(fromDate) && endTime <= new Date(toDate)) {
                    row.classList.remove('d-none');
                } else {
                    row.classList.add('d-none');
                }
            });
        }

        document.getElementById('togglePastAppointments').addEventListener('click', togglePastAppointments);
        document.getElementById('filterDates').addEventListener('click', filterAppointmentsByDate);
        document.getElementById('clearFilters').addEventListener('click', clearFilters);
    });
</script>


</body>
</html>
