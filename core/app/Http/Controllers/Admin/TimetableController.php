<?php

namespace App\Http\Controllers\Admin;
use App\TimeTable;
use App\TimeCategory;
use App\Language;
use App\BasicExtra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Megamenu;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Validator;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Image;


class TimetableController extends Controller
{




    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index(Request $request)
    {



        $lang = Language::where('code', $request->language)->first();
        $lang_id = $lang->id;
        $data['lang_id'] = $lang_id;
        $data['abx'] = $lang->basic_extra;
        $data['timetable'] = TimeTable::where('lang_id', $lang_id)->orderBy('id', 'DESC')->get();
        $data['timecategories'] = TimeCategory::where('lang_id', $lang_id)->where('status', '1')->get();
        return view('admin.timetable.timetable.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('admin.timetable.timetable.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {




        // $slug = make_slug($request->title);

        // $images = !empty($request->image) ? explode(',', $request->image)
        // : [];

        // $allowedExts = array('jpg', 'png', 'jpeg');

        // $rules = [
        //     'title' => [
        //         'required',
        //         'max:255',
        //         function ($attribute, $value, $fail) use ($slug) {
        //             $timetable = TimeTable::all();
        //             foreach ($timetable as $key => $table) {
        //                 if (strtolower($slug) == strtolower($table->slug)) {
        //                     $fail('The title field must be unique.');
        //                 }
        //             }
        //         }
        //     ],

        //     'date' => 'required',
        //     'day' => 'required',
        //     'start_time' => 'required',
        //     'end_time' => 'required',
        //     'trainer' => 'required',
        //     'color' => 'required',
        //     'lang_id' => 'required',
        //     'time_categories_id' => 'required',
        //     'image' => 'required'
            
        // ];

        //  if ($request->filled('image')) {
        //     $rules['image'] = [
        //         function ($attribute, $value, $fail) use ($images, $allowedExts) {
        //             foreach ($images as $key => $image) {
        //                 $extImage = pathinfo($image, PATHINFO_EXTENSION);
        //                 if (!in_array($extImage, $allowedExts)) {
        //                     return $fail("Only png, jpg, jpeg images are allowed");
        //                 }
        //             }
        //         }
        //     ];
        // }


        // $messages = [
        //     'title.required' => 'The title field is required',
        //     'date.required' => 'The date field is required',
        //     'day.required' => 'The day field is required',
        //     'start_time.required' => 'The start_time field is required',
        //     'end_time.required' => 'End time field is required',
        //     'trainer.required' => 'The organizer name field is required',
        //     'color.required' => 'The color field is required',
        //     'lang_id.required' => 'The language field is required',
        //     'time_categories_id.required' => 'The category field is required'
        // ];


        //  $validator = Validator::make($request->all(), $rules, $messages);
        // if ($validator->fails()) {
        //     $errmsgs = $validator->getMessageBag()->add('error', 'true');
        //     return response()->json($validator->errors());
        // }


        // $images = $request->image;
        // foreach ($images as $key => $image) {
        //     $extImage = pathinfo($image, PATHINFO_EXTENSION);
        //     $filename = uniqid() .'.'. $extImage;

        //     $directory = 'assets/front/img/timetable/';
        //     @mkdir($directory, 0775, true);

        //     @copy($image, $directory . $filename);
        //     $images = $filename;
        // }


        // $timetable = TimeTable::create($request->except('image', 'content') + [
        //         'slug' => $slug,
        //         'image' => json_encode($images),
        //         'content' => str_replace(url('/') . '/assets/front/img/', "{base_url}/assets/front/img/", $request->content)
                
        //     ]);


        // Session::flash('success', 'Time Table added successfully!');
        // return "success";



      $validatedData = $request->validate([
        'lang_id' => 'required',
        'time_categories_id' => 'required',
       ]);




        $data = new Timetable(); 
$data->lang_id = $request->lang_id;
$data->time_categories_id = $request->time_categories_id;
$data->title = $request->title;
$data->date = date('Y-m-d',strtotime($request->date));
$data->day = $request->day;
$data->start_time = $request->start_time;
$data->end_time = $request->end_time;
$data->trainer = $request->trainer;
$data->color = $request->color;
$data->content = $request->content;
$data->meta_keywords = $request->meta_keywords;
     $data->meta_description = $request->meta_description;

        

        // if ($request->file('image')) {
        //     $file = $request->file('image');
            
        //     $filename = date('YmdHi').$file->getClientOriginalName();
        //     $file->move(public_path('upload/timetable_images'),$filename);
        //     $data['image'] = $filename;
        // }


       //Intervention

          $image = $request->file('image');
          $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
          Image::make($image)->resize(300,300)->save('assets/front/timetable/'.$name_gen);
          $data['image'] = 'assets/front/timetable/'.$name_gen;



        $data->save();



    // $data = [];
    //  $data['lang_id'] = $request->lang_id;
    //  $data['time_categories_id'] = $request->time_categories_id;
    //  $data['title'] = $request->title;
    //  $data['date'] = date('d-m-Y');
    //  $data['day'] = date('l');
    //  $data['start_time'] = $request->start_time;
    //  $data['end_time'] = $request->end_time;
    //  $data['trainer'] = $request->trainer;
    //  $data['color'] = $request->color;
    //  $data['content'] = $request->content;
    //  $data['meta_keywords'] = $request->meta_keywords;
    //  $data['meta_description'] = $request->meta_description;
   

     // $image = $request->image;
     //    if ($image) {
     //        $image_one = uniqid().'.'.$image->getClientOriginalExtension(); 
     //        Image::make($image)->resize(500,300)->save('assets/front/timetable/'.$image_one);
     //        $data['image'] = 'assets/front/timetable/'.$image_one;

           
            
            // DB::table('time_tables')->insert($data);


        Session::flash('success', 'Time table added successfully!');
        return "success";




        
        // }else{
        //     return Redirect()->back();
        // } 



    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return
     */
    public function edit($id)
    {





        $data['timetable'] = TimeTable::findOrFail($id);
        $data['timecategories'] = TimeCategory::where('lang_id', $data['timetable']->lang_id)->where('status', 1)->get();
        
        return view('admin.timetable.timetable.edit', $data); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $slug = make_slug($request->title);
        $eventId = $request->event_id;

        $images = !empty($request->image) ? explode(',', $request->image) : [];
        $allowedExts = array('jpg', 'png', 'jpeg');

        $rules = [
            'image' => 'required',
            'title' => [
                'required',
                'max:255',
                function ($attribute, $value, $fail) use ($slug, $eventId) {
                    $timetable = TimeTable::all();
                    foreach ($timetable as $key => $time) {
                        if ($time->id != $eventId && strtolower($slug) == strtolower($time->slug)) {
                            $fail('The title field must be unique.');
                        }
                    }
                }
            ],
            'date' => 'required',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'color' => 'required',
            'trainer' => 'required',
            'time_categories_id' => 'required',
        ];


        if ($request->filled('image')) {
            $rules['image'] = [
                function ($attribute, $value, $fail) use ($images, $allowedExts) {
                    foreach ($images as $key => $image) {
                        $extImage = pathinfo($image, PATHINFO_EXTENSION);
                        if (!in_array($extImage, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg images are allowed");
                        }
                    }
                }
            ];
        }

        $messages = [
            'title.required' => 'The title field is required',
            'date.required' => 'The date field is required',
            'day.required' => 'The time field is required',
            'start_time.required' => 'The Start Time field is required',
            'end_time.required' => 'End Time field is required',
            'trainer.required' => 'The organizer name field is required',
            'time_categories_id.required' => 'The category field is required'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

     
        $timetable->update($request->except('image', 'content') + [
                'slug' => $slug,
                'content' => str_replace(url('/') . '/assets/front/img/', "{base_url}/assets/front/img/", $request->content)
            ]);
        $timetable = TimeTable::findOrFail($request->event_id);


        // copy the sliders first
        $fileNames = [];
        foreach ($images as $key => $image) {
            $extImage = pathinfo($image, PATHINFO_EXTENSION);
            $filename = uniqid() .'.'. $extImage;
            @copy($image, 'assets/front/img/timetable/sliders/' . $filename);
            $fileNames[] = $filename;
        }

        // delete & unlink previous slider images
        $preImages = json_decode($timetable->image, true);
        foreach ($preImages as $key => $pi) {
            @unlink('assets/front/img/timetable/sliders/' . $pi);
        }

        $timetable->image = json_encode($fileNames);
        $timetable->save();

        Session::flash('success', 'Time Table updated successfully!');
        return "success";
    }

    public function uploadUpdate(Request $request, $id)
    {
        $rules = [
            'file' => 'required | mimes:jpeg,jpg,png',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $validator->getMessageBag()->add('error', 'true');
            return response()->json(['errors' => $validator->errors(), 'id' => 'blog']);
        }
        $img = $request->file('file');
        $timetable = TimeTable::findOrFail($id);
        if ($request->hasFile('file')) {
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $request->file('file')->move('assets/front/img/timetable/', $filename);
            @unlink('assets/front/img/timetable/' . $timetable->image);
            $timetable->image = $filename;
            $timetable->save();
        }

        return response()->json(['status' => "success", "image" => "timetable image", 'timetable' => $timetable]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getCategories($lang_id)
    {
        return TimeCategory::where('lang_id', $lang_id)->where('status', '1')->get();
    }



    public function sliderRemove(Request $request)
    {
        $timetable = TimeTable::findOrFail($request->id);
        $images = json_decode($timetable->image, true);
        @unlink('assets/front/img/timetable/sliders/' . $images["$request->key"]);
        unset($images["$request->key"]);
        $newImages = array_values($images);
        $timetable->image = json_encode($newImages);
        $timetable->save();
        return response()->json(['status' => 200, 'message' => 'success']);
    }

    public function deleteFromMegaMenu($timetable) {
        // unset service from megamenu for service_category = 1
        $megamenu = Megamenu::where('lang_id', $timetable->lang_id)->where('category', 1)->where('type', 'timetable');
        if ($megamenu->count() > 0) {
            $megamenu = $megamenu->first();
            $menus = json_decode($megamenu->menus, true);
            $catId = $timetable->timeCategories->id;
            if (is_array($menus) && array_key_exists("$catId", $menus)) {
                if (in_array($timetable->id, $menus["$catId"])) {
                    $index = array_search($timetable->id, $menus["$catId"]);
                    unset($menus["$catId"]["$index"]);
                    $menus["$catId"] = array_values($menus["$catId"]);
                    if (count($menus["$catId"]) == 0) {
                        unset($menus["$catId"]);
                    }
                    $megamenu->menus = json_encode($menus);
                    $megamenu->save();
                }
            }
        }
    }

    public function delete(Request $request)
    {
        $timetable = TimeTable::findOrFail($request->event_id);
        $images = json_decode($timetable->image, true);
        if (count($images) > 0) {
            foreach ($images as $image) {
                $directory = 'assets/front/img/timetable/' . $image;
                if (file_exists($directory)) {
                    @unlink($directory);
                }
            }
        }
        

        $this->deleteFromMegaMenu($timetable);
        $timetable->delete();

        Session::flash('success', 'Time Table deleted successfully!');
        return back();
    }

    public function bulkDelete(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $ids = $request->ids;
            foreach ($ids as $id) {
                $timetable = TimeTable::findOrFail($id);
                $images = json_decode($timetable->image, true);
                if (count($images) > 0) {
                    foreach ($images as $image) {
                        $directory = 'assets/front/img/timetable/' . $image;
                        if (file_exists($directory)) {
                            @unlink($directory);
                        }
                    }
                }
               
               

                $this->deleteFromMegaMenu($timetable);
                $timetable->delete();

            }
            Session::flash('success', 'Time Table deleted successfully!');
            return "success";
        });
    }

    public function settings() {
        $data['abex'] = BasicExtra::first();
        return view('admin.timetable.settings', $data);
    }

    public function updateSettings(Request $request) {
        $bexs = BasicExtra::all();
        foreach($bexs as $bex) {
            $bex->event_guest_checkout = $request->event_guest_checkout;
            $bex->is_event = $request->is_event;
            $bex->save();
        }

        $request->session()->flash('success', 'Settings updated successfully!');
        return back();
    }

   

}

