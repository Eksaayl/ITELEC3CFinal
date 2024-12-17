<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>
    @vite('resources/css/app.css')

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .grid-container {
            margin-top: 2rem;
            padding: 0 2rem;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            grid-auto-rows: 10px;
            gap: 24px;
        }

        .grid-item {
            grid-column: span 1;
            grid-row: span auto;
            border-radius: 12px;
            overflow: hidden;
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .grid-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            cursor: pointer;
        }

        .grid-item img {
            width: 100%;
            display: block;
            height: auto;
            object-fit: cover;
        }

        #edit-btn {
            position: absolute;
            top: 16px;
            right: 16px;
            background-color: #f9f9f9;
            border: none;
            padding: 8px;
            border-radius: 50%;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            cursor: pointer;
            transition: background-color 0.2s ease, box-shadow 0.2s ease;
        }

        #edit-btn:hover {
            background-color: #e2e2e2;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
            z-index: 50;
        }

        .modal.show {
            display: flex;
        }

        body.modal-open {
            overflow: hidden;
        }

        .mt-navbar {
            margin-top: 2rem;
        }
    </style>
</head>

<body class="antialiased">
    <!-- Original Navbar -->
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Dribble</span>
            </a>

            <div class="flex md:order-2">
                <button type="button" data-collapse-toggle="navbar-search" aria-controls="navbar-search"
                    aria-expanded="false"
                    class="md:hidden text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 me-1">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
                <div class="relative hidden md:block">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                        <span class="sr-only">Search icon</span>
                    </div>
                    <input type="text" id="search-navbar"
                        class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search...">
                </div>
                <button data-collapse-toggle="navbar-search" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-search" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-search">
                <div class="relative mt-3 md:hidden">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="search-navbar"
                        class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search...">
                </div>
                <ul
                    class="flex flex-col p-4 md:p-0 -mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="{{ route('welcome') }}"
                            class="font-semibold text-gray-50 hover:text-blue-500 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Inspiration</a>
                    </li>
                    <li>
                        <a href="{{ route('inspiration') }}"
                            class="font-semibold text-gray-50 hover:text-blue-500 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                            aria-current="page">Jobs</a>
                    </li>
                    <li>
                        <a href="{{ route('pro') }}"
                            class="font-semibold text-gray-50 hover:text-blue-500 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 {{ request()->is('pro') ? 'text-blue-500' : '' }}">Go
                            Pro</a>
                    </li>
                    <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                            class="font-semibold flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
                            Find Designers
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <div id="dropdownNavbar"
                            class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-400"
                                aria-labelledby="dropdownLargeButton">
                                <li>
                                    <a href="{{ route('designer') }}"
                                        class="block px-4 py-2 font-semibold text-gray hover:bg-gray-300 hover:text-blue-600">Designer
                                        Search</a>
                                </li>
                                <li>
                                    <a href="{{ route('job-post') }}"
                                        class="block px-4 py-2 font-semibold text-gray hover:bg-gray-300 hover:text-blue-600">Post
                                        your Job</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('dashboard') }}"
                                    class="font-semibold text-gray-50 hover:text-blue-500 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="font-semibold text-gray-50 hover:text-blue-500 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                                    in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="ml-4 font-semibold text-gray-50 hover:text-blue-500 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                                @endif
                            @endauth
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Secondary Navigation -->
    <nav class="bg-white shadow-md py-4 mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="text-2xl font-bold text-gray-800">Artist Gallery</div>
            <button id="add-photo-btn" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                Add Photo
            </button>
        </div>
    </nav>

    <!-- Main Content with proper spacing -->
    <main class="grid-container">
        <div class="grid" id="masonry-grid">
            @foreach ($pictures as $picture)
                <div class="grid-item"
                    onclick="openModal('{{ $picture->image_url }}', '{{ $picture->title }}', '{{ $picture->description }}', '{{ $picture->user->name }}', '{{ route('test.destroy', $picture->id) }}', '{{ $picture->id }}')">
                    <img src="{{ $picture->image_url }}" alt="{{ $picture->title }}" onerror="this.src='/placeholder.jpg';"
                        loading="lazy">
                </div>
            @endforeach
        </div>
    </main>

    <!-- Add Photo Modal -->
    <div id="add-photo-modal" class="modal">
        <div class="bg-white rounded-lg p-6 w-full max-w-lg m-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Add a New Photo</h2>
                <button type="button" class="text-gray-400 hover:text-gray-500" onclick="hideModal('add-photo-modal')">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form id="add-photo-form" action="{{ route('test.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" id="title" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="3"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Image</label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="image"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Upload a file</span>
                                        <input id="image" name="image" type="file" accept="image/*" class="sr-only"
                                            required>
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6 flex justify-end space-x-2">
                    <button type="button" onclick="hideModal('add-photo-modal')"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500">
                        Cancel
                    </button>
                    <button type="submit"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500">
                        Upload Photo
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- View Photo Modal -->
    <div id="view-modal" class="modal">
        <div class="bg-white rounded-lg overflow-hidden max-w-4xl w-full shadow-lg flex relative m-4">
            <div class="w-1/2">
                <img id="modal-image" src="" alt="Image" class="w-full h-full object-cover">
            </div>
            <div class="w-1/2 flex flex-col p-6 justify-between relative">
                <button id="edit-btn"
                    class="absolute top-4 right-4 bg-gray-100 hover:bg-gray-200 text-gray-800 p-2 rounded-full shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536M16.5 3a2.121 2.121 0 113 3l-8.01 8.01a4 4 0 01-1.414.586L7 16l.404-3.404a4 4 0 01.586-1.414L16.5 3z" />
                    </svg>
                </button>
                <div>
                    <h3 id="modal-title" class="text-2xl font-bold mb-4"></h3>
                    <p id="modal-description" class="text-gray-600 mb-4"></p>
                    <p id="modal-uploader" class="text-gray-500 mb-4"></p>
                </div>
                <div class="flex justify-end space-x-4">
                    <button id="delete-btn"
                        class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
                    <button onclick="hideModal('view-modal')"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Photo Modal -->
    <div id="edit-photo-modal" class="modal">
        <div class="bg-white rounded-lg p-6 w-full max-w-lg m-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Edit Photo Details</h2>
                <button type="button" class="text-gray-400 hover:text-gray-500" onclick="hideModal('edit-photo-modal')">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form id="edit-photo-form" method="POST" enctype="multipart/form-data"
                action="{{ route('test.update', ['id' => $picture->id ?? 0]) }}">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label for="edit-title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" id="edit-title" name="title" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="edit-description"
                            class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea id="edit-description" name="description" rows="3"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Change Image (Optional)</label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="edit-image"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Upload a file</span>
                                        <input id="edit-image" name="image" type="file" accept="image/*"
                                            class="sr-only">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6 flex justify-end space-x-2">
                    <button type="button" onclick="hideModal('edit-photo-modal')"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500">
                        Cancel
                    </button>
                    <button type="submit"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.5.1/flowbite.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Modal functionality
            const addPhotoBtn = document.getElementById('add-photo-btn');
            const addPhotoModal = document.getElementById('add-photo-modal');
            const editPhotoModal = document.getElementById('edit-photo-modal');
            const viewModal = document.getElementById('view-modal');

            // Show modal function
            function showModal(modalId) {
                const modal = document.getElementById(modalId);
                modal.style.display = 'flex';
                document.body.classList.add('modal-open');
            }

            // Hide modal function
            function hideModal(modalId) {
                const modal = document.getElementById(modalId);
                modal.style.display = 'none';
                document.body.classList.remove('modal-open');
            }

            // Make functions globally available
            window.showModal = showModal;
            window.hideModal = hideModal;

            // Grid layout functionality
            const grid = document.getElementById('masonry-grid');

            function resizeMasonryItem(item) {
                const rowHeight = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-auto-rows'));
                const rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('gap'));
                const itemHeight = item.querySelector('img').getBoundingClientRect().height;
                const rowSpan = Math.ceil((itemHeight + rowGap) / (rowHeight + rowGap));
                item.style.gridRowEnd = `span ${rowSpan}`;
            }

            function resizeAllGridItems() {
                const allItems = document.querySelectorAll('.grid-item');
                allItems.forEach(resizeMasonryItem);
            }

            // Initialize layout
            function initLayout() {
                const allItems = document.querySelectorAll('.grid-item');
                allItems.forEach(item => {
                    const img = item.querySelector('img');
                    if (img.complete) {
                        resizeMasonryItem(item);
                    } else {
                        img.addEventListener('load', () => resizeMasonryItem(item));
                    }
                });
            }

            // Event listeners
            window.addEventListener('resize', resizeAllGridItems);
            initLayout();

            // Modal triggers continued
            addPhotoBtn.addEventListener('click', () => showModal('add-photo-modal'));

            // Form handling
            const editPhotoForm = document.getElementById('edit-photo-form');
            editPhotoForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const formData = new FormData(this);
                formData.append('_method', 'PUT'); // Append method override for Laravel

                const updateUrl = this.action;

                fetch(updateUrl, {
                    method: 'POST', // Use POST for Laravel to interpret PUT properly
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Photo updated successfully!');
                            location.reload();
                        } else {
                            alert('Error updating photo: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error updating photo');
                    })
                    .finally(() => {
                        hideModal('edit-photo-modal');
                    });
            });
            // Add photo form handling
            const addPhotoForm = document.getElementById('add-photo-form');
            addPhotoForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const formData = new FormData(this);

                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                    .then(response => {
                        if (response.ok) {
                            alert('Photo uploaded successfully!');
                            location.reload();
                        } else {
                            throw new Error('Failed to upload photo');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error uploading photo');
                    })
                    .finally(() => {
                        hideModal('add-photo-modal');
                    });
            });

            // View modal function
            window.openModal = function (imageUrl, title, description, uploaderName, deleteUrl, pictureId) {
                document.getElementById('modal-image').src = imageUrl;
                document.getElementById('modal-title').innerText = title;
                document.getElementById('modal-description').innerText = description;
                document.getElementById('modal-uploader').innerText = `Uploaded by: ${uploaderName}`;

                // Set up edit button
                const editBtn = document.getElementById('edit-btn');
                editBtn.onclick = function () {
                    hideModal('view-modal');
                    const updateUrl = `/test/${pictureId}`;
                    openEditModal(pictureId, title, description, updateUrl);
                };

                // Set up delete button
                const deleteBtn = document.getElementById('delete-btn');
                deleteBtn.onclick = function () {
                    if (confirm('Are you sure you want to delete this image?')) {
                        fetch(deleteUrl, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        })
                            .then(response => {
                                if (response.ok) {
                                    alert('Image deleted successfully!');
                                    location.reload();
                                } else {
                                    alert('Error deleting image!');
                                }
                            })
                            .catch(() => alert('Error deleting image!'));
                    }
                };

                showModal('view-modal');
            };

            // Edit modal function
            window.openEditModal = function (pictureId, title, description) {
                document.getElementById('edit-title').value = title;
                document.getElementById('edit-description').value = description;

                const editPhotoForm = document.getElementById('edit-photo-form');
                editPhotoForm.action = `/pictures/${pictureId}`; // Use the correct route
                console.log('Form action updated to:', editPhotoForm.action); // Debugging

                showModal('edit-photo-modal');
            };


            // Close modals on background click
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        hideModal(modal.id);
                    }
                });
            });
        });
    </script>
</body>

</html>