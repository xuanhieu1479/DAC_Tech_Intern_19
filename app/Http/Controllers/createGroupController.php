<?php
namespace App\Http\Controllers;

include_once "./inc/function_helper.php";

use Illuminate\Http\Request;
use DB;

class createGroupController extends Controller
{
    public function createGroup(Request $request)
    {
        if (!isLoggedInAndIsAdmin()) redirect('/login');

        try {
            $group_name = $request->input('group_name');
            $leader_name = $request->input('leader_name');

            DB::table('groups')->insert([
                'group_name' => $group_name,
                'leader_name' => $leader_name,
            ]);

            DB::table('ug')->insert([
                'user_name' => $leader_name,
                'group_name' => $group_name,
                'isLeader' => 1,
            ]);
        } catch (\Exception $e) {
            return redirect('/profile')->with('status', 'failure')->with('from', 'group');
        }

        return redirect('/profile')->with('status', 'success')->with('from', 'group');
    }
}
