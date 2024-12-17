<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts Create') }}
        </h2>
    </x-slot>

    <section class="bg-gray-50 dark:bg-gray-900">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      
      <div class="w-full bg-dark rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  Add A User
              </h1>
              <form class="space-y-4 md:space-y-6" action="/posts" method="POST">
                @csrf
                  <div>
                      <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                      <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name" required="">
                  </div>
                  <div>
                      <label for="art_typ" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Art Type</label>
                      <select name="art_type" id="art_type" class="bg-gray-50 border border-gray-300 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" @error('art_type') border-red-500 @enderror required>
        <option value="" disabled selected>Select Art Type</option>
        <option value="Painting" {{ old('art_type') == 'Painting' ? 'selected' : '' }}>Painting</option>
        <option value="Sculpture" {{ old('art_type') == 'Sculpture' ? 'selected' : '' }}>Sculpture</option>
        <option value="Digital" {{ old('art_type') == 'Digital' ? 'selected' : '' }}>Digital</option>
        <option value="Photography" {{ old('art_type') == 'Photography' ? 'selected' : '' }}>Photography</option>
        <option value="Drawing" {{ old('art_type') == 'Drawing' ? 'selected' : '' }}>Drawing</option>
    </select>
                  </div>
                  <div>
                      <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                      <input type="text" name="title" id="title" placeholder="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                  </div>
                  <div>
                      <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                      <input type="text" rows="4" name="description" id="title" placeholder="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                  </div>
                  
                  <button type="submit" class="w-full text-white bg-blue-700 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Submit</button>
                  
              </form>
          </div>
      </div>
  </div>
</section>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.5.1/flowbite.min.js"></script>
</x-app-layout>


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Details Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        form {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #555;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s;
        }
        input:focus, textarea:focus {
            border-color: #007bff;
            outline: none;
        }
        button {
            width: 100%;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        @media (max-width: 600px) {
            form {
                padding: 20px;
            }
            button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div>
        <h2>Add Post</h2>
        <form action="/posts" method="POST">
            @csrf
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>

            <label for="age">Age</label>
            <input type="number" id="age" name="age" required>

            <label for="title">Title</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html> -->
