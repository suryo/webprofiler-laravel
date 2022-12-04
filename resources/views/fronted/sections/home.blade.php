@php 
if ($slider->type == 'image'):
    echo '
    <div class="slider-content" data-interval="'.$slider->text_rotator_interval.'" data-number="'.count($slider_images).'"';
        $i=1;
        foreach ($slider_images as $image):
            echo ' data-image-'.$i.'="'.$image->image.'" ';
            $i++;
        endforeach;
    echo '
    ></div>';
endif;
@endphp
<div class="pt-page css3animate p-0 homepage d-flex justify-content-center align-items-center {{$slider->color_scheme}}" data-colorScheme="{{$slider->color_scheme}}" data-overflow="0" 
    data-overlayColor="{{$slider->overlay_color}}"
    data-overlayType="{{$slider->overlay_type}}"
    data-overlayColor1="{{$slider->color_1}}"
    data-overlayColor2="{{$slider->color_2}}"
    data-overlayGradient="{{$slider->gradient_type}}">
    @if ($slider->text != '')
    <section>
        <div class="container">
            <div class="row">
                @php
                $texts = preg_split( "/\\r\\n|\\r|\\n/", $slider->text ); @endphp
                <div id="messages-content">
                    <div class="col-lg-10 offset-lg-1 messages" 
                        data-textrotator="{{$slider->text_rotator}}" 
                        data-interval="{{$slider->text_rotator_interval}}"
                        data-number="@php echo (count($texts)>1) ? 1 : 0; @endphp"
                        data-animationin="{{$slider->animation_in}}"
                        data-animationout="{{$slider->animation_out}}">
                        
                        @php
                        $texts = str_replace("/*", "<span class='underlined'>", $texts);
                        $texts = str_replace("*/", "</span>", $texts);
                            if ($slider->text_rotator == 1){
                                foreach ($texts as $text):
                                    echo'
                                    <div class="animate__animated animate__bounceOut">
                                        <h2 class="m-0 text-center">'.$text.'</h2>
                                    </div>';
                                endforeach;
                            } else {
                                if (is_array($texts)){
                                    $texts = $texts[0];
                                }
                                echo'
                                <div class="animate__animated animate__bounceOut">
                                    <h2 class="m-0 text-center">'.$texts.'</h2>
                                </div>';
                            }
                        @endphp
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    @if ($slider->type == 'video')      
        <div class="video-controls">
            <button id="play_video"><i class="fas fa-play"></i></button>
            <button id="pause_video"><i class="fas fa-pause"></i></button>
            <button id="mute_video" class="d-none"><i class="fas fa-volume-mute"></i></button>
            <button id="unmute_video"><i class="fas fa-volume-up"></i></button>
        </div>
    @endif
</div>