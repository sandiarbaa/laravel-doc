<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::where('user_id', Auth::id())->paginate(3);
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        return view('documents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'file_path' => 'required|file|mimes:pdf,doc,docx,xls,xlsx'
        ]);

        $filePath = $request->file('file_path')->store('documents', 'public');

        Document::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
        ]);

        return redirect()->route('documents.index')->with('addDataSuccess', 'Dokumen berhasil ditambahkan.');
    }

    public function show(Document $document)
    {
        //$this->authorize('view', $document);
        return view('documents.show', compact('document'));
    }

    public function edit(Document $document)
    {
        //$this->authorize('update', $document);
        return view('documents.edit', compact('document'));
    }

    public function update(Request $request, Document $document)
    {
        //$this->authorize('update', $document);

        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx'
        ]);

        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('documents', 'public');
            $document->file_path = $filePath;
        }

        $document->title = $request->title;
        $document->description = $request->description;
        $document->save();

        return redirect()->route('documents.index')->with('editDataSuccess', 'Dokumen berhasil diperbarui.');
    }

    public function destroy(Document $document)
    {
        //$this->authorize('delete', $document);
        $document->delete();
        return redirect()->route('documents.index')->with('success', 'Dokumen berhasil dihapus.');
    }
}
