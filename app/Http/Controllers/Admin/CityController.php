<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $pageTitle = "Manage City";
        $emptyMessage = "No Data Found";
        $citys = City::latest()->paginate(getPaginate());
        return view('admin.city.index', compact('pageTitle', 'emptyMessage', 'citys'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:80',
            'image' => ['required', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);
        $city = new City();
        $city->name = $request->name;
        $path = imagePath()['city']['path'];
        $size = imagePath()['city']['size'];
        if ($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
            $city->image = $filename;
        }

        $city->status = $request->status ? 1: 0;
        $city->save();
        $notify[] = ['success', 'City has been created'];
        return back()->withNotify($notify);
    }


    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:80',
            'image' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);
        $city = City::findOrFail($request->id);
        $city->name = $request->name;
        $path = imagePath()['city']['path'];
        $size = imagePath()['city']['size'];
        if ($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size, $city->image);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
            $city->image = $filename;
        }
        $city->status = $request->status ? 1: 0;
        $city->save();
        $notify[] = ['success', 'City has been updated'];
        return back()->withNotify($notify);
    }
}
