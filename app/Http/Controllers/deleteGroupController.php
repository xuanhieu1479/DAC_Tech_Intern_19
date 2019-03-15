<?php

namespace App\Http\Controllers;

include_once "./inc/function_helper.php";

use Illuminate\Http\Request;
use DB;

class deleteGroupController extends Controller
{
    public function deleteGroup(Request $request) {
        if (!isLoggedInAndIsAdmin()) redirect('/login');

        $group_name = $request->get('group_name');
        try {
            DB::table('ug')->where('group_name', $group_name)->delete();
            DB::table('groups')->where('group_name', $group_name)->delete();
        } catch (\Exception $e) {}

        $firstGroup = DB::table('groups')->first();
        if ($firstGroup) {
            return redirect('/group?name=' . $firstGroup->group_name);
        }
        else {
            return redirect('/group');
        }
    }
}
