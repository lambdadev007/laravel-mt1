@extends('user.layout')

@php
    use Jenssegers\Agent\Agent;
    use App\Http\Controllers\TranslationsCT;

    use App\Models\CompanyHotline;

    $tranCT = new TranslationsCT();
    $agent = new Agent();

    $company_hotline = [
        'call_phone_number' => 'tel:+995597701010',
        'visible_phone_number' => '592 10 40 40'
    ];

    if ( CompanyHotline::where('id', 1)->exists() && !isset($data['is_vip_number']) ) {
        $company_hotline = CompanyHotline::where('id', 1)->get(['call_phone_number', 'visible_phone_number'])->first()->toArray();
    } else if ( isset($data['is_vip_number']) ) {
        $company_hotline = CompanyHotline::where('id', 1)->get(['call_phone_vip_number', 'visible_phone_vip_number'])->first()->toArray();
        $company_hotline = [
            'call_phone_number' => $company_hotline['call_phone_vip_number'],
            'visible_phone_number' => $company_hotline['visible_phone_vip_number']
        ];
    }
@endphp

@if ( $data['exists'] )
    @section('meta')
        <meta property="og:url" content="{{ url()->current() }}"/>
        <meta property="og:type" content="website"/>
        <meta property="og:title" content="{{ $data['raw']['meta_title'] }}"/>
        <meta property="og:description" content="{{ $data['raw']['meta_description'] }}"/>
        <meta property="og:image" content="{{ asset('images/logos/logo.png') }}"/>

        <title>{{ $data['raw']['meta_title'] }}</title>
        <meta name="keywords" content="{{ $data['raw']['meta_keywords'] }}">
        <meta name="description" content="{{ $data['raw']['meta_description'] }}">
    @endsection
@endif

