<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit User</title>
    <style>
        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div>
        <h2>Edit User</h2>
        <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf

            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ $post->name }}" required>

            <label for="age">Age</label>
            <input type="number" id="age" name="age" value="{{ $post->age }}" required>

            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="{{ $post->title }}" required>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" required>{{ $post->description }}</textarea>

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html> -->

<x-app-layout>
<section class="bg-gray-50 dark:bg-gray-900">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      
      <div class="w-full bg-dark rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  Edit A User
              </h1>
              <form class="space-y-4 md:space-y-6" action="{{ route('posts.update', $post->id) }}" method="POST">
                @csrf
                  <div>
                      <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                      <input type="text" name="name" id="name" value="{{ $post->name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name" required="">
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
                      <input type="text" name="title" id="title" value="{{ $post->title }}" placeholder="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                  </div>
                  <div>
                      <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                      <input type="text" rows="4"  name="description" id="title" value="{{ $post->description }}" placeholder="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                  </div>
                  
                  <button type="Update" class="w-full text-white bg-blue-700 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Update</button>
                  
              </form>
          </div>
      </div>
  </div>
</section>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.5.1/flowbite.min.js"></script>
</x-app-layout>