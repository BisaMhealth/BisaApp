@extends('layouts.apptheme_innerpage')

@section('title', __('Covid-19 Patient Review') )

@section('pageinfo')

          <div >
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/doctor/dashboard">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item cs-active" aria-current="page">{{ __('See all questions') }}</li>
              </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">{{ __('Review') }}</h4>
          </div>

@endsection


@section('content')

  <div class="col-lg-12">
    <!-- <div class="col-sm-12 col-lg-3 float-right mb-4">
      <label class="label-control">Sort By</label>
      <select class="form-control">
        <option value="yes">Trier par</option>
        <option value="no">Fermé</option>
      </select>
    </div> -->
      <table style="width:100%" class="table table-striped question-list-covid-followup" id="example">

          <thead>
            <th style="width:20%;">{{ __('Patient Name') }}</th>
          <!-- <th style="">{{ __('Username') }}</th> -->
          <th>{{ __(' Question') }}</th>
          <th>{{ __('Answered') }}</th>
          <th>{{ __('Updated at') }}</th>
          <th>{{ __('Options') }}</th>

        </thead>

        <tbody >



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


  </div>

@endsection



@push('scripts')

@endpush
