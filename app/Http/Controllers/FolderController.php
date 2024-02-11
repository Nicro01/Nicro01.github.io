<?php

namespace App\Http\Controllers;

use App\Models\FolderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class FolderController extends Controller
{
    public function getFolders($folder_id)
    {
        $folders = FolderModel::join('folder_folder_pivot', 'folder_models.id', '=', 'folder_folder_pivot.folder_id')
            ->join('folder_models as parent', 'folder_folder_pivot.parent_id', '=', 'parent.id')
            ->select('folder_models.*')
            ->where('folder_folder_pivot.parent_id', $folder_id)
            ->get();

        $currentFolder = FolderModel::find($folder_id);

        return response()->json(['folders' => $folders, 'currentFolder' => $currentFolder]);
    }

    public function uploadToFolder($folder_id)
    {
        $folder = FolderModel::find($folder_id);

        return Inertia::render('Upload', ['current_folder' => $folder]);
    }
}
