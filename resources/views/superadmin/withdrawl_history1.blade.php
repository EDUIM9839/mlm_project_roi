@extends('admin.layouts.main')
@section('mains')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
             <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Dashboard</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">withdrawl history</li>
                        </ol>
                    </nav>
                </div>
               
            </div>
            <!--end breadcrumb-->
             
            <!--end breadcrumb-->
           <!-- Scrollable -->
            <div class="card">
            <div class="card-body d-flex" style="justify-content: center;">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="#" method="post">
                              <div class="row">
                                <div class="col-sm-3 text-center" style="padding-top:6px">
                                  Select Payout:
                                  
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-coin'></i></span>
                                  <select class="form-control" name="date">
                                  
                                  </select>
                                </div>
                                </div>
                                <div class="col-sm-3">
                                    
                                    
                                    
                                    <input type="hidden" name="check_date"   />
                                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </div>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
              </div>
              <div class="table-responsive text-nowrap mb-5" style="padding:10px">
                <table id="example" class="table">
                  <thead>
                   <tr class='table-dark'>
                      <th>S.No.</th>
                      <th>User Name</th>
                      <th>User ID</th>
                      <th>Withdrawal Amount</th>
                      <th>TDS</th>
                      <th>Admin Charges</th>
                      <th>Paying Amount</th>
                      <th>Bank Details</th>
                      <th>Status</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                        <tr>
                          <td>1</td>
                          <td>1 </td>
                          <td> 1</td>
                          
                          <td> 1</td>
                          <td>1 </td>
                          <td> 1</td>
                          <!--<td>-->
                          <!--    <b>Bank Name: </b> <br/>-->
                          <!--    <b>A/c No.:  <br/>-->
                          <!--    <b>A/c Holder Name:  <br/>-->
                          <!--    <b>IFSC Code:  <br/>  -->
                          <!--    <b>GPay No.:  <br/>-->
                          <!--    <b>Phone pay No.:  <br/>-->
                          <!--    <b>Paytm No.: </b> -->
                          <!--</td>-->
                          <td> 1</td>
                          <td> 1</td>
                           <td> 1</td>
                          <td> 1</td>
                           <td> 1</td>
                          
                          <td>
                             
                            <form action="#" method="post">
                              <input type="hidden" name="userid"/>
                              <input type="hidden" name="id"  />
                              <input type="hidden" name="previous_amount"  />
                              <input type="hidden" name="amount"  />
                              
                            </form>
                            
                              
                          </td>
                        </tr>
                        
                        <!-- The Modal -->
                        <div class="modal" id="myModal ">
                          <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                        
                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">Withdrawal Amount Details</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                        
                              <!-- Modal body -->
                              <div class="modal-body">
                                Modal body..
                              </div>
                        
                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                              </div>
                        
                            </div>
                          </div>
                        </div>
 
                  </tbody>
                </table>
              </div>
            </div>
            <!--/ Scrollable -->

        </div>
    </div>
@endsection
