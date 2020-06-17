<?php

namespace App\Http\Controllers;

use App\NewsItem;
use Illuminate\Http\Request;
use JWTAuth;

class NewsItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsItems = NewsItem::all()->toArray();
        return array_reverse($newsItems);
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
        $user = JWTAuth::parseToken()->authenticate();
        $newsItem = new NewsItem([
            'name' => $request->input('name'),
            'user_id' => $user->id,
        ]);
        $newsItem->save();

        return response()->json('The news item successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NewsItem  $newsItem
     * @return \Illuminate\Http\Response
     */
    public function show(NewsItem $newsItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NewsItem  $newsItem
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $newsItem = NewsItem::find($id);
        return response()->json($newsItem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NewsItem  $newsItem
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $newsItem = NewsItem::find($id);
        $newsItem->update($request->all());
        return response()->json('The news item successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NewsItem  $newsItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newsItem = NewsItem::find($id);
        $newsItem->delete();
        return response()->json('The news item successfully deleted');
    }
}
