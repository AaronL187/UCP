@include('admin.newsidebar')

<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-xl font-semibold mb-6">Admin Team</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach([1 => 'Helper', 2 => 'Adminisztrátor', 3 => 'SzuperAdminisztrátor', 4 => 'Tulajdonos'] as $level => $title)
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-lg font-bold mb-4">{{ $title }}</h2>
                <ul class="space-y-3">
                    @foreach($users->where('adminlevel', $level) as $user)
                       <a href="{{url('users/edit', $user->id) }} ">
                           <li class="border-b last:border-b-0 pb-3">{{ $user->adminnickname }}</li> </a>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>
