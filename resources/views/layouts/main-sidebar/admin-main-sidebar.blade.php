<div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->


                    <li> <a href="{{route('dashboard')}}">{{ __('track.dashboard') }}</a> </li>




                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{ __('track.All Tracking') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="dashboard" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('tracking.all')}}">{{ __('track.all_tracking') }}</a> </li>
							<li> <a href="{{route('ajax.track')}}">تجربة الشحنات</a> </li>
							
                            <li> <a href="{{route('UpdateTracking')}}">{{ __('track.Updated Tracking number') }}</a> </li>
                            <li> <a href="{{route('Archives')}}">{{ __('track.archives') }}</a> </li>

                        </ul>
                    </li>
                    <!-- menu title -->

                    <!-- menu item Elements-->
                    <li>
                        <a href="" data-toggle="collapse" data-target="#Reports">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{ __('track.Reports') }}</span></div>
                                    <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Reports" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('reportnumber')}}">{{ __('track.Tracking Number') }}</a> </li>
                            <li> <a href="{{route('report')}}">{{ __('track.Tracking Status') }}</a> </li>


                        </ul>

                    <!-- menu item calendar-->
                   <!-- {{--@if(auth()->user()->is_admin==1)--}} -->

                     @if(auth()->user()->is_admin==1)
                      <!-- menu item Users-->
                      <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#users">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{ __('track.Users') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="users" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('all.user')}}">{{ __('track.Users') }}</a> </li>
                            <li> <a href="{{route('add.user')}}">{{ __('track.Add User') }}</a> </li>


                        </ul>
                    </li>
                    @endif



 <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Countries">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{ __('track.Countries') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Countries" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('all.country')}}">{{ __('track.Add Countries') }}</a> </li>



                        </ul>
                    </li>



                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Type">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{ __('track.Type Tracking') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Type" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('all.TrackingType')}}">{{ __('track.Add Type Tracking') }}</a> </li>
                           



                        </ul>
                    </li>


                    @if(auth()->user()->is_admin==1)
                   <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#client">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{ __('track.customers') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="client" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('all.clients.show')}}"> {{ __('track.customer_show') }}</a> </li>
                            <!--<li> <a href="{{route('Account.clients.show')}}">{{ __('track.رصيد العملاء  ') }}</a> </li> -->
                            <li> <a href="{{route('Payment.clients.show')}}">{{ __('track.customer_account') }} </a> </li>




                        </ul>
                    </li>

                    @endif
                    
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#noti">
                            <div class="pull-left"><i class="ti-bell"></i><span class="right-nav-text">{{ __('track.Notifications') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="noti" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('notification.all')}}"> {{ __('track.Notifications') }}</a> </li>
                            <!--<li> <a href="{{route('Account.clients.show')}}">{{ __('track.رصيد العملاء  ') }}</a> </li> -->
                            <li> <a href="{{route('notification.read')}}"> {{ __('track.old_Notifications') }} </a> </li>




                        </ul>
                    </li>
<!--  end menu item Users-->








                </ul>
            </div>

