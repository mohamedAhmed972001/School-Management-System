<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ParentAttachment;
use App\Models\MyParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ParentAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attachments = ParentAttachment::all(); // عرض جميع المرفقات
        return response()->json($attachments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function uploadAttachment(Request $request)
    {
       // $validatedData = $request->validated();
        // التحقق من وجود Parent_id
        $parent = MyParent::find($request->Parent_id);
        if (!$parent) {
            return response()->json(['message' => 'Parent not found.'], 404);
        }

        // التحقق من وجود الملف في الطلب
        if (!$request->hasFile('File_name')) {
            return response()->json([
                'message' => 'Attachment not found.',
                'error_code' => 'ATTACHMENT_NOT_FOUND',
                'details' => 'The file was not provided in the request.'
            ], 400);
        }

        // رفع الملف
        $file = $request->file('File_name');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $folder = 'attachments/' . $request->Parent_id;
        $file->move(public_path($folder), $fileName);

        // حفظ بيانات المرفق في قاعدة البيانات
        $attachment = ParentAttachment::create([
            'File_name' => $fileName,
            'Parent_id' => $request->Parent_id,
        ]);

        return response()->json(['message' => 'Attachment uploaded successfully.', 'data' => $attachment]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $attachment = ParentAttachment::find($id); // العثور على المرفق بناءً على الـ ID
        if (!$attachment) {
            return response()->json(['message' => 'Attachment not found.'], 404);
        }
        return response()->json($attachment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $attachment = ParentAttachment::find($id); // العثور على المرفق بناءً على الـ ID
        if (!$attachment) {
            return response()->json(['message' => 'Attachment not found.'], 404);
        }

        // حذف المرفق من الـ storage
        $filePath = public_path('attachments/' . $attachment->Parent_id . '/' . $attachment->File_name);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // حذف المرفق من قاعدة البيانات
        $attachment->delete();

        return response()->json(['message' => 'Attachment deleted successfully.']);
    }
}
