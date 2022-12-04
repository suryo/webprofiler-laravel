<div id="main-footer">
    <footer class="pt-9 pb-4b py-5 hide border-top">
        <div class="container">
            
            @if ($footer->columns != 0)
            <div class="row mb-4 mb-md-5">
                
                @php            
                for($i=1; $i <= $footer->columns; $i++){
                    $title = 'column_'.$i.'_title';
                    $subtitle = 'column_'.$i.'_subtitle';
                    $content = 'column_'.$i.'_content';
                    $social = 'column_'.$i.'_social';
                    $marginTop = ($i != 1) ? ' mt-2' : '';
                    $marginBottom = ($i != $footer->columns) ? ' mb-4' : '';
                    echo'
                    <div class="col-12 col-sm-'.(12/$footer->columns).$marginTop.$marginBottom.' my-md-0 pe-0 pe-md-5">
                        <p class="mb-1 mb-md-2 fnt-small text-uppercase">'.$footer->$subtitle.'</span>
                        <h3 class="mb-2 mb-md-4">'.$footer->$title.'</h3> 
                        <p class="m-0">'.html_entity_decode($footer->$content).'</p>';
                        if (!empty($general->social_links) && ($general->social_links != '[]') && ($footer->$social == 1)){
                        echo'
                        <p class="social-icons d-flex align-items-center mt-2 mt-md-3 mb-0">';
                            $social_links = json_decode($general->social_links);
                            foreach($social_links as $key){
                                $title = explode("-",substr($key->title, 7));
                                echo '<a href="'.$key->text.'" class="css3animate p-0 me-3" title="'.ucfirst($title[0]).'" data-bs-toggle="tooltip" data-bs-placement="bottom"><i class="'.$key->title.'"></i></a>';
                            }
                        echo'</p>';
                        }
                    echo '</div>';
                }
                @endphp
            </div>
            @endif

            @if ($footer->copyright != '')
            <div class="row">
                <div class="col-12 border-top mt-3 mt-md-4 pt-4 pt-md-5 pb-4 pb-md-0">
                    <p class="copyright text-center m-0">
                        {!!$footer->copyright!!}
                    </p>
                </div>
            </div>
            @endif
            
        </div>
        
        @if ($footer->top_button == 1)
        <a href="#" class="toTop css3animate p-0 m-0 rounded-circle text-center" title="{{ $general->title }} - top">
            <i class="fas fa-chevron-up"></i>
        </a>
        @endif

    </footer>
</div>