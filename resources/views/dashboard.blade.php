@extends('components.head')
@section('title', 'Home')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<div class="flex gap-8">

    <div class="w-1/4">
        <div class="rounded-xl border-2 overflow-hidden mb-8 p-4">
            <h1 class="mb-4 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-4xl">
                Next Deadline</h1>
            <p class="mb-4">Potential product owner: Pitch your creative concept</p>
            <p class="mb-4"> <strong>Who?</strong> </p>
            <p class="mb-4"><strong>When?</strong></p>
            {{-- <p class="mb-4">hier komt deadline</p> --}}

        </div>

    </div>

    <div>
        <canvas id="pieChart" width="400" height="400"></canvas>
        <canvas id="barChart" width="400" height="400"></canvas>
    </div>



   

    {{-- <div class="w-3/4">
        @if ($projects->count()===0)
        <h1 class="mb-8 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl">
            Projects</h1>
        <hr>
        <p class="mb-4">There are not yet any project proposals. <br></p>
        <br>
        <br>
        @else
        <h1 class="mb-8 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl">
            Pending Projects</h1>
        @foreach ($projects as $project)
        <div class="rounded-xl border-2 overflow-hidden mb-8 p-4">
            <img src="{{$project->filepath}}" alt="project image">
            <p class="mb-4">{{$project->name}}</p>
            <p class="mb-4">Created By: {{ $project->owner->name }}</p>
        </div>
        @endforeach
        <br>
        <h1 class="mb-8 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl">
            Published Projects</h1>
        @foreach ($projects as $project)
        <div class="rounded-xl border-2 overflow-hidden mb-8 p-4">
            <img src="{{$project->filepath}}" alt="project image">
            <p class="mb-4">{{$project->name}}</p>
            <p class="mb-4">Created By: {{ $project->owner->name }}</p>
        </div>
        @endforeach
        <br>
        <h1 class="mb-8 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl">
            Approved Projects</h1>
        @foreach ($projects as $project)
        <div class="rounded-xl border-2 overflow-hidden mb-8 p-4">
            <img src="{{$project->filepath}}" alt="project image">
            <p class="mb-4">{{$project->name}}</p>
            <p class="mb-4">Created By: {{ $project->owner->name }}</p>
        </div>
        @endforeach
        <br>
        <h1 class="mb-8 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl">
            Closed Projects</h1>
        @foreach ($projects as $project)
        <div class="rounded-xl border-2 overflow-hidden mb-8 p-4">
            <img src="{{$project->filepath}}" alt="project image">
            <p class="mb-4">{{$project->name}}</p>
            <p class="mb-4">Created By: {{ $project->owner->name }}</p>
        </div>
        @endforeach
        <br>
        <h1 class="mb-8 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl">
            Denied Projects</h1>
        @foreach ($projects as $project)

        <div class="rounded-xl border-2 overflow-hidden mb-8 p-4">
            <img src="{{$project->filepath}}" alt="project image">
            <p class="mb-4">{{$project->name}}</p>
            <p class="mb-4">Created By: {{ $project->owner->name }}</p>
        </div>
        @endforeach
        <br>
        <br>
        @endif

    </div>

</div> --}}

</div>

<script>
    // Pie Chart
    let labels = ['Product Owner', 'Applicants', 'Inactive Students'];
    let itemData = [{{$po}}, {{$applicants}}, {{$inactiveStudents}}];

    const data = {
        labels: labels,
        datasets: [{
            data: itemData,
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    const pieConfig = {
        type: 'pie',
        data: data,
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Students'
                }
            }
        },
    };

    const pieChart = new Chart(
        document.getElementById('pieChart'),
        pieConfig
    );

    // Bar Chart
    const barLabels = ['projects'];
    const barData = {
        labels: barLabels,
        
        datasets: [{
            label: 'approved',
        data: [{{$approvedProjects}}],
        backgroundColor: 'rgb(75, 192, 192)',
        borderColor: 'rgb(75, 192, 192)',
        borderWidth: 1
    }
    , 
    {
        label: 'denied',
        data: [{{$deniedProjects}}],
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        borderWidth: 1
    }, {
        label: 'closed',
        data: [{{$closedProjects}}],
        backgroundColor: 'rgb(54, 162, 235)',
        borderColor: 'rgb(54, 162, 235)',
        borderWidth: 1
    }, {
        label: 'pending',
        data: [{{$pendingProjects}}],
        backgroundColor: 'rgb(255, 205, 86)',
        borderColor: 'rgb(255, 205, 86)',
        borderWidth: 1
    }, {
        label: 'published',
        data: [{{$publishedProjects}}],
        backgroundColor: 'rgb(153, 102, 255)',
        borderColor: 'rgb(153, 102, 255)',
        borderWidth: 1
    }
        ]
    };


    const barConfig = {
                            type: 'bar',
                            data: barData,
                            options: {
                                responsive: true,
                                indexAxis: 'y',
                                plugins: {
                                    title: {
                                        display: true,
                                        text: 'Projects Status'
                                    }
                                },
                                scales: {
                                    x: {
                                        max: {{$allProjects}},
                                        beginAtZero: true 
                                        },
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                       };

    const barChart = new Chart(
        document.getElementById('barChart'),
        barConfig
    );
    
</script>
@endsection
