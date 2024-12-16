<x-app-layout>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pinterest Style Grid</title>
        <script src="https://cdn.tailwindcss.com"></script>

        <style>
            .grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* Flexible column width */
    grid-auto-rows: 10px; /* Base row height */
    gap: 20px;
}

.grid-item {
    grid-column: span 1;
    grid-row: span auto; /* Items will span rows based on content */
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
    height: auto; /* Let images adjust their height naturally */
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

        </style>
    </head>
    <body class="bg-gray-100">

        <!-- Navigation Bar -->
        <nav class="bg-white shadow-md py-4 mb-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <div class="text-2xl font-bold text-gray-800">Pinterest</div>
                <!-- Add Photo Button -->
                <button id="add-photo-btn" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                    Add Photo
                </button>
            </div>
        </nav>

        <!-- Pinterest Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid" id="masonry-grid">
                @foreach ($pictures as $picture)
                    <div class="grid-item" onclick="openModal('{{ $picture->image_url }}', '{{ $picture->title }}', '{{ $picture->description }}', '{{ $picture->user->name }}', '{{ route('pinterest.destroy', $picture->id) }}', '{{ $picture->id }}')">
                        <img src="{{ $picture->image_url }}" alt="{{ $picture->title }}">
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Add Photo Modal -->
        <div id="add-photo-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
            <div class="bg-white rounded-lg p-6 w-full max-w-lg">
                <h2 class="text-xl font-bold mb-4">Add a New Photo</h2>
                <form action="{{ route('pinterest.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" id="title" required class="w-full px-3 py-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="3" class="w-full px-3 py-2 border rounded"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                        <input type="file" name="image" id="image" accept="image/*" required class="w-full">
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" id="close-add-photo-modal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- View Photo Modal -->
        <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-lg overflow-hidden max-w-4xl w-full shadow-lg flex relative">
        <div class="w-1/2">
            <img id="modal-image" src="" alt="Image" class="w-full h-full object-cover">
        </div>
        <div class="w-1/2 flex flex-col p-6 justify-between relative">
            <!-- Edit Button -->
            <!-- Edit Button -->
<button 
    id="edit-btn" 
    onclick="openEditModal('{{ $picture->id }}', '{{ $picture->title }}', '{{ $picture->description }}', '{{ route('pinterest.update', $picture->id) }}')"
    class="absolute top-4 right-4 bg-gray-100 hover:bg-gray-200 text-gray-800 p-2 rounded-full shadow">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M16.5 3a2.121 2.121 0 113 3l-8.01 8.01a4 4 0 01-1.414.586L7 16l.404-3.404a4 4 0 01.586-1.414L16.5 3z" />
    </svg>
</button>

            <!-- Modal Content -->
            <div>
                <h3 id="modal-title" class="text-2xl font-bold mb-4"></h3>
                <p id="modal-description" class="text-gray-600 mb-4"></p>
                <p id="modal-uploader" class="text-gray-500 mb-4"></p>
            </div>
            <div class="flex justify-end space-x-4 mt-6">
                <button id="delete-btn" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                <button onclick="closeModal()" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Photo Modal -->
<div id="edit-photo-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 w-full max-w-lg">
        <h2 class="text-xl font-bold mb-4">Edit Photo Details</h2>
        <form id="edit-photo-form" method="POST" enctype="multipart/form-data">
        @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="edit-title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="edit-title" name="title" required class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="edit-description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="edit-description" name="description" rows="3" class="w-full px-3 py-2 border rounded"></textarea>
            </div>
            <div class="mb-4">
                <label for="edit-image" class="block text-sm font-medium text-gray-700">Change Image (Optional)</label>
                <input type="file" id="edit-image" name="image" accept="image/*" class="w-full">
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" id="close-edit-photo-modal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>


        <script>

document.addEventListener('DOMContentLoaded', () => {
    const grid = document.getElementById('masonry-grid');
    const resizeMasonryItem = (item) => {
        const rowHeight = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-auto-rows'));
        const rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('gap'));
        const itemHeight = item.querySelector('img').getBoundingClientRect().height;
        const rowSpan = Math.ceil((itemHeight + rowGap) / (rowHeight + rowGap));
        item.style.gridRowEnd = `span ${rowSpan}`;
    };

    const resizeAllGridItems = () => {
        const allItems = document.querySelectorAll('.grid-item');
        allItems.forEach(item => resizeMasonryItem(item));
    };

    window.addEventListener('resize', resizeAllGridItems);
    resizeAllGridItems();
});

// Get elements
const editPhotoModal = document.getElementById('edit-photo-modal');
const closeEditPhotoModal = document.getElementById('close-edit-photo-modal');
const editPhotoForm = document.getElementById('edit-photo-form');

// Function to open the Edit Modal
function openEditModal(pictureId, title, description, updateUrl) {
    // Populate the form fields
    document.getElementById('edit-title').value = title;
    document.getElementById('edit-description').value = description;

    // Set the form's action URL
    editPhotoForm.action = updateUrl;

    // Show the modal
    editPhotoModal.classList.remove('hidden');
}

// Function to close the Edit Modal
closeEditPhotoModal.addEventListener('click', () => {
    editPhotoModal.classList.add('hidden');
});

// Close modal on background click
window.onclick = function (event) {
    if (event.target === editPhotoModal) {
        editPhotoModal.classList.add('hidden');
    }
};



            const modal = document.getElementById('modal');
            const csrfToken = '{{ csrf_token() }}';

            // Function to open the modal
            function openModal(imageUrl, title, description, uploaderName, deleteUrl, pictureId) {
                modal.classList.remove('hidden');

                // Populate modal content
                document.getElementById('modal-image').src = imageUrl;
                document.getElementById('modal-title').innerText = title;
                document.getElementById('modal-description').innerText = description;
                document.getElementById('modal-uploader').innerText = `Uploaded by: ${uploaderName}`;

                // Delete button logic
                const deleteBtn = document.getElementById('delete-btn');
                deleteBtn.onclick = function () {
                    if (confirm('Are you sure you want to delete this image?')) {
                        fetch(deleteUrl, {
                            method: 'DELETE',
                            headers: { 'X-CSRF-TOKEN': csrfToken }
                        }).then(response => {
                            if (response.ok) {
                                alert('Image deleted successfully!');
                                location.reload();
                            } else {
                                alert('Error deleting image!');
                            }
                        }).catch(() => alert('Error deleting image!'));
                    }
                };
            }

            // Function to close the modal
            function closeModal() {
                modal.classList.add('hidden');
            }

            // Event listeners
            window.onclick = function (event) {
                if (event.target === modal) closeModal();
            };

            document.getElementById('add-photo-btn').onclick = () => {
                document.getElementById('add-photo-modal').classList.remove('hidden');
            };

            document.getElementById('close-add-photo-modal').onclick = () => {
                document.getElementById('add-photo-modal').classList.add('hidden');
            };
        </script>

    </body>
    </html>
</x-app-layout>
