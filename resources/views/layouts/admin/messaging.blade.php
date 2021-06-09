@extends('layouts.apptheme_innerpage')

@section('title', __('Messaging') )

@section('pageinfo')

          <div >
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/doctor/dashboard">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item cs-active" aria-current="page">{{ __('Messaging') }}</li>
              </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1"> <button data-toggle="modal" data-target="#modalRegisterPatient" type="button" class="btn btn-xs btn-dark">
            <i class="fa fa-envelope"></i> New</button> </h4>

          </div>

@endsection


@section('content')

  <div class="col-lg-12">
    <!-- <div class="col-sm-12 col-lg-3 float-right mb-4">
      <label class="label-control">Sort By</label>
      <select class="form-control">
        <option value="yes">Read</option>
        <option value="no">Un</option>
      </select>
    </div> -->


      <table style="width:100%" class="table table-striped question-list" id="example">

          <thead>
            <th style="width:20%;">{{ __('Title') }}</th>
            <!-- <th>{{ __(' Age') }}</th> -->
            <th>{{ __('Body') }}</th>
            <th>{{ __('Date Created') }}</th>
            <th>{{ __('Status') }}</th>
            <!-- <th>{{ __('Options') }}</th> -->
        </thead>

        <tbody >

            <tr>
              <td> Greetings </td>
              <td> Text
              </td>
              <td> Sep.01.2020</td>
              <td> Sent </td>
              <!-- <td> <button type="button" class="btn btn-xs btn-dark"><i class="fa fa-edit"></i></button> </td>
               <td>
                <button type="button" class="btn btn-xs btn-danger"> <i class="fa fa-trash"></i> </button>
              </td> -->
            </tr>




        </tbody>

      </table>

        <nav aria-label="Page navigation example " class="float-right">


        </nav>

  </div>





  <div class="modal fade effect-scale" id="modalRegisterPatient" tabindex="-1" role="dialog" aria-hidden="true">
<form action="{{ route('sendusernotification') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-body pd-20">
      <button type="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"><i data-feather="x" class="wd-20"></i></span>
      </button>

    <h6 class="tx-uppercase tx-spacing-1 tx-semibold mg-b-20">
    {{ __('New Message') }}</h6>

          <div class="form-group">
            <div class="col-sm-12">
                      @if (count($errors) > 0)
                                    <div class = "alert alert-danger">
                                        <ul>
                                          @foreach ($errors->all() as $error)
                                              <li>{{ $error }}</li>
                                          @endforeach
                                        </ul>
                                    </div>
                        @endif

              </div>
              @error('question_category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $error }}</strong>
                            </span>
                        @enderror
            </div>

            <div class="form-group">
              <label>{{ __('Title ')  }} *</label>
              <input required type="text" value="{{ old('first_name') }}" name="first_name" class="form-control input-outline" placeholder="{{ __('Message Title')  }}">
            </div>


          <div class="form-group">
              <label for="lable-controlg">{{ __('Type') }} *</label>
              <select class="form-control" name="message_type">
                <option value="push_notification">Push Notification</option>
                
              </select>
          </div>

          <div class="form-group">
              <label for="lable-controlg">{{ __('Message Body') }} *</label>
              <textarea name="message_body" rows="10" class="form-control">{{ old('message_body') }}</textarea>

          </div>





  </div>
  <div class="modal-footer pd-x-20 pd-b-20 pd-t-0 bd-t-0">
    <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">{{ __('Close') }}</button>
    <button type="submit" class="btn btn-success tx-13">{{ __('Submit')}}</button>
  </div>
</div>
</div>
</form>
</div>

@endsection



@push('scripts')

@endpush
