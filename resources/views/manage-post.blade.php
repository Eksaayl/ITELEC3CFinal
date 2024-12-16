<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Post') }}
        </h2>
    </x-slot>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container1 {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        main {
            background-color: #111827;
        }        
        .header1 {
            padding: 20px 0;
            text-align: center;
        }
        .header h2 {
            font-size: 2em;
            color: #333;
        }
        .btn1 {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
        .btn1:hover {
            background-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
         td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            color: #FFFFFF;
        }
        th {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            background-color: #f2f2f2;
        }
        .actions {
            display: flex;
            gap: 8px;
        }
        
    </style>

    
    
    <div class="header1">
        <h1 class="text-white text-center mt-10">User List</h1>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show w-64 mx-auto text-center bg-green-500 text-yellow-800 rounded-lg p-4" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif




    <div class="container1" style="display: flex; justify-content: space-between; align-items: flex-start;">
         <div class="w-fit bg-dark rounded-lg shadow dark:border dark:bg-gray-800 dark:border-gray-700">
            <h1 class="pb-0 sm:p-8 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                        Add A User
                    </h1>
             <div class="table-container" style="display: flex; justify-content: center; align-items: center; width: 60%; margin: 0 auto;">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>User ID</th>
                    <th>Created At</th>
                    <th style="text-align: center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td class="">{{ $post->id }}</td>
                    <td class="">{{ $post->name }}</td>
                    <td class="">{{ $post->age }}</td>
                    <td class="">{{ $post->title }}</td>
                    <td class="">{{ $post->description }}</td>
                    <td class="">{{ $post->user->name }}</td>
                    <td class="whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ $post->created_at->diffForHumans() }}</td>
                <td class="actions">
                    <a href="/posts/{{ $post->id }}" class="btn1">View</a>
                    <a href="/posts/{{ $post->id }}/edit" class="btn1">Edit</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this post?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn1 btn-danger">Delete</button>
                     </form>
                </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    
    </div>
    {{$posts->links()}}
    </div>
    

    
    <div class="form-container" style="width: 35%; margin-left: 20px;">
        <section class="bg-gray-50 dark:bg-gray-900">
            <div class="w-full bg-dark rounded-lg shadow dark:border dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 sm:p-8">
                @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    <h1 class="text-xl font-bold leading-tight text-gray-900 dark:text-white">
                        Add A User
                    </h1>
                       
                    <form class="space-y-4" action="/posts" method="POST" novalidate>
                        @csrf
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" value="{{ old('name') }}" name="name" id="name" class= "bg-gray-50 border border-gray-300 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" @error('name') border-red-500 @enderror required="">
                            @error('name')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                             @enderror
                        </div>
                        <div>
                            <label for="age" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
                            <input type="number" value="{{ old('age') }}" name="age" id="age" class="bg-gray-50 border border-gray-300 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" @error('age') border-red-500 @enderror required="">
                            @error('age')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                             @enderror
                        </div>
                        <div>
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="text" value="{{ old('title') }}" name="title" id="title" class="bg-gray-50 border border-gray-300 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" @error('title') border-red-500 @enderror required="">
                            @error('title')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                             @enderror
                        </div>
                        <div>
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white @error('description') is-invalid @enderror">Description</label>
                            <input type="text" value="{{ old('description') }}" name="description" id="description" class="bg-gray-50 border border-gray-300 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" @error('description') border-red-500 @enderror required="">
                            @error('description')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                             @enderror
                        </div>
                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-primary-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700">Submit</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</x-app-layout>
