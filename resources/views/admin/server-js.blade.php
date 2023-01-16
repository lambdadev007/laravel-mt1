<script type="text/javascript">
    $(document).ready(function(){
        {{-- /* Slug */ --}}
            @isset ( $data['misc']['slug-check'] )
                let slugs = '{{ implode('+', $data['misc']['slugs']) }}'
                let og_slugs = '{{ implode('+', $data['misc']['og_slugs']) }}'

                let slugs_arr = slugs.split('+')
                let og_slugs_arr = og_slugs.split('+')

                $('input[name="slug"]').keyup(function(){
                    if ( slugs_arr.includes($(this).val()) ) {
                        $(this).siblings('h5').text('ბმული მოხმარებაშია')
                        $(this).addClass('slug-in-use')
                    } else if ( og_slugs_arr.includes($(this).val()) ) { 
                        $(this).siblings('h5').text('ბმული მოხმარებაშია')
                        $(this).addClass('slug-in-use')
                    } else {
                        $(this).siblings('h5').text('ბმული / აუცილებელია და უნდა იყოს უნიკალური')
                        $(this).removeClass('slug-in-use')
                    }
                })
            @endisset
        {{-- /* Slug */ --}}
    })
</script>