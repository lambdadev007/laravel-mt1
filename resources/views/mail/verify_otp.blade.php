@php
    use App\Models\InvoiceMailBuffer;
    $data = InvoiceMailBuffer::find(1)->toArray();
    print_r($request);
    exit;
@endphp

<!DOCTYPE html>
<html>
    <head>
        <title>Laravel 8 Send Email Example</title>
    </head>
    <body>
        <span style="font-size: 16px; margin-top: 6px; margin-bottom: 6px;">{{$data}}</span>
    </body>
</html> 