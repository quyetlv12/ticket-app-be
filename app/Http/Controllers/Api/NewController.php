<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class NewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){

        $this->middleware('auth:api_sessionuser',['except' => ['index']]);


   }
    public function index()
    {
        $list_new = News::with('user:id,name')->get();

        return $list_new;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('add_news')) {
            return response()->json([
                'message' => 'bạn không có quyền truy cập'
            ],403);
        }else{
        $news = new News;
        $news->name = $request->name;
        $news->description = $request->description;
        $news->image = $request->image;
        $news->post_time = now();
        $news->user_id = auth()->user()->getId();
        $news->save();
        return $news;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::with('user')->where('id', '=', $id)->first();
        return $news;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        if (! Gate::allows('edit_news')) {
            return response()->json([
                'message' => 'bạn không có quyền truy cập'
            ],403);
        }else{
        $news = News::find($id);
        $news->name = $request->name;
        $news->description = $request->description;
        $news->image = $request->image;
        $news->post_time = now();
        $news->user_id = auth()->user()->getId();
        $news->update();
        return $news;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('delete_news')) {
                return response()->json([
                    'message' => 'bạn không có quyền truy cập'
                ],403);
            }else{
            News::find($id)->delete();
            return response()->json([
                'code' => 200,
                'message'=>'success'
            ],200);
        }
    }
}
