<nav id="sidebar">
  <ul class="list-unstyled components">
    <p style="text-align: center;">
      <a href="#">Afroza Traders</a>
      @if(isset(Auth::user()->id))
        <br>
        <span>User - {{ Auth::user()->mobile }}</span>
      @endif
    </p>
    <li>
      <a href="#type" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Create</a>
      <ul class="collapse list-unstyled" id="type">
         <li><a href="#">Type</a></li>
         <li><a href="#">Category</a></li>
         <li><a href="#">Brand</a></li>
         <li><a href="#">Product</a></li>
      </ul>
    </li>
    <li>
      <a href="#stockin" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Stockin</a>
      <ul class="collapse list-unstyled" id="stockin">
         <li><a href="#">Stockin</a></li>
      </ul>
    </li>
     {{-- {!! SessionController::list() !!} --}}
  </ul>
</nav>
