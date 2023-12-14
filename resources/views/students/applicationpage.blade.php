@extends('components.head')
@section('title', 'Home')

@section('content')
<body class="font-sans bg-gray-100">
<form id="form_apply"method="post">

    <div class="max-w-4xl mx-auto p-4">

        <h2 class="text-3xl font-bold mb-4">Application Form</h2>
        <p class="text3 font-bold mb-4">Project Connect</p>

        <header class="mb-4">
            <p>Welcome to the developer application form. if you're passionate...</p>
        </header>

        <div class="float-right border rounded-lg border-gray-300 p-4" >
            <h2 class="font-bold">Application done ?</h2>
            <p>click to submit</p>
            
                @csrf
            <button class="bg-gray-500 hover:bg-brown-700 text-black font-bold py-2 px-4 rounded-full border border-white-500">Submit</button>
            
        </div>

        <header class="mb-4">
            <h2 class="text-2xl font-bold">Motivation letter</h2>
            <p>Provide any additional details or upload supporting documents.</p>
        </header>

        <div class="mt-4">
            <label for="file" class="block text-sm font-medium text-gray-700">Upload File:</label>
            <input type="file" id="file" name="file" class="mt-1 p-2 border rounded-full border-gray-300">
        </div>

        <h2 class="font-bold">OR</h2>

        <div class="flex flex-col space-y-2 w-3/4">
            <input type="hidden" id="content" name="content">
        <label for="editor" class="text-gray-600 font-semibold">Write your motivation down below</label>
        <div id="editor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"><div>
        </div>

    </div>
    </form>
@endsection
