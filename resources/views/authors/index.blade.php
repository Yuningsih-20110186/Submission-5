<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')
</head>
<body>
    <h2>Data Penulis Buku</h2>
    <br>

    @if (session('status'))
        <h4>{{session('status')}}</h4>
    @endif

    <br>
    <form name="book-save-form" id="book-save-form" action="{{url('/authors/save-authors')}}" method="post">
        @csrf
        <table>
            <tr>
                <td>ID Penulis</td>
                <td>:</td>
                <td><input type="text" name="id_penulis" id="id-penulis" readonly></td>
            </tr>
            <tr>
                <td>Nama Penulis</td>
                <td>:</td>
                <td><input type="text" name="nama_penulis" id="nama-penulis"></td>

            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">Save</button>
                </td>
            </tr>
        </table>
    </form>
    <br>
    <table>
        <tr>
            <th>No.</th>
            <th>ID Penulis</th>
            <th>Nama Penulis</th>
        </tr>
        @php($num = 1)
        @foreach ($data as $b)
        <tr class="row-data">
            <td>{{ $num++ }}</td>
            <td>{{ $b['id_penulis'] }}</td>
            <td>{{ $b['nama_penulis'] }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
