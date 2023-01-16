@php
//session_start();

    use App\Models\InvoiceMailBuffer;
    $data = InvoiceMailBuffer::find(1)->toArray();
    
@endphp

<!DOCTYPE html>
<html>
    <head>
        <title>Laravel 8 Send Email Example</title>
    </head>
    <body>
        <span style="font-size: 16px; margin-top: 6px; margin-bottom: 6px;">Customer details:  </span>
        @if($_SESSION['data']['is_company']) 
<table class="w-100 mb-4">
    <tr>
        <td class="border border-right-0 py-2 px-3 w-50">
            Company Name:
        </td>
    
        <td class="border py-2 px-3 w-50">
            {{ $_SESSION['data']['full_name'] }}
        </td>

    </tr>
    <tr>    
        <td class="border border-right-0 py-2 px-3 w-50">
            Company E-mail:
        </td>
        <td class="border py-2 px-3 w-50">
            {{ $_SESSION['data']['email'] }}
        </td>
    </tr>
    <tr>     
        <td class="border border-right-0 py-2 px-3 w-50">
            Company Phone Number:
        </td>
        <td class="border py-2 px-3 w-50">
            {{ $_SESSION['data']['phone_number'] }}
        </td>
    </tr>
    <tr>     
        <td class="border border-right-0 py-2 px-3 w-50">
            Square meters:
        </td>
        <td class="border py-2 px-3 w-50">
            {{ $_SESSION['data']['fill'] }}
        </td>
    </tr>
    <tr> 
        <td class="border border-right-0 py-2 px-3 w-50">
           Total Price:
        </td>
        <td class="border py-2 px-3 w-50">
            {{ $_SESSION['data']['price'] }}
        </td>
    </tr>
</table>
@else 
<table class="w-100 mb-4">
    <tr>
        <td class="border border-right-0 py-2 px-3 w-50">
            First and Last Name:
        </td>
    
        <td class="border py-2 px-3 w-50">
            {{ $_SESSION['data']['full_name'] }}
        </td>

    </tr>
    <tr>    
        <td class="border border-right-0 py-2 px-3 w-50">
            E-mail:
        </td>
        <td class="border py-2 px-3 w-50">
            {{ $_SESSION['data']['email'] }}
        </td>
    </tr>
    <tr>     
        <td class="border border-right-0 py-2 px-3 w-50">
            Phone Number:
        </td>
        <td class="border py-2 px-3 w-50">
            {{ $_SESSION['data']['phone_number'] }}
        </td>
    </tr>
    <tr>     
        <td class="border border-right-0 py-2 px-3 w-50">
            Square meters:
        </td>
        <td class="border py-2 px-3 w-50">
            {{ $_SESSION['data']['fill'] }}
        </td>
    </tr>
    <tr> 
        <td class="border border-right-0 py-2 px-3 w-50">
           Total Price:
        </td>
        <td class="border py-2 px-3 w-50">
            {{ $_SESSION['data']['price'] }}
        </td>
    </tr>
</table>
@endif
    </body>
</html> 