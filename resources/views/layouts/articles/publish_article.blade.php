@extends('layouts.apptheme_innerpage')

@section('title',__('Articles'))

@section('pageinfo')
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/article-dashboard">{{__('Articles')}}</a></li>
                <li class="breadcrumb-item cs-active" aria-current="page">{{__('Publish')}}</li>
              </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1"></h4>
          </div>
        </div>
@endsection



@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-10">

              <form action="/post/publish" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}


                <div class="form-group">
                  <div style="margin-left:50px;" class="col-md-4">
                    <input type="file" required name="new_image" onchange="uploadNewFile(event)" id="file_upload" ref="file_upload" value="UPDATE"  class="btn btn-secondary float-right" />
                    <div class="form-group col-md-12">
                        <img style="width:150px" id="output-single"/>
                    </div>
                  </div>
                </div>



                  <div class="form-group">
                      <label for="lable-controlg">{{ __('Category') }}</label>
                       <select name="cat_id" class="form-control">
                         @foreach($category as $value)
                            <option value="{{$value->category_id}}"> {{$value->category_name}}</option>
                         @endforeach
                         <option value=""></option>

                      </select>

                  </div>

                <div class="form-group">
                    <label for="lable-controlg">{{ __('Title') }}</label>
                    <input name="title" type="text" value="" class="form-control">
                </div>


                <div class="form-group">
                    <label for="lable-controlg">{{ __('Content') }}</label>
                    <textarea rows="25" name="content"></textarea>
                </div>




                <div class="form-group">
                  <a href="/admin/dashboard" class="btn btn-secondary">{{ __('BACK') }}</a>

                   <button type="submit" class="btn btn-primary float-right">{{ __('PUBLISH') }}</button>
                </div>

              </form>

            </div>




        </div>
    </div>
@endsection

@push('scripts')

<script>

  var uploadNewFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output-single');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };


</script>
@endpush


@push('scripts')
<script src="https://cdn.tiny.cloud/1/f2x6960we0mi285pckfg3dm33e79zxih38b6vav834q75y81/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
   tinymce.init({
     selector: 'textarea',
     plugins: 'advcode casechange formatpainter lists checklist media mediaembed pageembed permanentpen powerpaste table advtable',
     toolbar: 'casechange checklist code formatpainter pageembed permanentpen table',
     toolbar_mode: 'floating',
   });
 </script>
<script src="{{ asset('../lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('../lib/prismjs/prism.js') }}"></script>
@endpush
