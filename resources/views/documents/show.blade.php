@extends('layouts.app')

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
@endsection
