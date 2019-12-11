<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @queryParam fields[users]=id,email 顯示哪些欄位 No-example
     * @queryParam filter['id', 'name', 'email']=abc 包含那些欄位自段 No-example
     * @queryParam sort=['id', 'email'] 包含那些欄位字段 No-example
     * @queryParam append=fullname 附加欄位 No-example
     * @queryParam include=oauthProviders 關聯資料 No-example
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = QueryBuilder::for(User::class)
            ->allowedFields('id')
            ->allowedFilters(['id', 'name', 'email'])
            ->allowedSorts(['id', 'email'])
            ->allowedAppends(['fullname'])
            ->allowedIncludes('oauthProviders')
            ->get();
        return $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::find($id);
        return $users;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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

    public function sendResponse()
    {

    }
}
