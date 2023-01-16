@extends('admin.layout')

@section('content')
    <form class="d-fc" action="/enter/projects-page/update/null" method="post" enctype="multipart/form-data">
        @csrf
        <div class="projects-page-wrapper d-fc admin-create">
            <div class="modal-content modal-1160 modal-custom modal-projects mx-auto p-5 mb-3">
                <!-- <div class="top-misc">
                    <h3 class="modal-title">ნამუშევრის შესახებ</h3>
                </div> -->
                <div class="row align-items-center">
                   <div class="col-5 d-flex">
                        <label  class="col-form-label w-25">ნამუშევრის დასახელება</label>
                        <input type="text" id="project_name" class="form-control" placeholder="დაასათაურეთ">
                    </div>
                   <div class="col-5 d-flex">
                       <label  class="col-form-label w-25">აირჩიეთ კატეგორია</label>
                        <!-- <button type="button" class="add-categories universal-button mb-3">კატეგორიების დამატება (გთხოვთ კატეგორიები არ გაიმეოროთ)</button> -->
                        <select class="form-control mb-3" name="categories[]">
                            <option value="designer">დიზაინერი</option>
                            <option value="repairs">რემონტი</option>
                            <option value="furniture">ავეჯის დამზადება</option>
                            <option value="vip">VIP მასტერი</option>
                        </select>
                    </div>
                 </div>

                 <div class="row  align-items-center">
                   <div class="col-5 d-flex">
                        <label  class="col-form-label w-25">ობიექტის მისამართი:</label>
                        <input type="text" id="address:" class="form-control" placeholder="Address:">
                    </div>
                   <div class="col-5 d-flex">
                        <label class="form-label w-25">კომპანიის ლოგო:</label>
                        <input class="form-control" type="file" id="formFileMultiple" multiple>
                    </div>
                 </div>
