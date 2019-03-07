<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class createGroupController extends Controller
{
    public function createGroup(Request $request)
    {
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
