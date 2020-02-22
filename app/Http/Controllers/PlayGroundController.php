<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class PlayGroundController extends Controller
{
    public function import_users_to_db(Request $request)
    {
        Excel::import(new UsersImport(), $request->file('excel_file')->getRealPath());
        return back()->with('status', 'All Data Has Been Imported Successfully!');

    }

    public function export_users_to_excel()
    {
        return Excel::download(new UsersExport(), 'Users.xlsx');
    }
}
