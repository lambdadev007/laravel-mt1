@extends('admin.layout')

@php
    use App\Http\Controllers\HelpersCT;

    $soft_delete = [
        'true'  => 'წაშლილია',
        'false' => 'არ არის წაშლილი',
    ];

    $value = Cookie::get('admin_cookie');
    $admin_cookie=json_decode($value,true);
@endphp

@section('content')
    {{-- Action Modal And Sort --}}
        {{-- Action and Sort --}}

        <!-- <h4><a href="/enter/staff_projects/create">Add Staff Member +</a></h4> -->

            <div class="action-and-sort-wrapper col-4">
                
                <div class="action-modal-caller {{ ($data == []) ? 'd-none' : '' }}">
                <a href="/enter/staff_projects/create" class="universal-button w-100 mb-3">ადმინის დამატება +</a>
                    <!-- <button disabled type="button" class="universal-button w-100 mb-3" data-toggle="modal" data-target="#action-modal">
                        <span class="modal-caller-text">მონიშნულებზე მოქმედება</span>
                    </button> -->
                </div>
            <P style="font-size:14px;font-weight:900;">ადმინის დამატება</P>

            </div>
        {{-- Action and Sort --}}

        {{-- Modal --}}
            <div class="modal fade" id="action-modal" tabindex="-1" role="dialog" aria-labelledby="action-modal-label" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="action-modal-label">დარწმუნებული ხართ ?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        {{-- Modal --}}
    {{-- Action Modal And Sort --}}

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>სახელი</th>
                <th>გვარი</th>
                <th>მომხმარებლის სახელი</th>
                <th>ელ</th>
                <th>ტელეფონი</th>
                @if($admin_cookie['info']['is_super'])
                <th>Action</th>
                @endif
                
            </tr>
        </thead>
        @foreach ( $data['admins'] as $item )
      <?php $id=$item['id']; ?>

          
            <tbody>
                <tr>
                    <td>{{ $item['id'] }}</td>
                    
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['surname'] }}</td>
                    <td>{{ $item['login'] }}</td>
                    <td>{{ $item['email'] }}</td>
                    <td>{{ $item['number'] }}</td>
                    
                    <td class="d-flex">
                    @if($item['is_super'] == 0)
                        <a href="/enter/staff_projects/edit/{{ $item['id'] }}" class="btn btn-primary">რედაქტირება</a>
                        <form action="/enter/staff_projects/delete/hard" method="post" class="pl-1">
                        @csrf
                            <input type="hidden" name="id_string" value=<?=$id?> >
                        
                                <button type="submit"  class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?');"><span  >წაშლა</span></button>
                            
                        </form>
                        @endif
                    </td>
                   
                </tr>
            </tbody>
        @endforeach
        
    </table>
@endsection