<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\Student as StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $students = Student::all();

            return $this->sendResponse(StudentResource::collection($students), 'Students Retrieved Successfully');
        } catch(\Exception $e){
            return $this->sendError($e->getMessage(), 500);
        }
    }

    /**
     * Search for a resource by name.
     */

    public function search(Request $request)
    {
        try{
            $student_name = $request->query('name');

            $results = Student::where('first_name', 'LIKE', "%{$student_name}%")
                                ->orWhere('last_name', 'LIKE', "%{$student_name}")->get();

            $check_results = json_decode($results, true);


            if(empty($check_results))
            {
                return $this->sendError('Student Not Found', 404);
            }

            return $this->sendResponse(StudentResource::collection($results), 'Resource Retrieved Successfully');

        } catch(\Exception $e){
            return $this->sendError($e->getMessage(), 500);
        }
    }

    /**
     * Show result from students and courses.
     */
    public function student_courses($id)
    {
        try{
            $students = Student::with('courses')->where('id', $id)->first();

            return response()->json($students);

        } catch(\Exception $e){
            return $this->sendError($e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $input = $request->all();

            $validator = Validator::make($input, [
                'first_name' => 'required|string|',
                'last_name' => 'required|string',
                'email' => 'required|email|unique:students'
            ]);

            if($validator->fails())
            {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $student = Student::create($input);

            return $this->sendResponse(new StudentResource($student), 'Student Created Successfully', 201);
        } catch(\Exception $e){
            return $this->sendError($e->getMessage(), 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
            $student = Student::find($id);

            if(is_null($student))
            {
                return $this->sendError('Student Not Found.');
            }

            return $this->sendResponse(new StudentResource($student), 'Student Retrieved Successfully');
        } catch(\Exception $e){
            return $this->sendError($e->getMessage(), 500);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            $input = $request->all();

            $validator = Validator::make($input, [
                'first_name' => 'nullable',
                'last_name' => 'nullable',
                'email' => 'nullable',
                'course_id' => 'nullable',
            ]);

            if($validator->fails())
            {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $student = Student::find($id);

            $student->courses()->attach($input['course_id']);

            $student->update($request->only('first_name', 'last_name', 'email'));

            return $this->sendResponse(new StudentResource($student), 'Student Profile Updated Successfully');

        } catch(\Exception $e){
            return $this->sendError($e->getMessage(), 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $student = Student::find($id);
            $student->delete();

            return $this->sendResponse([], 'Student Deleted Successfully.');
        } catch(\Exception $e){
            return $this->sendError($e->getMessage(), 500);
        }

    }
}
