@extends('components.head')
@section('title', 'Home')

@section('content')
<body class="font-sans bg-gray-100">

    <div class="max-w-4xl mx-auto p-4">

        <h2 class="text-3xl font-bold mb-4">Application Form</h2>
        <p class="text3 font-bold mb-4">Project Connect</p>

        <header class="mb-4">
            <p>Welcome to the developer application form. if you're passionate about...</p>
        </header>

        <div class="float-right">
            <form action="submit_form.php" method="post">
                <button class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded-full border border-white-500">Submit</button>
            </form>
        </div>

        <header class="mb-4">
            <h2 class="text-2xl font-bold">Additional Information</h2>
            <p>Provide any additional details or upload supporting documents.</p>
        </header>

        <div class="mt-4">
            <label for="file" class="block text-sm font-medium text-gray-700">Upload File:</label>
            <input type="file" id="file" name="file" class="mt-1 p-2 border rounded-full border-gray-300">
        </div>

    </div>

@endsection
