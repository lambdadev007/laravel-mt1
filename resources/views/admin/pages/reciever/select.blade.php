@extends('admin.layout')
@php
    use App\Http\Controllers\HelpersCT;

    $soft_delete = [
        'true'  => 'წაშლილია',
        'false' => 'არ არის წაშლილი',
    ];
    //$value = Cookie::get('admin_cookie');
    //$admin_cookie=json_decode($value,true);
@endphp

@section('content')
<div class="action-and-sort-wrapper">
                <div class="action-modal-caller {{ ($data == []) ? 'd-none' : '' }}">
                    <!-- <button disabled type="button" class="universal-button w-100 mb-3" data-toggle="modal" data-target="#action-modal"> -->
                        <!-- <span class="modal-caller-text">მონიშნულებზე მოქმედება</span> -->
                        <button type="button" class="universal-button w-100 mb-3" onclick="window.location='{{ url("enter/reciever-form/create") }}'">
                        <span class="modal-caller-text">დამატება +</span>
                    </button>
                </div>
            </div>
           
<table class="table table-bordered">
  <thead>
    <tr>
      <th>სახელი და გვარი</th>
      <th>ელ.ფოსტა</th>
      <th>ტელეფონი</th>
      <th>მეილის მიღება</th>
      <th>სმს-ის მიღება</th>
      <th>სტატუსი</th>
      <!-- @if($admin_cookie['info']['is_super']) -->
      <th>ქმედება</th>
      <!-- @endif -->
    </tr>
  </thead>
  
    <div class="projects-page-wrapper d-fc admin-select">
        <div class="projects-wrapper d-fc container-1280">

        <tbody>
   
   @if(count($data['rows']))
    @foreach (array_reverse($data['rows']) as $i => $row)
      <?php $id=$row['id']; ?>
    <tr>
    <td> {{ $row['name'] }}</td>
    <td> {{ $row['email'] }}</td>
    <td> {{ $row['phone'] }}</td>
    <td> {{ strtoupper($row['send_email']) }}</td>
    <td> {{ strtoupper($row['send_sms']) }}</td>
    <td> {{ strtoupper($status[$row['status']]) }}</td>
    <!-- @if($admin_cookie['info']['is_super']) -->
    <td class="d-flex"><button id="edit_project" type="button" onclick="window.location='{{ url("enter/reciever-form/edit/$id") }}'" class="btn btn-primary">რედაქტირება</button>
    
    @if ( HelpersCT::is_admin() )
                                    <form action="/enter/reciever-form/delete/hard" method="post" class="pl-1">
                                    @csrf
                                        <input type="hidden" name="id_string" value=<?=$id?> >
                                        <button type="submit" class="universal-button bg-danger border-danger w-100" onclick="return confirm('Are you sure you want to delete this?');">
                                            <span>მყარი წაშლა</span>
                                        </button>
                                    </form>
                                @endif
    </td>
    <!-- @endif -->
    </tr>
    @endforeach
   @else
   <tr>
    <td colspan="5">
        ჩანაწერები არ იძებნება....!
    </td>
    </tr>
   @endif
  </tbody>

         
        </div>
    </div>

    </table>
@endsection