<?php
namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
class StudentController extends Controller
{

    public function index(Request $request)
    {
        $data['students'] = Student::get();
        return view('home', $data);
    }

    public function removeMulti(Request $request)
    {
        $ids = $request->ids;
        Student::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>"Student successfully removed."]);

    }

}
