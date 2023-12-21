@extends('components.head')
@section('title', 'Home')
@section('content')
@include('components.breadcrumb', ['breadcrumbName' => 'students', 'id' => null])
{{-- <div class="breadcrumbs">
    {!! Breadcrumbs::render('students') !!}
</div> --}}
    <h2 class="subtitle mb-4 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">Students</h2>
    <table class="table-auto w-full text-left">
        <thead>
            <tr>
                <th class="p-2 min-w-1/3">Name</th>
                <th class="p-2">Role</th>
                <th class="p-2">Project</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr class="border-b-2 transition duration-200 hover:bg-gray-100 cursor-pointer" onclick="window.location.href='{{ route('students.show', $user->id) }}';">
                <td class="p-2">{{$user->name}}</td>
                <td class="p-2">{{$user->role}} </td>
                <td class="p-2">
                    @if ($user->projects->isEmpty())
                        <div class="text-gray-400">No projects yet</div>
                    @else
                        {!! implode(', ', $user->projects->map(function ($project) {
                        return '<a href="'.route('projects.show', $project->id).'" class="text-blue-500 hover:text-blue-700 hover:underline">'.$project->name.'</a>';
                    })->toArray()) !!}
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

<script>



</script>
@endsection

