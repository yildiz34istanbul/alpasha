<div id="myModal" class="modal fade" role="dialog"
     @if (App::getLocale() == 'ar')
     style="direction: rtl"
     dir="rtl"
     @endif
>
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                <h4 class="modal-title">اشعار جديد</h4>
            </div>
            <div class="modal-body">
                <p id="notify-msg"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a id="notify-link-btn" href="{{route('UpdateTracking')}}" type="button" class="btn btn-success" data-dismiss="modal">show</a>
            </div>
        </div>

    </div>
</div>
<!-- Footer opened -->
 <footer class="bg-white p-4">
      <div class="row">
        <div class="col-md-6">
          <div class="text-center text-md-left">
              <p class="mb-0"> &copy; Copyright <span id="copyright"> <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script></span>. <a href="#"> ALPASHA GROUP </a> All Rights Reserved. </p>
          </div>
        </div>
        <div class="col-md-6">
          <ul class="text-center text-md-right">
            <li class="list-inline-item"><a href="#">Terms & Conditions </a> </li>
          
          </ul>
        </div>
      </div>
    </footer>
<!-- Footer closed -->
