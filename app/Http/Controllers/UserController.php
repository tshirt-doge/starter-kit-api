<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\User;
use App\Traits\ApiResponder;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    use ApiResponder;

    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of users
     *
     * @return JsonResponse
     */
    public function index()
    {
        $users = User::all();
        return $this->success(['data' => $users], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function store(UserRequest $request)
    {
        $userCreds = $request->only('email', 'password');
        $userCreds['password'] = Hash::make($userCreds['password']);
        $userInfo = $request->except('email', 'password', 'roles');
        $roles = $request->only('roles');

        /** @var User $user */
        $user = $this->repository->create($userCreds, $userInfo, $roles);

        return $this->success(['data' => $user], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        /** @var User $user */
        $user = $this->repository->read($id);

        return $this->success(['data' => $user], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
