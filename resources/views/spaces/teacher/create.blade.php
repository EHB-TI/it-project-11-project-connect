 @extends('components.head')
@section('title', 'Home')
@section('content')
    <!-- Hier voeg je de content van de pagina toe -->
    <form action="{{ route('spaces.store') }}" method="POST">
        @csrf
        <h1 style="font-size: 30px; font-weight: bold;">Create space</h1>
        <div>
            <br>
            <label for="name" class="block text-sm font-medium text-gray-700" style="font-size: 17px;">Space title:</label>
            <div class="mt-1">
                <input type="text" id="name" name="name" required
                    class="block w-64 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
        </div>

        <div>
            <br>
            <label for="canvasCourseId" class="block text-sm font-medium text-gray-700" style="font-size: 17px;">Course:</label>
            
            <select id="canvasCourseId" name="canvasCourseId" required
                class="block w-64 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="1">Test</option>
                <!--HIERONDER DE DROPDOWN VOOR DE CANVAS COURSE -->
                {{-- @foreach ($canvasCourses as $canvasCourse)
                    <option value="{{ $canvasCourse->canvasCourse_Id }}">{{ $canvasCourse->course_name }}</option>
                @endforeach --}}
            </select>
        </div>

        <div>
            <br>
            <label for="defaultTeamSize" class="block text-sm font-medium text-gray-700" style="font-size: 17px;">Default teammembers:</label>
            
            <input type="number" name="defaultTeamSize">
        </div>

        <div class = "mt-[20px]" >
            <button type="submit" style="background-color: gray; color: white; padding: 10px 20px; border: none; border-radius: 5px;">Create Space</button>
        </div>
    </form>
@endsection
   

    
