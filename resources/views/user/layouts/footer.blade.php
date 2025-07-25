
<!--start overlay-->
<div class="overlay toggle-icon"></div>
<!--end overlay-->
<!--Start Back To Top Button-->
<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
<!--End Back To Top Button-->
<!--<footer class="page-footer" style="background: #01142b !important;">-->
<!--    <p class="mb-0 text-white">Copyright © 2024. All right reserved.</p>-->
<!--</footer>-->
</div>
<!--end wrapper-->
    @php
    $isActive = DB::table('user_package')->where('user_id', Auth::user()->id)->where('status','approved')->exists();
     $blockCheck =  DB::table('user')->where('id',Auth::user()->id)->where('block_withdrawl_wallet',0)->exists();
    @endphp
 <nav class="bottom-navBar navbar">
     <div class=" ">
        <a href="{{route('activate_user')}}" class="nav-linkMenu text-success {{ $isActive && $blockCheck ? '' : 'disabled-link' }}"><i class='bx bx-down-arrow-alt text-warning'></i>Deposit</a>
     </div> 
     <div>
        <a href="{{route('withdrawl_income')}}" class="nav-linkMenu {{ $isActive && $blockCheck ? '' : 'disabled-link' }}"><i class='bx bx-up-arrow-alt text-info'></i>Withdraw</a>
     </div>
     <div>
        <a href="{{route('ptop_transefer')}}" class="nav-linkMenu text-warning {{ $isActive && $blockCheck ? '' : 'disabled-link' }}"><i class='bx bx-transfer-alt text-success'></i>Transfer</a>
     </div> 
     <div>
        <a href="{{route('withdrawl_to_fund')}}" class="nav-linkMenu {{ $isActive && $blockCheck ? '' : 'disabled-link' }}"><i class='bx bx-transfer text-danger'></i>Convert</a>
     </div>
    </nav>
<!-- search modal -->
<div class="modal" id="SearchModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header gap-2">
                <div class="position-relative popup-search w-100">
                    <input class="form-control form-control-lg ps-5 border border-3 border-primary" type="search"
                        placeholder="Search">
                    <span class="position-absolute top-50 search-show ms-3 translate-middle-y start-0 top-50 fs-4"><i
                            class='bx bx-search'></i></span>
                </div>
                <button type="button" class="btn-close d-md-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="search-list">
                    <p class="mb-1">Html Templates</p>
                    <div class="list-group">
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action active align-items-center d-flex gap-2 py-1"><i
                                class='bx bxl-angular fs-4'></i>Best Html Templates</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                class='bx bxl-vuejs fs-4'></i>Html5 Templates</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                class='bx bxl-magento fs-4'></i>Responsive Html5 Templates</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                class='bx bxl-shopify fs-4'></i>eCommerce Html Templates</a>
                    </div>
                    <p class="mb-1 mt-3">Web Designe Company</p>
                    <div class="list-group">
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                class='bx bxl-windows fs-4'></i>Best Html Templates</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                class='bx bxl-dropbox fs-4'></i>Html5 Templates</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                class='bx bxl-opera fs-4'></i>Responsive Html5 Templates</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                class='bx bxl-wordpress fs-4'></i>eCommerce Html Templates</a>
                    </div>
                    <p class="mb-1 mt-3">Software Development</p>
                    <div class="list-group">
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                class='bx bxl-mailchimp fs-4'></i>Best Html Templates</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                class='bx bxl-zoom fs-4'></i>Html5 Templates</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                class='bx bxl-sass fs-4'></i>Responsive Html5 Templates</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                class='bx bxl-vk fs-4'></i>eCommerce Html Templates</a>
                    </div>
                    <p class="mb-1 mt-3">Online Shoping Portals</p>
                    <div class="list-group">
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                class='bx bxl-slack fs-4'></i>Best Html Templates</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                class='bx bxl-skype fs-4'></i>Html5 Templates</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                class='bx bxl-twitter fs-4'></i>Responsive Html5 Templates</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                class='bx bxl-vimeo fs-4'></i>eCommerce Html Templates</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end search modal -->
	<!-- Bootstrap JS -->
	<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	<script src="{{asset('assets/js/jquery.min.js')}}"></script>
	<script src="{{asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="{{asset('assets/plugins/select2/js/select2-custom.js')}}"></script>
	<script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
	<script src="{{asset('assets/plugins/chartjs/js/chart.js')}}"></script>
	<script src="{{asset('assets/js/index.js')}}"></script>
	<!--app JS-->
    <script src="{{asset('assets/plugins/notifications/js/notification-custom-script.js')}}"></script>
    <script src="{{asset('assets/plugins/notifications/js/lobibox.min.js')}}"></script>
    <script src="{{asset('assets/plugins/notifications/js/notifications.min.js')}}"></script>
	<script src="{{asset('assets/js/app.js')}}"></script>
	<script>
		new PerfectScrollbar(".app-container")
	</script>


<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        var table = $('#example2').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print']
        });
        table.buttons().container()
            .appendTo('#example2_wrapper .col-md-6:eq(0)');
    });
</script>

<script>
    $(".delete-btn").on( 'click', function(e){
        // some implementation
        // Now showing the alert
        var url=$(this).attr('href');
        // console.log(url);
        e.preventDefault();
        jQuery.getScript('https://cdn.jsdelivr.net/npm/sweetalert2@11', function() {
        
        Swal.fire({
          title: 'Are you sure to delete?',
          text: "",
          icon: 'success',
          showCancelButton: true,
          confirmButtonColor: '#C64EB2',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes'
        }).then((result) => {
          if (result.isConfirmed) {
             
             console.log(url);
             location.assign(url);
           
          } else {
            console.log('clicked cancel');
          }
        })
        
        })
       
    });
    </script>

</body>
</html>
