<?php

namespace App\Http\Controllers\Backend;

use App\Enums\Message;
use App\Helper\Helper;
use App\Helper\Toastr;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Services\DocumentService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {

        try {
            $this->authorize('company_document_view', Document::class);
            $documents = DocumentService::getAll()->sortBy('title');
            return view('backend.pages.documents.index', compact('documents'));
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }
    public function create()
    {

        try {
            $this->authorize('company_document_create', Document::class);
            return view('backend.pages.documents.create');
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function edit(Document $document)
    {


        try {
            $this->authorize('company_document_edit', $document);
            return view('backend.pages.documents.edit', compact('document'));
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function delete(Document $document)
    {
        try {
            $this->authorize('company_document_delete', $document);
            if (!$document) :
                Toastr::error(Message::NOT_FOUND);
                return back();
            endif;
            if ($document->data) :
                Helper::deleteOldImage($document->data);
            endif;
            $document->delete($document);
            Toastr::success(Message::DELETED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function viewFile(Document $document)
    {


        return response()->file(storage_path('app/public/'.$document->data));
    }
}
