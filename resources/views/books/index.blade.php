<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')
</head>
<body>
    <h2>Data Buku Perpustakaan</h2>
    <br>

    @if (session('status'))
        <h4>{{session('status')}}</h4>
    @endif

    <br>
    <form name="book-save-form" id="book-save-form" action="{{url('/books/save-book')}}" method="post">
        @csrf
        <table>
            <tr>
                <td>ID</td>
                <td>:</td>
                <td><input type="text" name="id" id="id" readonly></td>

            </tr>
            <tr>
                <td>Nama Buku</td>
                <td>:</td>
                <td><input type="text" name="nama_buku" id="nama-buku"></td>

            </tr>
            <tr>
                <td>Penulis</td>
                <td>:</td>
                {{-- <td><input type="text" name="author" id="author"></td> --}}
                <td>
                    <select name="id_penulis" id="penulis">
                        <option value="">-- Pilih Penulis --</option>
                        @foreach ($dataAuthor as $a)
                        <option value="{{ $a['id_penulis'] }}">{{ $a['nama_penulis'] }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>Penerbit</td>
                <td>:</td>
                <td><input type="text" name="nama_penerbit" id="nama-penerbit"></td>

            </tr>
            <tr>
                <td>Tahun Terbit</td>
                <td>:</td>
                <td><input type="text" name="tahun_terbit" id="tahun-terbit"></td>

            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">Save</button>
                    <button type="button" id="button-reset">Reset</button>
                </td>
            </tr>
        </table>
    </form>
    <br>
    <table>
        <tr>
            <th>No.</th>
            <th>ID</th>
            <th>Nama Buku</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun Terbit</th>
            <th>Tanggal publikasi</th>
            <th colspan="2">Aksi</th>
        </tr>
        @php($num = 1)
        @foreach ($data as $b)
        <tr class="row-data">
            <td>{{ $num++ }}</td>
            <td>{{ $b['id'] }}</td>
            <td>{{ $b['nama_buku'] }}</td>
            <td>{{ $b['nama_penulis'] }}</td>
            <td>{{ $b['nama_penerbit'] }}</td>
            <td>{{ $b['tahun_terbit'] }}</td>
            <td>{{ $b['published_at'] }}</td>
            <td>
                <button id="button-edit" class="button-edit"
                    data-id="{{ $b['id'] }}"
                    data-nama="{{ $b['nama_buku'] }}"
                    data-penulis="{{ $b['id_penulis'] }}"
                    data-penerbit="{{ $b['nama_penerbit'] }}"
                    data-tahun="{{ $b['tahun_terbit'] }}">Edit</button>
            </td>
            <td>
                <form action="{{ url('/books/delete-book?id=').$b['id'] }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    <script>
        var button = $('.button-edit');

        $(document).ready(function() {
            clearForm();
        });

        button.each(function(index) {
            $(this).on('click', function(){
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                var penulis = $(this).data('penulis');
                var penerbit = $(this).data('penerbit');
                var tahun = $(this).data('tahun');

                $('#id').val(id);
                $('#nama-buku').val(nama);
                $('#penulis').val(penulis);
                $('#nama-penerbit').val(penerbit);
                $('#tahun-terbit').val(tahun);
            });
        });

        $('#button-reset').on('click', function () {
            clearForm();
        });

        function clearForm(){
            $('#id').val('');
            $('#nama-buku').val('');
            $('#penulis').val('');
            $('#nama-penerbit').val('');
            $('#tahun-terbit').val('');
        }
    </script>
</body>
</html>
