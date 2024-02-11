<?php

namespace App\Http\Controllers;

use App\Models\FileModel;
use App\Models\FolderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class FileController extends Controller
{
    public function getFiles($folder_id)
    {
        $files = FolderModel::join('folder_file_pivot', 'folder_models.id', '=', 'folder_file_pivot.folder_id')
            ->join('file_models', 'folder_file_pivot.file_id', '=', 'file_models.id')
            ->select('file_models.*')
            ->where('folder_file_pivot.folder_id', $folder_id)
            ->get();

        return response()->json($files);
    }

    public function uploadFile($folder_id, Request $request)
    {
        $request->validate([
            'file' => 'required|max:2048',
        ]);

        $fileName =  $request->name . '.' . $request->file->getClientOriginalExtension();

        $request->file->move(public_path('uploads'), $fileName);

        $fileModel = new FileModel();
        $fileModel->name = $request->name;
        $fileModel->path = 'uploads/' . $fileName;
        $fileModel->extension = $request->file->getClientOriginalExtension();
        $fileModel->save();

        DB::table('folder_file_pivot')->insert([
            'folder_id' => $folder_id,
            'file_id' => $fileModel->id,
        ]);

        return response()->json(['success' => 'You have successfully upload file.']);
    }

    public function showFile($file_id)
    {
        $file = FileModel::find($file_id);
        $fileContent = file_get_contents($file->path);
        return Inertia::render('EditFile', ['file' => $file, 'fileContent' => $fileContent]);
    }

    public function edit($file_id, Request $request)
    {

        $file = FileModel::find($file_id);
        $file->updated_at = now();
        $file->save();
        file_put_contents($file->path, $request->content);
        return response()->json(['success' => 'You have successfully edit file.']);
    }

    public function delete($file_id)
    {
        DB::table('folder_file_pivot')->where('file_id', $file_id)->delete();

        $file = FileModel::find($file_id);

        unlink($file->path);

        $file->delete();

        return response()->json(['success' => 'You have successfully delete file.']);
    }
}
