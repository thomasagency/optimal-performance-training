@extends('admin.layout')


@php
$selLang = \App\Language::where('code', request()->input('language'))->first();
@endphp
@if(!empty($selLang) && $selLang->rtl == 1)
@section('styles')
<style>
    form input,
    form textarea,
    form select {
        direction: rtl;
    }
    form .note-editor.note-frame .note-editing-area .note-editable {
        direction: rtl;
        text-align: right;
    }
</style>
@endsection
@endif





@section('content')



<div class="page-header">
    <h4 class="page-title">Create Timetable</h4>
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
        <a href="#">Create Timetable</a>
      </li>
    </ul>
  </div> <!-- End page-header -->




  <div class="row">
    <div class="col-md-12">
      <div class="card">

        <div class="card-header">
          <div class="card-title d-inline-block">Create Time</div>
          <a class="btn btn-info btn-sm float-right d-inline-block" href="{{route('admin.timetable.index') . '?language=' . request()->input('language')}}">
            <span class="btn-label">
              <i class="fas fa-backward" style="font-size: 12px;"></i>
            </span>
            Back
          </a>
        </div> <!-- end card-header -->


        <div class="card-body pt-5 pb-5">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">



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
          </div>
        </div> <!-- end card-body -->



        <div class="card-footer">
          <div class="form">
            <div class="form-group from-show-notify row">
              <div class="col-12 text-center">
                <button type="submit" id="submitBtn" class="btn btn-success">Submit</button>
              </div>
            </div>
          </div>
        </div> <!-- end card-footer -->

      </div> <!-- end card -->

    </div> <!-- end col-md-12 -->
  </div>  <!-- End row -->



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
