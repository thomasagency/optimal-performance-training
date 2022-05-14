@extends('admin.layout')

@if(!empty($event->language) && $event->language->rtl == 1)
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
    <h4 class="page-title">Edit Timetable</h4>
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
        <a href="#">Edit Timetable</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">Edit Timetable</div>
          <a class="btn btn-info btn-sm float-right d-inline-block" href="{{route('admin.timetable.index') . '?language=' . request()->input('language')}}">
            <span class="btn-label">
              <i class="fas fa-backward" style="font-size: 12px;"></i>
            </span>
            Back
          </a>
        </div>
        <div class="card-body pt-5 pb-5">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
                {{-- Slider images upload start --}}
                {{-- <div class="px-2">
                    <label for="" class="mb-2"><strong>Slider Images **</strong></label>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped" id="imgtable">
                                @if (!is_null($timetable->image))
                                    @foreach(json_decode($timetable->image) as $key => $img)
                                        <tr class="trdb" id="trdb{{$key}}">
                                            <td>
                                                <div class="thumbnail">
                                                    <img style="width:150px;" src="{{asset('assets/front/img/timetable/sliders/'.$img)}}" alt="Ad Image">
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger pull-right rmvbtndb" onclick="rmvdbimg({{$key}},{{$timetable->id}})">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                    </div>
                    <form action="" id="my-dropzone" enctype="multipart/formdata" class="dropzone create">
                        @csrf
                        <div class="fallback">
                        </div>
                    </form>
                    <p class="em text-danger mb-0" id="errimage"></p>
                </div> --}}
                {{-- Slider images upload end --}}
                
              <form id="ajaxForm" class="" action="{{route('admin.timetable.update')}}" method="post">
                @csrf
                <input type="hidden" name="event_id" value="{{$timetable->id}}">
                <input type="hidden" name="lang_id" value="{{$timetable->lang_id}}">

            
                {{-- START: slider Part --}}
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Slider Images ** </label>
                            <br>
                            <div class="slider-thumbs" id="sliderThumbs2">

                            </div>

                            <input id="fileInput2" type="hidden" name="slider" value="" />
                            <button id="chooseImage2" class="choose-image btn btn-primary" type="button" data-multiple="true" data-toggle="modal" data-target="#lfmModal2">Choose Images</button>


                            <p class="text-warning mb-0">JPG, PNG, JPEG images are allowed</p>
                            <p id="errslider" class="mb-0 text-danger em"></p>

                            <!-- slider LFM Modal -->
                            <div class="modal fade lfm-modal" id="lfmModal2" tabindex="-1" role="dialog" aria-labelledby="lfmModalTitle" aria-hidden="true">
                                <i class="fas fa-times-circle"></i>
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <iframe id="lfmIframe2" src="{{url('laravel-filemanager')}}?serial=2&event={{$timetable->id}}" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END: slider Part --}}

                <div class="form-group">
                  <label for="">Title **</label>
                  <input type="text" class="form-control" name="title" value="{{$timetable->title}}" placeholder="Enter title">
                  <p id="errtitle" class="mb-0 text-danger em"></p>
                </div>


                <div class="form-group">
                  <label for="">Category **</label>
                  <select class="form-control" name="time_categories_id">
                    <option value="" selected disabled>Select a category</option>
                    @foreach ($time_categories as $key => $time_category)
                      <option value="{{$time_category->id}}" {{$time_category->id == $timetable->timeCategories->id ? 'selected' : ''}}> {{$time_category->name}} </option>
                    @endforeach
                  </select>
                  <p id="errtime_categories_id" class="mb-0 text-danger em"></p>
                </div>


                <div class="form-group">
                      <label for="">Date</label>
                      <input type="date" class="form-control ltr" name="date" value="{{$timetable->date}}" placeholder="Enter Event Date">
                      <p id="errdate" class="mb-0 text-danger em"></p>
                  </div>


                   <div class="form-group">
                  <label for="">Day **</label>
                  <select class="form-control" name="day">
                    <option value="" selected disabled>Select a category</option>
                    
                <option value=" monday " <?php echo ($day == 'monday') ? 'selected' : ''; ?> > Monday </option>

                <option value="tuesday" <?php echo ($day == 'tuesday') ? 'selected' : ''; ?>>Tuesday</option>

                <option value="wednesday" <?php echo ($day == 'wednesday') ? 'selected' : ''; ?>>Wednesday</option>

                <option value="thursday" <?php echo ($day == 'thursday') ? 'selected' : ''; ?>>Thursday</option>

                <option value="friday" <?php echo ($day == 'friday') ? 'selected' : ''; ?>>Friday</option>

                <option value="saturday" <?php echo ($day == 'saturday') ? 'selected' : ''; ?>>Saturday</option>

                <option value="sunday" <?php echo ($day == 'sunday') ? 'selected' : ''; ?>>Sunday</option>
                    
                  </select>
                  <p id="errday" class="mb-0 text-danger em"></p>
                </div>


                  <div class="form-group">
                      <label for=Time>Start_Time</label>
                      <input type="time" class="form-control ltr" name="start_time" value="{{\Carbon\Carbon::parse($timetable->start_time)->format('H:i:s')}}" placeholder="Enter Start Time">
                      <p id="errstart_time" class="mb-0 text-danger em"></p>
                  </div>


                   <div class="form-group">
                      <label for=Time>End_Time</label>
            <input type="time" class="form-control ltr" name="end_time" value="{{\Carbon\Carbon::parse($timetable->end_time)->format('H:i:s')}}" placeholder="Enter End Time">
                      <p id="errend_time" class="mb-0 text-danger em"></p>
                  </div>


    
                  <div class="form-group">
                      <label for="">Trainer</label>
                      <input type="text" class="form-control ltr" name="trainer" value="{{$timetable->trainer}}" placeholder="Timetable">
                      <p id="errortrainer" class="mb-0 text-danger em"></p>
                  </div>



                     <div class="form-group">
                  <label for="">Color **</label>
                  <select name="color" class="form-control">
                <option value="1" <?php echo ($color == '1') ? 'selected' : ''; ?>>1</option>
                <option value="2" <?php echo ($color == '2') ? 'selected' : ''; ?>>2</option>
                <option value="3" <?php echo ($color == '3') ? 'selected' : ''; ?>>3</option>
                <option value="4" <?php echo ($color == '4') ? 'selected' : ''; ?>>4</option>
                <option value="5" <?php echo ($color == '5') ? 'selected' : ''; ?>>5</option>
            </select>
                  <p id="errcolor" class="mb-0 text-danger em"></p>
                </div>



                <div class="form-group">
                  <label for="">Content **</label>
                  <textarea class="form-control summernote" name="content" data-height="300" placeholder="Enter content">{{replaceBaseUrl($timetable->content)}}</textarea>
                  <p id="errcontent" class="mb-0 text-danger em"></p>
                </div>
                  

           
                <div class="form-group">
                  <label for="">Meta Keywords</label>
                  <input type="text" class="form-control" name="meta_tags" value="{{$timetable->meta_tags}}" data-role="tagsinput">
                  <p id="errmeta_keywords" class="mb-0 text-danger em"></p>
                </div>
                <div class="form-group">
                  <label for="">Meta Description</label>
                  <textarea type="text" class="form-control" name="meta_description" rows="5">{{$timetable->meta_description}}</textarea>
                  <p id="errmeta_description" class="mb-0 text-danger em"></p>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="form">
            <div class="form-group from-show-notify row">
              <div class="col-12 text-center">
                <button type="submit" id="submitBtn" class="btn btn-success">Update</button>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $("select[name='lang_id']").on('change', function() {
                $("#bcategory").removeAttr('disabled');
                let langid = $(this).val();
                let url = "{{url('/')}}/admin/event/" + langid + "/get-categories";
                $.get(url, function(data) {
                    console.log(data);
                    let options = `<option value="" disabled selected>Select a category</option>`;
                    for (let i = 0; i < data.length; i++) {
                        options += `<option value="${data[i].id}">${data[i].name}</option>`;
                    }
                    $("#bcategory").html(options);

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

            $("#upload-video").on('change',function (event){
                let formData = new FormData($('#video-frm')[0]);
                let file = $('input[type=file]')[0].files[0];
                // formData.append('upload_video', file, file.name);
                formData.append('upload_video', file);
                $.ajax({
                    url: '{{route('admin.event.upload')}}',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    cache: false,
                    data: formData,
                    success: function(data) {
                        console.log(data.filename,"edit");
                        $("#my_video").val(data.filename);
                        var url = '{{ asset("assets/front/img/events/videos/filename") }}';
                        url = url.replace('filename', data.filename);
                        $("#video_src").attr('src',url);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                })
            })
        });
    </script>
@endsection
