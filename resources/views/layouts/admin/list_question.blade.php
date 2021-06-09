@extends('layouts.apptheme_innerpage')

@section('title', __('User Questions') )

@section('pageinfo')

          <div >
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/doctor/dashboard">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item cs-active" aria-current="page">
                {{ __('Questions') }}
                </li>
              </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">{{ __('Questions') }}</h4>
          </div>

@endsection


@section('content')

  <div class="col-lg-12">
    <div class="col-sm-12 col-lg-3 float-right mb-4">
      <!-- <label class="label-control">Sort By</label>
      <select class="form-control">
        <option value="yes">Trier par</option>
        <option value="no">Fermé</option>
      </select> -->
    </div>
      <table class="table table-striped">
      <thead>
                         <tr>
                          <th> {{ __('Patient Name') }} </th>
                          <th style="width: 50%"> {{ __('Age') }}</th>
                          <th> {{ __('Question') }}</th>
                          <th> {{ __('Status') }}</th>
                          <th> {{ __('Details') }}</th>
                         </tr>
                  </thead>


        <tbody id="">


     <!--      <tr>
            <td> View All Questions </td>
            <td> Sample question 1 It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout
            </td>
            <td> 2 </td>
            <td> Opened </td>
            <td> <button type="button" class="btn btn-xs btn-dark"><i class="fa fa-edit"></i></button> </td>
             <td>
              <button type="button" class="btn btn-xs btn-danger"> <i class="fa fa-trash"></i> </button>
            </td>
          </tr> -->

        </tbody>

      </table>
        <nav aria-label="Page navigation example " class="float-right">
          <ul class="">

          <!--   <li class="page-item disabled"><a class="page-link page-link-icon" href="#"><i data-feather="chevron-left"></i></a></li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link page-link-icon" href="#"><i data-feather="chevron-right"></i></a></li> -->
          </ul>

        </nav>

  </div>

@endsection



@push('scripts')

@endpush
