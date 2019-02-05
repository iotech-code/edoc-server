<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cabinet ;
use App\Models\Folder ;

trait CabinetFolderTrait {

    public function indexFolder($cabinet_id) {
        $cabinet = Cabinet::find($cabinet_id);
        $folders = $cabinet->folders()->paginate(15);
        return view("cabinets.folders.index")
        ->with(compact([
            'folders',
            'cabinet',
            'breadscrumb'
        ]));
    }

    public function storeFolder(Cabinet $cabinet, Request $request) {
        // return $request->all();
        $cabinet->folders()->create($request->except(['_token']));
        return redirect()->route("cabinet.folder.index", $cabinet->id)
            ->withSuccess("ทำรายการสำเร็จ");
    }

    public function createFolder($cabinet_id) {
        $cabinet = Cabinet::find($cabinet_id);
        return view("cabinets.folders.create", compact([
            'cabinet'
        ]));
    }

    public function editFolder($folder_id) {
        $folder = Folder::findOrfail($folder_id);
        return view("cabinets.folders.edit", compact([
            'folder'
        ]));
    }

    public function updateFolder($folder_id, Request $request) {
        $folder = Folder::findOrfail($folder_id);
        $folder->update($request->except(['_token']));
        return redirect()->route("cabinet.folder.index", $folder->cabinet_id)
            ->withSuccess("ทำรายการสำเร็จ");
    }
}