<nav id="sidebar">
   <ul class="list-unstyled components">
      <p style="text-align: center;">
         <a href="#">{{ auth()->user()->brand ?? '' }}</a>
         @auth
            <br>
            <span>User - {{ Auth::user()->phone }}</span>
         @endauth
      </p>
      <li>
         <a href="#type" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Create</a>
         <ul class="collapse list-unstyled" id="type">
            <li><a href="{{ route('classes.index') }}">Class</a></li>
            <li><a href="{{ route('subjects.index') }}">Subject</a></li>
            <li><a href="{{ route('students.index') }}">Student</a></li>
         </ul>
      </li>
      <li>
        <a href="#price" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Price</a>
        <ul class="collapse list-unstyled" id="price">

        </ul>
     </li>
      <li>
         <a href="#stock" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Stock</a>
         <ul class="collapse list-unstyled" id="stock">

         </ul>
       </li>
       <li>
         <a href="#report" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Report</a>
         <ul class="collapse list-unstyled" id="report">

         </ul>
       </li>
      {{-- <li><a href="{{ route('admin.interested.list') }}">Interested List &nbsp;<span class="badge badge-danger badge-pill" id="inns">{{ SessionController::adminPanel()['interest'] }}</span></a></li>
      <li><a href="{{ route('admin.product.special.list') }}">Special Bike &nbsp;<span class="badge badge-danger badge-pill" id="inns">{{ SessionController::adminPanel()['special'] }}</span></a></li>
      <li><a href="{{ route('admin.report.sell.product.list') }}">Sell Product List</a></li> --}}
   </ul>
 </nav>
