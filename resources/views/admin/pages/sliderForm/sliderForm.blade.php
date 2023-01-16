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
                        <button type="button" class="universal-button w-100 mb-3" onclick="window.location='{{ url("enter/slider-form/create") }}'">
                        <span class="modal-caller-text">დამატება +</span>
                    </button>
                </div>
            </div>
           
<table class="table table-bordered">
  <thead>
    <tr>
      <th>კვ.მ ლიმიტი</th>
      <th>ფასი ლიმიტს ქვემოთ</th>
      <th>კოეფიციენტი ლიმიტს ზემოთ</th>
      <th>ვისთვის</th>
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
    <td> {{ $row['square_limit'] }}</td>
    <td> {{ $row['price_low'] }}</td>
    <td> {{ $row['price_high'] }}</td>
    <td> {{ strtoupper($status[$row['status']]) }}</td>
    <!-- @if($admin_cookie['info']['is_super']) -->
    <td class="d-flex "><button id="edit_project" type="button" onclick="window.location='{{ url("enter/slider-form/edit/$id") }}'" class="btn btn-primary">რედაქტირება</button>
    <!-- @if ( HelpersCT::is_admin() ) -->
                                    <form action="/enter/slider-form/delete/hard" method="post" class="pl-1">
                                    @csrf
                                        <input type="hidden" name="id_string" value=<?=$id?> >
                                        <button type="submit" class="universal-button bg-danger border-danger " onclick="return confirm('Are you sure you want to delete this?');">
                                            <span>მყარი წაშლა</span>
                                        </button>
                                    </form>
                                <!-- @endif -->
    <!-- <button onclick="///window.location='{{ url("/enter/slider-form/delete/hard?id_string=$id") }}'" class="btn btn-danger">Delete</button> -->
  </td>
  <!-- @endif -->
    </tr>
    @endforeach
   @else
   <tr>
    <td colspan="5">
        ჩანაწერი არ იძებნება....!
    </td>
    </tr>
   @endif
  </tbody>

         
        </div>
    </div>

    </table>
@endsection