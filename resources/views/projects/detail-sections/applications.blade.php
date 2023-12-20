<table class="table-auto w-full text-left">
    <thead>
        <tr>
            <th class="p-2 min-w-1/3">Name</th>
            <th class="p-2">Status</th>
            <th class="p-2">Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($projectApplications as $application)
            <tr class="border-b-2 transition duration-200 hover:bg-gray-100 cursor-pointer" onclick="window.location.href='{{ route('applications.show', $application->id) }}'">
                <td class="p-2">{{ $application->user->name }}</td>
                <td class="p-2">
                    <div class="bg-gray-300 rounded-lg w-fit py-1 px-2">
                        {{ $application->status }}
                    </div>
                </td>
                <td class="p-2">{{ $application->created_at->format('m/d/Y - H:i') }}</td>
            </tr>
        @endforeach
    </tbody>
    @if($projectApplications->isEmpty())
        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
            <p class="font-bold">No Applications</p>
            <p>There are no applications yet for this project.</p>
        </div>
    @endif
</table>
