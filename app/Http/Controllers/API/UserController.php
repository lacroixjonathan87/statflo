<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$query = User::query();

		$name = Input::get('name');
		if(!is_null($name)){
			$query->where('name', 'like', '%' . $name . '%');
		}

		$role = Input::get('role');
		if(!is_null($role)){
			$query->where('role', 'like', '%' . $role . '%');
		}

		$collection = $query->paginate();
		return UserResource::collection($collection);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$validation = Validator::make(
			$request->all(),
			[
				'name' => 'required|max:100',
				'role' => 'required|max:100',
			]
		);

		if($validation->fails()){
			Log::warning('Input fail validation');
			return response([
				'message' => 'Not able to save the user',
				'errors' => $validation->errors()->all(),
			], 400);
		}

		$model = new User();
		$model->fill($validation->validate());

		if (!$model->save()) {
			Log::critical('Not able to save to the database');
			return response(['message' => 'Not able to save the user'], 500);
		}
		return new UserResource($model);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$model = User::findOrFail($id);
		return new UserResource($model);
	}

}
