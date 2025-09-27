<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with('documentCategory')->latest()->paginate(10);
        return Inertia::render('documents/index', [
            'documents' => $documents
        ]);
    }
}