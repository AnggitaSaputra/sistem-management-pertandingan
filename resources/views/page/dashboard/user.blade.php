@extends('layout.app')

@section('content')

<div class="bg-white rounded-lg h-full p-5 shadow-lg">
    <div class="text-xl">
        <h1>{{$data['title']}}</h1>
    </div>
    <div class="relative overflow-x-auto mt-5">
        <div class="pb-4 bg-white flex justify-between">
            <div class="relative mt-1">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search for items">
            </div>
            <div>
                <button id="openModalButton" class="bg-blue-700 hover:bg-blue-500 text-white p-2 rounded-lg">
                    Tambah Data
                </button>
            </div>
        </div>
        <div id="myModal" class="modal hidden fixed inset-0 z-50 overflow-auto bg-gray-500 bg-opacity-50 flex justify-center items-center">
            <div class="modal-content bg-white w-1/2 p-4 rounded-lg">
                <div class="flex justify-between">
                    <h2 class="text-xl font-bold">Modal Title</h2>
                    <button id="closeModalButton" class="text-red-500 hover:text-red-700">&times;</button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-6">
                            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama address</label>
                            <input type="text" id="nama" name="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="john.doe@company.com" required />
                        </div> 
                        <div class="mb-6">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
                            <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="john.doe@company.com" required />
                        </div> 
                        <div class="mb-6">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
                            <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="john.doe@company.com" required />
                        </div> 
                        <div class="mb-6">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required />
                        </div> 
                        <div class="mb-6">
                            <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                            <input type="password" id="confirm_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required />
                        </div> 
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <table id="table" class="w-full text-sm text-left rtl:text-right text-gray-500 rounded-lg p-2 border-black divide-y">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nama Lengkap
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Role
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Dibuat
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody id="table">
            </tbody>
        </table>
        <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4" aria-label="Table navigation">
            <span class="text-sm font-normal text-gray-500 mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing <span class="font-semibold text-gray-900">1-10</span> of <span class="font-semibold text-gray-900">1000</span></span>
            <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                <li>
                    <a href="#" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">Previous</a>
                </li>
                <li>
                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">1</a>
                </li>
                <li>
                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">2</a>
                </li>
                <li>
                    <a href="#" aria-current="page" class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700">3</a>
                </li>
                <li>
                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">4</a>
                </li>
                <li>
                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">5</a>
                </li>
                <li>
                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>

@endsection

@section('script')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        loadData();

        function loadData() {
            $.ajax({
                url: '{{ route('user')}}',
                type: 'GET',
                success: function(response) {
                    renderData(response);
                },
                error: function(error) {
                    console.error('Error getting data:', error.responseText);
                }
            });
        }

        function renderData(data) {
            const tableBody = document.querySelector('tbody');
            tableBody.innerHTML = '';

            data.forEach(data => {
                const row = document.createElement('tr');
                var created_at = data.created_at;
                var date = new Date(created_at);
                var formattedDate = date.toISOString().slice(0, 19).replace("T", " ");
                row.innerHTML = `
                    <td class="px-6 py-4">${data.nama}</td>
                    <td class="px-6 py-4">${data.email}</td>
                    <td class="px-6 py-4">${data.role}</td>
                    <td class="px-6 py-4">${formattedDate}</td>
                    <td class="px-6 py-4">
                        <button class="font-medium text-blue-600 hover:underline edit-button" data-id="${product.id}">Edit</button>
                    </td>
                `;

                row.className = 'bg-white border-b hover:bg-gray-50';

                tableBody.appendChild(row);
            });

            const editButtons = document.querySelectorAll('.edit-button');
            editButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const productId = button.getAttribute('data-id');
                    fetch({{ route('user.update', productId)}})
                        .then(response => response.json())
                        .then(product => {
                            const modalBody = document.querySelector('.modal-body');
                            modalBody.innerHTML = `
                                <p><strong>Product Name:</strong> ${product.name}</p>
                                <p><strong>Color:</strong> ${product.color}</p>
                                <p><strong>Category:</strong> ${product.category}</p>
                                <p><strong>Price:</strong> ${product.price}</p>
                            `;

                            toggleModal();
                        })
                        .catch(error => console.error('Error fetching product details:', error));
                });
            });
        }
    });

    function toggleModal() {
        var modal = document.getElementById("myModal");
        modal.classList.toggle("hidden");
    }

    function closeModal() {
        var modal = document.getElementById("myModal");
        modal.classList.add("hidden");
    }

    document.getElementById("openModalButton").addEventListener("click", toggleModal);
    document.getElementById("closeModalButton").addEventListener("click", closeModal);
    window.addEventListener("click", function(event) {
        var modal = document.getElementById("myModal");
        if (event.target == modal) {
            closeModal();
        }
    });
</script>
@endSection()