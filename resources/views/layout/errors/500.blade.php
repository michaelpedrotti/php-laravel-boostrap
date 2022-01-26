@extends('layout.blank')

@section('css')
  <style>
      td, th {
        white-space: normal; /* Only needed when it's set differntly somewhere else */
        word-break: break-word;
      }

    span.warning-notice{
      white-space: normal;
      font-size:90%;
      line-height:2.5;
    }

    td.loop{
       word-break: initial; 
      }

  </style>
@append
@section('content')
<div class="error-page">
          
        <h2 class="headline text-red"> 500</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-red"></i> Internal Server Error.</h3>

          <p>
            This page is temporarily unavailable. Try again later, you may  <a href="../../index.html">return to dashboard</a>
          </p>
          
          <form class="search-form">
            <div class="input-group">
              <input name="search" class="form-control" placeholder="Search" type="text">

              <div class="input-group-btn">
                <button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fa fa-search"></i>
                </button>
              </div>
            </div>
            <!-- /.input-group -->
          </form>
        </div>

        <div class="" style="margin-top:30px;">

        <div class="box box-solid">
          <div class="box-header with-border" style="color:white;background-color:#333!important;">
            <h3 class="box-title">Debug Details</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="" >
            <table class="table teste table-striped table-bordered">
          
              <thead>

                <tr>
                  <td class='loop'>#</td>
                  <td>Backtrace Errors/Exceptions Details </td>
                </tr>
                
              </thead>
          <tbody>

           
         @foreach ($exception->getTrace() as $trace)
         <tr>
           <td class='loop'>{{$loop->iteration}}</td>
         <td>
          
          @if ($loop->first)
          <strong>{{ $exception->getClass()}}</strong>
          {{ $exception->getFile()}}:  <span class="label" style="background-color:#333;color:white;">{{ $exception->getLine()}} </span>
         <br>
          
         <span class="label label-danger warning-notice" style="">{{ $exception->getMessage()}} ({{$exception->getCode()}})</span>
           
          @else
              
         
          <strong>{{ $trace['class'] }}</strong> 
           @if ($trace['function'])
           <i>  (function) {{ $trace['function'] }}  </i> <br>
           @endif
           
           @if (isset($trace['file']))
           {{ $trace['file'] }} <span class="label" style="background-color:#333;color:white;">{{ $trace['line'] }}</span>
           @else
              <span style="color:#a29d9d;">[internal]:0</span> 
           @endif

           @endif
          </td>
         </tr>
        @endforeach
     
            </tbody>
              
            </table>
          </div>     
          </div>
        </div>
      </div>
                
        <!-- /.error-content -->
</div>
@endsection
