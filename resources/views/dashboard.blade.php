<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }} for {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3>List of Users</h3>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Joined Date</th>
                  </tr>
                </thead>
                <tbody>

                    @php($count = 1)
                    @foreach ($users as $user)

                    <tr>
                        <th scope="row">{{ $count++ }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                      </tr>
                    @endforeach
                    <tr><td colspan="4"><strong>Total Users: {{ count($users) }}</strong></td></tr>
                </tbody>
              </table>
        </div>
    </div>
</x-app-layout>
