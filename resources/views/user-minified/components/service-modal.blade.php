@php
use Jenssegers\Agent\Agent;
use App\Http\Controllers\TranslationsCT;

$tranCT = new TranslationsCT();
$agent = new Agent();
@endphp

<div id="modals-wrapper">
@if ( $data['exists'] && $data['content'] != [] )
@foreach ( $data['content']['modals'] as $index => $modal )
<div class="modal fade modal-background" id="card-modal-{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="card-modal-{{ $index }}-label" aria-hidden="true">
<div class="modal-dialog modal-custom modal-service modal-1160 modal-dialog-centered" role="document">
<div class="modal-content">
<div class="top-misc">
<h3 class="modal-title">{{ $tranCT->translate('order') }}</h3>
<span class="close-modal" data-dismiss="modal">&times</span>
</div>

<div class="universal-banner-wrapper">
<div class="image-wrapper">
<img src="{{ asset($modal['banner_location']) }}" alt="{{ $modal['banner_alt'] }}">
<div class="background-layer"></div>
</div>
<div class="text-wrapper">
<h2>{{ $modal['title'] }}</h2>
<p>{{ $modal['description'] }}</p>
</div>
</div>

<p class="information container-1000">{!! $modal['information'] !!}</p>

<div class="lists d-fc container-1000">
@if ( array_key_exists('modal_lists', $data['content']) )
@foreach ( $data['content']['modal_lists'] as $list )
@if ( $list['belongs'] == $modal['has'] )
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
<h3>{{ $list['title'] }}</h3>
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
<div class="bottom-buttons">
<a href="#"><i class="dark" id="awesome-phone"></i> 597 70 10 10</a>
<button type="button">{{ $tranCT->translate('order') }}</button>
</div>
</div>
</div>
</div>
@endforeach
@endif
</div>