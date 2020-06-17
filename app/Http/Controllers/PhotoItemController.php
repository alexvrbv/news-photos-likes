<?php

namespace App\Http\Controllers;

use App\PhotoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use JWTAuth;
use File;
use Debugbar;

class PhotoItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photoItems = PhotoItem::all()->toArray();
        return array_reverse($photoItems);
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

        $image = '';
        if ($request->image) {
            $exploded = explode(',', $request->image);
            $decoded = base64_decode($exploded[1]);
            if (str_contains($exploded[0], 'jpeg')) {
                $extension = 'jpg';
            } else {
                $extension = 'png'; 
            }
            $fileName = Str::random().'.'.$extension;
            $path = public_path().'/storage/'.$fileName;
            file_put_contents($path, $decoded);            
            $image .= $fileName;
        }

        $photoItem = new PhotoItem([
            'name' => $request->input('name'),
            'user_id' => $user->id,
            'image' => $image,
        ]);
        $photoItem->save();

        return response()->json('The photo item successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PhotoItem  $photoItem
     * @return \Illuminate\Http\Response
     */
    public function show(PhotoItem $photoItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PhotoItem  $photoItem
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photoItem = PhotoItem::find($id);
        return response()->json($photoItem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PhotoItem  $photoItem
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $photoItem = PhotoItem::find($id);
        $image = $photoItem->image;
        if ($request->image && ($request->image != $image)) {
            $image = "";
            Debugbar::info($request->image);
            $exploded = explode(',', $request->image);
            $decoded = base64_decode($exploded[1]);
            if (str_contains($exploded[0], 'jpeg')) {
                $extension = 'jpg';
            } else {
                $extension = 'png'; 
            }
            $fileName = Str::random().'.'.$extension;
            $path = public_path().'/storage/'.$fileName;
            file_put_contents($path, $decoded);            
            $image .= $fileName;
        }
        $photoItem->update($request->except('image') + [
            'image' => $image
        ]);
        return response()->json('The photo item successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PhotoItem  $photoItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photoItem = PhotoItem::find($id);
        $photoItem->delete();
        return response()->json('The photo item successfully deleted');
    }
}
