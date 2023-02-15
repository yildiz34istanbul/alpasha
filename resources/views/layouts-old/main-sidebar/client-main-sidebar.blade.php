<div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->


                    <li> <a href="{{route('dashboard')}}" style="font-family: 'Cairo', sans-serif;">{{ __('track.dashboard') }}</a> </li>




                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text" style="font-family: 'Cairo', sans-serif;">{{ __('track.All Tracking') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="dashboard" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('Track.show')}}" style="font-family: 'Cairo', sans-serif;">{{ __('track.all_tracking') }}</a> </li>


                        </ul>
                    </li>
                    <!-- menu title -->

                    <!-- menu item Elements-->
                    <li>
                        <a href="" data-toggle="collapse" data-target="#Reports">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text" style="font-family: 'Cairo', sans-serif;">{{ __('track.Invoices') }} </span></div>
                                    <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Reports" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('invoice.show')}}" style="font-family: 'Cairo', sans-serif;">{{ __('track.Invoices') }} </a> </li>



                        </ul>

                    <!-- menu item calendar-->
                   <!-- {{--@if(auth()->user()->is_admin==1)--}} -->


                      <!-- menu item Users-->
                     <!--   <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#users">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{ __('track.Payments') }} </span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="users" class="collapse" data-parent="#sidebarnav">
                        <!--    <li> <a href="{{route('payment.show')}}">الدفعات المالية</a> </li> 



                        </ul>
                    </li> -->




 <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Countries">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text" style="font-family: 'Cairo', sans-serif;">{{ __('track.Shipment_Tracking') }} </span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Countries" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('client.reportnumber')}}" style="font-family: 'Cairo', sans-serif;">{{ __('track.Shipment_Tracking') }}</a> </li>



                        </ul>
                    </li>


 <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#clientnoti">
                            <div class="pull-left"><i class="ti-bell"></i><span class="right-nav-text" style="font-family: 'Cairo', sans-serif;">{{ __('track.Notifications') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="clientnoti" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('Client.notification.all')}}" style="font-family: 'Cairo', sans-serif;">{{ __('track.Notifications') }}</a> </li>
                            <!--<li> <a href="{{route('Account.clients.show')}}">{{ __('track.رصيد العملاء  ') }}</a> </li> -->
                            <li> <a href="{{route('Client.notification.read')}}" style="font-family: 'Cairo', sans-serif;">{{ __('track.old_Notifications') }} </a> </li>




                        </ul>
                    </li>

<!--  end menu item Users-->








                </ul>
            </div>

