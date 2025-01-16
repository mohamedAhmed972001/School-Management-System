<?php
namespace App\Traits;

use App\Models\Image;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


trait ModelHandler
{
    protected $model;


    public function setModel(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(Request $request)
    {
        try {
            $models = $this->model::paginate();
            return response()->json([
                'results' => $models->total(),  // عدد النتائج الإجمالي
                'data' => $models->items(),     // البيانات التي تم جلبها في الصفحة الحالية
                'total' => $models->total(),    // إجمالي السجلات
                'pagination' => [
                    'current_page' => $models->currentPage(),
                    'last_page' => $models->lastPage(),
                    'per_page' => $models->perPage(),
                    'total' => $models->total(),
                ],
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while retrieving the models.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getOne($id)
    {
        try {
            $model = $this->model::find($id);
            if (!$model) {
                return response()->json([
                    'message' => "Model with ID {$id} not found."
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'data' => $model
            ], Response::HTTP_OK);

        } catch (\Exception $e) {

            return response()->json([
                'message' => 'An error occurred while retrieving the model.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function createOne(array $data, array $translatableColumns)
    {
        try {
            $newModel = new $this->model();

            foreach ($translatableColumns as $column) {
                if (isset($data[$column]) && is_array($data[$column])) {
                    $newModel->setTranslations($column, $data[$column]);
                }
            }

            foreach ($data as $column => $value) {
                if (!in_array($column, $translatableColumns)) {
                    $newModel->$column = $value;
                }
            }

            $newModel->save();

            return response()->json(['message' => 'Grade created successfully', 'grade' => $newModel], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while creating the grade.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateOne(array $data, array $translatableColumns, $id)
    {
        try {
            $newModel = $this->model::findOrFail($id);  // `findOrFail` ستعيد الخطأ 404 إذا لم يتم العثور على السجل.

            foreach ($translatableColumns as $column) {
                if (isset($data[$column]) && is_array($data[$column])) {
                    $newModel->setTranslations($column, $data[$column]);
                }
            }

            foreach ($data as $column => $value) {
                if (!in_array($column, $translatableColumns)) {
                    $newModel->$column = $value;
                }
            }

            $newModel->save();

            return response()->json(['message' => 'Grade updated successfully', 'grade' => $newModel], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating the grade.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function deleteOne($id)
    {
        try {
            $model = $this->model::find($id);
            if (!$model) {
                return response()->json([
                    'message' => "Model with ID {$id} not found."
                ], Response::HTTP_NOT_FOUND);
            }
            $model->delete();
            return response()->json([
                'message' => 'Model deleted successfully.'
            ], Response::HTTP_NO_CONTENT);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while deleting the model.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function getRelatedRecordsByParent($relation, $id)
    {
        try {
            $parentModel = $this->model::with($relation)->findOrFail($id);

            $relatedItems = $parentModel->$relation;

            if ($relatedItems instanceof \Illuminate\Support\Collection || is_array($relatedItems)) {
                if ($relatedItems->isEmpty()) {
                    return response()->json([
                        'status' => false,
                        'message' => 'No related records found.',
                    ], Response::HTTP_NOT_FOUND);
                }

                return response()->json([
                    'status' => true,
                    'num_of_items' => $relatedItems->count(),
                    'items' => $relatedItems,
                ], Response::HTTP_OK);
            }

            // Handle single related item (hasOne, belongsTo)
            return response()->json([
                'status' => true,
                'item' => $relatedItems,
            ], Response::HTTP_OK);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Parent model not found.',
                'error' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * Get the parent record for a specific child model.
     * @param int $childId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getParentRecordByChild($relation, $childId)
    {
        try {
            $childRecord = $this->model::with($relation)->findOrFail($childId);

            $parentRecord = $childRecord->$relation;

            if (!$parentRecord) {
                return response()->json([
                    'status' => false,
                    'message' => 'Parent record not found.',
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'status' => true,
                'item' => $parentRecord,
            ], Response::HTTP_OK);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Child record not found.',
            ], Response::HTTP_NOT_FOUND);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(), // عرض رسالة الخطأ
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



    public function uploadFile(Request $request, $parentId)
    {
        // Validate file input
        if (!$request->hasFile('filename') || !$request->file('filename')->isValid()) {
            throw new \Exception('Invalid file or no file uploaded.');
        }

        $file = $request->file('filename');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $folder = 'attachments/' . class_basename($this->model) . '/' . $parentId;


        // Store the file in the public disk
        Storage::disk('public')->putFileAs($folder, $file, $fileName);

        return $fileName;  // Returning the file name
    }

    public function addImagetomodel(Request $request,$id)
    {
        DB::beginTransaction();

        try{
            $fileName = $this->uploadFile($request, $id);
            $student = Student::findOrFail($id);
            $image = new Image();
            $image->filename = $fileName;
            $image->imageable_id = $id;
            $image->imageable_type = $this->model::class; // تعيين النوع polymorphic
            $image->save();

            $student->images()->save($image);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Image added successfully!',
                'image' => $image
            ]);


        } catch (\Exception $e) {
            DB::rollBack();
            // التعامل مع الأخطاء
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while adding the image.',
                'error' => $e->getMessage()
            ], 500);
        }


    }

    public function updateImageInModel(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // البحث عن الصورة المرتبطة بالنموذج
            $image = Image::where('imageable_id', $id)
                ->where('imageable_type', Student::class)
                ->firstOrFail();

            // حذف الصورة القديمة من التخزين
            $oldFilePath = 'attachments/' . class_basename($this->model) . '/' . $id . '/' . $image->filename;
            if (Storage::disk('public')->exists($oldFilePath)) {
                Storage::disk('public')->delete($oldFilePath);
            }

            // رفع الصورة الجديدة باستخدام دالة uploadFile
            $fileName = $this->uploadFile($request, $id);

            // تحديث اسم الملف في قاعدة البيانات
            $image->filename = $fileName;
            $image->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Image updated successfully!',
                'image' => $image
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while updating the image.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteImageFromModel($id)
    {
        DB::beginTransaction();

        try {
            // العثور على الصورة المرتبطة بالنموذج
            $image = Image::where('imageable_id', $id)
                ->where('imageable_type', $this->model::class)
                ->firstOrFail();

            // حذف الصورة من التخزين
            $filePath = 'attachments/' . class_basename($this->model) . '/' . $id . '/' . $image->filename;
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            // حذف السجل من قاعدة البيانات
            $image->delete();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Image deleted successfully!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while deleting the image.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * @desc    Get all images for a student
     * @route   GET /api/v1/students/{studentId}/images
     * @access  Private/Admin
     */
    public function getImagesForModel($id)
    {
        try {
            $model = $this->model::findOrFail($id);

            // جلب جميع الصور المرتبطة بالطالب
            $images = $model->images()->get();

            return response()->json([
                'status' => true,
                'message' => 'Images retrieved successfully!',
                'images' => $images
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while retrieving images.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @desc    Download a specific image for a given model
     * @route   GET /api/v1/{id}/images/{imageId}/download
     * @access  Private/Admin
     */
    public function downloadImageForModel($id, $imageId)
    {
        try {
            $model = $this->model::findOrFail($id);

            // البحث عن الصورة المرتبطة بالموديل باستخدام العلاقة polymorphic
            $image = $model->images()->findOrFail($imageId);

            // مسار الصورة في التخزين
            $folder = 'attachments/' . class_basename($this->model) . '/' . $id;
            $filePath = $folder . '/' . $image->filename;

            // التحقق من وجود الملف في التخزين
            if (!Storage::disk('public')->exists($filePath)) {
                throw new \Exception('Image not found.');
            }

            // تحميل الصورة باستخدام Storage::download
            return Storage::disk('public')->download($filePath, $image->filename);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while downloading the image.',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    protected function checkIfExists($column, $data)
    {
        return $this->model::whereJsonContains("{$column}->en", $data['en'])
            ->orWhereJsonContains("{$column}->ar", $data['ar'])
            ->exists();
    }

}


