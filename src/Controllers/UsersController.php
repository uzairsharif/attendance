<?php

namespace Uzair3\Attendance\Controllers;

use Uzair3\Attendance\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function user_account_not_approved(){
        return view('attendance::user.not_approved_account');
    }
    public function admin_side_users_list(){
        $users = User::all();
        
        return view('attendance::users/admin_side_users_list',compact('users'));
    }
    public function delete_user($user_id){
        
        $user = User::find($user_id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found.']);
        }

        $user->delete();
        return response()->json(['success' => true, 'message' => 'User deleted successfully.']);
    }
    public function update_user_status($user_id){
        $user = User::find($user_id);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found']);
        }
        $user->status = 'active';
        $user->save();
        $new_status = $user->status;
        
        return response()->json(['success' => true, 'message' => 'User Status Updated Successfully','new_status' => $user->status]);

    }
    public function update_user(Request $request, $user_id){

        $request->validate([
            'email' => 'required|email',
            'status' => 'required|in:active,inactive',
        ]);

        $user = User::find($user_id);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found']);
        }
        $user->email = $request->email;
        $user->status = $request->status;
        $user->save();


        
        return response()->json(['success' => true, 'message' => 'User Updated Successfully', 'updatedData' => $user]);
    }

    public function uploadProfileImage(Request $request)
    {


        $request->validate([
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = auth()->user();
        
        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->update(['profile_image' => $path]);
        }

        return back()->with('success', 'Profile image updated successfully.');
    }

    

}
