@extends('components.head')
@section('title', 'Home')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<div class="flex gap-8">

    <div class="w-1/4">
        @if ($deadline === null)

        @else
        <div class="rounded-xl border-2 overflow-hidden mb-8 p-4">
            <h1 class="mb-4 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-4xl">
                Next Deadline</h1>
            <p class="mb-4">{{$deadline->title}}</p>
            <p class="mb-4"> <strong>What?</strong> <br> {{$deadline->what}} </p>
            <p class="mb-4"><strong>When?</strong> <br> {{$deadline->end_date}}</p>
            <div id="timer"><p id="count"></p></div>
        </div>
        @endif


    </div>

    <div>
        <canvas id="pieChart" width="400" height="400"></canvas>
        <canvas id="barChart" width="400" height="400"></canvas>
    </div>


</div>
@if($deadline !== null)
    <script>
        (function() {
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