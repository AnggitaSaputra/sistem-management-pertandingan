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
                <input type="text" id="search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search for items">
            </div>
            <div>
                <button id="openModalButton" class="bg-blue-700 hover:bg-blue-500 text-white p-2 rounded-lg">
                    Tambah Data
                </button>
            </div>
        </div>
        <div id="timModal" class="modal hidden fixed inset-0 z-50 overflow-auto bg-gray-500 bg-opacity-50 flex justify-center items-center">
            <div class="modal-content bg-white w-1/2 p-4 rounded-lg">
                <div class="flex justify-between">
                    <h2 class="text-xl font-bold">Tambah {{$data['title'] }}</h2>
                    <button id="closeModalButton" class="text-red-500 hover:text-red-700">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="formTim" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-6">
                            <label for="nama_tim" class="block mb-2 text-sm font-medium text-gray-900">Nama Tim Kelas</label>
                            <input type="text" id="nama_tim" name="nama_tim" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukan Nama Tim Kelas" required />
                            <input type="id" id="id" name="id" hidden>
                        </div> 
                        <div class="mb-6">
                            <label for="asal_institusi" class="block mb-2 text-sm font-medium text-gray-900">Asal Institusi</label>
                            <input type="text" id="asal_institusi" name="asal_institusi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukan Asal Institusi" required />
                        </div> 
                        <div class="mb-6">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                            <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukan Email" required />
                        </div> 
                        <div class="mb-6">
                            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat Institusi</label>
                            <textarea type="text" id="alamat" name="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukan Alamat" required>Alamat</textarea>
                        </div> 
                        <div class="mb-6">
                            <label for="manager" class="block mb-2 text-sm font-medium text-gray-900">Manager</label>
                            <select id="manager" name="manager" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option selected value="">Pilih manager</option>
                                @foreach($data['user'] as $user)
                                <option value="{{ $user->id }}">{{ $user->nama }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="mb-6">
                            <label for="no_hp" class="block mb-2 text-sm font-medium text-gray-900">Nomor HP</label>
                            <input type="number" id="no_hp" name="no_hp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="6821XXXXX" required />
                        </div> 
                        <div class="mb-6">
                            <label for="foto_" class="block mb-2 text-sm font-medium text-gray-900">Foto Tim</label>
                            <input class="block w-full text-sm border border-gray-300 rounded-lg cursor-artikelnter bg-gray-50 text-gray-400 focus:outline-none placeholder-gray-400" aria-describedby="file_input_help" name="foto_tim" id="foto_tim" type="file" required>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="foto_tim">.PNG , .JPG, .JPEG</p>
                        </div> 
                        <div class="mb-6">
                            <label for="foto_" class="block mb-2 text-sm font-medium text-gray-900">Surat Tugas</label>
                            <input class="block w-full text-sm border border-gray-300 rounded-lg cursor-artikelnter bg-gray-50 text-gray-400 focus:outline-none placeholder-gray-400" aria-describedby="file_input_help" name="surat_tugas" id="surat_tugas" type="file" required>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="surat_tugas">.DOCX , .PDF</p>
                        </div> 
                        <button type="button" onclick="saveTim()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <table id="table" class="w-full text-sm text-left rtl:text-right text-gray-500 rounded-lg p-2 border-black divide-y">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Tim
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Asal Institusi
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Alamat
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Manager
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nomor HP
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Foto Tim
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Surat Tugas
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Dibuat
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4" aria-label="Table navigation">
            <span id="pagination-info" class="text-sm font-normal text-gray-500 mb-4 md:mb-0 block w-full md:inline md:w-auto"></span>
            <ul id="pagination" class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                <li>
                    <a href="#" onclick="previousPage()" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg">Previous</a>
                </li>
                <li>
                    <a href="#" onclick="nextPage()" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>

@endsection

@section('script')

<script>
    let currentPage = 1;
    let totalPages = 1;
    const itemsPerPage = 10;

    $(document).ready(function() {
        fetchData();
    });

    function fetchData() {
        const searchQuery = $('#search').val();
        $.ajax({
            url: '{{ route('tim')}}',
            type: 'GET',
            data: {
                page: currentPage,
                per_page: itemsPerPage,
                search: searchQuery
            },
            success: function(response) {
                console.log(response)
                populateTable(response.data);
                updatePagination(response);
            },
            error: function(error) {
                console.error('Error getting tim data:', error.responseText);
            }
        });
    }
    
    function previousPage() {
        if (currentPage > 1) {
            currentPage--;
            fetchData();
        }
    }

    function nextPage() {
        if (currentPage < totalPages) {
            currentPage++;
            fetchData();
        }
    }

    function updatePagination(data) {
        currentPage = data.current_page;
        totalPages = data.last_page;
        totalItems = data.total;
        let paginationHTML = '';
        paginationHTML += `<li><a href="#" onclick="previousPage()" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg">Previous</a></li>`;

        for (let i = 1; i <= totalPages; i++) {
            paginationHTML += `<li><a href="#" onclick="changePage(${i})" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 ${currentPage === i ? 'text-blue-600 bg-blue-50 hover:bg-blue-100 hover:text-blue-700' : ''}">${i}</a></li>`;
        }

        paginationHTML += `<li><a href="#" onclick="nextPage()" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg">Next</a></li>`;

        $('#pagination').html(paginationHTML);
        updatePaginationInfo();
    }

    function updatePaginationInfo() {
        $('#pagination-info').html(`Showing <span class="font-semibold text-gray-900">${(currentPage - 1) * itemsPerPage + 1}-${Math.min(currentPage * itemsPerPage, totalItems)}</span> of <span class="font-semibold text-gray-900">${totalItems}</span>`);
    }

    function changePage(page) {
        currentPage = page;
        fetchData();
    }

    $('#search').on('input', function() {
        fetchData();
    });

    function populateTable(response) {
        if (!response) {
            console.error('Invalid response format or missing tim data.');
            return;
        }

        var tableBody = $('#table tbody');
        tableBody.empty();

        if (!response.length) {
            console.warn('No categories found in the response.');
            return;
        }

        response.forEach(function(tim, index) {
            var created_at = tim.created_at;
            var date = new Date(created_at);
            var options = { timeZone: 'Asia/Jakarta', year: 'numeric', month: 'numeric', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric' };
            var formattedDate = date.toLocaleString('id-ID', options);
            
            var row = $('<tr>').addClass('bg-white border-b');
            row.append($('<td>').addClass('px-6 py-4').text(index + 1));
            row.append($('<td>').addClass('px-6 py-4').text(tim.nama_tim));
            row.append($('<td>').addClass('px-6 py-4').text(tim.asal_institusi));
            row.append($('<td>').addClass('px-6 py-4').text(tim.email));
            row.append($('<td>').addClass('px-6 py-4').text(tim.alamat));    
            row.append($('<td>').addClass('px-6 py-4').text(tim.user.nama));
            row.append($('<td>').addClass('px-6 py-4').text(tim.no_hp));
            row.append($('<td>').addClass('px-6 py-4').text(tim.foto_tim));
            row.append($('<td>').addClass('px-6 py-4').text(tim.surat_tugas));
            row.append($('<td>').addClass('px-6 py-4').text(formattedDate));  
            var editButton = $('<button>')
                .addClass('font-medium text-blue-600 hover:underline edit-button mr-2')
                .text('Edit')
                .attr('id', 'editButton_' + tim.id)
                .click(function() {
                    editTim(tim.id);
                });
            
            var deleteButton = $('<button>')
                .addClass('font-medium text-red-600 hover:underline delete-button mr-2')
                .text('Delete')
                .attr('id', 'deleteButton_' + tim.id)
                .click(function() {
                    deleteTim(tim.id);
                });
            
            var indexListAtletButton = $('<button>')
                .addClass('font-medium text-cyan-300 hover:underline indexListAtlet-button')
                .text('List Atlet & Official')
                .attr('id', 'indexListAtletButton_' + tim.id)
                .click(function() {
                    indexListAtlet(tim.id);
                });

            row.append($('<td>').addClass('px-6 py-4').append(editButton).append(deleteButton).append(indexListAtletButton));

            tableBody.append(row);
        });
    }

    function indexListAtlet(id) {
        var redirectUrl = `http://127.0.0.1:8000/tim/list/user/${id}`;
        window.location.href = redirectUrl;
    }

    function editTim(id) {
        $.ajax({
            url: `http://127.0.0.1:8000/tim/update/${id}`,
            type: 'GET',
            success: function(response) {
                $('#id').val(response.id);
                $('#nama_tim').val(response.nama_tim);
                $('#asal_institusi').val(response.asal_institusi);
                $('#email').val(response.email);
                $('#alamat').val(response.alamat);
                $('#manager').val(response.manager);
                $('#no_hp').val(response.no_hp);

                toggleModal();
            },
            error: function(error) {
                console.error('Error getting data:', error.responseText);
            }
        });
    }

    function deleteTim(id) {
        if (confirm('Apakah anda yakin ingin menghapus tim ini?')) {
            $.ajax({
                url: `http://127.0.0.1:8000/tim/delete/${id}`,
                type: 'GET',
                success: function(response) {
                    alert(response);
                    fetchData();
                },
                error: function(error) {
                    console.error('Error getting data:', error.responseText);
                }
            });
        }
    }

    function saveTim() {
        const formData = new FormData(document.getElementById("formTim"));
        const id = $('#id').val();
        const url = id ? `http://127.0.0.1:8000/tim/update/${id}` : '{{ route('tim') }}';

        const ajaxSettings = {
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response);
                fetchData();
                closeModal();
                $('#formTim')[0].reset();
                $('#passwordSection').show();
            },
            error: function(error) {
                console.error('Error saving data:', error.responseText);
            }
        };

        $.ajax(ajaxSettings);
    }

    function toggleModal() {
        var modal = document.getElementById("timModal");
        modal.classList.toggle("hidden");
    }

    function closeModal() {
        var modal = document.getElementById("timModal");
        modal.classList.add("hidden");
    }

    document.getElementById("openModalButton").addEventListener("click", toggleModal);
    document.getElementById("closeModalButton").addEventListener("click", closeModal);
    window.addEventListener("click", function(event) {
        var modal = document.getElementById("timModal");
        if (event.target == modal) {
            closeModal();
        }
    });
</script>
@endSection()