@if ( $product_categories['exists'] )
    <div class="all-categories-popup hidden">
        <div class="inner">
            <div class="left d-fc">
                @foreach ( $product_categories['main'] as $main_index => $main )
                    <div class="{{ $main['has'] }}">
                        <button type="button" class="toggle-all-categories-popup  no-delay" data-target="{{ $main['has'] }}">{{ $main['title'] }}</button>
                    </div>
                @endforeach
            </div>
            <div class="right">
                @foreach ( $product_categories['main'] as $main_index => $main )
                    <div class="groups-wrapper {{ $main['has'] }} hidden">
                        @foreach ( $product_categories['groups'] as $group_index => $group )
                            @if ( $group['belongs'] == $main['has'] )
                                <div class="category">
                                    <div class="title">
                                        <a href="/market?group={{ $group['has'] }}">{{ $group['title'] }}</a>
                                        <div class="underline"></div>
                                    </div>
                                    <div class="links d-fc">
                                        @foreach ( $product_categories['sub_groups'] as $sub_group_index => $sub_groups )
                                            @if ( $sub_groups['belongs'] == $group['has'] )
                                                <a href="/market?group={{ $sub_groups['belongs'] }}&category={{ $sub_groups['search_id'] }}">{{ $sub_groups['title'] }}</a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <div class="outer toggle-market-all-categories-popup"></div>
        <span class="toggle-market-all-categories-popup">&times</span>
    </div>
@endif