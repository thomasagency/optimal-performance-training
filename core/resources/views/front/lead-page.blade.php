@extends("front.$version.layout")

@section('pagename')
- {{__('Lead Page')}}
@endsection


<!-- @section('meta-keywords', "$be->contact_meta_keywords")
@section('meta-description', "$be->contact_meta_description")

@section('breadcrumb-title', $bs->contact_title)
@section('breadcrumb-subtitle', $bs->contact_subtitle)
@section('breadcrumb-link', __('Lead Page')) -->

@section('content')




div id="pcon">
    
<div class="pb_section" id="sec_0">
    
<div class="pb_row pb_row-pad" id="row_0">
    
<div class="pb_col pb_col-1-2" id="col_0">
    
<div id="element_0_loop">
    
<div class="el_type_image" id="element_0">
    
<div id="element_image_0" class="">
    
<img src="{{asset('assets/front/images/user/Instagram_Post.png')}}">

</div>

</div>

</div>

</div>

<div class="pb_col pb_col-1-2" id="col_1">
    
<div class="el_type_text" id="element_1">
    
<div id="element_text_1">
    
<span class="el_text dynva">Learn The '7 Best Tips' To Staying Fit &amp; Healthy! <em>A Must Read For Staying Healthy</em>...</span>

</div>

</div>

<div class="el_type_text" id="element_2">
    
<div id="element_text_2">
    
<span class="el_text dynva">Tell us where to send it below!</span>

</div>

</div>

<div class="el_type_email" id="element_3">
    
<div id="element_email_3">
    
<div class="frm_name frm_firstname">
    
<input type="text" name="name" placeholder="Your name">

</div>

<div class="frm_email">
    
<input type="email" name="email" placeholder="Your email address">

</div>

<div class="frm_btn brightup">
    
<div class="frm_btn_cont dynva">Discover The Health Tips Now!</div>

</div>

<div class="frm_thankyou dynva">Thank you!</div>

</div>

</div>

<div class="el_type_text" id="element_4">
    
<div id="element_text_4">
    
<span class="el_text dynva">We will never send spam or share your details</span>

</div>

</div>

</div>

</div>

</div>

<div id="contest_overlay" title="Click to close" style="cursor:pointer"></div>


<div id="contest_popup">
    
    <div class="cp_title">Thanks for subscribing. Share your unique referral link to get points to win prizes..</div>
    
    <div class="cp_video">
        <iframe width="560" height="315" frameborder="0" allowfullscreen></iframe>
    </div>
    
    <div class="cp_input">
        <input type="text" value="" onClick="this.setSelectionRange(0, this.value.length)">
    </div>
    
    <div class="cp_share">
        
        <div class="cp_share_wrap">
            
            <div class="social_wrap brightup social_delicious facebook sh_item hvr-grow-rotate">
                
                <a href="" target="_blank">
                <div class="social_icon sh_icon">
                    <i class="icons8-facebook-2"></i>
                </div>
                
                <div class="social_text sh_text">
                    Like
                </div>
                </a>
            </div>
            
            <div class="social_wrap brightup social_delicious twitter sh_item hvr-grow-rotate">
                
                <a href="" target="_blank">
                <div class="social_icon sh_icon">
                    <i class="icons8-twitter"></i>
                </div>
                <div class="social_text sh_text">
                    Tweet
                </div>
                </a>
            </div>
            
            <div class="social_wrap brightup social_delicious google sh_item hvr-grow-rotate">
                
                <a href="" target="_blank">
                    
                <div class="social_icon sh_icon">
                    <i class="icons8-google-plus"></i>
                </div>
                
                <div class="social_text sh_text">
                    Share
                </div>
                </a>
            </div>
            
            <div class="social_wrap brightup social_delicious pinterest sh_item hvr-grow-rotate">
                <a href="" target="_blank">
                <div class="social_icon sh_icon">
                    <i class="icons8-pinterest-filled"></i>
                </div>
                <div class="social_text sh_text">
                    Pin
                </div>
                </a>
            </div>
            
        </div>
    </div>
    
    <!-- <div class="cp_button brightup" onclick="igloo.goToContestResults()">
        Go to the contest stats page
    </div> -->
    
    <div class="cp_close" onclick="igloo.closeContestPopup()">
        <span class="icons8-delete-2"></span>
    </div>
</div>


<div id="contest_results">
    <div class="cs_title"></div>
    <div class="cs_points_description">Loading..</div>
    <div class="cs_points"></div>
    <div class="cs_rank_description"></div>
    <div class="cs_rank"></div>
    <div class="cp_share" style="margin-top:50px">
        <div class="cp_share_wrap">
            <div class="social_wrap brightup social_delicious facebook sh_item2 hvr-grow-rotate">
                <a href="" target="_blank">
                <div class="social_icon sh_icon">
                    <i class="icons8-facebook-2"></i>
                </div>
                <div class="social_text sh_text">
                    Like
                </div>
                </a>
            </div>
            <div class="social_wrap brightup social_delicious twitter sh_item2 hvr-grow-rotate">
                <a href="" target="_blank">
                <div class="social_icon sh_icon">
                    <i class="icons8-twitter"></i>
                </div>
                <div class="social_text sh_text">
                    Tweet
                </div>
                </a>
            </div>
            <div class="social_wrap brightup social_delicious google sh_item2 hvr-grow-rotate">
                <a href="" target="_blank">
                <div class="social_icon sh_icon">
                    <i class="icons8-google-plus"></i>
                </div>
                <div class="social_text sh_text">
                    Share
                </div>
                </a>
            </div>
            <div class="social_wrap brightup social_delicious pinterest sh_item2 hvr-grow-rotate">
                <a href="" target="_blank">
                <div class="social_icon sh_icon">
                    <i class="icons8-pinterest-filled"></i>
                </div>
                <div class="social_text sh_text">
                    Pin
                </div>
                </a>
            </div>
        </div>
    </div>
    <div class="cs_close" onclick="igloo.closeContestResults()">
        <span class="icons8-delete-2"></span>
    </div>
</div>

<div id="contest_results_icon" title="Show Contest Results">
    <img src="{{asset('assets/front/images/score.png')}}">
</div>

</div>





@endsection
