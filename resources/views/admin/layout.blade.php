@php
    use App\Http\Controllers\HelpersCT;

    $locale_to_datepicker = [
        'ka' => 'ka-GE',
        'en' => 'en-US',
        'it' => 'it-IT',
    ];

    if ( Cookie::has('admin_cookie') ) {
        $admin_logged = HelpersCT::decode_cookie('admin_cookie')['info']['logged'];
    } else {
        $admin_logged = false;
    }

    use Jenssegers\Agent\Agent;

    $agent = new Agent();
@endphp

<!doctype html>
<html lang="">
    <head>
        {{-- Meta --}}
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <title>მეტრიქს ადმინ პანელი</title>
            <link rel="icon" href="{{ asset('images/logos/favcon.png') }}">
            @yield('meta')
        {{-- Meta --}}

        {{-- CSS --}}
            <link rel="stylesheet" href="{{ asset('masters/bootstrap-master/css/bootstrap.min.css') }}">
            <link rel="stylesheet" href="{{ asset('masters/waves-master/css/waves.min.css') }}">
            <link rel="stylesheet" href="{{ asset('masters/owl-master/css/owl.carousel.min.css') }}">
            <link rel="stylesheet" href="{{ asset('masters/owl-master/css/owl.theme.default.min.css') }}">
            <link rel="stylesheet" href="{{ asset('masters/datepicker-master/css/bootstrap-datepicker3.min.css') }}">
            <link rel="stylesheet" href="{{ asset('masters/noUiSlider-master/distribute/nouislider.min.css') }}">
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
            @php
                $load = 'desktop';
                if ( $agent->isMobile() ) $load = 'mobile';
                if ( $agent->isTablet() ) $load = 'tablet';
            @endphp
            <link rel="stylesheet" href="{{ asset('css/load-'. $load .'.css') }}">
            <link rel="stylesheet" href="{{ asset('css/load.admin.css') }}">
        {{-- CSS --}}

        {{-- JS --}}
            <script defer type="text/javascript" src="{{ asset('masters/waves-master/js/waves.min.js') }}"></script>
            <script defer type="text/javascript" src="{{ asset('masters/owl-master/js/owl.carousel.min.js') }}"></script>
            <script defer type="text/javascript" src="{{ asset('masters/ckeditor-master/ckeditor.js') }}"></script>
            <script defer type="text/javascript" src="{{ asset('masters/ckeditor-master/adapters/jquery.js') }}"></script>
            <script defer type="text/javascript" src="{{ asset('masters/datepicker-master/js/bootstrap-datepicker.min.js') }}"></script>
            <script defer type="text/javascript" src="{{ asset('masters/datepicker-master/locales/bootstrap-datepicker.ka.min.js') }}"></script>
            <script defer type="text/javascript" src="{{ asset('masters/datepicker-master/locales/bootstrap-datepicker.ru.min.js') }}"></script>
            <script defer type="text/javascript" src="{{ asset('masters/noUiSlider-master/distribute/nouislider.min.js') }}"></script>
            <script defer type="text/javascript" src="{{ asset('js/core.v026.js') }}"></script>
            <script defer type="text/javascript" src="{{ asset('js/admin.js') }}"></script>
        {{-- JS --}}
        

    </head>
    
    <body>
        <div class="admin-wrapper d-fc {{ ($admin_logged) ? 'panel-body' : 'form-body' }}">
            @if ( $admin_logged )
                @if ( !$agent->isMobile() && !$agent->isTablet() )
                    @include('admin.components.navbar')
                    @include('admin.components.sidebar')
                @endif
            @endif

            {{-- Content --}}
                <div class="admin-content-darkener"></div>
                <div class="admin-content-wrapper d-fc">
                    @include('admin.components.alerts')

                    @yield('content')
                </div>
            {{-- Content --}}
        </div>

        <script type="text/javascript" src="{{ asset('masters/jquery-master/js/jquery.js') }}"></script>
        <script type="text/javascript" src="{{ asset('masters/bootstrap-master/js/popper.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('masters/bootstrap-master/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript">
            var KTDatatablesBasicBasic = function() {

            var initTable1 = function() {
                var table = $('#datatable');
                table.DataTable( {
                    dom: 'Qlfrtip',
                    responsive: true,
                    searchBuilder: {
                        columns: [0,1,2]
                    }
                });
                // begin first table
                // $('#kt_datatable thead th').each(function () {
                // 	var title = $(this).text();
                // 	$(this).append('<input type="text" placeholder="Search ' + title + '" /><br/>');
                // });
                // table.DataTable({
                // 	// responsive: true,
                // 	initComplete: function () {
                // 		// Apply the search
                // 		this.api()
                // 			.columns([1])
                // 			.every(function () {
                // 				var that = this;
            
                // 				$('input', this.footer()).on('keyup change clear', function () {
                // 					if (that.search() !== this.value) {
                // 						that.search(this.value).draw();
                // 					}
                // 				});
                // 			});
                // 	},

                // });
                
            
                // DataTable
                // var table = $('#example').DataTable({
                    
                // });
                // $('#kt_datatable thead').prepend( $("<tr><td class='search_option'></td></tr>") );
                // var table = $('#kt_datatable').DataTable();
            

                //    $(".search_option").html( '<input type="text" placeholder="Search Invoices" />' );
                //    $( 'input' ).on( 'keyup change', function () {
                    
                // 		table.columns([1]).search( this.value ).draw();
                // 		 console.log(this.value);
                    
                //    } );
                // table.on('change', '.group-checkable', function() {
                //     var set = $(this).closest('table').find('td:first-child .checkable');
                //     var checked = $(this).is(':checked');

                //     $(set).each(function() {
                //         if (checked) {
                //             $(this).prop('checked', true);
                //             $(this).closest('tr').addClass('active');
                //         }
                //         else {
                //             $(this).prop('checked', false);
                //             $(this).closest('tr').removeClass('active');
                //         }
                //     });
                // });

                // table.on('change', 'tbody tr .checkbox', function() {
                //     $(this).parents('tr').toggleClass('active');
                // });
            };

            return {

                //main function to initiate the module
                init: function() {
                    initTable1();
                }
            };
            }();
            $(document).ready(function(){
                KTDatatablesBasicBasic.init();
                $('.datepicker-location').datepicker({
                    maxViewMode: 1,
                    todayBtn: "linked",
                    clearBtn: true,
                    orientation: "auto",
                    daysOfWeekHighlighted: "0,6",
                    autoclose: true,
                    todayHighlight: true,
                    format: 'dd/mm/yyyy',
                    language: '{{ $locale_to_datepicker[Session::get('locale')] }}'
                })

                $('.text-editor').ckeditor()

                // $(function() {
                // $("button[type=submit]").click(function(){
                //     if (confirm("Click OK to continue?")){
                //         $('form.pl-1').submit();
                //     }
                // });
                // });
            });
            
          

        </script>
        @include('admin.server-js')
        @yield('js')
    </body>
</html>