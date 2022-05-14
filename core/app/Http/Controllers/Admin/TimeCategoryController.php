<?php

namespace App\Http\Controllers\Admin;

use App\TimeCategory;
use App\Http\Requests\TimeCategory\TimeCategoryStoreRequest;
use App\Http\Requests\TimeCategory\TimeCategoryUpdateRequest;
use App\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Megamenu;
use Validator;
use Session;
use DB;


class TimeCategoryController extends Controller
{


	public function index(Request $request)
    {
        $lang = Language::where('code', $request->language)->first();
        $lang_id = $lang->id;
        $data['lang_id'] = $lang_id;
        $data['timecategories'] = TimeCategory::where('lang_id', $lang_id)->orderBy('id', 'DESC')->paginate(10);
        return view('admin.timetable.time_category.index', $data);
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
    public function store(TimeCategoryStoreRequest $request)
    {
        TimeCategory::create($request->all()+[
                'slug' => make_slug($request->name)
            ]);
        Session::flash('success', 'Timetable category added successfully!');
        return "success";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(TimeCategoryUpdateRequest $request)
    {
        TimeCategory::findOrFail($request->time_category_id)->update($request->all()+[
            'slug' => make_slug($request->name)
        ]);
        Session::flash('success', 'Timetable category updated successfully!');
        return "success";
    }

    public function deleteFromMegaMenu($ecat) {
        $megamenu = Megamenu::where('language_id', $ecat->lang_id)->where('category', 1)->where('type', 'timetable');
        if ($megamenu->count() > 0) {
            $megamenu = $megamenu->first();
            $menus = json_decode($megamenu->menus, true);
            $catId = $ecat->id;
            if (is_array($menus) && array_key_exists("$catId", $menus)) {
                unset($menus["$catId"]);
                $megamenu->menus = json_encode($menus);
                $megamenu->save();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $ecat = TimeCategory::findOrFail($request->time_category_id);
        $this->deleteFromMegaMenu($ecat);
        $ecat->delete();
        Session::flash('success', 'Timetable category deleted successfully!');
        return back();
    }

    public function bulkDelete(Request $request)
    {
        return DB::transaction(function() use ($request){
            $ids = $request->ids;
            foreach ($ids as $id) {
                $ecat = TimeCategory::findOrFail($id);
                $this->deleteFromMegaMenu($ecat);
                $ecat->delete();
            }
            Session::flash('success', 'Timetable category deleted successfully!');
            return "success";
        });
    }
    
    




}
