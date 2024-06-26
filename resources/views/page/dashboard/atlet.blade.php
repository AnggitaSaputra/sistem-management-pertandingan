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
        <div id="atletModal" class="modal hidden fixed inset-0 z-50 overflow-auto bg-gray-500 bg-opacity-50 flex justify-center items-center">
            <div class="modal-content bg-white w-1/2 p-4 rounded-lg">
                <div class="flex justify-between">
                    <h2 class="text-xl font-bold">Tambah {{$data['title'] }}</h2>
                    <button id="closeModalButton" class="text-red-500 hover:text-red-700">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="formAtlet" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-6">
                            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama Atlet</label>
                            <input type="text" id="nama" name="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukan Nama" required />
                            <input type="id" id="id" name="id" hidden>
                        </div> 
                        <div class="mb-6">
                            <label for="ttl" class="block mb-2 text-sm font-medium text-gray-900">Tempat Tanggal Lahir</label>
                            <input type="date" id="ttl" name="ttl" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukan TTL" required />
                        </div> 
                        <div class="mb-6">
                            <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900">Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option selected value="">Pilih jenis kelamin</option>
                                <option value="perempuan">Perempuan</option>
                                <option value="laki-laki">Laki-Laki</option>
                            </select>
                        </div> 
                        <div class="mb-6">
                            <label for="berat_badan" class="block mb-2 text-sm font-medium text-gray-900">Berat Badan</label>
                            <input type="number" id="berat_badan" name="berat_badan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukan Berat Badan" required>
                        </div> 
                        <div class="mb-6">  
                            <label class="block mb-2 text-sm font-medium text-gray-900">Foto Diri</label>
                            <input class="block w-full text-sm border border-gray-300 rounded-lg cursor-artikelnter bg-gray-50 text-gray-400 focus:outline-none placeholder-gray-400" aria-describedby="file_input_help" name="foto" id="foto" type="file" required>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="foto_atlet">.PNG , .JPG, .JPEG</p>
                        </div> 
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900">Foto KTP</label>
                            <input class="block w-full text-sm border border-gray-300 rounded-lg cursor-artikelnter bg-gray-50 text-gray-400 focus:outline-none placeholder-gray-400" aria-describedby="file_input_help" name="foto_ktp" id="foto_ktp" type="file" required>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="foto_atlet">.PNG , .JPG, .JPEG</p>
                        </div> 
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900">Ijazah Terakhir Karate</label>
                            <input class="block w-full text-sm border border-gray-300 rounded-lg cursor-artikelnter bg-gray-50 text-gray-400 focus:outline-none placeholder-gray-400" aria-describedby="file_input_help" name="ijazah_karate" id="ijazah_karate" type="file" required>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="surat_tugas">.PNG , .JPG, .JPEG, .PDF</p>
                        </div> 
                        <button type="button" onclick="saveAtlet()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
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
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tempat Tanggal lahir
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jenis Kelamin
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Berat Badan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Foto Diri
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Foto KTP
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ijazah Karate
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
            url: '{{ route('atlet')}}',
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
                console.error('Error getting atlet data:', error.responseText);
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
            console.error('Invalid response format or missing atlet data.');
            return;
        }

        var tableBody = $('#table tbody');
        tableBody.empty();

        if (!response.length) {
            console.warn('No categories found in the response.');
            return;
        }

        response.forEach(function(atlet, index) {
            var created_at = atlet.created_at;
            var date = new Date(created_at);
            var options = { atleteZone: 'Asia/Jakarta', year: 'numeric', month: 'numeric', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric' };
            var formattedDate = date.toLocaleString('id-ID', options);
            
            var row = $('<tr>').addClass('bg-white border-b');
            row.append($('<td>').addClass('px-6 py-4').text(index + 1));
            row.append($('<td>').addClass('px-6 py-4').text(atlet.nama));
            row.append($('<td>').addClass('px-6 py-4').text(atlet.ttl));
            row.append($('<td>').addClass('px-6 py-4').text(atlet.jenis_kelamin));
            row.append($('<td>').addClass('px-6 py-4').text(atlet.berat_badan));    
            row.append($('<td>').addClass('px-6 py-4').text(atlet.foto));
            row.append($('<td>').addClass('px-6 py-4').text(atlet.foto_ktp));
            row.append($('<td>').addClass('px-6 py-4').text(atlet.ijazah_karate));
            row.append($('<td>').addClass('px-6 py-4').text(formattedDate));  
            var editButton = $('<button>')
                .addClass('text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800')
                .text('Edit')
                .attr('id', 'editButton_' + atlet.id)
                .click(function() {
                    editAtlet(atlet.id);
                });
            
            var deleteButton = $('<button>')
                .addClass('focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-xs px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900')
                .text('Delete')
                .attr('id', 'deleteButton_' + atlet.id)
                .click(function() {
                    deleteAtlet(atlet.id);
                });
            
            row.append($('<td>').addClass('px-6 py-4').append(editButton).append(deleteButton));

            tableBody.append(row);
        });
    }

    function editAtlet(id) {
        $.ajax({
            url: `http://127.0.0.1:8000/atlet/update/${id}`,
            type: 'GET',
            success: function(response) {
                $('#id').val(response.id);
                $('#nama').val(response.nama);
                $('#ttl').val(response.ttl);
                $('#jenis_kelamin').val(response.jenis_kelamin);
                $('#berat_badan').val(response.berat_badan);

                toggleModal();
            },
            error: function(error) {
                console.error('Error getting data:', error.responseText);
            }
        });
    }

    function deleteAtlet(id) {
        if (confirm('Apakah anda yakin ingin menghapus atlet ini?')) {
            $.ajax({
                url: `http://127.0.0.1:8000/atlet/delete/${id}`,
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

    function saveAtlet() {
        const formData = new FormData(document.getElementById("formAtlet"));
        const id = $('#id').val();
        const url = id ? `http://127.0.0.1:8000/atlet/update/${id}` : '{{ route('atlet') }}';

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
                $('#formAtlet')[0].reset();
                $('#passwordSection').show();
            },
            error: function(error) {
                console.error('Error saving data:', error.responseText);
            }
        };

        $.ajax(ajaxSettings);
    }

    function toggleModal() {
        var modal = document.getElementById("atletModal");
        modal.classList.toggle("hidden");
    }

    function closeModal() {
        var modal = document.getElementById("atletModal");
        modal.classList.add("hidden");
    }

    document.getElementById("openModalButton").addEventListener("click", toggleModal);
    document.getElementById("closeModalButton").addEventListener("click", closeModal);
    window.addEventListener("click", function(event) {
        var modal = document.getElementById("atletModal");
        if (event.target == modal) {
            closeModal();
        }
    });
</script>
@endSection()