<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\UploadFIle;
use Illuminate\Support\Facades\Hash;

class UserApiController extends Controller
{
    use UploadFIle;

    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public $field = ['profile'];

    public function store(Request $request)
    {
        $data = User::all();

        // បើDataមិនទទេ
        
        if(!empty($data))
        {
            foreach($data as $item)
            {
                $item->delete();
            }
        }

        DB::beginTransaction();
        try{

            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password)
            ]);

            // $this->updateOrInsertMorpOne('profile',$user);
            $this->updateOrInsertMorphMany($this->field ,$user);

            DB::commit();
            return response()->json([
                'Success' => true,
                'Massage' => 'User Create Successfully'
            ]);
        }
        catch(\Exception $exp)
        {
            DB::rollBack();
            return response()->json(['Massage' => $exp->getMessage()], 500);
        }

    }

    public function destroy($id)
    {
        $is_deleted = User::find($id);

        $is_deleted->files()->forceDelete();
        $is_deleted->delete();
        if ($is_deleted) {
            return response()->json([
                'success' => true,
                'message' => 'User has been deleted successfully!.'
            ]);
        }
    }
}
