@extends('layouts.apptheme_innerpage')

@section('title', __('Workflow') )

@section('pageinfo')

          <div >
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/doctor/dashboard">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item cs-active" aria-current="page">{{ __('Covid-19') }}</li>
              </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">{{ __('Patients') }} <button data-toggle="modal" data-target="#modalRegisterPatient" type="button" class="btn btn-xs btn-dark"><i class="fa fa-plus"></i></button></h4>

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
            <th style="width:20%;">{{ __('Patient Name') }}</th>
            <!-- <th>{{ __(' Age') }}</th> -->
            <th>{{ __('Phone') }}</th>
            <th>{{ __('Email') }}</th>
            <th>{{ __('Address') }}</th>
            <th>{{ __('Options') }}</th>
        </thead>

        <tbody >

          @if($userData)
            @foreach($userData as $user)
            <tr>
              <td> {{$user->first_name}} </td>
              <td> {{$user->phone}}
              </td>
              <td> {{$user->email}}</td>
              <td> {{$user->address}} </td>
              <td> <button type="button" class="btn btn-xs btn-dark"><i class="fa fa-edit"></i></button> </td>
               <td>
                <button type="button" class="btn btn-xs btn-danger"> <i class="fa fa-trash"></i> </button>
              </td>
            </tr>
            @endforeach
          @endif



        </tbody>

      </table>

        <nav aria-label="Page navigation example " class="float-right">


        </nav>

  </div>





  <div class="modal fade effect-scale" id="modalRegisterPatient" tabindex="-1" role="dialog" aria-hidden="true">
<form action="{{ route('onboardpatient') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="modal-dialog modal-dialog-centered " role="document">
  <div class="modal-content">
    <div class="modal-body pd-20">
      <button type="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"><i data-feather="x" class="wd-20"></i></span>
      </button>

    <h6 class="tx-uppercase tx-spacing-1 tx-semibold mg-b-20">
    {{ __('Add New Patient') }}</h6>

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
              <label>{{ __('First Name')  }} *</label>
              <input required type="text" value="{{ old('first_name') }}" name="first_name" class="form-control input-outline" placeholder="{{ __('First Name')  }}">
            </div>

            <div class="form-group">
              <label>{{ __('Last Name')  }} *</label>
              <input required type="text" value="{{ old('last_name') }}" name="last_name" class="form-control input-outline" placeholder="{{ __('Last Name')  }}">
            </div>

          <div class="form-group">
              <label for="lable-controlg">{{ __('Gender') }} *</label>
              <select class="form-control" name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
          </div>

          <?php $rand  = rand(); ?>
          <input type="hidden"  name="country" value="Ghana"  />
          <input type="hidden"  name="password" value="<?php echo $rand; ?>"  />
          <input type="hidden"  name="password_confirmation" value="<?php echo $rand; ?>"  />

          <div class="form-group">
              <label for="lable-controlg">{{ __('Email') }} *</label>
              <input required type="email" name="email" value="{{ old('email') }}" class="form-control input-outline" placeholder="{{ __('Email Address')  }}">
          </div>

          <div class="form-group">
              <label for="lable-controlg">{{ __('Phone') }} *</label>
              <input required type="text" value="{{ old('phone') }}" name="phone" class="form-control input-outline" placeholder="{{ __('Phone')  }}">

          </div>

          <div class="form-group">
             <label>{{ __('Date of Birth') }} *</label>
              <input required name="date_of_birth" value="{{ old('date_of_birth') }}"  type="date" id="" class="form-control input-outline  bs-datepicker"  placeholder="{{ __('Date of Birth') }}">
           </div>

           <div class="form-group">
              <label>{{ __('Blood Group')  }}</label>
              <select name="blood_group" class="form-control">
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>

              </select>
            </div>

             <div class="form-group ">
               <label>{{ __('Any Chronic  / Known Condition ?')  }} *</label>
               <input required type="text" name="known_condition" value="{{ old('known_condition') }}" class="form-control input-outline" placeholder="{{ __('Any Chronic  / Known Condition ?')  }}">
             </div>


           <input type="hidden" value="1"  name="follow_up">

          <div class="form-group">
            <!-- <input type="file" name="file" id="file" class="inputfile" data-multiple-caption="{count} files selected" multiple />
             -->
            <div class="form-group col-md-5">
                    <img style="width:150px" id="output"/>
            </div>
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