<hr> <br>
                 <div class="row pt-1 align-items-center">
                   <div class="col-8 d-flex">
                        <label  class="form-label w-30">რემონტამდე (ვიდეო)</label>
                        <textarea class="form-control w-100  border-top-0 border-left-0 border-right-0" id="embed_video1" rows="1"></textarea>
                    </div>
                 </div>
                 <div class="row pt-2 align-items-center">
                   <div class="col-8 d-flex">
                        <label  class="form-label w-30">რემონტის შემდეგ (ვიდეო)</label>
                        <textarea class="form-control w-100  border-top-0 border-left-0 border-right-0" id="embed_video2" rows="1"></textarea>
                    </div>
                 </div>
                 <div class="row pt-2 align-items-center">
                 <div class="col-5 d-flex">
                        <label class="form-label w-25">სურათების გალერეა (დესკტოპი) </label>
                        <input class="form-control" type="file" id="formFileMultiple" multiple>
                    </div>
                 </div>
                 <div class="row pt-2 align-items-center">
                 <div class="col-5 d-flex">
                        <label class="form-label w-25">სურათების გალერეა (მობილური)</label>
                        <input class="form-control" type="file" id="formFileMultiple" multiple>
                    </div>
                 </div>
                 <div class="form-check pl-0 d-flex">
                   <label class="form-label w-15">ფოტოს ფორმატი</label>
                   <div class="form-check form-check-inline pl-3 d-flex">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                        <label class="form-check-label" for="inlineRadio1">JPG</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                        <label class="form-check-label" for="inlineRadio2">JPEG</label>
                    </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">PNG</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">WEBP</label>
                        </div>
                    </div>
                    <div class="group">
                       <label class="form-label w-25">ატვირთული სურათები (დესკტოპი):</label>
                      <div class="d-flex pt-2 w-50">
                        <div class="border w-25"><input type="checkbox" class="checkbox" >მთავარი?</div>
                        <div class="border w-25"><input type="desble"  class="form-control" disabled></div>
                        <div class="border w-25"><button type="button" class="btn w-100">წაშლა</button></div>
                       </div>
                      </div>
                    <div class="group">
                    <label class="form-label w-25">ატვირთული სურათები (მობილური):</label>
                        <div class="d-flex pt-2 w-50">
                            <div class="border w-25"><input type="checkbox" class="checkbox" >მთავარი?</div>
                            <div class="border w-25"><input type="desble"  class="form-control" disabled></div>
                            <div class="border w-25"><button type="button" class="btn w-100">წაშლა</button></div>
                        </div>
                    </div>
                    <div class="pt-5">
                        <div class="">
                           <input class="form-check-input" type="checkbox" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                           <label class="form-check-label" for="inlineRadio2">აჩვენე პროექტი მთავარ გვერდზე</label>
                        </div>
                        <div class="">
                            <input class="form-check-input" type="checkbox" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">აჩვენე პროექტი სერვისის გვერდზე</label>
                      </div>
                    </div>
                    <!-- <div  class="float-right">
                        <button class="btn btn-primary float-right ">upload</button>
                    </div> -->
                </div>

        <!-- {{-- <h5 id="countdown">სესია მოკვდება 24:00:00 საათში</h5> --}}
        {{-- Meta --}}
            <button class="s-collapse container-800 active" type="button" data-target="#meta">მეტა ინფორმაცია</button>
            <div class="s-collapse d-fc container-800 align-self-center show" id="meta">
                <div class="form-section d-fc">
                    <span class="letter-counter">0/60</span>
                    <input class="form-control" type="text" name="meta_title" placeholder="სათაური" value="{{ ($data['exists']) ? $data['raw']['meta_title'] : 'მეტრიქსი - ნამუშევრები' }}" required>
                </div>
                <div class="form-section d-fc">
                    <span class="letter-counter">0/135</span>
                    <textarea class="form-control" rows="2" name="meta_description" placeholder="აღწერა" maxlength="135" required>{{ ($data['exists']) ? $data['raw']['meta_description'] : '' }}</textarea>
                </div>
                <div class="form-section d-fc">
                    <span class="letter-counter">0/60</span>
                    <input class="form-control" type="text" name="meta_keywords" placeholder="ქივორდები" value="{{ ($data['exists']) ? $data['raw']['meta_keywords'] : '' }}" maxlength="60" required>
                </div>
            </div>
        {{-- Meta --}}

        {{-- Projects Title --}}
            {{-- <button class="s-collapse container-800 active" type="button" data-target="#title">ყველა ნამუშევრის სათაური</button>
            <div class="s-collapse d-fc container-800 align-self-center show" id="title">
                <div class="form-section d-fc">
                    <input class="form-control" type="text" name="titles" placeholder="სათაური" value="{{ ($data['exists']) ? $data['raw']['titles'] : 'მეტრიქსი - ნამუშევრები' }}" required>
                </div>
            </div> --}}
        {{-- Projects Title --}}

        <div class="projects-page-wrapper d-fc">
            {{-- Banner --}}
                <button class="s-collapse" type="button" data-target="#banner-wrapper">ბანერი</button>
                <div class="s-collapse d-fc" id="banner-wrapper">
                    <div class="universal-banner-wrapper">
                        <div class="image-wrapper">
                            <label class="image-reader-wrapper d-fc" for="banner">
                                @if ( $data['exists'] )
                                    <img class="image-loader" src="{{ asset($data['raw']['banner']) }}">
                                    <input type="hidden" name="existing_banner" value="{{ $data['raw']['banner'] }}" required>
                                @else
                                    <img class="image-loader" src="{{ asset('images/projects/lorem/main-banner.png') }}">
                                @endif
                                <span class="dire-edit"></span>
                                <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="banner" id="banner" {{ (!$data['exists']) ? 'required' : '' }}>
                                {{-- <div class="background-layer"></div> --}}
                            </label>
                        </div>
                    </div>
                </div>
            {{-- Banner --}}

            {{-- Mob Banner --}}
                <button class="s-collapse" type="button" data-target="#mob-banner-wrapper">მობილური ბანერი</button>
                <div class="s-collapse d-fc" id="mob-banner-wrapper">
                    <div class="universal-banner-wrapper darker w-375 mx-auto">
                        <div class="image-wrapper">
                            <label class="image-reader-wrapper w-100" for="mob-banner">
                                @if ( $data['exists'] )
                                    <img class="image-loader" src="{{ asset($data['raw']['mob_banner']) }}">
                                    <input type="hidden" name="existing_mob_banner" value="{{ $data['raw']['mob_banner'] }}" required>
                                @else
                                    <img class="image-loader" src="{{ asset('images/vip-master/lorem/mob-banner.png') }}">
                                @endif
                                {{-- <div class="background-layer"></div> --}}
                                <span class="dire-edit"></span>
                                <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="mob_banner" id="mob-banner">
                            </label>
                        </div>
                    </div>
                </div>
            {{-- Mob Banner --}}
        </div> -->
        <div class="modal-content modal-1160 border-0 mx-auto">
        <button type="submit" class="universal-button ml-auto">ატვირთვა</button>
        </div>
    </form>
@endsection