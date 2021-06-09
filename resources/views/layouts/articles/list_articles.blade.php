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

            <div class="col-md-12">

              <table class="table table-Stripped list-articles datatables-minimal">
                <thead>
                  <th>Id</th>
                  <th>Category Id</th>
                  <th>Title</th>
                  <th>UpVotes</th>
                  <th>DownVotes</th>
                  <th>Edit</th>
                  <th>Remove</th>
                  <tbody>
                    @if(isset($responseData))

                      @foreach($responseData as $articles)

                      <tr>
                        <td>{{$articles->article_id}}</td>
                        <td>{{$articles->article_cat_id}}</td>
                        <td>{{$articles->article_title}}</td>
                        <td>{{$articles->article_upvotes}}</td>
                        <td>{{$articles->article_downvotes}}</td>
                        <td> <a title="Edit" href="/view-article/{{$articles->article_id}}" class="btn btn-small"><i class="fa fa-edit"></i></a>
                        </td>
                        <td><button data-articleid="{{$articles->article_id}}" style="color:red" class="btn btn-small remove-article"><i class="fa fa-trash"></i></button></td>
                      </tr>

                      @endforeach

                    @endif
                    <!-- <tr>
                      <td>12</td>
                      <td>4</td>
                      <td>This is a Simple title</td>
                      <td>3</td>
                      <td>5</td>
                      <td> <a href="#" class="btn btn-small"><i class="fa fa-edit"></i></a>
                        / <button class="btn btn-small "><i class="fa fa-trash"></i></button>
                      </td>
                    </tr> -->
                  </tbody>
                </thead>
              </table>

            </div>




        </div>
    </div>
@endsection



@push('scripts')
<script src="{{ asset('../lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('../lib/prismjs/prism.js') }}"></script>
@endpush
