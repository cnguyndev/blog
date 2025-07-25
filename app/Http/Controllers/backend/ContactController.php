<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::with('updater') // Eager load updater
            ->where('deleted_at', null)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $trashCount = Contact::onlyTrashed()->count();

        return view('backend.contact.index', compact('contacts', 'trashCount'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        // Có thể đánh dấu đã xem khi hiển thị
        if ($contact->status == 1) { // Nếu trạng thái là 'Mới'
            $contact->status = 2; // Đánh dấu là 'Đã xem'
            $contact->save(); // Tự động cập nhật updated_by
        }
        $contact->load('creator', 'updater'); // Eager load creator và updater
        return view('backend.contact.show', compact('contact'));
    }

    /**
     * Update the specified resource in storage (for status change).
     */
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'status' => 'required|integer|in:1,2,3,4', // Tùy thuộc vào các giá trị trạng thái bạn định nghĩa
        ]);

        $contact->status = $request->status;
        $contact->save(); // Tự động cập nhật updated_by

        return redirect()->back()->with('success', 'Cập nhật trạng thái liên hệ thành công!');
    }


    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy(Contact $contact)
    {
        $contact->delete(); // Soft delete

        return redirect()->route('admin.contacts.index')->with('success', 'Xóa liên hệ thành công (đã chuyển vào thùng rác)!');
    }

    /**
     * Display a listing of trashed resources.
     */
    public function trash()
    {
        $trashedContacts = Contact::onlyTrashed()->with(['updater'])->paginate(10);
        return view('backend.contact.trash', compact('trashedContacts'));
    }

    /**
     * Restore the specified soft-deleted resource.
     */
    public function restore($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->restore();

        return redirect()->route('admin.contacts.trash')->with('success', 'Khôi phục liên hệ thành công!');
    }

    /**
     * Permanently remove the specified resource from storage.
     */
    public function forceDelete($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->forceDelete(); // Xóa vĩnh viễn

        return redirect()->route('admin.contacts.trash')->with('success', 'Xóa vĩnh viễn liên hệ thành công!');
    }

    /**
     * Permanently remove all trashed resources from storage.
     */
    public function forceDeleteAll()
    {
        Contact::onlyTrashed()->forceDelete(); // Xóa vĩnh viễn tất cả

        return redirect()->route('admin.contacts.trash')->with('success', 'Đã xóa vĩnh viễn tất cả liên hệ trong thùng rác!');
    }
}
