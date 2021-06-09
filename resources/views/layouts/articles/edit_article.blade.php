@extends('layouts.apptheme_innerpage')

@section('title',__('Articles'))

@section('pageinfo')
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/article-dashboard">{{__('Articles')}}</a></li>
                <li class="breadcrumb-item cs-active" aria-current="page">{{__('List Articles')}}</li>
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

              <form action="/article/edit" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                @if($responseData)

                <div class="form-group">
                  <div class="">
                    <img style="width:400px" src="{{ $responseData->thumbnail }}" />
                  </div>


                </div>
                <div style="margin-left:50px;" class="col-md-4">
                  <input type="file" name="new_image" onchange="uploadNewFile(event)" id="file_upload" ref="file_upload" value="UPDATE"  class="btn btn-secondary float-right" />
                  <div class="form-group col-md-12">
                      <img style="width:150px" id="output-single"/>
                  </div>

                </div>


                  <input name="old_url" type="hidden" value="{{$responseData->thumbnail}}" class="form-control">

                  <input name="article_id" type="hidden" value="{{$responseData->id}}" class="form-control">
                  <p>&nbsp;</p>

                  <div class="form-group">
                      <label for="lable-controlg">{{ __('Category') }}</label>
                       <select name="cat_id" class="form-control">
                         <option value="{{$responseData->category_id}}">{{$responseData->category}}</option>
                         <option value=""></option>
                            @foreach($category as $listCategory)
                                  <option value="{{$listCategory->article_cat_id}}">{{$listCategory->category_name}}</option>
                            @endforeach
                      </select>
                      <!-- <input name="title" type="text" value="{{$responseData->category}}" class="form-control"> -->
                  </div>

                <div class="form-group">
                    <label for="lable-controlg">{{ __('Title') }}</label>
                    <input name="title" type="text" value="{{$responseData->title}}" class="form-control">
                </div>


                <div class="form-group">
                    <label for="lable-controlg">{{ __('Content') }}</label>
                    <textarea rows="30" name="content">{{$responseData->content}}</textarea>
                </div>


                @endif

                <div class="form-group">
                  <a href="/list-articles" class="btn btn-secondary">BACK</a>

                   <button type="submit" class="btn btn-primary float-right">UPDATE</button>
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
<script src="https://cdn.tiny.cloud/1/w8wdwjeza4qm5da0eqdz6uawnyf5b1r0c4c459ud0e2smhpr/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea',
    plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
    toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
    toolbar_mode: 'floating',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
  });
</script>
<script src="{{ asset('../lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('../lib/prismjs/prism.js') }}"></script>
@endpush
