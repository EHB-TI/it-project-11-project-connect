@extends('components.head')
@section('title', 'Home')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <div class="flex gap-8">

        <div class="w-3/4">
            @if(Auth::check() && Auth::user()->hasRole('student'))
                <div class="mb-8">
                    <h2 class="subtitle mb-4 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">My projects</h2>
                    @if ($projects->isEmpty())
                        <p class="mb-4">Nothing here yet, come back later or start your own project.</p>

                    @else
                        @foreach($projects as $project)
                        <div class="project-card__container grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                            <div class="project-card rounded-xl overflow-hidden hover:cursor-pointer"
                                 onclick="window.location.href='{{ route('projects.show', $project->id) }}'">
                                <div class="project-card__image bg-cover bg-center w-full h-[200px] bg-amber-500" style="background-image: url( {{ Storage::url($project->file_path) }} )"></div>
                                <div class="project-card__content rounded-b-xl border-2 border-t-0 p-4 flex flex-col gap-2">
                                    <h2 class="project-card__title text-2xl font-bold">{{ $project->name }}</h2>
                                    <p class="project-card__owner">Created By: {{ $project->owner->name }}</p>
                                    <div class="project-card__members flex items-center gap-4">
                                        <div class="icon_placeholder w-8 h-8 bg-indigo-950 rounded-full"></div>
                                        <p>{{ $project->users->count() }} / {{ $project->space->defaultTeamSize }}</p>
                                    </div>
                                    <p class="project-card__description">{{ $project->brief }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
                <h2 class="subtitle mb-4 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">Projects I have applied for</h2>
                @if ($appliedProjects->isEmpty())
                    <p class="mb-4">Nothing here yet, go ahead and take a look at some projects.</p>

                @else
                    @foreach($appliedProjects as $project)
                        <div class="project-card__container grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                            <div class="project-card rounded-xl overflow-hidden hover:cursor-pointer"
                                 onclick="window.location.href='{{ route('projects.show', $project->id) }}'">
                                <div class="project-card__image bg-cover bg-center w-full h-[200px] bg-amber-500" style="background-image: url( {{ Storage::url($project->file_path) }} )"></div>
                                <div class="project-card__content rounded-b-xl border-2 border-t-0 p-4 flex flex-col gap-2">
                                    <h2 class="project-card__title text-2xl font-bold">{{ $project->name }}</h2>
                                    <p class="project-card__owner">Created By: {{ $project->owner->name }}</p>
                                    <div class="project-card__members flex items-center gap-4">
                                        <div class="icon_placeholder w-8 h-8 bg-indigo-950 rounded-full"></div>
                                        <p>{{ $project->users->count() }} / {{ $project->space->defaultTeamSize }}</p>
                                    </div>
                                    <p class="project-card__description">{{ $project->brief }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            @endif
            @if(Auth::check() && Auth::user()->hasRole('teacher'))
                <h2 class="subtitle mb-4 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">
                    Projects</h2>
                <div class="mb-20">
                    <canvas id="barChart"></canvas>
                </div>
                <h2 class="subtitle mb-4 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">
                    Formed Teams</h2>
                <div>
                    <canvas id="barChart2"></canvas>
                </div>
            @endif
        </div>

        <div class="w-1/4">
            @if ($deadline === null)

            @else
                <div class="rounded-xl border-2 overflow-hidden mb-8 p-4">
                    <h1 class="mb-4 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-4xl">
                        Next Deadline</h1>
                    <p class="mb-4">{{$deadline->title}}</p>
                    <p class="mb-4"><strong>What?</strong> <br> {{$deadline->what}} </p>
                    <p class="mb-4"><strong>When?</strong> <br> {{$deadline->end_date}}</p>
                    <div id="timer"><p id="count"></p></div>
                </div>
            @endif
            @if(Auth::check() && Auth::user()->hasRole('teacher'))
                <div class="">
                    <canvas id="pieChart" width="400px" height="400px"></canvas>
                </div>
            @endif
        </div>


    </div>
    @if($deadline !== null)
        <script>
            (function () {
                //TIMER
                const divTimer = document.getElementById("timer");
                const deadlineEndDate = new Date('{{ $deadline->end_date }}');
                updateTimer(); // Call the function initially

                setInterval(updateTimer, 60000);

                function updateTimer() {
                    const currentDate = new Date();

                    const timeDifference = deadlineEndDate - currentDate;

                    const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
                    //const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

                    const timer = document.getElementById('count');
                    timer.innerHTML = `Time left: ${days} days, ${hours} hours, ${minutes} minutes`;
                }
            })();

        </script>
    @endif

    @if(Auth::check() && Auth::user()->hasRole('teacher'))
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


        // Bar Chart 2
        const barLabels2 = ['members'];
        const datasets2 = [];

        let members = {!! json_encode($members) !!};
        for (let projectName in members) {
            let memberCount = members[projectName];
            datasets2.push({
                label: projectName,
                data: [memberCount],
                backgroundColor: 'rgb(75, 192, 192)',
                borderColor: 'rgb(75, 192, 192)',
                borderWidth: 1
            });
        }
        const barData2 = {
            labels: barLabels2,
            datasets: datasets2
        };

        const barConfig2 = {
            type: 'bar',
            data: barData2,
            options: {
                responsive: true,
                indexAxis: 'y',
                plugins: {
                    title: {
                        display: true,
                        text: 'Formed Teams'
                    }
                },
                scales: {
                    x: {
                        max: 14, //should be the max of members for groups
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        const barChart2 = new Chart(
            document.getElementById('barChart2'),
            barConfig2
        );

    </script>
    @endif
@endsection
