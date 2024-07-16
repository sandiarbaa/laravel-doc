{{-- @extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-8 col-md-10">
            <h2>Detail Dokumen</h2>

            <div class="form-group mb-3">
                <label for="title">Judul</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $document->title }}" readonly>
            </div>

            <div class="form-group mb-3">
                <label for="description">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" readonly>{{ $document->description }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="file_path">File</label>
                <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="form-control">Lihat File</a>
            </div>

            <a href="{{ route('documents.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection --}}


@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-8 col-md-10">
            <h2 class="mb-4">Detail Dokumen</h2>

            <div class="form-group mb-3">
                <label for="title">Judul</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $document->title }}" readonly>
            </div>

            <div class="form-group mb-3">
                <label for="description">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="4" readonly>{{ $document->description }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="file_path">File</label>
                <div>
                    <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="btn btn-primary">Lihat File</a>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('documents.index') }}" class="btn btn-secondary">Kembali</a>
                @can('update', $document)
                    <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-warning">Edit</a>
                @endcan
                @can('delete', $document)
                    <form action="{{ route('documents.destroy', $document->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">Hapus</button>
                    </form>
                @endcan
            </div>
        </div>
    </div>
@endsection
