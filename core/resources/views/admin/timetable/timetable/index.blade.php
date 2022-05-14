@extends('admin.layout')

@php
$selLang = \App\Language::where('code', request()->input('language'))->first();
@endphp
@if(!empty($selLang) && $selLang->rtl == 1)
@section('styles')
<style>
    form:not(.modal-form) input,
    form:not(.modal-form) textarea,
    form:not(.modal-form) select,
    select[name='language'] {
        direction: rtl;
    }
    form:not(.modal-form) .note-editor.note-frame .note-editing-area .note-editable {
        direction: rtl;
        text-align: right;
    }
</style>
@endsection
@endif

@section('content')
<div class="page-header">
   <h4 class="page-title">Timetable</h4>
   <ul class="breadcrumbs">
      <li class="nav-home">
         <a href="{{route('admin.dashboard')}}">
         <i class="flaticon-home"></i>
         </a>
      </li>
      <li class="separator">
         <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
         <a href="#">Timetable Page</a>
      </li>
      <li class="separator">
         <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
         <a href="#">Timetable</a>
      </li>
   </ul>
</div>
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header">
            <div class="row">
               <div class="col-lg-4">
                  <div class="card-title d-inline-block">Timetable</div>
               </div>
               <div class="col-lg-3">
                  @if (!empty($langs))
                  <select name="language" class="form-control" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                     <option value="" selected disabled>Select a Language</option>
                     @foreach ($langs as $lang)
                     <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                     @endforeach
                  </select>
                  @endif
               </div>

               <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
                  <a href=" {{route('admin.timetable.create')}} " class="btn btn-primary float-right btn-sm">
                     <i class="fas fa-plus" style="color: white !important;"></i> Add Timetable</a>



                  <button class="btn btn-danger float-right btn-sm mr-2 d-none bulk-delete" data-href="{{route('admin.timetable.bulk.delete')}}"><i class="flaticon-interface-5"></i> Delete</button>
               </div>


            </div>
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-lg-12">

                  @if (count($timetable) == 0)
                  <h3 class="text-center">NO TIMETABLE FOUND</h3>
                  @else
                  <div class="table-responsive">
                     <table class="table table-striped mt-3" id="basic-datatables">
                        <thead>
                           <tr>
                              <th scope="col">
                                 <input type="checkbox" class="bulk-check" data-val="all">
                              </th>
                              <th scope="col">Image</th>
                              <th scope="col">Title</th>
                              <th scope="col">Category</th>
                              <th scope="col">Class Date</th>
                              <th scope="col">Class Day</th>
                              <th scope="col">Class Time</th>
                              <th scope="col">Actions</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($timetable as $key => $time)
                           <tr>
                              <td>
                                 <input type="checkbox" class="bulk-check" data-val="{{$time->id}}">
                              </td>
                              @php
                                $images = json_decode($time->image, true);
                              @endphp
                              <td><img src="{{(!empty($images)) ? asset('/assets/front/img/timetable/sliders/'.$images[0]) : ''}}" alt="" width="80"></td>


                              <td>{{convertUtf8(strlen($time->title)) > 30 ? convertUtf8(substr($time->title, 0, 30)) . '...' : convertUtf8($time->title)}}</td>

                              <td>{{ !empty(convertUtf8($time->timeCategories)) ? convertUtf8($time->timeCategories->name) : '' }}</td>

                              <td>
                                 @php
                                 $date = \Carbon\Carbon::parse($time->date);
                                 @endphp
                                 {{$date->translatedFormat('jS F, Y')}}
                              </td>

                              
                                <td> {{ Carbon\Carbon::parse($time->day)->format('l' ) }}
                                </td>

                                <td> 
                                 {{ Carbon\Carbon::parse($time->start_time)->format(' H:i:s A' ) }}  - {{ Carbon\Carbon::parse($time->end_time)->format('H:i:s A' ) }}

                                </td>


                                 <td>
                                 @if ($time->status == "1")
                                 <h2 class="d-inline-block"><span class="badge badge-success">Active</span></h2>
                                 @else
                                 <h2 class="d-inline-block"><span class="badge badge-danger">Deactive</span></h2>
                                 @endif
                                 </td>
                              


                              <td>
                                 <a class="btn btn-secondary btn-sm" href="{{route('admin.timetable.edit', $time->id) . '?language=' . request()->input('language')}}">
                                 <span class="btn-label">
                                 <i class="fas fa-edit"></i>
                                 </span>
                                 Edit
                                 </a>
                                 <form class="deleteform d-inline-block" action="{{route('admin.timetable.delete')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="event_id" value="{{$time->id}}">
                                    <button type="submit" class="btn btn-danger btn-sm deletebtn">
                                    <span class="btn-label">
                                    <i class="fas fa-trash"></i>
                                    </span>
                                    Delete
                                    </button>
                                 </form>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
                  @endif
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Create Blog Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Timetable</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">

   <form id="ajaxForm" class="modal-form" action="{{route('admin.timetable.store')}}" method="POST" >
      @csrf
   <div class="form-group">
      <label for="">Language **</label>
      <select id="language" name="lang_id" class="form-control" required>
         <option value="" selected disabled>Select a language</option>
         @foreach ($langs as $lang)
         <option value="{{$lang->id}}">{{$lang->name}}</option>
         @endforeach
      </select>
      <p id="errlang_id" class="mb-0 text-danger em"></p>
   </div>




                  <div class="form-group">
                  <label for="">Category **</label>
                  <select id="categories_id" class="form-control" name="time_categories_id" disabled required>
                     <option value="" selected disabled>Select a category</option>
                  </select>
                  <p id="errtime_categories_id" class="mb-0 text-danger em"></p>
               </div>



               <div class="form-group">
                  <label for="">Title **</label>
                  <input type="text" class="form-control" name="title" placeholder="Enter title" value="" required>
                  <p id="errtitle" class="mb-0 text-danger em"></p>
               </div>




                               {{-- Image Part --}}
