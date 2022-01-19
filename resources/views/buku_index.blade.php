@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <h3> Library </h3>
                    <a href="{{ url('admin/buku/tambah', []) }}" class="btn btn-primary btn-sm">Tambah</a>
                    
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Pengarang</th>
                                    <th>Created</th>
                                    <th>Last Updated</th>


                                    <th>Ubah</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($utama as $item)
                                <tr>
                                    <td>{{  $loop->iteration }}</td>
                                    <td>{{  $item->judul }}</td>
                                    <td>{{  $item->pengarang }}</td>
                                    <td>{{  $item->created_at }}</td>
                                    <td>{{  $item->updated_at }}</td>

                                    <td>
                                        <a href="{{ url('admin/buku/edit/'. $item->id, []) }}" class="btn 
                                            btn-info btn-sm">
                                            Edit</a>
                                            <a href="{{ url('admin/buku/hapus/'. $item->id, []) }}" class="btn 
                                                btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
