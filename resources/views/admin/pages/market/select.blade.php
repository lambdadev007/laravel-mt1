@extends('admin.layout')

@section('meta')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@php
    use App\Http\Controllers\HelpersCT;
@endphp

@section('content')
    {{-- Meta --}}
        <form class="d-fc" action="/enter/market-meta/update/null" method="post" enctype="multipart/form-data">
            @csrf
            <div class="container-800 d-fc">
                <button class="s-collapse" type="button" data-target="#meta">მეტა ინფორმაცია</button>
                <div class="s-collapse d-fc" id="meta">
                    <div class="form-section d-fc">
                        <span class="letter-counter">0/60</span>
                        <input class="form-control" type="text" name="meta_title" placeholder="სათაური" value="{{ ($data['meta']['exists']) ? $data['meta']['meta_title'] : '' }}" maxlength="60" required>
                    </div>
                    <div class="form-section d-fc">
                        <span class="letter-counter">0/135</span>
                        <textarea class="form-control" rows="2" name="meta_description" placeholder="აღწერა" maxlength="135" required>{{ ($data['meta']['exists']) ? $data['meta']['meta_description'] : '' }}</textarea>
                    </div>
                    <div class="form-section d-fc">
                        <span class="letter-counter">0/60</span>
                        <input class="form-control" type="text" name="meta_keywords" placeholder="ქივორდები" value="{{ ($data['meta']['exists']) ? $data['meta']['meta_keywords'] : '' }}" maxlength="60" required>
                    </div>
                    <button type="submit" class="universal-button w-100">გაგზავნა</button>
                </div>
            </div>
        </form>
    {{-- Meta --}}

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
                <div class="modal-dialog modal-450" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="action-modal-label">დარწმუნებული ხართ ?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-sm-12 d-fc">
                                @if ( HelpersCT::is_admin() )
                                    <form action="/enter/product/delete/hard" method="post" class="d-fc">
                                    @csrf
                                        <input type="hidden" name="id_string" value>
                                        <button type="submit" class="universal-button bg-danger border-danger w-100 mb-3" onclick="return confirm('Are you sure you want to delete this?');">
                                            <span>წაშლა</span>
                                        </button>
                                        <button type="button" class="universal-button w-100" data-dismiss="modal">
                                            <span>უკან დაბრუნება</span>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- Modal --}}
    {{-- Action Modal And Sort --}}

    <div class="market-wrapper d-fc">
        <div class="top container-1280">
            <div class="left">
                <button type="button" class="toggle-market-all-categories-popup"><i class="orange" id="market-bars"></i> ყველა კატეგორია</button>
                <div class="market-crumbs">
                    @if ( $get_data['has_group'] )
                        <a href="/enter/product/select?group={{ $get_data['group'] }}">{{ $get_data['current_group_name'] }}</a>
                        @if ( $get_data['has_category'] )
                            <i class="dark-gray" id="market-arrow"></i>
                            <a href="/enter/product/select?group={{ $get_data['group'] }}&category={{ $get_data['category'] }}">{{ $get_data['current_category_name'] }}</a>
                        @endif
                    @endif
                </div>
            </div>
            <div class="right">
                <div class="select-wrapper">
                    <select class="market-top-filter" id="select-amount">
                        <option value="16" {{ (Session::get('market.amount') == '16' ? 'selected' : '')  }}>16 ნივთი ერთ გვერდზე</option>
                        <option value="24" {{ (Session::get('market.amount') == '24' ? 'selected' : '')  }}>24 ნივთი ერთ გვერდზე</option>
                        <option value="32" {{ (Session::get('market.amount') == '32' ? 'selected' : '')  }}>32 ნივთი ერთ გვერდზე</option>
                    </select>
                    <i class="dark-gray" id="market-arrow"></i>
                </div>
                @if ( Session::get('market.sort') == 'desc' )
                    <button type="button" id="sort-price" data-val="asc"><p><span>ფასი:</span> ზრდადობით</p><i class="yellow margined" id="market-arrow"></i></button>
                @elseif ( Session::get('market.sort') == 'asc' )
                    <button type="button" id="sort-price" data-val="desc"><p><span>ფასი:</span> კლებადობით</p><i class="yellow margined" id="market-arrow"></i></button>
                @else
                    <button type="button" id="sort-price" data-val="asc"><p><span>ფასი:</span> ზრდადობით</p><i class="yellow margined" id="market-arrow"></i></button>
                @endif
            </div>
        </div>

        <div class="middle container-1280">
            <div class="left d-fc">
                <div class="top d-fc">
                    @if ( $get_data['has_group'] )    
                        @foreach ( $product_categories['groups'] as $group )
                            @if ( $group['has'] == $get_data['group'] )
                                @foreach ( $product_categories['sub_groups'] as $sub_group )
                                    @if ( $sub_group['belongs'] == $group['has'] )
                                        <a href="/enter/product/select?group={{ $sub_group['belongs'] }}&category={{ $sub_group['search_id'] }}" class="item {{ ($sub_group['search_id'] == $get_data['category']) ? 'active' : '' }}">{{ $sub_group['title'] }}</a>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </div>

                <div class="range price d-fc">
                    <div class="top">
                        <p>ფასის ინტერვალი</p> 
                        <div>
                            <input type="number" value="{{ (Session::has('market.price-range-min')) ? Session::get('market.price-range-min') : '0' }}" id="price-range-min"> 
                            <span>-</span> 
                            <input type="number" value="{{ (Session::has('market.price-range-max')) ? Session::get('market.price-range-max') : '400' }}" id="price-range-max">
                        </div>
                    </div>
                    <div class="bottom">
                        <div id="price-range-slider"></div>
                        <input type="hidden">
                    </div>
                </div>

                {{-- Filters --}}
                    <div class="filter">
                        <p>ქვეყნის ფილტრაცია</p>
                        <div class="checkboxes d-fc">
                            @foreach ( $filters['general']['country'] as $filter )
                                <label class="checkbox-wrapper">
                                    <p class="{{ (in_array($filter, $filters['checked'])) ? 'active' : '' }}">{{ $filter }}</p>
                                    <label class="universal-checkbox-wrapper"><input type="checkbox" data-type="country" value="{{ $filter }}" {{ (in_array($filter, $filters['checked'])) ? 'checked' : '' }}> <div class="before"></div> <div class="after"></div></label>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="filter">
                        <p>ბრენდის ფილტრაცია</p>
                        <div class="checkboxes d-fc">
                            @foreach ( $filters['general']['brand'] as $filter )
                                <label class="checkbox-wrapper">
                                    <p class="{{ (in_array($filter, $filters['checked'])) ? 'active' : '' }}">{{ $filter }}</p>
                                    <label class="universal-checkbox-wrapper"><input type="checkbox" data-type="brand" value="{{ $filter }}" {{ (in_array($filter, $filters['checked'])) ? 'checked' : '' }}> <div class="before"></div> <div class="after"></div></label>
                                </label>
                            @endforeach
                        </div>
                    </div>
                {{-- Filters --}}
            </div>
            
            <div class="right d-fc">
                @csrf
                <div class="market-items-grid">
                    @foreach ( $products as $product )
                        <div class="market-item d-fc">
                            {{-- Action Checker --}}
                                <label class="check-for-action-label" for="action-checkbox-{{ $product['id'] }}">მონიშვნა</label>
                                <input class="check-for-action-checkbox d-none" type="checkbox" id="action-checkbox-{{ $product['id'] }}" data-id={{ $product['id'] }}>
                            {{-- Action Checker --}}
                            <a href="/enter/product/edit/{{ $product['id'] }}" class="d-fc">
                                <h5>{{ $product['brand'] }}</h5>
                                <img src="{{ asset($product['card_image']) }}" alt="{{ $product['card_image_alt'] }}">
                                <p>{!! $product['card_description'] !!}</p>
                                @php
                                    $price = $product['price'];
                                    if ( $product['discount'] == 'true' ) $price = $product['price'] * $product['discount_amount'];
                                    $price = number_format(round($price, 2), 2, '.', '');
                                @endphp
                                <span class="price"><strong>₾ {{ $price }}</strong> /ცალი</span>
                            </a>
                            <input type="hidden" name="ids[]" value="{{ $product['id'] }}">
                        </div>
                    @endforeach
                </div>
                
                @if ( $get_data['has_group'] )
                    {{ $products->appends(['group' => $get_data['group']])->links() }}
                @elseif ( $get_data['has_category'] )
                    {{ $products->appends(['group' => $get_data['group'], 'category' => $get_data['category']])->links() }}
                @else
                    {{ $products->links() }}
                @endif
            </div>
        </div>
    </div>

    @include('admin.components.all-categories-popup')
@endsection

@section('js')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.page-item.disabled').each(function() {
                if ( $(this).html() == '<span class="page-link">...</span>') {
                    $(this).html(`<div></div> <div></div> <div></div>`)
                }
            })
        })
  </script>
@endsection