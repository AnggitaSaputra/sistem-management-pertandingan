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
        <div id="kelasModal" class="modal hidden fixed inset-0 z-50 overflow-auto bg-gray-500 bg-opacity-50 flex justify-center items-center">
            <div class="modal-content bg-white w-1/2 p-4 rounded-lg">
                <div class="flex justify-between">
                    <h2 class="text-xl font-bold">Tambah {{$data['title'] }}</h2>
                    <button id="closeModalButton" class="text-red-500 hover:text-red-700">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="formKelas">
                        @csrf
                        <div class="mb-6">
                            <label for="nama_kelas" class="block mb-2 text-sm font-medium text-gray-900">Nama Kelas</label>
                            <input type="text" id="nama_kelas" name="nama_kelas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukan Nama Kelas" required />
                            <input type="id" id="id" name="id" hidden>
                        </div> 
                        <div class="mb-6">
                            <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900">Kategori</label>
                            <select id="kategori" name="kategori" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option selected value="">Pilih kelas</option>
                                @foreach($data['kategori'] as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="mb-6">
                            <label for="bb" class="block mb-2 text-sm font-medium text-gray-900">Berat Badan</label>
                            <input type="number" id="bb" name="bb" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukan Berat Badan" required />
                        </div> 
                        <button type="button" onclick="saveKelas()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
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
                        Nama Kelas
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Kategori
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Berat Badan
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
            url: '{{ route('kelas')}}',
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
                console.error('Error getting kelas data:', error.responseText);
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
            console.error('Invalid response format or missing kelas data.');
            return;
        }

        var tableBody = $('#table tbody');
        tableBody.empty();

        if (!response.length) {
            console.warn('No categories found in the response.');
            return;
        }

        response.forEach(function(kelas, index) {
            var created_at = kelas.created_at;
            var date = new Date(created_at);
            var options = { timeZone: 'Asia/Jakarta', year: 'numeric', month: 'numeric', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric' };
            var formattedDate = date.toLocaleString('id-ID', options);
            
            var row = $('<tr>').addClass('bg-white border-b');
            row.append($('<td>').addClass('px-6 py-4').text(index + 1));
            row.append($('<td>').addClass('px-6 py-4').text(kelas.nama_kelas));
            row.append($('<td>').addClass('px-6 py-4').text(kelas.kategori.nama_kategori));
            row.append($('<td>').addClass('px-6 py-4').text(kelas.bb));
            row.append($('<td>').addClass('px-6 py-4').text(formattedDate));  
            var editButton = $('<button>')
                .addClass('font-medium text-blue-600 hover:underline edit-button mr-2')
                .text('Edit')
                .attr('id', 'editButton_' + kelas.id)
                .click(function() {
                    editKelas(kelas.id);
                });
            
            var deleteButton = $('<button>')
                .addClass('font-medium text-red-600 hover:underline delete-button mr-2')
                .text('Delete')
                .attr('id', 'deleteButton_' + kelas.id)
                .click(function() {
                    deleteKelas(kelas.id);
                });
            
            var indexListAtletButton = $('<button>')
                .addClass('font-medium text-cyan-300 hover:underline indexListAtlet-button')
                .text('List Atlet')
                .attr('id', 'indexListAtletButton_' + kelas.id)
                .click(function() {
                    indexListAtlet(kelas.id);
                });

            row.append($('<td>').addClass('px-6 py-4').append(editButton).append(deleteButton).append(indexListAtletButton));

            tableBody.append(row);
        });
    }

    function indexListAtlet(id) {
        var redirectUrl = `http://127.0.0.1:8000/kelas/list/user/${id}`;
        window.location.href = redirectUrl;
    }

    function editKelas(id) {
        $.ajax({
            url: `http://127.0.0.1:8000/kelas/update/${id}`,
            type: 'GET',
            success: function(response) {
                $('#id').val(response.id);
                $('#nama_kelas').val(response.nama_kelas);
                $('#kategori').val(response.kategori.id);
                $('#bb').val(response.bb);
                toggleModal();
            },
            error: function(error) {
                console.error('Error getting data:', error.responseText);
            }
        });
    }

    function deleteKelas(id) {
        if (confirm('Apakah anda yakin ingin menghapus kelas ini?')) {
            $.ajax({
                url: `http://127.0.0.1:8000/kelas/delete/${id}`,
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

    function saveKelas() {
        const formData = new FormData(document.getElementById("formKelas"));
        const id = $('#id').val();
        const url = id ? `http://127.0.0.1:8000/kelas/update/${id}` : '{{ route('kelas') }}';

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
                $('#formKelas')[0].reset();
                $('#passwordSection').show();
            },
            error: function(error) {
                console.error('Error saving data:', error.responseText);
            }
        };

        $.ajax(ajaxSettings);
    }

    function toggleModal() {
        var modal = document.getElementById("kelasModal");
        modal.classList.toggle("hidden");
    }

    function closeModal() {
        var modal = document.getElementById("kelasModal");
        modal.classList.add("hidden");
    }

    document.getElementById("openModalButton").addEventListener("click", toggleModal);
    document.getElementById("closeModalButton").addEventListener("click", closeModal);
    window.addEventListener("click", function(event) {
        var modal = document.getElementById("kelasModal");
        if (event.target == modal) {
            closeModal();
        }
    });
</script>
@endSection()