@section('content')
    <div class="repairs-wrapper d-fc">
        <div class="universal-banner-wrapper darker">
            <div class="image-wrapper">
                {{-- @if ( @data['exists'] )
                    @php
                        $banner = $data['raw']['banner'];
                        if ( $agent->isMobile() ) $banner = $data['raw']['mob_banner'];
                    @endphp
                    <img src="{{ asset($banner) }}" alt="რემონტი">
                @endif --}}
                {{-- <div class="background-layer"></div> --}}
            </div>
            <div class="text-wrapper">
                {{-- <h1>რემონტი</h1> --}}
                {{-- <p>{{ ($data['exists']) ? $data['banner_text'][Session::get('locale')] : '' }}</p> --}}
            </div>
        </div>

        
    </div>

    <div id="modals-wrapper">
        @if ( $data['exists'] && $data['content'] != [] )
            <div class="modal-custom modal-service">
                <div class="universal-banner-wrapper">
                    <div class="image-wrapper">
                        <img src="{{ asset($data['content']['modal']['banner_location']) }}" alt="{{ $data['content']['modal']['banner_alt'] }}">
                        <div class="background-layer"></div>
                    </div>
                    <div class="text-wrapper">
                        <h2>{{ $data['content']['modal']['title'] }}</h2>
                        <p>{{ $data['content']['modal']['description'] }}</p>
                    </div>
                </div>

                <p class="information container-1000">{!! $data['content']['modal']['information'] !!}</p>

                <div class="lists d-fc {{ $agent->isDesktop() ? 'container-1000' : '' }}">
                    @if ( array_key_exists('modal_lists', $data['content']) )
                        @foreach ( $data['content']['modal_lists'] as $list )
                            @if ( $list['belongs'] == $data['content']['modal']['has'] )
                                @if ( $list['has_stages'] == 'true' )
                                    <div class="list-wrapper d-fc w-100">
                                        <div class="title has-stages">
                                            <h3>{{ $list['title'] }}</h3> @if ( !$agent->isMobile() && !$agent->isTablet() ) <i class="square"></i> @endif
                                            @if ( array_key_exists('modal_stages', $data['content']) )
                                                <div class="stages-wrapper">
                                                    @foreach ( $data['content']['modal_stages'] as $stage_index => $stage )        
                                                        @if ( $list['has'] == $stage['belongs'] )
                                                            <button class="user-service-stage-toggle {{ $stage['first'] == 'true' ? 'active' : '' }}" data-target="{{ $stage['has'] }}">{{ $stage['name'] }}</button>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="list d-fc">
                                            @if ( array_key_exists('modal_list_items', $data['content']) )
                                                @foreach ( $data['content']['modal_list_items'] as $index => $list_item)
                                                    @if ( $list_item['belongs'] == $list['has'] )
                                                        @if ( $list_item['type'] == 'double' )
                                                            <div class="item {{ $list_item['stage'] }} {{ ($list_item['stage_first'] == 'true') ? '' : 'd-none' }}">
                                                                <p>{!! $list_item['left_text'] !!}</p>
                                                                <span>{!! $list_item['right_text'] !!}</span>
                                                            </div>
                                                        @elseif ( $list_item['type'] == 'red' )
                                                            <div class="item {{ $list_item['stage'] }} {{ ($list_item['stage_first'] == 'true') ? '' : 'd-none' }}">
                                                                <p>{!! $list_item['left_text'] !!}</p>
                                                                <span><i class="red" id="times"></i></span>
                                                            </div>
                                                        @elseif ( $list_item['type'] == 'green' )
                                                            <div class="item {{ $list_item['stage'] }} {{ ($list_item['stage_first'] == 'true') ? '' : 'd-none' }}">
                                                                <p>{!! $list_item['left_text'] !!}</p>
                                                                <span><i class="green" id="checkmark"></i></span>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="list-wrapper d-fc w-100">
                                        <div class="title">
                                            <h3 class="{{ !$agent->isDesktop() ? 'ml-2' : '' }}">{{ $list['title'] }}</h3>
                                        </div>
                                        <div class="list d-fc">
                                            @if ( array_key_exists('modal_list_items', $data['content']) )
                                                @foreach ( $data['content']['modal_list_items'] as $index => $list_item)
                                                    @if ( $list_item['belongs'] == $list['has'] )
                                                        @if ( $list_item['type'] == 'double' )
                                                            <div class="item">
                                                                <p>{!! $list_item['left_text'] !!}</p>
                                                                <span>{!! $list_item['right_text'] !!}</span>
                                                            </div>
                                                        @elseif ( $list_item['type'] == 'red' )
                                                            <div class="item">
                                                                <p>{!! $list_item['left_text'] !!}</p>
                                                                <span><i class="red" id="times"></i></span>
                                                            </div>
                                                        @elseif ( $list_item['type'] == 'green' )
                                                            <div class="item">
                                                                <p>{!! $list_item['left_text'] !!}</p>
                                                                <span><i class="green" id="checkmark"></i></span>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @endif
                </div>
                <div class="bottom-buttons justify-content-center">
                    <a href="tel:{{ $company_hotline['call_phone_number'] }}"><i class="dark" id="awesome-phone"></i> {{ $company_hotline['visible_phone_number'] }}</a>
                    @if ( @$data['has_invoice'] )
                        <button type="button" {{ Cookie::has('invoice_sent') ? 'disabled' : '' }} id="call-invoice" class="px-3" style="width: auto; {{ Cookie::has('invoice_sent') ? 'border-color: var(--gray); color: var(--gray);' : '' }}">{{ $tranCT->translate('generate_invoice') }}</button>
                    @endif
                </div>
            </div>
        @endif
    </div>

    @if ( @$data['has_invoice'] )
        <div class="modal fade" role="dialog" id="invoice_modal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3" id="old-wrapper">
                            <div class="col-12"><p style="font-size: 14px;">ხარჯთაღრიცხვა ითვალისწინებს მხოლოდ პრემიუმ, შავი, თეთრი და მწვანე კარკასის დათვლას, სხვა დანარჩენ შემთხვევაში დაგვიკავშირდით ნომერზე <strong>592 10 40 40</strong></p></div>
                        </div>
                        <form id="post-select" method="post" action="/repair-invoice">
                            @csrf
                            <div class="row" id="new-wrapper">
                                <div class="col-12 d-flex align-items-center pb-4 border-bottom"><span style="min-width: 150px;">თქვენი ელ.ფოსტა <span class="text-danger">*</span></span> <input required class="form-control" type="email" name="requestor_email"></div>

                                <div class="col-12 d-flex align-items-center mt-4 mb-3">
                                    <label class="d-flex align-items-center mr-4"><span class="mr-2">ფიზიკური პირი</span> <input type="radio" name="requestor_type" value="individual" id="individual" checked></label>
                                    <label class="d-flex align-items-center"><span class="mr-2">კომპანია</span> <input type="radio" name="requestor_type" value="company" id="company"></label>
                                </div>

                                <div class="col-12 d-flex align-items-center mb-4">
                                    <span style="min-width: 260px;">
                                        <span>რამდენი კვადრატია თქვენი ფართი?</span> 
                                        <span class="text-danger">*</span>
                                    </span> 
                                    <input required class="form-control" type="number" name="flat_size" min="0">
                                </div>
                                <div class="col-12 d-flex align-items-center mb-1">
                                    <span style="min-width: 150px;">
                                        <span id="name-wrapper">სახელი და გვარი</span> 
                                        <span class="text-danger">*</span>
                                    </span> 
                                    <input required class="form-control" type="text" name="name">
                                </div>
                                <div class="col-12 d-flex align-items-center mb-1">
                                    <span style="min-width: 150px;">
                                        <span id="id-wrapper">პირადი ნომერი</span> 
                                        <span class="text-danger">*</span>
                                    </span> 
                                    <input required class="form-control" type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==11) return false" name="p_id" id="p_id">
                                </div>
                                <div class="col-12 d-flex align-items-center mb-3">
                                    <span style="min-width: 150px;">
                                        <span>ტელეფონი</span> 
                                        <span class="text-danger">*</span>
                                    </span> 
                                    <input required class="form-control" type="number" name="phone_number">
                                </div>
                                <div class="col-12"><button type="submit" class="btn w-100 text-white rounded-0" style="background-color: rgb(var(--metrix-main-accent))">ინვოისის ჩამოტვირთვა</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @include('user.components.projects')
    @include('user.components.partners')
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            let modal = $('#invoice_modal')
            $('body').on('click', '#call-invoice', function() {
                modal.find('.modal-title').html('ინვოისის მოთხოვნა')
                modal.modal('show')
            })

            $('#company').on('change', function() {
                $('#p_id').attr('onKeyPress', 'if(this.value.length==9) return false')
                $('#name-wrapper').text('დასახელება')
                $('#id-wrapper').text('საიდენტიფიკაციო კოდი')
            })
            $('#individual').on('change', function() {
                $('#p_id').attr('onKeyPress', 'if(this.value.length==11) return false')
                $('#name-wrapper').text('სახელი და გვარი')
                $('#id-wrapper').text('პირადი ნომერი')
            })

            @if ( old('requestor_email') != null )
                $('#invoice_modal').modal()
            @endif
        })
    </script>
@endsection