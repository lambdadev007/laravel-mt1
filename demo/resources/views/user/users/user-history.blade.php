@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;

    $local = [
        'ka' => [
            'user_profile'              => 'მომხმარებლის პროფილი',
            'history'                   => 'შეკვეთების ისტორია',
            'product'                   => 'პროდუქტი',
            'amount'                    => 'რაოდენობა',
            'unit_price'                => 'ერთეულის ფასი',
            'discount'                  => 'ფასდაკლება',
            'transportation'            => 'ტრანსპორტირება',

            'statistics'               => 'შეჯამება',

            'total_orders'              => 'სულ შეკვეთებია',
            'ongoing'                   => 'მიმდინარეა',
            'finished'                  => 'დასრულებულია',
            'production'                => 'პროდუქცია',
            'service'                   => 'მომსახურება',
            'total_price'               => 'ჯამური ღირებულება',
            'discount'                  => 'ფასდაკლება',
            
        ],
        'en' => [
            'user_profile'              => 'User Profile',
            'history'                   => 'Purchase History',
            'product'                   => 'Product',
            'amount'                    => 'Amount',
            'unit_price'                => 'Unit price',
            'discount'                  => 'Discount',
            'transportation'            => 'Transportation',

            'statistics'               => 'Statistics',

            'total_orders'              => 'Total amount of orders',
            'ongoing'                   => 'Ongoing',
            'finished'                  => 'Finished',
            'production'                => 'Production',
            'service'                   => 'Service',
            'total_price'               => 'Total price',
            'discount'                  => 'discount',
        ]
    ];
@endphp

@section('meta')
    <title>შეკვეთების ისტორია, {{ $TC->TG('html_title') }}</title>
@endsection

@section('content')
     <div class="page-title-wrapper container-fluid mb-1">
         <div class="page-title-line"></div>
         <h3 class="page-title">{{ $TC->T($local, 'history') }}</h3>
         <div class="page-title-line"></div>
     </div>

    {{-- Link Path --}}
        <div class="link-path-wrapper container-fluid">
            <div class="link-path">
                <a class="link-path-item" href="/">{{ $TC->TG('homepage') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/user/profile">{{ $TC->TG('user_profile') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/user/history">{{ $TC->T($local, 'history') }}</a>
            </div>
            {{-- Phone Call Modal Button --}}
                <button class="split-button pulse-button p-0 ml-auto" data-toggle="modal" data-target="#phone-call-modal">
                    <span class="dire-right-arrow"></span>
                    <span class="anchor-text">597 70 10 10</span>
                </button>
            {{-- Phone Call Modal Button --}}
        </div>
    {{-- Link Path --}}

    <div class="container-fluid user-history-wrapper">
        <div class="purchase-list">
            <div class="purchase show">
                <div class="top">
                    <p>VIP-მასტერი | 17 სექტემბერ 2018 | მიმდინარე</p>
                    <span class="dire-up-arrow"></span>
                </div>
                <div class="bottom">
                    <div class="item">
                        <span class="left">რკინის კარის გახსნა/საკეტის გაჭრით</span>
                        <span class="right">45.00 <span class="dire-lari"></span></span>
                    </div>
                    <div class="item">
                        <span class="left">რკინის კარზე საკეტის მონტაჟი/ძველის ანალოგიური</span>
                        <span class="right">45.00 <span class="dire-lari"></span></span>
                    </div>
                    <div class="item total important">
                        <span class="left">{{ $TC->TG('sum') }}:</span>
                        <span class="right">90.00 <span class="dire-lari"></span></span>
                    </div>
                </div>
            </div>

            <div class="purchase product show">
                <div class="top">
                    <p>პროდუქცია | 21 ოქტომბერი 2018</p>
                    <span class="dire-up-arrow"></span>
                </div>
                <div class="bottom">
                    <div class="item segmented important">
                        <span class="product">{{ $TC->T($local, 'product') }}</span>
                        <span class="amount">{{ $TC->T($local, 'amount') }}</span>
                        <span class="price">{{ $TC->T($local, 'unit_price') }}</span>
                        <span class="sum">{{ $TC->TG('total') }}</span>
                    </div>
                    <div class="item segmented">
                        <span class="product">წებო-ემულსია საფასადე. 20 ლ</span>
                        <span class="amount"><b>1</b> ც</span>
                        <span class="price"><b>20.00</b> <span class="dire-lari"></span></span>
                        <span class="sum"><b>20.00</b> <span class="dire-lari"></span></span>
                    </div>
                    <div class="item segmented">
                        <span class="product">წებო-ემულსია საფასადე. 20 ლ</span>
                        <span class="amount"><b>1</b> ც</span>
                        <span class="price"><b>20.00</b> <span class="dire-lari"></span></span>
                        <span class="sum"><b>20.00</b> <span class="dire-lari"></span></span>
                    </div>
                    <div class="item segmented">
                        <span class="product">წებო-ემულსია საფასადე. 20 ლ</span>
                        <span class="amount"><b>1</b> ც</span>
                        <span class="price"><b>20.00</b> <span class="dire-lari"></span></span>
                        <span class="sum"><b>20.00</b> <span class="dire-lari"></span></span>
                    </div>
                    <div class="item discount important">
                        <span class="left">{{ $TC->T($local, 'discount') }}:</span>
                        <span class="right">0 <span class="dire-lari"></span></span>
                    </div>
                    <div class="item transportin important">
                        <span class="left">{{ $TC->T($local, 'transportation') }}:</span>
                        <span class="right">45.00 <span class="dire-lari"></span></span>
                    </div>
                    <div class="item total important">
                        <span class="left">{{ $TC->TG('sum') }}:</span>
                        <span class="right">60.00 <span class="dire-lari"></span></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="statistics">
            <div class="top">
                <span>{{ $TC->T($local, 'statistics') }}</span>
            </div>

            <div class="bottom">
                <div>
                    <span class="left">{{ $TC->T($local, 'total_orders') }}:</span>
                    <span class="right">3</span>
                </div>
                <div>
                    <span class="left">{{ $TC->T($local, 'ongoing') }}:</span>
                    <span class="right">1</span>
                </div>
                <div>
                    <span class="left">{{ $TC->T($local, 'finished') }}:</span>
                    <span class="right">2</span>
                </div>
                <div>
                    <span class="left">{{ $TC->T($local, 'production') }}:</span>
                    <span class="right">2</span>
                </div>
                <div>
                    <span class="left">{{ $TC->T($local, 'service') }}:</span>
                    <span class="right">1</span>
                </div>
                <div>
                    <span class="left">{{ $TC->T($local, 'total_price') }}:</span>
                    <span class="right">326.50 <span class="dire-lari"></span></span>
                </div>
                <div>
                    <span class="left">{{ $TC->T($local, 'discount') }} (0%):</span>
                    <span class="right">0 <span class="dire-lari"></span></span>
                </div>
            </div>
        </div>
    </div>

    @include('user.components.offers')
@endsection

@section('bottom_js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.user-history-wrapper .purchase-list .purchase .top').click(function() {
                $(this).parents('.purchase').toggleClass('show')
                $(this).children('span').toggleClass('dire-up-arrow')
                $(this).children('span').toggleClass('dire-down-arrow')
            })
        })
    </script>
@endsection