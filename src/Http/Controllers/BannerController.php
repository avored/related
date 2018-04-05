<?php

namespace AvoRed\Banner\Http\Controllers;

use AvoRed\Banner\DataGrid\Banner as BannerGrid;
use App\Http\Controllers\Controller;
use AvoRed\Banner\Models\Database\Banner;
use AvoRed\Banner\Http\Requests\BannerRequest;
use AvoRed\Framework\Image\Facade as Image;

class BannerController extends Controller
{
    public function index() {

        $bannerGrid = new BannerGrid(Banner::query());

        return view('avored-banner::banner.index')->with('dataGrid', $bannerGrid->dataGrid);
    }

    public function create() {
        return view('avored-banner::banner.create');
    }

    public function edit($id) {

        $banner = Banner::find($id);
        return view('avored-banner::banner.edit')->with('model', $banner);
    }

    public function update(BannerRequest $request, $id) {

        $banner = Banner::find($id);

        $image = $request->get('image');

        if(null != $image) {
            $dbPath = $this->_uploadBanner($image);
            $request->merge(['image_path' => $dbPath]);
        }

        $banner->update($request->all());

        return redirect()->route('admin.banner.index');
    }

    public function store(BannerRequest $request) {


        $image = $request->file('image');
        $dbPath = $this->_uploadBanner($image);

        $request->merge(['image_path' => $dbPath]);
        Banner::create($request->all());

        return redirect()->route('admin.banner.index');
    }

    public function destroy($id) {
        Banner::destroy($id);

        return redirect()->route('admin.banner.index');
    }

    private function _uploadBanner($image) {

        $tmpPath = str_split(strtolower(str_random(3)));
        $checkDirectory = '/uploads/cms/images/'.implode('/', $tmpPath);
        $dbPath = $checkDirectory.'/'.$image->getClientOriginalName();

        Image::upload($image, $checkDirectory);

        return $dbPath;

    }
}
