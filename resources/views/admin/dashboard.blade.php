@extends('admin.layout.app')

@section('maincontent')

<!-- Main Content -->

<style>
   .contain{
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      grid-gap: 5px;
   }
   .contain-2{
      display: grid;
      grid-template-columns: 1fr 1fr;
      grid-gap: 5px;
   }
</style>

<div>
   <h4 style="text-align: center;" class="p-2 bg-success text-white">Profit</h4>
   <div class="contain">

   </div>
</div>
<hr>

<div>
    <div class="contain-2">
        <div style="text-align: center;">

        </div>
    </div>
</div>
<hr>
<div class="d-flex align-items-stretch flex-wrap">




</div>
<hr>
<h6 style="text-align: center;" class="p-2 bg-success text-white">Last 30 Days Profit</h6>


@endsection

@section('extrascript')

<!-- Extra Script -->

@endsection
