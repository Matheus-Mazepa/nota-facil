@extends('layouts.app')

@section('content')
   <div class="row mt-70">
       <div class="col-sm-8">
          <products
                  :user='@json(current_user())'
          ></products>
       </div>
       <div class="col-sm-4">
           <resume-tax
                   :user='@json(current_user())'
           ></resume-tax>
       </div>
   </div>
@endsection
