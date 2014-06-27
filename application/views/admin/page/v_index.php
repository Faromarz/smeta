
        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        Widget settings form goes here
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn blue">Save changes</button>
                        <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        <!-- BEGIN STYLE CUSTOMIZER -->
        <div class="theme-panel hidden-xs hidden-sm">
            <div class="toggler">
            </div>
            <div class="toggler-close">
            </div>
            <div class="theme-options">
                <div class="theme-option theme-colors clearfix">
                    <span>
                        THEME COLOR </span>
                    <ul>
                        <li class="color-default current tooltips" data-style="default" data-original-title="Default">
                        </li>
                        <li class="color-darkblue tooltips" data-style="darkblue" data-original-title="Dark Blue">
                        </li>
                        <li class="color-blue tooltips" data-style="blue" data-original-title="Blue">
                        </li>
                        <li class="color-grey tooltips" data-style="grey" data-original-title="Grey">
                        </li>
                        <li class="color-light tooltips" data-style="light" data-original-title="Light">
                        </li>
                        <li class="color-light2 tooltips" data-style="light2" data-html="true" data-original-title="Light 2">
                        </li>
                    </ul>
                </div>
                <div class="theme-option">
                    <span>
                        Layout </span>
                    <select class="layout-option form-control input-small">
                        <option value="fluid" selected="selected">Fluid</option>
                        <option value="boxed">Boxed</option>
                    </select>
                </div>
                <div class="theme-option">
                    <span>
                        Header </span>
                    <select class="page-header-option form-control input-small">
                        <option value="fixed" selected="selected">Fixed</option>
                        <option value="default">Default</option>
                    </select>
                </div>
                <div class="theme-option">
                    <span>
                        Sidebar </span>
                    <select class="sidebar-option form-control input-small">
                        <option value="fixed">Fixed</option>
                        <option value="default" selected="selected">Default</option>
                    </select>
                </div>
                <div class="theme-option">
                    <span>
                        Sidebar Position </span>
                    <select class="sidebar-pos-option form-control input-small">
                        <option value="left" selected="selected">Left</option>
                        <option value="right">Right</option>
                    </select>
                </div>
                <div class="theme-option">
                    <span>
                        Footer </span>
                    <select class="page-footer-option form-control input-small">
                        <option value="fixed">Fixed</option>
                        <option value="default" selected="selected">Default</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- END STYLE CUSTOMIZER -->
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    Orders <small>orders listing</small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li class="btn-group">
                        <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
                            <span>Actions</span><i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a href="#">Action</a>
                            </li>
                            <li>
                                <a href="#">Another action</a>
                            </li>
                            <li>
                                <a href="#">Something else here</a>
                            </li>
                            <li class="divider">
                            </li>
                            <li>
                                <a href="#">Separated link</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="index.html">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">eCommerce</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">Orders</a>
                    </li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- Begin: life time stats -->
                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-shopping-cart"></i>Order Listing
                        </div>
                        <div class="actions">
                            <a href="#" class="btn default yellow-stripe">
                                <i class="fa fa-plus"></i>
                                <span class="hidden-480">
                                    New Order </span>
                            </a>
                            <div class="btn-group">
                                <a class="btn default yellow-stripe" href="#" data-toggle="dropdown">
                                    <i class="fa fa-share"></i>
                                    <span class="hidden-480">
                                        Tools </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">

                            <div id="datatable_orders_wrapper" class="dataTables_wrapper dataTables_extended_wrapper" role="grid"><div id="prefix_316120453760" class="Metronic-alerts alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><i class="fa-lg fa fa-warning"></i>  Could not complete request. Please check your internet connection</div><div class="row"><div class="col-md-8 col-sm-12"><div class="dataTables_paginate paging_bootstrap_extended"><div class="pagination-panel"> Page <a href="#" class="btn btn-sm default prev disabled" title="Prev"><i class="fa fa-angle-left"></i></a><input type="text" class="pagination-panel-input form-control input-mini input-inline input-sm" maxlenght="5" style="text-align:center; margin: 0 5px;"><a href="#" class="btn btn-sm default next disabled" title="Next"><i class="fa fa-angle-right"></i></a> of <span class="pagination-panel-total"></span></div></div><div id="datatable_orders_length" class="dataTables_length"><label><span class="seperator">|</span>View <select size="1" name="datatable_orders_length" aria-controls="datatable_orders" class="form-control input-xsmall input-sm"><option value="20" selected="selected">20</option><option value="50">50</option><option value="100">100</option><option value="150">150</option><option value="-1">All</option></select> records</label></div><div class="dataTables_info" id="datatable_orders_info"></div></div><div class="col-md-4 col-sm-12"><div class="table-group-actions pull-right">
                                            <span>
                                            </span>
                                            <select class="table-group-action-input form-control input-inline input-small input-sm">
                                                <option value="">Select...</option>
                                                <option value="Cancel">Cancel</option>
                                                <option value="Cancel">Hold</option>
                                                <option value="Cancel">On Hold</option>
                                                <option value="Close">Close</option>
                                            </select>
                                            <button class="btn btn-sm yellow table-group-action-submit"><i class="fa fa-check"></i> Submit</button>
                                        </div></div></div><div class="table-scrollable"><table class="table table-striped table-bordered table-hover dataTable" id="datatable_orders" aria-describedby="datatable_orders_info">
                                        <thead>
                                            <tr role="row" class="heading"><th width="5%" class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="

                                                                               ">
                                        <div class="checker"><span><input type="checkbox" class="group-checkable"></span></div>
                                    </th><th width="5%" class="sorting_asc" role="columnheader" tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-label="
                                             Order&amp;nbsp;#
                                             : activate to sort column ascending">
                                    Order&nbsp;#
                                </th><th width="15%" class="sorting" role="columnheader" tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-label="
                                         Purchased&amp;nbsp;On
                                         : activate to sort column ascending">
                                    Purchased&nbsp;On
                                </th><th width="15%" class="sorting" role="columnheader" tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-label="
                                         Customer
                                         : activate to sort column ascending">
                                    Customer
                                </th><th width="10%" class="sorting" role="columnheader" tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-label="
                                         Ship&amp;nbsp;To
                                         : activate to sort column ascending">
                                    Ship&nbsp;To
                                </th><th width="10%" class="sorting" role="columnheader" tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-label="
                                         Base&amp;nbsp;Price
                                         : activate to sort column ascending">
                                    Base&nbsp;Price
                                </th><th width="10%" class="sorting" role="columnheader" tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-label="
                                         Purchased&amp;nbsp;Price
                                         : activate to sort column ascending">
                                    Purchased&nbsp;Price
                                </th><th width="10%" class="sorting" role="columnheader" tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-label="
                                         Status
                                         : activate to sort column ascending">
                                    Status
                                </th><th width="10%" class="sorting" role="columnheader" tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-label="
                                         Actions
                                         : activate to sort column ascending">
                                    Actions
                                </th></tr>
                                <tr role="row" class="filter"><td rowspan="1" colspan="1">
                                    </td><td rowspan="1" colspan="1">
                                        <input type="text" class="form-control form-filter input-sm" name="order_id">
                                    </td><td rowspan="1" colspan="1">
                                        <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                            <input type="text" class="form-control form-filter input-sm" readonly="" name="order_date_from" placeholder="From">
                                            <span class="input-group-btn">
                                                <button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
                                            </span>
                                        </div>
                                        <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                                            <input type="text" class="form-control form-filter input-sm" readonly="" name="order_date_to" placeholder="To">
                                            <span class="input-group-btn">
                                                <button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
                                            </span>
                                        </div>
                                    </td><td rowspan="1" colspan="1">
                                        <input type="text" class="form-control form-filter input-sm" name="order_customer_name">
                                    </td><td rowspan="1" colspan="1">
                                        <input type="text" class="form-control form-filter input-sm" name="order_ship_to">
                                    </td><td rowspan="1" colspan="1">
                                        <div class="margin-bottom-5">
                                            <input type="text" class="form-control form-filter input-sm" name="order_base_price_from" placeholder="From">
                                        </div>
                                        <input type="text" class="form-control form-filter input-sm" name="order_base_price_to" placeholder="To">
                                    </td><td rowspan="1" colspan="1">
                                        <div class="margin-bottom-5">
                                            <input type="text" class="form-control form-filter input-sm margin-bottom-5 clearfix" name="order_purchase_price_from" placeholder="From">
                                        </div>
                                        <input type="text" class="form-control form-filter input-sm" name="order_purchase_price_to" placeholder="To">
                                    </td><td rowspan="1" colspan="1">
                                        <select name="order_status" class="form-control form-filter input-sm">
                                            <option value="">Select...</option>
                                            <option value="pending">Pending</option>
                                            <option value="closed">Closed</option>
                                            <option value="hold">On Hold</option>
                                            <option value="fraud">Fraud</option>
                                        </select>
                                    </td><td rowspan="1" colspan="1">
                                        <div class="margin-bottom-5">
                                            <button class="btn btn-sm yellow filter-submit margin-bottom"><i class="fa fa-search"></i> Search</button>
                                        </div>
                                        <button class="btn btn-sm red filter-cancel"><i class="fa fa-times"></i> Reset</button>
                                    </td></tr>
                                </thead>
                                <tbody role="alert" aria-live="polite" aria-relevant="all">
                                </tbody>
                            </table></div><div class="row"><div class="col-md-8 col-sm-12"><div class="dataTables_paginate paging_bootstrap_extended"><div class="pagination-panel"> Page <a href="#" class="btn btn-sm default prev disabled" title="Prev"><i class="fa fa-angle-left"></i></a><input type="text" class="pagination-panel-input form-control input-mini input-inline input-sm" maxlenght="5" style="text-align:center; margin: 0 5px;"><a href="#" class="btn btn-sm default next disabled" title="Next"><i class="fa fa-angle-right"></i></a> of <span class="pagination-panel-total"></span></div></div><div class="dataTables_length"><label><span class="seperator">|</span>View <select size="1" name="datatable_orders_length" aria-controls="datatable_orders" class="form-control input-xsmall input-sm"><option value="20" selected="selected">20</option><option value="50">50</option><option value="100">100</option><option value="150">150</option><option value="-1">All</option></select> records</label></div><div class="dataTables_info"></div></div><div class="col-md-4 col-sm-12"></div></div></div>
                </div>
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
