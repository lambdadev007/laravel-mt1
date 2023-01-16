@php
    use App\Models\InvoiceMailBuffer;
    $data = InvoiceMailBuffer::find(1)->toArray();
@endphp

<!DOCTYPE html>
<html>
    <head>
        <title>Laravel 8 Send Email Example</title>
    </head>
    <body>
        <span style="font-size: 16px; margin-top: 6px; margin-bottom: 6px;">{{ $data['type'] == 'individual' ? 'მომხარებელმა' : 'კომპანიამ' }}, {{ $data['name'] }}, მოითხოვა ახალი ინვოისი {{ $data['invoice_counter'] }}. დეტალური ინფორმაციისთვის, გთხოვთ იხილოთ მიმაგრებული PDF ფაილი.</span>
    </body>
</html> 