<div class="form-group">
    <label for="">Image ** </label>
    <br>
    <div class="thumb-preview" id="thumbPreview1">
        <img src="{{asset('assets/admin/img/noimage.jpg')}}" alt="User Image">
    </div>
    <br>
    <br>


    <input id="fileInput1" type="hidden" name="image">
    <button id="chooseImage1" class="choose-image btn btn-primary" type="button" data-multiple="false" data-toggle="modal" data-target="#lfmModal1">Choose Image</button>


    <p class="text-warning mb-0">JPG, PNG, JPEG, SVG images are allowed</p>
    <p class="em text-danger mb-0" id="errimage"></p>

</div>
                {{-- END: Image Part --}}


               
                <div class="form-group">
                    <label for="">Date **</label>
                    <input type="date" class="form-control ltr" name="date" value="" placeholder="Enter Event Date" required>
                    <p id="errdate" class="mb-0 text-danger em"></p>
                </div>


                 <div class="form-group">
                  <label for="">Day **</label>
                <select name="day" class="form-control">

            <option value="">---</option>

            <option value="monday" <?php echo ($day ?? '' == 'monday') ? 'selected' : ''; ?>>Monday</option>

            <option value="tuesday" <?php echo ($day ?? '' == 'tuesday') ? 'selected' : ''; ?>>Tuesday</option>

            <option value="wednesday" <?php echo ($day ?? '' == 'wednesday') ? 'selected' : ''; ?>>Wednesday</option>

            <option value="thursday" <?php echo ($day ?? '' == 'thursday') ? 'selected' : ''; ?>>Thursday</option>

            <option value="friday" <?php echo ($day ?? '' == 'friday') ? 'selected' : ''; ?>>Friday</option>

            <option value="saturday" <?php echo ($day ?? '' == 'saturday') ? 'selected' : ''; ?>>Saturday</option>

            <option value="sunday" <?php echo ($day ?? '' == 'sunday') ? 'selected' : ''; ?>>Sunday</option>
         </select>

      </div>




                <div class="form-group">
                    <label for=""> Start_Time **</label>
                    <input type="time" class="form-control ltr" name="start_time" value="" placeholder="Enter Class Start Time" required>
                    <p id="errstart_time" class="mb-0 text-danger em"></p>
                </div>

                <div class="form-group">
                    <label for=""> End_Time **</label>
                    <input type="time" class="form-control ltr" name="end_time" value="" placeholder="Enter Class End Time" required>
                    <p id="errend_time" class="mb-0 text-danger em"></p>
                </div>

                
                <div class="form-group">
                    <label for="">Trainer **</label>
                    <input type="text" class="form-control ltr" name="trainer" value="" placeholder="Class trainer" required>
                    <p id="errtrainer" class="mb-0 text-danger em"></p>
                </div>



                      <div class="form-group">
                  <label for="">Color **</label>
                  <select name="color" class="form-control">
                <option value="1" <?php echo ($color ?? '' == '1') ? 'selected' : ''; ?>>1</option>
                <option value="2" <?php echo ($color ?? '' == '2') ? 'selected' : ''; ?>>2</option>
                <option value="3" <?php echo ($color ?? '' == '3') ? 'selected' : ''; ?>>3</option>
                <option value="4" <?php echo ($color ?? '' == '4') ? 'selected' : ''; ?>>4</option>
                <option value="5" <?php echo ($color ?? '' == '5') ? 'selected' : ''; ?>>5</option>
            </select>
                  <p id="errcolor" class="mb-0 text-danger em"></p>
                </div>



                <div class="form-group">
                  <label for="">Content</label>
                  <textarea class="form-control summernote" name="content" rows="8" cols="80" placeholder="Enter content"></textarea>
                  <p id="errcontent" class="mb-0 text-danger em"></p>
               </div>




               <div class="form-group">
                  <label for="">Meta Keywords</label>
                  <input type="text" class="form-control" name="meta_tags" value="" data-role="tagsinput">
               </div>
               <div class="form-group">
                  <label for="">Meta Description</label>
                  <textarea type="text" class="form-control" name="meta_description" rows="5"></textarea>
               </div>
            </form>



         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id="submitBtn" type="button" class="btn btn-primary">Submit</button>
         </div>
      </div>
   </div>
