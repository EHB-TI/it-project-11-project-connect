 @extends('components.head')
@section('title', 'Home')
@section('content')
    <!-- Hier voeg je de content van de pagina toe -->
    <form action="{{ route('spaces.store') }}" method="POST">
        @csrf
        <h1 style="font-size: 30px; font-weight: bold;">Create space</h1>
        <br>
        <div style="width: 500px;  padding: 10px; border-radius: 5px;">
            <p>Effortlessly organize your classes with our innovative application! Craft tailored 'spaces' for each subject, enabling smooth student enrollment. Simplify your workflow, enhance communication, and create a dynamic learning experience. Join us now to revolutionize your teaching approach!</p>
        </div>
        <div>
            <br>
            <label for="space_title" class="block text-sm font-medium text-gray-700" style="font-size: 17px;">Space titel:</label>
            <div class="mt-1">
                <input type="text" id="space_title" name="name" required
                    class="block w-64 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
        </div>

        <div>
            <br>
            <label for="course" class="block text-sm font-medium text-gray-700" style="font-size: 17px;">Course:</label>
            
            <select id="course" name="course" required
                class="block w-64 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Select a course</option>
                <option value="1">Test</option>
                <!--HIERONDER DE DROPDOWN VOOR DE CANVAS COURSE -->
                {{-- @foreach ($canvasCourses as $canvasCourse)
                    <option value="{{ $canvasCourse->canvasCourse_Id }}">{{ $canvasCourse->course_name }}</option>
                @endforeach --}}
            </select>
        </div>

        <div>
            <br>
            <label for="default_teamsize" class="block text-sm font-medium text-gray-700" style="font-size: 17px;">Default teamleden:</label>
            
            <select id="default_teamsize" name="default_teamsize" required
                class="block w-64 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">  teamleden</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
            </select>
        </div>

        <div class = "mt-[20px]" >
            <button type="submit" style="background-color: gray; color: white; padding: 10px 20px; border: none; border-radius: 5px;">Create Space</button>
        </div>
    </form>
@endsection
   

    
