@extends('components.head')
@section('title', 'Home')
@section('content')
    <!-- Hier voeg je de content van de pagina toe -->
    <table class="table-auto w-full text-left">
        <thead>
            <tr>
                <th class="p-2 min-w-1/3">Name</th>
                <th class="p-2">Role</th>
                <th class="p-2">Project</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user )
            <tr class="border-b-2 transition duration-200 hover:bg-gray-100 cursor-pointer" onclick="window.location.href='/user/{{$user->id}}';">
                <td class="p-2">{{$user->name}}</td>
                <td class="p-2">{{$user->role}} </td>
                <td class="p-2">
                    @foreach ($user->projects as $project)
                        {{$project->name}}
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

<script>



</script>
@endsection

