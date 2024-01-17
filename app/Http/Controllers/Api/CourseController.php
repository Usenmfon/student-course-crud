<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\Course as CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $courses = Course::all();

            return $this->sendResponse(CourseResource::collection($courses), 'Courses Retrieved Successfully');

        } catch(\Exception $e){
            return $this->sendError($e->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $input = $request->all();

            $validator = Validator::make($input, [
                'name' => 'required',
                'code' => 'required',
            ]);

            if($validator->fails())
            {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $course = Course::create($input);

            return $this->sendResponse(new CourseResource($course), 'Course Retrieved Successfully');

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
            $course = Course::find($id);

            if(is_null($course))
            {
                return $this->sendError('Course Not Found.');
            }

            return $this->sendResponse(new CourseResource($course), 'Course Retrieved Successfully');

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
                'name' => 'required',
                'code' => 'required',
            ]);

            if($validator->fails())
            {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $course = Course::find($id);
            $course->students()->attach($input['student_id']);

            $course->update($request->only('name', 'code'));

            return $this->sendResponse(new CourseResource($course), 'Course Updated Successfully');

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
            $course = Course::find($id);
            $course->delete();

            return $this->sendResponse([], 'Course Deleted Successfully.');

        } catch(\Exception $e){
            return $this->sendError($e->getMessage(), 500);
        }
    }
}
