@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-8 col-md-10">
            <h2>Daftar Dokumen</h2>
            <a href="{{ route('documents.create') }}" class="btn btn-primary mb-3">Tambah Dokumen</a>
            @if (session('addDataSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <p>{{ session('addDataSuccess') }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('editDataSuccess'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <p>{{ session('editDataSuccess') }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($documents->count() > 0)
                        @foreach ($documents as $document)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $document->title }}</td>
                                <td>{{ $document->description }}</td>
                                <td><a href="{{ asset('storage/' . $document->file_path) }}" target="_blank">Lihat File</a></td>
                                <td>
                                    <a href="{{ route('documents.show', $document->id) }}" class="btn btn-info">Lihat</a>
                                    <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('documents.destroy', $document->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data dokumen.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            {{ $documents->links() }}
        </div>
    </div>
@endsection