</div>

 <!-- Image LFM Modal -->
    <div class="modal fade lfm-modal" id="lfmModal1" tabindex="-1" role="dialog" aria-labelledby="lfmModalTitle" aria-hidden="true">
        <i class="fas fa-times-circle"></i>
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <iframe src="{{url('laravel-filemanager')}}?serial=1" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
   $(document).ready(function() {
       $("select[name='lang_id']").on('change', function() {
           $("#categories_id").removeAttr('disabled');
           let langid = $(this).val();
           let url = "{{url('/')}}/admin/timetable/" + langid + "/get-categories";
           $.get(url, function(data) {
               console.log(data);
               let options = `<option value="" disabled selected>Select a category</option>`;
               for (let i = 0; i < data.length; i++) {
                   options += `<option value="${data[i].id}">${data[i].name}</option>`;
               }
               $("#categories_id").html(options);

           });
       });

       // make input fields RTL
       $("select[name='lang_id']").on('change', function() {
           $(".request-loader").addClass("show");
           let url = "{{url('/')}}/admin/rtlcheck/" + $(this).val();
           $.get(url, function(data) {
               $(".request-loader").removeClass("show");
               if (data == 1) {
                   $("form input").each(function() {
                       if (!$(this).hasClass('ltr')) {
                           $(this).addClass('rtl');
                       }
                   });
                   $("form select").each(function() {
                       if (!$(this).hasClass('ltr')) {
                           $(this).addClass('rtl');
                       }
                   });
                   $("form textarea").each(function() {
                       if (!$(this).hasClass('ltr')) {
                           $(this).addClass('rtl');
                       }
                   });
                   $("form .summernote").each(function() {
                       $(this).siblings('.note-editor').find('.note-editable').addClass('rtl text-right');
                   });

               } else {
                   $("form input, form select, form textarea").removeClass('rtl');
                   $("form.modal-form .summernote").siblings('.note-editor').find('.note-editable').removeClass('rtl text-right');
               }
           })
       });

       // translatable portfolios will be available if the selected language is not 'Default'
       $("#language").on('change', function() {
           let language = $(this).val();
           if (language == 0) {
               $("#translatable").attr('disabled', true);
           } else {
               $("#translatable").removeAttr('disabled');
           }
       });

      
   });

</script>
@endsection
