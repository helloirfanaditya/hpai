<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Resources\Users\GetListUser;
use App\Repositories\UserRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function listUsers(Request $request): Response
    {
        try {
            $parseRequest = $request->only('limit', 'next_page', 'prev_page', 'search');
            $getListUsers = UserRepository::getListUsers($parseRequest);
            GetListUser::collection($getListUsers);
            return $this->resJson($this->paginateV2($getListUsers), true, 200);
        } catch (\Exception $e) {
            return $this->resJson('Something went wrong: ' . $e->getMessage(), false, 500);
        }
    }

    public function createUser(CreateUserRequest $request): Response
    {
        try {
            $ok = UserRepository::createUser($request->all());
            return $this->resJson($ok, true, 200);
        } catch (ModelNotFoundException $e) {
            return $this->resJson("User not found.", false, 404);
        }
    }

    public function getDetailUser($id): Response
    {
        try {
            $getDetailUser = UserRepository::getDetailUser($id);
            return $this->resJson($getDetailUser, true, 200);
        } catch (ModelNotFoundException $e) {
            return $this->resJson("User not found.", false, 404);
        }
    }

    public function deleteUser($id): Response
    {
        try {
            [$msg, $status, $responseCode] = UserRepository::deleteUser($id);
            return $this->resJson($msg, $status, $responseCode);
        } catch (ModelNotFoundException $e) {
            return $this->resJson("User not found.", false, 404);
        }
    }
}
