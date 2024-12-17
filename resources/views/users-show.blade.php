<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .user-details {
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            margin: 10px 0;
        }
        .btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
            margin-top: 20px;
            display: block;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="user-details">
        <h2>{{ $post->name }}</h2>
        <p><strong>Age:</strong> {{ $post->age }}</p>
        <p><strong>Title:</strong> {{ $post->title }}</p>
        <p><strong>Description:</strong> {{ $post->description }}</p>
        <a href="{{ route('dashboard') }}" class="btn">Back to Users List</a>
    </div>
</body>
</html> -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts Show') }}
        </h2>
    </x-slot>

    <section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      
        
        <!-- User Details Display -->
        <div class="w-full max-w-2xl mx-auto mt-8 p-6 bg-white rounded-lg shadow dark:bg-gray-800 text-center">
    <h2 class="text-xl font-bold text-dark-900 dark:text-dark">{{ $post->name }}</h2>
    <p class="text-gray-700 dark:text-dark-300"><strong>Art Type:</strong> {{ $post->art_type }}</p>
    <p class="text-gray-700 dark:text-dark-300"><strong>Title:</strong> {{ $post->title }}</p>
    <p class="text-gray-700 dark:text-dark-300"><strong>Description:</strong> {{ $post->description }}</p>
    <div class="flex justify-center mt-4">
        <a href="{{ route('manage-post') }}" class="w-45 flex items-center justify-center text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700 no-underline">
            Back to Users List
        </a>
    </div>
</div>



</section>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.5.1/flowbite.min.js"></script>
</x-app-layout>
