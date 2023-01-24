@extends('admin.layout')
<?php
$project_address= json_decode($data ["raw"]["project_address"], true);
$embd_video= json_decode($data ['raw']['embd_video'], true);
$embds_videos= json_decode($data ['raw']['embds_videos'], true);
$mobile_video= json_decode($data ['raw']['mobile_video'], true);
$card_image= json_decode($data ['raw']['card_image'], true);
$section_items = json_decode($data ['raw']['section_items'], true);
// $social = json_decode($data['raw']['social'], true);
$in_progress = json_decode($data["raw"]["in_progress"]);
// echo "<pre>";
// print_r($data);
// echo "</pre>"; 
// exit; 
?>
@section('content')
    <form class="d-fc" action="/enter/projects/update/{{ $data['raw']['id'] }}" method="post" enctype="multipart/form-data">
        @csrf
              
        <!-- {{-- <h5 id="countdown">სესია მოკვდება 24:00:00 საათში</h5> --}} -->
        <!-- <div class="projects-page-wrapper d-fc admin-create">
            <div class="modal-content modal-custom modal-1160 modal-projects mx-auto mb-3 pb-3">
                <div class="top-misc">
                    <h3 class="modal-title">გარე ნამუშევარი</h3>
                </div>

                <div class="d-fc">
                    <label class="mb-5">
                        <h5 class="text-center">ნამუშევრის სათაური</h5>
                        <input type="text" name="project_title" id="project-title" class="form-control w-50 mx-auto text-center" placeholder="ნამუშევრის სათაური" required>
                    </label>

                    <label class="image-reader-wrapper admin-outer-project size-accordingly mx-auto mb-2" for="card-image-input" data-size-target="#card-image">
                        <img class="image-loader" src="{{ asset('images/enter/upload-any-200.jpg') }}" id="card-image">
                        <span class="dire-edit"></span>
                        <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="card_image1" id="card-image-input" required>
                        <div class="background-layer"></div>
                        <span class="title">სათაურის მინიჭება ქვემოთაა</span>
                        <span class="category">კატეგორიების მითითება ქვემოთაა</span>
                    </label>

                    {{-- <div class="size-accordingly admin-outer-project mx-auto mb-2" data-size-target="#card-image">
                        <div class="hover-layer d-fc">
                            <span class="title">სათაურის მინიჭება ქვემოთაა</span>
                            <span class="category">კატეგორიების მითითება ქვემოთაა</span>
                            <p class="description" contenteditable="true" data-text-to-value="#card-description-input-ka">დააჭირეთ ტექსტი რომ შეცვალოთ</p>
                            <a href="#">
                                <span>დაწვრილებით</span>
                                <img src="{{ asset('images/xd-icons/white/arrow-right.svg') }}">
                            </a>
                        </div>
                    </div> --}}

                    {{-- <input type="hidden" class="form-control text-center mt-1 mb-3 w-50 mx-auto" name="card_image_alt" value="{{ old('card_image_alt') }}" placeholder="სურათის alt ინფორმაცია" required> --}}
                    {{-- <button type="button" class="universal-button w-50 mx-auto" id="resize-accordingly-button">თუ სურათის შეცვლისას ის გაიჟონა ამ ღილაკს დააჭირეთ</button> --}}

                    <div class="d-fc admin-outer-project mx-auto mt-3">
                        <p>მიმდინარია თუ არა</p>
                        <div class="d-flex justify-content-center">
                            <label class="d-flex align-items-center mr-3">
                                <span class="mr-2">კი</span>
                                <input type="radio" name="in_progress" value="true">
                            </label>
                            <label class="d-flex align-items-center">
                                <span class="mr-2">არა</span>
                                <input type="radio" name="in_progress" value="false" checked>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         -->
        <div class="projects-page-wrapper d-fc admin-create">
            <div class="modal-content modal-1160 modal-custom modal-projects mx-auto p-5 mb-3">
            <!-- <label class="image-reader-wrapper admin-outer-project size-accordingly mx-auto mb-2" for="card-image-input" data-size-target="#card-image">
                        <img class="image-loader" src="{{ asset('images/enter/upload-any-200.jpg') }}" id="card-image">
                        <span class="dire-edit"></span>
                        <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="card_image2" id="card-image-input" required>
                        <div class="background-layer"></div>
                        <span class="title">სათაურის მინიჭება ქვემოთაა</span>
                        <span class="category">კატეგორიების მითითება ქვემოთაა</span>
                    </label> -->

                <!-- <div class="top-misc">
                    <h3 class="modal-title">ნამუშევრის შესახებ</h3>
                </div> -->
                <div class="row align-items-center">
                   <div class="col-5 d-flex">
                        <label  class="col-form-label w-25">ნამუშევრის დასახელება</label>
                        <input type="text" name="project_title" id="project-title" class="form-control w-50 mx-auto text-center" placeholder="დაასათაურეთ" value="{{ $data['title']['ka'] }}" required >
                    </div>
                    <div class="col-5 d-flex">
                            <label  class="col-form-label w-25">კატეგორია</label>
                            @foreach ($data['categories'] as $index => $category)
                                @if ( $index == 0 )
                                    <div class="d-flex">
                                        <select class="form-control mb-3" name="categories[]" required>
                                            <option value="designer" {{ $category == 'designer' ? ' selected' : '' }}>დიზაინერი</option>
                                            <option value="repairs" {{ $category == 'repairs' ? ' selected' : '' }}>რემონტი</option>
                                            <option value="furniture" {{ $category == 'furniture' ? ' selected' : '' }}>ავეჯის დამზადება</option>
                                            <option value="vip" {{ $category == 'vip' ? ' selected' : '' }}>VIP მასტერი</option>
                                        </select>
                                    </div>
                                @else
                                    <div class="d-flex">
                                        <select class="form-control mb-3" name="categories[]" required>
                                            <option value="designer" {{ $category == 'designer' ? ' selected' : '' }}>დიზაინერი</option>
                                            <option value="repairs" {{ $category == 'repairs' ? ' selected' : '' }}>რემონტი</option>
                                            <option value="furniture" {{ $category == 'furniture' ? ' selected' : '' }}>ავეჯის დამზადება</option>
                                            <option value="vip" {{ $category == 'vip' ? ' selected' : '' }}>VIP მასტერი</option>
                                        </select>
                                        <button type="button" class="delete-this-category universal-button bg-danger ml-3">წაშლა (2x)</button>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                 </div>

                 <div class="row  align-items-center">
                   <div class="col-4 d-flex">
                        <label  class="col-form-label w-25">ობიექტის მისამართი:</label>
                            @if($project_address)
                            <input type="text" id="address" class="form-control" name="project_address" placeholder="Address" value="{{ $project_address['ka']}}" >
                            @else
                            <input type="text" id="address" class="form-control" name="project_address" placeholder="Address" >
                            @endif
                    </div>
                    <div class="col-4 d-flex">
                        <label class="form-label w-25">დამკვეთი:</label>
                           <div class="d-flex">
                            <input class="form-control" type="text" name="customer" value="{{ $data['raw']['customer'] }}" />
                           </div>
                        </div>
                   <div class="col-4 d-flex">
                        <label class="form-label w-25">          
                        კომპანიის ლოგო:
                        </label>
                        <div class="d-flex">
                            <input class="form-control image-input " type="file" name="card_image" id="card-image-input"  accept="image/png, image/jpeg" >
                            <input type="hidden" name="old_card_image" value="{{ $data['raw']['card_image'] }}">
                        <!-- <img src="/{{ substr($card_image['location'],0,strpos($card_image['location'],'?')) }}" width="20%" alt="{{ $card_image['alt'] }}"> -->
                    
                        </div>
                    </div>
                    <div class="form-check pl-3 d-flex">
                        <label class="form-label w-15">Პროგრესირებს</label>
                        <div class="form-check form-check-inline pl-3 d-flex">
                            <input class="form-check-input" type="radio" <?php if($in_progress == 'true') echo "checked";   ?> name="in_progress" id="inlineRadio11" value="true">
                            <label class="form-check-label" for="inlineRadio11">დიახ</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" <?php if($in_progress != 'true') echo "checked";  ?> name="in_progress" id="inlineRadio12" value="false">
                            <label class="form-check-label" for="inlineRadio12">არა</label>
                        </div>
                    </div>
                 </div>

                        <!-- mobile video work  -->
                        
                                        <?php $flage=true; $x=1;?>
                            @if(!empty($section_items))
                                @foreach($section_items as $i => $item)
                                    @if($item['type']=='mobile_video')
                                    <?php $flage=false ?>
                                    <div class="row pt-1 align-items-center d-flex">
                                        <div class="col-8 d-flex">
                                            <label  class="form-label w-30"> მობილური ვიდეო <?=$x?></label>
                                             <textarea class="form-control w-100  border-top-0 border-left-0 border-right-0" id="embed_video<?=$x++?>" name="mobile_video[]" rows="1"><?php echo $item['code'] ?></textarea>
                                        </div>
                                     
                                    </div>
                                    @endif
                                @endforeach
                                @endif
                            @if($flage)
                            <hr> <br>
                            
                            <div class="row pt-2 align-items-center d-flex">
                               <div class="col-8 d-flex">
                                    <label  class="form-label w-30">მობილური ვიდეო1</label>
                                    <textarea class="form-control w-100  border-top-0 border-left-0 border-right-0" id="mobile_video1" name="mobile_video[]" rows="1"></textarea>
                                </div>
                                <div class="col-8 d-flex">
                                    <label  class="form-label w-30">მობილური ვიდეო2</label>
                                    <textarea class="form-control w-100  border-top-0 border-left-0 border-right-0" id="mobile_video2" name="mobile_video[]" rows="1"></textarea>
                                </div>
                            </div>
                            @endif
                        <!-- mobile video work  -->
                            <?php $flage=true; $x=1;?>
                            @if(!empty($section_items))
                                @foreach($section_items as $i => $item)
                                    @if($item['type']=='video')
                                    <?php $flage=false ?>
                                    <div class="row pt-1 align-items-center">
                                        <div class="col-8 d-flex">
                                            <label  class="form-label w-30"> რემონტამდე (ვიდეო) <?=$x?></label>
                                             <textarea class="form-control w-100  border-top-0 border-left-0 border-right-0" id="embed_video<?=$x++?>" name="amount_of_videos[]" rows="1"><?php echo $item['code'] ?></textarea>
                                        </div>
                                        <!-- <div class="col-4 d-flex">
                                            <label  class="form-label w-30">ტექსტი (ვიდეო) <?//=$x?></label>
                                            <input type="text" class="form-control w-100"  name="text_video_<?//=$x++?>" value="{{ $item['text'] }}">
                                        </div> -->
                                    </div>
                                    @endif
                                @endforeach
                                @endif
                            @if($flage)
                            <hr> <br> <br>
                            
                            <div class="row pt-2 align-items-center">
                            <div class="col-8 d-flex">
                                    <label  class="form-label w-30">რემონტის შემდეგ (ვიდეო)</label>
                                        
                                        <textarea class="form-control w-100  border-top-0 border-left-0 border-right-0" id="embed_video1" name="amount_of_videos[]" rows="1"></textarea>
                                        
                                </div>
                                <!-- <div class="col-4 d-flex">
                                    <label  class="form-label w-30">ტექსტი (ვიდეო) 1</label>
                                    <input type="text" class="form-control w-100"  name="text_video_1">
                                </div> -->
                            </div>
                            <div class="row pt-2 align-items-center">
                            <div class="col-8 d-flex">
                                    <label  class="form-label w-30">რემონტის შემდეგ (ვიდეო)</label>
                                        
                                        <textarea class="form-control w-100  border-top-0 border-left-0 border-right-0" id="embed_video2" name="amount_of_videos[]" rows="1"></textarea>
                                        
                                </div>
                                <!-- <div class="col-4 d-flex">
                                    <label  class="form-label w-30">ტექსტი (ვიდეო) 2</label>
                                    <input type="text" class="form-control w-100"  name="text_video_2" >
                                </div> -->
                            </div>
                            @endif
                    
                 
                 <div class="row pt-2 align-items-center">
                 <div class="col-5 d-flex">
                        <label class="form-label w-25">სურათები (დესკტოპი):</label>
                        <input class="form-control" type="file" name="amount_of_images[]" multiple>
                    </div>
                 </div>
                 <div class="row pt-2 align-items-center">
                 <div class="col-5 d-flex">
                        <label class="form-label w-25">სურათები (მობილური)</label>
                        <input class="form-control" type="file" name="amount_of_mobile_images[]"  multiple>
                    </div>
                 </div>
                 <div class="form-check pl-0 d-flex">
                   <label class="form-label w-15">ფოტოს ფორმატი</label>
                   <div class="form-check form-check-inline pl-3 d-flex">
                        <input class="form-check-input" type="radio" {{ $section_items == 'jpg' ? ' checked' : '' }} name="img_format" id="inlineRadio1" value="jpg">
                        <label class="form-check-label" for="inlineRadio1">JPG</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" {{ $section_items == 'jpeg' ? ' checked' : '' }} name="img_format" id="inlineRadio2" value="jpeg">
                        <label class="form-check-label" for="inlineRadio2" >JPEG</label>
                    </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" {{ $section_items == 'png' ? ' checked' : '' }} name="img_format" id="inlineRadio2" value="png">
                            <label class="form-check-label" for="inlineRadio2">PNG</label>
                        </div>
                        <!-- <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" {{ $section_items == 'webp' ? ' checked' : '' }}  name="img_format" id="inlineRadio2" value="webp">
                            <label class="form-check-label" for="inlineRadio2">WEBP</label>
                        </div> -->
                    </div>
                    <div class="group" id="desktop_img">
                       <label class="form-label w-25">ატვირთული სურათები (დესკტოპი):</label>
                       <?php $desk=0;?>
                       @if(!empty($section_items))
                       
                                @foreach($section_items as $i => $item)
                                    @if($item['type']=='image')
                      <div class="d-flex pt-2 w-50 img-div">
                        <div class="border w-25"><input type="checkbox" class="checkbox" <?php echo isset($item['is_feature'])?$item['is_feature']=='1'?'checked':'':'' ?> name="image_desktop_feature_<?=$item['item-number']?>" >მთავარი?</div>
                                <!-- <input type="hidden" name="old_images_desktop[]" value="{{ json_encode($item) }}"> -->
                                <img class="my" src="{{ asset($item['location']) }}" alt="{{ asset($item['alt']) }}" width="50px" height="50px">
                                <input type="hidden" name="desktop_img[]" value="{{ $item['item-number'] }}">
                                <input type="hidden" name="old_images_desktop_<?=$item['item-number']?>" class="d-none" value="{{ $item['location'] }}" />            
                                <input type="hidden" name="old_thumbnail_desktop_<?=$item['item-number']?>" class="d-none" value="{{ $item['thumbnail'] }}" />            
                                
                               
                                
                                
                            <div class="border w-25">
                                <!-- <h1></h1> -->
                                <form ></form>
                                <form action="/enter/project-image/delete/hard"  method="post" class="pl-1">
                                    @csrf
                                    <input type="hidden" name="id_string" value="{{ $data['raw']['id'] }}" >
                                    <input type="hidden" name="item_number" value="<?=$item['item-number']?>" >
                                    <input type="hidden" name="type" value="<?=$item['type']?>" >
                                    <input type="hidden" name="img_<?=$item['item-number']?>" value="{{ $item['location'] }}" >
                                    <input type="hidden" name="img_thumb_<?=$item['item-number']?>" value="{{ $item['thumbnail'] }}" >
                                    <button type="submit"  class="btn w-100 remove "  >წაშლა</button>
                                </form>

                            </div>
                       </div>
                       <?php $desk=$item['item-number']; ?>
                       @endif
                        @endforeach
                        <?php $desk++; ?>
                        @endif 
                        <input type="hidden" id="next_desk_img" value="<?=$desk?>">
                    </div>
                    <div class="group" id="mobile_img">
                    <label class="form-label w-25">ატვირთული სურათები (მობილური):</label>
                    <?php $mobi=0;?>
                    @if(!empty($section_items))
                                @foreach($section_items as $i => $item)
                                    @if($item['type']=='mobile_image')
                      <div class="d-flex pt-2 w-50 img-div">
                        <div class="border w-25"><input type="checkbox" class="checkbox" <?php echo isset($item['is_feature'])?$item['is_feature']=='1'?'checked':'':'' ?> name="image_mobile_feature_<?=$item['item-number']?>" >მთავარი?</div>
                                <!-- <input type="hidden" name="old_images_mobile[]" value="{{ json_encode($item) }}"> -->
                        
                                <img class="my" src="{{ asset($item['location']) }}" alt="{{ asset($item['alt']) }}" width="50px" height="50px">
                                <input type="hidden" name="mobi_img[]" value="{{ $item['item-number'] }}">
                                <input type="hidden" name="old_images_mobile_<?=$item['item-number']?>" class="d-none" value="{{ $item['location'] }}" />                    
                                <input type="hidden" name="old_thumbnail_mobile_<?=$item['item-number']?>" class="d-none" value="{{ $item['thumbnail'] }}" />            
                                
                               
                                
                                
                            <div class="border w-25">
                                <form ></form>

                                <form action="/enter/project-image/delete/hard"  method="post" class="pl-1">
                                    @csrf
                                    <input type="hidden" name="item_number" value="<?=$item['item-number']?>" >
                                    <input type="hidden" name="type" value="<?=$item['type']?>" >
                                    <input type="hidden" name="id_string" value="{{ $data['raw']['id'] }}" >
                                    <input type="hidden" name="img_<?=$item['item-number']?>" value="{{ $item['location'] }}" >
                                    <input type="hidden" name="img_thumb_<?=$item['item-number']?>" value="{{ $item['thumbnail'] }}" >
                                    <button type="submit"  class="btn w-100 remove">წაშლა</button>
                                </form>

                            </div>
                       </div>
                       <?php $mobi=$item['item-number']; ?>
                       @endif
                        @endforeach
                        <?php $mobi++; ?>
                        
                        @endif 
                        <input type="hidden" id="next_mobi_img" value="<?=$mobi?>">
                    </div>
                    <!-- <div class="pt-5">
                        <label class="form-label w-25">სოციალური ბმულები:</label>
                        <div class="row">
                            <div class="col-3">Facebook:<input type="text" class="form-control" name="links[facebook]" placeholder="Facebook" value="<?=$social['facebook']??''?>" /></div>
                            <div class="col-3">Instagram:<input type="text" class="form-control" name="links[instagram]" placeholder="Instagram" value="<?=$social['instagram']??''?>"/></div>
                            <div class="col-3">Pinterest:<input type="text" class="form-control" name="links[pinterest]" placeholder="Pinterest" value="<?=$social['pinterest']??''?>"/></div>
                        </div>
                    </div> -->
                    <div class="pt-5">
                        <div class="">
                           <input class="form-check-input" {{$data ["raw"]['show_on_homepage']?'checked':''}}  type="checkbox" name="show_on_homepage" id="inlineRadio2" value="1">
                           <label class="form-check-label" for="inlineRadio2">აჩვენე პროექტი მთავარ გვერდზე</label>
                        </div>
                        <div class="">
                            <input class="form-check-input" {{$data ["raw"]['show_on_servicepage']?'checked':''}} type="checkbox" name="show_on_servicepage" id="inlineRadio2" value="1">
                            <label class="form-check-label" for="inlineRadio2">აჩვენე პროექტი სერვისის გვერდზე</label>
                      </div>
                    </div>
                    <!-- <div  class="float-right">
                        <button class="btn btn-primary float-right ">upload</button>
                    </div> -->
                </div>

                <!-- {{-- <div class="universal-banner-wrapper">
                    <div class="image-wrapper">
                        <label class="image-reader-wrapper d-fc" for="banner">
                            <img class="image-loader" src="{{ asset('images/enter/upload-1160-290.jpg') }}">
                            <span class="dire-edit"></span>
                            <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="banner" id="banner" required>
                            <div class="background-layer"></div>
                        </label>
                        <input type="text" class="form-control w-75 mx-auto text-center" name="banner_alt" value="{{ old('banner_alt') }}" placeholder="ბანერის alt ინფორმაცია" required>
                    </div>
                    <div class="text-wrapper d-fc">
                        <h2 contenteditable="true" data-text-to-value="#title-input-ka">სათაური, დააჭირეთ რომ შეცვალოთ</h2>
                    </div>
                </div> --}} -->

                <!-- <div class="categories-wrapper container-1020 d-fc mb-5">
                    <button type="button" class="add-categories universal-button w-100 mb-3">კატეგორიების დამატება (გთხოვთ კატეგორიები არ გაიმეოროთ)</button>
                    <div class="d-flex">
                        <select class="form-control mb-3" name="categories[]">
                            <option value="designer">დიზაინერი</option>
                            <option value="repairs">რემონტი</option>
                            <option value="furniture">ავეჯის დამზადება</option>
                            <option value="vip">VIP მასტერი</option>
                        </select>
                    </div>
                </div> -->

                <!-- {{-- <div class="project-information container-1020" contenteditable="true" data-html-to-value="#information-input-ka">
                    <p>დააჭირეთ რედაქტირება რომ დაიწყოთ</p>
                </div> --}}

                <div class="project-gallery container-1020" id="ka">
                    <button type="button" class="universal-button w-100 mb-5 add-sections">სექციის დამატება</button>
                </div>
            </div>
        </div> -->
