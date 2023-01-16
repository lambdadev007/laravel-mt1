@extends('admin.layout')


@section('content')
<div class="action-and-sort-wrapper">
                <div class="action-modal-caller {{ ($data == []) ? 'd-none' : '' }}">
                    <!-- <button disabled type="button" class="universal-button w-100 mb-3" data-toggle="modal" data-target="#action-modal"> -->
                        <!-- <span class="modal-caller-text">მონიშნულებზე მოქმედება</span> -->
                        <button type="button" class="universal-button w-100 mb-3" onclick="window.location='{{ url("admin/slider-form/create") }}'">
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
      <th>ვისთის?</th>
      <th>ქმედება</th>
    </tr>
  </thead>
  
    <div class="projects-page-wrapper d-fc admin-select">
        <div class="projects-wrapper d-fc container-1280">

        <tbody>
   
   @if(count($data['rows']))
    @foreach (array_reverse($data['rows']) as $i => $row)
    <tr>
    <td> {{ $row['square_limit'] }}</td>
    <td> {{ $row['price_low'] }}</td>
    <td> {{ $row['price_high'] }}</td>
    <td> {{ strtoupper($status[$row['status']]) }}</td>
    <td><button id="edit_project" type="button" onclick="window.location='{{ url("admin/slider-form/edit/$row['id']") }}'" class="btn btn-primary">Edit</button>
    <button class="btn btn-danger">Delete</button></td>

    </tr>
    @endforeach
   @else
   <tr>
    <td colspan="5">
        No Record Found....!
    </td>
    </tr>
   @endif
  </tbody>

         
        </div>
    </div>

    </table>
@endsection