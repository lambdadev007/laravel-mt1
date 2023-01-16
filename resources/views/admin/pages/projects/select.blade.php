@extends('admin.layout')

@php
    use app\Http\Controllers\HelpersCT;

    $category_translations = [
        'designer' => 'დიზაინერი',
        'repairs' => 'რემონტი',
        'furniture' => 'ავეჯის დამზადება',
        'vip' => 'VIP მასტერი',
    ];

    $soft_delete = [
        'true'  => 'წაშლილია',
        'false' => 'არ არის წაშლილი',
    ];
    // $value = Cookie::get('admin_cookie');
    //print_r($value,'hello');
                //exit;
    // $admin_cookie=json_decode($value,true);
    //print_r($admin_cookie);
@endphp

@section('content')
    {{-- Action Modal And Sort --}}
        {{-- Action and Sort --}}
            <div class="action-and-sort-wrapper col-4">
                <div class="action-modal-caller {{ ($data == []) ? 'd-none' : '' }}">
                    <!-- <button disabled type="button" class="universal-button w-100 mb-3" data-toggle="modal" data-target="#action-modal"> -->
                        <!-- <span class="modal-caller-text">მონიშნულებზე მოქმედება</span> -->
                        <button type="button" class="universal-button w-100 mb-3" onclick="window.location='{{ url("enter/projects/create") }}'">
                        <span class="modal-caller-text">პროექტის დამატება +</span>
                    </button>
                </div>
            <P style="font-size:14px;font-weight:900;">პროექტების სია</P>

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
                            <!-- <div class="col-sm-12 d-fc">
                                @if ( HelpersCT::is_admin() )
                                    <form action="/enter/project/delete/hard" method="post" class="d-flex">
                                    @csrf
                                        <input type="hidden" name="id_string" value>
                                        <button type="submit" class="universal-button bg-danger border-danger w-100">
                                            <span>წაშლა</span>
                                        </button>
                                    </form>
                                @endif
                            </div> -->
<!-- 
                            <div class="col-sm-12 mt-5 d-fc">
                                <button type="button" class="universal-button align-self-end" data-dismiss="modal">
                                    <span>უკან დაბრუნება</span>
                                </button>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        {{-- Modal --}}
    {{-- Action Modal And Sort --}}
    <!-- </?php print_r($admin_cookie['info']['is_super']); ?> -->
    <table class="table table-bordered" id="datatable">
  <thead>
    <tr>
      <th>ნამუშევრის დასახელება</th>
      <th>კოდი</th>
      <th>კატეგორია</th>
      <!-- @if($admin_cookie['info']['is_super']) -->
      <th>ქმედება</th>
      <!-- @endif -->
    </tr>
  </thead>
  <tbody>
    <div class="projects-page-wrapper d-fc admin-select">
        <div class="projects-wrapper d-fc container-1280">

            @foreach ($data['projects'] as $i => $project)

                @php
                
                    $section_items = json_decode($project['section_items'], true);
                    
                    //$amount = count($section_items);
                    //$upper_items = array_slice($section_items, 0, $amount / 2);
                    //$lower_items = array_slice($section_items, $amount / 2);

                    $project['categories'] = json_decode($project['categories'], true);
                @endphp

                <?php 
          
               $title_data= json_decode($project['title'], true);
           
          
            ?>
             

    <tr>
      
      <td><?php echo $title_data['ka']??'' ?></td>

      <td><?php echo $project["id"]??'' ?></td>

      <td>@if(!empty($project['categories'])) @foreach ($project['categories'] as $ci => $category) {{ $category_translations[$category] }}{{ (array_key_last($project['categories']) == $ci) ? '' : ',' }} @endforeach @endif</td>
<?php $id = $project["id"];
?>

    <!-- @if($admin_cookie['info']['is_super']) -->
        <td class="d-flex">
        
        <button id="edit_project" type="button" onclick="window.location='{{ url("enter/projects/edit/$id") }}'" class="btn btn-primary">რედაქტირება</button>
        
        @if ( HelpersCT::is_admin() )
        <form action="/enter/project/delete/hard" method="post" class="pl-1">
        @csrf
            <input type="hidden" name="id_string" value=<?=$project["id"]?> >
            <button type="submit" class="universal-button bg-danger btn border-danger w-100" onclick="return confirm('Are you sure you want to delete this?');">
                <span>მყარი წაშლა</span>
            </button>
        </form>
        @endif
       
        </td>
        <!-- @endif -->
        
    </tr>
    
    @endforeach


            
        </div>
    </div>
    </tbody>
    </table>

                                
@endsection