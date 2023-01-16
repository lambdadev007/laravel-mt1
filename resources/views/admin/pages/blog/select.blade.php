@extends('admin.layout')

@php
    use App\Http\Controllers\HelpersCT;

    $category_translation = [
        'designer' => 'დიზაინერი',
        'repairs' => 'რემონტი',
        'furniture' => 'ავეჯის დამზადება',
        'vip' => 'VIP - მასტერი'
    ];

    $soft_delete = [
        'true'  => 'წაშლილია',
        'false' => 'არ არის წაშლილი',
    ];

    //$value = Cookie::get('admin_cookie');
    //$admin_cookie=json_decode($value,true);
@endphp

@section('content')
    {{-- Action Modal And Sort --}}
        {{-- Action and Sort --}}
            <div class="action-and-sort-wrapper">
                <div class="action-modal-caller {{ ($data == []) ? 'd-none' : '' }}">
                    <button disabled type="button" class="universal-button w-100 mb-3" data-toggle="modal" data-target="#action-modal">
                        <span class="modal-caller-text">მონიშნულებზე მოქმედება</span>
                    </button>
                </div>
            </div>
        {{-- Action and Sort --}}

        {{-- Modal --}}
            <div class="modal fade" id="action-modal" tabindex="-1" role="dialog" aria-labelledby="action-modal-label" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="action-modal-label">დარწმუნებული ხართ ?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-md-6 col-sm-12 d-fc">
                                <span class="text-center mb-4"><b>წაშლა</b></span>

                                <form action="/enter/blog/delete/soft" method="post" class="d-flex mb-3">
                                @csrf
                                    <input type="hidden" name="id_string" value>
                                    <button type="submit" class="universal-button bg-danger border-danger w-100" onclick="return confirm('Are you sure you want to delete this?');">
                                        <span>რბილი წაშლა</span>
                                    </button>
                                </form>

                                @if ( HelpersCT::is_admin() )
                                    <form action="/enter/blog/delete/hard" method="post" class="d-flex">
                                    @csrf
                                        <input type="hidden" name="id_string" value>
                                        <button type="submit" class="universal-button bg-danger border-danger w-100" onclick="return confirm('Are you sure you want to delete this?');">
                                            <span>მყარი წაშლა</span>
                                        </button>
                                    </form>
                                @endif
                            </div>

                            <div class="col-md-6 col-sm-12 d-fc">
                                <span class="text-center mb-4"><b>აღდენა</b></span>

                                <form action="/enter/blog/restore" method="post" class="d-flex">
                                @csrf
                                    <input type="hidden" name="id_string" value>
                                    <button type="submit" class="universal-button bg-info border-info w-100">
                                        <span >რბილად წაშლილის აღდგენა</span>
                                    </button>
                                </form>
                            </div>

                            <div class="col-sm-12 mt-5 d-fc">
                                <button type="button" class="universal-button align-self-end" data-dismiss="modal">
                                    <span>უკან დაბრუნება</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- Modal --}}
    {{-- Action Modal And Sort --}}

    <div class="article-cards smaller">
        @foreach ($data['articles'] as $article)
            <div class="universal-card d-fc article-card">
                {{-- Action Checker --}}
                    <label class="check-for-action-label" for="action-checkbox-{{ $article['id'] }}">მონიშვნა</label>
                    <input class="check-for-action-checkbox d-none" type="checkbox" id="action-checkbox-{{ $article['id'] }}" data-id={{ $article['id'] }}>
                    <span class="delete-status {{ $article['soft_delete'] }}">{{ $soft_delete[$article['soft_delete']] }}</span>
                {{-- Action Checker --}}

                <div class="top">
                    <img src="{{ asset($article['card_image']) }}">
                    <div class="background-layer"></div>
                    <span class="floating-category orange">{{ $category_translation[$article['category']] }}</span>
                    <h5 class="title">{{ $article['title'] }}</h5>
                </div>
                <div class="bottom d-fc">
                    <div class="top-info">
                        <div class="views">
                            <img src="{{ asset('images/blog/icon-views-orange.svg') }}">
                            <span>263</span>
                        </div>
                        <div class="shares">
                            <img src="{{ asset('images/blog/icon-share-orange.svg') }}">
                            <span>76</span>
                        </div>
                        <span class="date">{{ $article['date_created'] }}</span>
                    </div>
                    <p class="description">{{ $article['card_description'] }}</p>
                    <!-- @if($admin_cookie['info']['is_super']) -->
                    <a class="bottom-button" href="/enter/blog/edit/{{ $article['id'] }}">რედაქტირება</a>
                    <!-- @endif -->
                </div>
            </div>
        @endforeach
    </div>
@endsection