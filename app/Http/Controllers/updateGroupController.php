<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class updateGroupController extends Controller
{
    public function updateLeader(Request $request) {
        $group_name = $request->input('group_name');
        $leader_name = $request->input('leader_name');

        if (!DB::table('groups')->where('group_name', $group_name)->where('leader_name', $leader_name)->get()->isEmpty()) {
            return redirect('/group?name=' . $group_name)->with('updateLeader', 'This member is already leader of group');
        }

        if (DB::table('ug')->where('group_name', $group_name)->where('user_name', $leader_name)->get()->isEmpty()) {
            return redirect('/group?name=' . $group_name)->with('updateLeader', 'This member is no longer in group');
        }

        try {
            DB::table('groups')->where('group_name', $group_name)->update(['leader_name' => $leader_name]);

            DB::table('ug')->where('group_name', $group_name)->update(['isLeader' => 0]);
            DB::table('ug')->where('group_name', $group_name)->where('user_name', $leader_name)->update(['isLeader' => 1]);
        } catch (\Exception $e) {
            return redirect('/group?name=' . $group_name)->with('updateLeader', 'Please contact my mentor to fix this~');
        }

        return redirect('/group?name=' . $group_name);
    }

    public function addMember(Request $request) {
        $group_name = $request->input('group_name');
        $add_member_name = $request->input('add_member_name');

        if (!isset($add_member_name)) {
            return redirect('/group?name=' . $group_name)->with('addMember', 'There is no one to add');
        }

        if (!DB::table('ug')->where('group_name', $group_name)->where('user_name', $add_member_name)->get()->isEmpty()) {
            return redirect('/group?name=' . $group_name)->with('addMember', 'This guy/gal is already member of group');
        }

        try {
            DB::table('ug')->insert([
                'user_name' => $add_member_name,
                'group_name' => $group_name,
                'isLeader' => 0,
            ]);
        } catch (\Exception $e) {
            return redirect('/group?name=' . $group_name)->with('addMember', 'Please contact my mentor to fix this~');
        }

        return redirect('/group?name=' . $group_name);
    }

    public function removeMember(Request $request) {
        $group_name = $request->input('group_name');
        $del_member_name = $request->input('del_member_name');

        if (!isset($del_member_name)) {
            return redirect('/group?name=' . $group_name)->with('removeMember', 'You just did a pointless action. Bravo!');
        }

        try {
            DB::table('ug')->where('user_name', $del_member_name)->where('group_name', $group_name)->delete();
        } catch (\Exception $e) {
            return redirect('/group?name=' . $group_name)->with('removeMember', 'Please contact my mentor to fix this~');
        }

        return redirect('/group?name=' . $group_name);
    }
}
