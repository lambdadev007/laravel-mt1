@include('user.pages.repairs.bootstrap')
@php
    use App\Models\Pdf;
   
@endphp
<style type="text/css">
    * {font-family: Dejavu Sans !important}
    .border {border-color: black !important;}
</style>


<table class="w-100">
    <tr>
        <td class="w-100 border border-bottom-0 py-2 px-3">
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJwAAAAuCAYAAADdunAzAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAXMSURBVHhe7Zvba1xVFIf9X3zKiyLoiyCxYNV6gb74UkSLqVIfWishKa03KoggFfVFCwqiUgPSiE28QLW5tNFWq9ZcRAzV3FMJ1dbMJBOTmdnOb7rXsLKy9z6XmR7SzvrgRzP77LXPPnt9M2lIe5NRlAxR4ZRMUeGUTFHhlExR4ZRMUeGUTFHhlExJJFzx3CFTXl6wrxQlOYmEW+u5x6x9/qApT/baEUVJRnLhPru7muL3zxuTn7NXFCUeqYWrpvK69Ee3vaoo0dQnnE3xu05TXpywsxTFT0OEo5TGu+xMRXHTUOGQ4tCzpnz5d1uhKOtJJFzx9F6nZK6Uxj+2VdGs/dRnv1JudBIJB0rjR52CycQS7r+CKbz/ssk9s9UOhJmZ+6uaY8dPmLPnhu1omDQ1BOYjqE8C5lNtHNLu71pCz9DofSUWDpSvXDDFb9udolGihFv94URVtH93tMQS7q13PjI333rfurRueywoAw5K1uxo64glEK/FveOAdfk+O184bK+4wXzsh+YjeKa49wOhfeL+dC3OMxOQjOooSfflI5VwROnCJxW5tmyQLSRceTlnCu++WBWNEiWc6wAoOAgXLtkovhoC9+MixD1sfg8kSjg5nwd78EFiY4/YG9U0Qrioc8P1eqhLOFBenDTFM/tjCbd65iuT27NlnWxxhAM4TGo8moE/6SDkQQPZCNSEmkPITxwe1Psa5xI0JA2XgeYjfMwF1qQ5MvKZ0ggnz0ieNZ6zHuoWjij9+Wnlp9itTuHKuStm+ciBDaJR4v4dDuDg8C7Dn75D4Nf4p0yoBoRko/ik43NojyF4Y/l6fA9yDfnpgzWkIJw0wtF8rMuhfcnxpDRMOFDOz1V/5cWFWx3qNYtP3+UUjRJHOBw2P1weeQg0F5FNoDVkDf/koDp6jcZRHb3m+D51XPcnfPvg95XCcYFoD1zCeoXDHJovn5G/EeqhocIR5YleUxx5zyy/3ekUTCZKOPnOlpFNC+FrNG8O7icbyZsha0Pf5hDZPODbR0g4NB3zeU0a4Xw1m064sV9/MysrK/ZVmJWuw065ZP7Ze695Y/cuW+WGmoPgaxyGHIsL1ckavh5wNcV36FwSmg8J+ZpSHt8++FqyxsUNLVzfwKAZODVk5uYv2hE/K12vOwXj+fFgm2m57X7T+sDjtmoj/HD4w4Y+cUJN8DWaDpTGsT6kQahZVIvwBnJJMJ9Isw++FuoJepMh/N6he8QRju8Xc2h80wj3Td9ANSOjY6ZQKNgrGwkJd2nfNvPqrrbaA4SE44cgm0Pj8nB4DQ6K46vhjZbXAG9SqJZLEqpJKpxvHMLQOJcHJK3Z1MIh/YOnzcys+9/E+YQ7e/DJ2sYpcYVDcIg4PH4ALkH4JxbVYJ6vRt4H19EM1PHGIbx5wNdYfE3j8n5JheNroYb2RusgeAaOrMFrLpus2fTCUX4ZGTX5pSU76ypSuIX2h81LO5+obZonJByQh8QjG0aEahDZHBBVg8hPTJCFcIA3XUauD/CMSWquG+GQk/2DZnp6xs5cL9zQgadqm3UlSjggP2WqdfZd6yNNDaQjGWQd1nORlXAQAuvQdYrrTUD4pPMJ6ru+6YSj/Hx+2ORy+apwCx3bzf5Hd9Y26ksc4QAOBEKgKSFpOGlrMDduHeZTOL5xEDXuukbgGu0tNI/AHP48vhqMUySha0louHCUk0fedMrlSlzhlOufRMKBickpp2AyHxztdsrF03LHQ+bDruN2ZaUZSCwcyOVy1W+dLtEoUcLt3nfITE3P2xWVZiGVcMRU5YcEl2yIT7hb7txuuo59YVdQmo26hAP5/JI5PzwSS7g9Ha+Y+Yv6P/ebmbqFI2ZmZys/VJxyCnd76yOmu+drO1NpZhomHMCvuoZHx9YJ1/7ca+bS35ftDKXZaahwBH65D+F6vuy3I4pylWsinKL4UOGUTFHhlExR4ZRMUeGUTFHhlExR4ZRMUeGUTFHhlAwx5n+F0XkkkiOC7AAAAABJRU5ErkJggg==">
        </td>
    </tr>
