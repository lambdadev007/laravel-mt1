@extends('admin.layout')

@php
    use App\Http\Controllers\HelpersCT;

    $soft_delete = [
        'true'  => 'წაშლილია',
        'false' => 'არ არის წაშლილი',
    ];

@endphp

@section('content')
    {{-- Action Modal And Sort --}}
        {{-- Action and Sort --}}
            <div class="action-and-sort-wrapper">
                <div class="action-modal-caller {{ ($data == []) ? 'd-none' : '' }}">
                    <button disabled type="button" class="universal-button w-100 mb-3" data-toggle="modal" data-target="#action-modal">
                        <span class="modal-caller-text">მონიშნულებზე მოქმედება</span>
                    </button>
                </div>
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
                        <div class="modal-body row">
                            <div class="col-md-6 col-sm-12 d-fc">
                                <span class="text-center mb-4"><b>წაშლა</b></span>
                                @if ( HelpersCT::is_admin() )
                                    <form action="/enter/administration/delete/hard" method="post" class="d-flex">
                                    @csrf
                                        <input type="hidden" name="id_string" value>
                                        <button type="submit" class="universal-button bg-danger border-danger w-100" onclick="return confirm('Are you sure you want to delete this?');">
                                            <span>მყარი წაშლა</span>
                                        </button>
                                    </form>
                                @endif
                            </div>

                            <div class="col-sm-12 mt-5 d-fc">
                                <button type="button" class="universal-button align-self-end" data-dismiss="modal">
                                    <span>უკან დაბრუნება</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- Modal --}}
    {{-- Action Modal And Sort --}}

    <table class="table table-dark">
        <thead>
            <tr>
                <th>#</th>
                <th>სახელი</th>
                <th>რედაქტირება</th>
                <th>მონიშვნა</th>
            </tr>
        </thead>
        @foreach ( $data['admins'] as $item )    
            <tbody>
                <tr>
                    <th>{{ $item['id'] }}</th>
                    <th>{{ $item['name'] }}</th>
                  
                    <th><a href="/enter/administration/edit/{{ $item['id'] }}">რედაქტირება</a></th>
                 
                    <th>
                        {{-- Action Checker --}}
                            <label class="check-for-action-label position-relative" for="action-checkbox-{{ $item['id'] }}">მონიშვნა</label>
                            <input class="check-for-action-checkbox d-none" type="checkbox" id="action-checkbox-{{ $item['id'] }}" data-id={{ $item['id'] }}>
                        {{-- Action Checker --}}
                    </th>
                </tr>
            </tbody>
        @endforeach
    </table>
@endsection