<!-- 
        {{-- Italian --}}
            {{-- <button class="s-collapse active modal-1160 mx-auto mt-5" type="button" data-target="#it-wrapper" style="color: purple; border-color: purple;">იტალიანო</button>
            <div class="s-collapse d-fc show" id="it-wrapper">
                <div class="projects-page-wrapper d-fc admin-create">
                    <div class="modal-content modal-custom modal-1160 modal-projects mx-auto mb-3 pb-3">
                        <div class="top-misc">
                            <h3 class="modal-title">გარე ნამუშევარი</h3>
                        </div>

                        <div class="d-fc">
                            <div class="size-accordingly admin-outer-project mx-auto mb-2" data-size-target="#card-image">
                                <div class="hover-layer d-fc">
                                    <span class="title">სათაურის მინიჭება ქვემოთაა</span>
                                    <span class="category">კატეგორიების მითითება ქვემოთაა</span>
                                    <p class="description" contenteditable="true" data-text-to-value="#card-description-input-it">დააჭირეთ ტექსტი რომ შეცვალოთ</p>
                                    <a href="#">
                                        <span>დაწვრილებით</span>
                                        <img src="{{ asset('images/xd-icons/white/arrow-right.svg') }}">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                
                <!-- <div class="projects-page-wrapper d-fc admin-create">
                    <div class="modal-content modal-1160 modal-custom modal-projects mx-auto mb-3">
                        <div class="top-misc">
                            <h3 class="modal-title">ნამუშევრის შესახებ</h3>
                        </div>

                        <div class="universal-banner-wrapper">
                            <div class="image-wrapper">
                                <label class="image-reader-wrapper d-fc">
                                    <img class="image-loader" src="{{ asset('images/enter/upload-1160-290.jpg') }}">
                                    <div class="background-layer"></div>
                                </label>
                            </div>
                            <div class="text-wrapper d-fc">
                                <h2 contenteditable="true" data-text-to-value="#title-input-it">სათაური, დააჭირეთ რომ შეცვალოთ</h2>
                            </div>
                        </div>

                        <div class="project-information container-1020" contenteditable="true" data-html-to-value="#information-input-it">
                            <p>დააჭირეთ რედაქტირება რომ დაიწყოთ</p>
                        </div>

                        <div class="project-gallery container-1020" id="it">
                        </div>
                    </div>
                </div>
            </div> --}} -->
        {{-- Italian --}}

        <div class="modal-content modal-1160 border-0 mx-auto">
            <button type="submit" class="universal-button ml-auto">ატვირთვა</button>
        </div>

        @foreach ( ['ka', 'it'] as $locale)    
            {{-- <input type="hidden" name="card_description_{{ $locale }}" id="card-description-input-{{ $locale }}" value="დააჭირეთ ტექსტი რომ შეცვალოთ" required> --}}
            <input type="hidden" name="title_{{ $locale }}" id="title-input-{{ $locale }}" value="სათაური, დააჭირეთ რომ შეცვალოთ" required>
            <input type="hidden" name="address_{{ $locale }}" id="address-input-{{ $locale }}" value="სათაური, დააჭირეთ რომ შეცვალოთ" required>
            <input type="hidden" name="embds_videos_{{ $locale }}" id="embds-input-{{ $locale }}" value="სათაური, დააჭირეთ რომ შეცვალოთ" required>
            <input type="hidden" name="embd_video_{{ $locale }}" id="embd-input-{{ $locale }}" value="სათაური, დააჭირეთ რომ შეცვალოთ" required>
            <input type="hidden" name="information_{{ $locale }}" id="information-input-{{ $locale }}" value='<p>დააჭირეთ რედაქტირება რომ დაიწყოთ</p>' required>
        @endforeach
    </form>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            // jQuery('.remove').click(function(){
            //         // jQuery(this).parents('.img-div').remove();
            //         var name=$(this).data('name');
            //         var form=$('form[name="'+name+'"]')//.serialize();
            //         console.log(name,"form");
            //     });
            var desk=jQuery('#next_desk_img').val();
            jQuery('input[name="amount_of_images[]"]').on('change',function(){
                var files = jQuery(this).prop("files");
                console.log(files.length,"len");
                for(var i = 0 ; i < this.files.length; i++){
                    var fileName = this.files[i].name;
                    console.log(this.files,i);
                    jQuery('#desktop_img').append('<div class="d-flex pt-2 w-50 img-div">'+
                        '<div class="border w-25"><input type="checkbox" class="checkbox" name="image_desktop_feature[]" >მთავარი?</div>'+
                        '<div class="border w-25" id="preview-'+i+'">'+
                        '<input type="hidden" name="desktop_img[]" value="'+ desk++ +'">'+
                        '</div>'+
                        '<div class="border w-25"><button type="button" class="btn w-100 remove">Delete</button></div>'+
                       '</div>');
                       preview(files[i],i,'preview');
                    
                    
                }
                jQuery('.remove').click(function(){
                    jQuery(this).parents('.img-div').remove();
                });
            });
            var mobi=jQuery('#next_mobi_img').val();
            jQuery('input[name="amount_of_mobile_images[]"]').on('change',function(){
                var files = jQuery(this).prop("files");
                
                for(var i = 0 ; i < this.files.length; i++){
                    var fileName = this.files[i].name;
                    console.log(this.files,i);
                    jQuery('#mobile_img').append('<div class="d-flex pt-2 w-50 img-div">'+
                        '<div class="border w-25"><input type="checkbox" class="checkbox" name="image_mobile_feature[]" >მთავარი?</div>'+
                        '<div class="border w-25" id="preview-mobi-'+i+'">'+
                        '<input type="hidden" name="mobi_img[]" value="'+ mobi++ +'">'+
                        '</div>'+
                        '<div class="border w-25"><button type="button" class="btn w-100 remove">Delete</button></div>'+
                       '</div>');
                       preview(files[i],i,'preview-mobi');
                    
                }
                jQuery('.remove').click(function(){
                    jQuery(this).parents('.img-div').remove();
                });
            });
            function preview(file,i,id){
                var fr = new FileReader();
                    fr.onload = () => {
                        var img = document.createElement("img");
                        img.src = fr.result;  // String Base64 
                        img.alt = file.name;
                        img.className="preview";
                        document.querySelector('#'+id+'-'+i).append(img);
                    };
                    fr.readAsDataURL(file);
            }
            // Outer
                function size_accordingly() {
                    $('.size-accordingly').each(function() {
                        let width = $($(this).data('size-target')).css('width')
                        let height = $($(this).data('size-target')).css('height')
                        $(this).css({
                            'width': width,
                            'height': height
                        })
                    })
                }

                size_accordingly()

                $('#resize-accordingly-button').click(function() {
                    size_accordingly()
                })
            // Outer

            // Inner
                let items = 0;

                function generate_random_string(length) {
                    let result = '';
                    let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                    let charactersLength = characters.length;
                    for (let i = 0; i < length; i++) {
                        result += characters.charAt(Math.floor(Math.random() * charactersLength));
                    }
                    return result;
                }

                function gallery_markup(locales) {
                    let has = generate_random_string(12)
                    data = {
                        main: '',
                        localized: []
                    }

                    // <h3 contenteditable="true" data-text-to-value="#section-title-ka-${has}">სექციის სათაური, დააჭირეთ რომ შეცვალოთ</h3>
                    // <h3 contenteditable="true" data-text-to-value="#section-title-${e}-${has}">სექციის სათაური, დააჭირეთ რომ შეცვალოთ</h3>
                    data.main =  `<div class="gallery-wrapper d-fc ${has}">
                                <div class="d-flex mb-3">
                                    <button type="button" class="universal-button mr-3 add-section-item" data-type="image" data-has="${has}">სურათის დამატება</button>
                                    <button type="button" class="universal-button mr-3 add-section-item" data-type="video" data-has="${has}">ვიდეოს დამატება</button>
                                    <button type="button" class="universal-button mr-auto add-section-item" data-type="mobile_image" data-has="${has}">მობილური სურათის დამატება</button>
                                    <button type="button" class="universal-button bg-danger remove-this-section" data-target=".${has}">სექციის წაშლა (2x)</button>
                                </div>
                                <div class="gallery" id="gallery-${has}">
                                    
                                </div>
                                <input type="hidden" name="section_has[]" value="${has}" required>
                                <input type="hidden" name="section_titles_ka[]" id="section-title-ka-${has}" value="სათაური, დააჭირეთ რომ შეცვალოთ" required>
                                <input type="hidden" name="amount_of_sections[]" value="null" required>
                            </div>`
                    locales.forEach(e => {
                       tempMarkup = `<div class="gallery-wrapper d-fc ${has}">
                            <input type="hidden" name="section_titles_${e}[]" id="section-title-${e}-${has}" value="სათაური, დააჭირეთ რომ შეცვალოთ" required>
                        </div>`
                        data.localized.push(tempMarkup)
                    })

                    return data
                }

                // <input type="text" class="form-control text-center w-100 mt-2" name="image_alts[]" placeholder="სურათის alt ინფორმაცია" required>
                // <input type="text" class="form-control text-center w-100 mt-2" name="mobile_image_alts[]" placeholder="სურათის alt ინფორმაცია" required>
                function item_markup(item_type, belongs, items) {
                    if ( item_type == 'image' ) {
                        return `<label class="image-reader-wrapper d-fc" for="item-${items}">
                                    <div class="remove-this-item">&times</div>
                                    <img class="image-loader" src="{{ asset('images/admin/upload-330-150.jpg') }}">
                                    <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="images[]" id="item-${items}" required>
                                    <input type="hidden" name="belongs-${items}" value="${belongs}" required>
                                    <input type="hidden" name="amount_of_images[]" value="${items}" required>
                                </label>`
                    } else if ( item_type == 'mobile_image' ) {
                        return `<label class="image-reader-wrapper d-fc" for="mobile-item-${items}">
                                    <div class="remove-this-item">&times</div>
                                    <img class="image-loader" src="{{ asset('images/admin/upload.jpg') }}">
                                    <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="mobile_images[]" id="mobile-item-${items}" required>
                                    <input type="hidden" name="belongs-${items}" value="${belongs}" required>
                                    <input type="hidden" name="amount_of_mobile_images[]" value="${items}" required>
                                </label>`
                    } else if ( item_type == 'video' ) {
                        return `<div class="d-fc video-wrapper">
                                    <button type="button" class="universal-button w-100 bg-danger remove-this-video">წაშლა</button>
                                    <iframe width="330" height="150" src="https://www.youtube.com/embed/" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    <input type="text" class="form-control" name="video_code[]" placeholder="ვიდეოს კოდი" required>
                                    <input type="hidden" name="belongs-${items}" value="${belongs}" required>
                                    <input type="hidden" name="amount_of_videos[]" value="${items}" required>
                                    <input type="hidden" name="mobile_video[]" value="${items}" required>
                                </div>`
                    }
                }

                function category_markup() {
                    return `<div class="d-flex">
                                <select class="form-control mb-3" name="categories[]">
                                    <option value="designer">დიზაინერი</option>
                                    <option value="repairs">რემონტი</option>
                                    <option value="furniture">ავეჯის დამზადება</option>
                                    <option value="vip">VIP მასტერი</option>
                                </select>
                                <button type="button" class="delete-this-category universal-button bg-danger ml-3">წაშლა (2x)</button>
                            </div>`
                }

                $('.add-sections').click(function() {
                    index = 0
                    locales = ['it']
                    markup = gallery_markup(locales)
                    $('.project-gallery#ka').append(markup.main)
                    locales.forEach(e => {
                        $(`.project-gallery#${e}`).append(markup.localized[index])
                        index++
                    })
                })

                $('.project-gallery').on('click', '.add-section-item', function() {
                    let has = $(this).data('has')
                    let type = $(this).data('type')
                    $(`#gallery-${has}`).append(item_markup(type, has, items))
                    items++
                })

                $('.add-categories').click(function() {
                    $('.categories-wrapper').append(category_markup())
                })

                $('.categories-wrapper').on('dblclick', '.delete-this-category', function() {
                    $(this).parent('.d-flex').remove()
                })

                $('.project-gallery').on('dblclick', '.remove-this-section', function() {
                    $($(this).data('target')).remove()
                })

                $('.project-gallery').on('click', '.remove-this-item', function() {
                    $(this).parents('label').remove()
                })

                $('.project-gallery').on('click', '.remove-this-video', function() {
                    $(this).parents('.video-wrapper').remove()
                })
            // Inner
        })
    </script>
@endsection
<style>
    .preview {     
        max-height: 100%;
        max-width: 100%;
     }
</style>