</table>
<table class="w-100">
    <tr>
        <td class="border border-bottom-0 border-right-0 py-2 px-3 w-50">
            "შპს მეტრიქსი - 405483418 <br>
            0194, თბილისი, საქართველო, <br>
            ადამ მიცკევიჩის 29 ბ  <br>
            ტელ: (+995) 592 10 40 40 <br>
        </td>
        <td class="border border-bottom-0 py-2 px-3 w-50">
            "metrix" LTD - 405483418 <br>
            0194, Tbilisi, Georgia <br>
            Adam Mitskevichi str 29 b  <br>
            Phone: (+995) 592 10 40 40 <br>
        </td>
    </tr>
</table>
<table class="w-100">
    <tr>
        <td class="border border-bottom-0 border-right-0 py-2 px-3 w-50">
            ელ.ფოსტა: info@metrix.ge"
        </td>
        <td class="border border-bottom-0 py-2 px-3 w-50">
            E-mail: info@metrix.ge”
        </td>
    </tr>
</table>
<table class="w-100">
    <tr>
        <td class="border border-bottom-0 border-right-0 py-2 px-3 w-50">
            ინვოისის N: {{ date('d.m.Y') }}/{{ $data['invoice_counter'] }}
        </td>
        <td class="border border-bottom-0 py-2 px-3 w-50">
            {{ date('d.m.Y') }}
        </td>
    </tr>
</table>


<table class="w-100 mb-4">
    <tr>
        <td class="border border-right-0 py-2 px-3 w-50">
            გადამხდელის მონაცემები:
        </td>
        <td class="border py-2 px-3 w-50">
            @if($data['is_company'])
                კომპანიის დასახელება :{{ $data['full_name'] }}<br>
                კომპანიის ელფოსტა : {{ $data['email'] }}<br>
                კომპანიის ნომერი : {{ $data['phone_number'] }}<br>
            @else
                სახელი და გვარი :{{ $data['full_name'] }}<br>
                ელ.ფოსტა : {{ $data['email'] }}<br>
                ტელეფონის ნომერი  : {{ $data['phone_number'] }}<br>
            @endif
        </td>
    </tr>
</table>


<table class="w-100">
    <tr>
        <td class="border border-bottom-0 border-right-0 py-2 pl-3" style="width: 20px">
            #
        </td>
        <td class="border border-bottom-0 border-right-0 py-2 px-3" style="width: 250px">
            დასახელება
        </td>
        <td class="border border-bottom-0 py-2 px-3" style="width: 150px">
            ღირებულება
        </td>
    </tr>
</table>
<table class="w-100">
    <tr>
        <td class="border border-right-0 py-2 pl-3" style="width: 20px">
            1
        </td>
        <td class="border border-right-0 py-2 px-3" style="width: 250px">
            ხარჯთაღრიცხვის წარმოების ღირებულება
        </td>
        <td class="border py-2 px-3" style="width: 150px">
            {{ $data['price'] }} ლარი
        </td>
    </tr>
</table>
<p class="my-5">დირექტორი: ლაშა ბორაშვილი</p>


<table class="w-100">
    <tr>
        <td class="w-100 border border-bottom-0 py-2 px-3">
            ანგარისწორებისთვის, გთხოვთ გადმორიცხოთ ზემოთხსენებული თანხა შემდეგ საბანკო რეკვიზიტებზე
        </td>
    </tr>
</table>
<table class="w-100">
    <tr>
        <td class="border border-bottom-0 border-right-0 py-2 px-3 w-50">
            მიმღების ბანკი
        </td>
        <td class="border border-bottom-0 py-2 px-3 w-50">
            სს "თიბისი ბანკი" <br>
            სს "საქართველოს ბანკი" <br>
        </td>
    </tr>
</table>
<table class="w-100">
    <tr>
        <td class="border border-bottom-0 border-right-0 py-2 px-3 w-50">
            ბანკის კოდი:
        </td>
        <td class="border border-bottom-0 py-2 px-3 w-50">
            BAGAGE22
        </td>
    </tr>
</table>
<table class="w-100">
    <tr>
        <td class="border border-right-0 py-2 px-3 w-25">
            ანგარიშის ნომერი:
        </td>
        <td class="border py-2 px-3 w-75">
            "თიბისი ბანკი" - GE66TB7008336060100001 <br>
            "საქართველოს ბანკი" - GE93BG0000000525609641
        </td>
    </tr>
</table>