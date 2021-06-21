<?php require_once('header.php'); ?>
	<style>
		.dataTable tr, .dataTable td {
		     white-space: unset;
		}
		.editComp{
			cursor: pointer;
		}
    </style>
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="components-preview wide-md mx-auto">
                                    <div class="nk-block nk-block-lg contner">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content">
                                                <h4 class="title nk-block-title">Deposits</h4>
                                                <div class="nk-block-des">
                                                    <p>Get Deposits Stats here</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                                <ul class="nav nav-tabs nav-tabs-s2 mt-n2">
                                                    <li class="nav-item active">
                                                        <a class="nav-link" data-toggle="tab" href="#tabItem9">Deposits</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#tabItem10">Waiting</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#tabItem11">Pending</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#tabItem12">Completed</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#tabItem13">Insufficient</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#tabItem14">Cancelled</a>
                                                    </li>
                                                </ul>
                                                <hr/>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tabItem9">
                                                    	<div class="table-responsive">
			                                                <table class="datatable-init table nk-tb-list responsive">
			                                                    <thead>
			                                                        <tr>
			                                                            <th>Username</th>
			                                                            <th>Time</th>
			                                                            <th>Expected-Amt <?php echo $core->site_currency; ?></th>
			                                                            <th>Actual-Amt <?php echo $core->site_currency; ?></th>
			                                                            <th>Plan</th>
			                                                            <th>Currency</th>
			                                                            <th>Method</th>
			                                                            <th>T-id</th>
			                                                            <th>Desc</th>
			                                                            <th>Status</th>
			                                                            <th>...</th>
			                                                        </tr>
			                                                    </thead>
			                                                    <tbody>
	                        										<?php foreach ($core->all_deposits_records as $depositItem) { ?>
				                                                        <tr>
				                                                            <td id="use-<?php echo $depositItem->id; ?>"><?php echo $depositItem->user; ?></td>
				                                                            <td id="tim-<?php echo $depositItem->id; ?>"><?php echo $depositItem->time; ?></td>
				                                                            <td id="iamt-<?php echo $depositItem->id; ?>"><?php echo number_format((int)$depositItem->init_amount,2); ?></td>
				                                                            <td id="amt-<?php echo $depositItem->id; ?>"><?php echo number_format((int)$depositItem->amount,2); ?></td>
				                                                            <td id="pla-<?php echo $depositItem->id; ?>"><?php echo $depositItem->plan_id; ?></td>
				                                                            <td id="cur-<?php echo $depositItem->id; ?>"><?php echo $depositItem->currency; ?></td>
				                                                            <td id="met-<?php echo $depositItem->id; ?>"><?php echo $depositItem->reference; ?></td>
				                                                            <td id="tid-<?php echo $depositItem->id; ?>"><?php echo $depositItem->txn_id; ?></td>
				                                                            <td id="des-<?php echo $depositItem->id; ?>"><?php echo $depositItem->description; ?></td>
				                                                            <td id="sta-<?php echo $depositItem->id; ?>"><?php echo $depositItem->status; ?></td>
				                                                            <td class="nk-tb-col nk-tb-col-tools">
						                                                        <ul class="nk-tb-actions gx-1" style="justify-content: unset;">
				                                                                    <li>
				                                                                        <div class="drodow">
				                                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
				                                                                            <div class="dropdown-menu dropdown-menu-right">
				                                                                                <ul class="link-list-opt no-bdr">
				                                                                                    <li><a onclick="editor('<?php echo $depositItem->id; ?>')" class="editComp"><em class="icon ni ni-edit-alt tb-status text-warning"></em><span>Edit</span></a></li>
				                                                                                    <li><a href="../includes/form.php?dact=withdrawals&did=<?php echo $depositItem->id; ?>" class="editComp"><em class="icon ni ni-trash tb-status text-danger"></em><span>Delete</span></a></li>
				                                                                                </ul>
				                                                                            </div>
				                                                                        </div>
				                                                                    </li>
				                                                                </ul>
		                                                                    </td>
				                                                        </tr>
						                                            <?php } ?>
			                                                    </tbody>
			                                                </table>
		                                            	</div>
                                                    </div>
                                                    <div class="tab-pane" id="tabItem10">
                                                    	<div class="table-responsive">
			                                                <table class="datatable-init table nk-tb-list responsive">
			                                                    <thead>
			                                                        <tr>
			                                                            <th>Username</th>
			                                                            <th>Time</th>
			                                                            <th>Expected-Amt <?php echo $core->site_currency; ?></th>
			                                                            <th>Actual-Amt <?php echo $core->site_currency; ?></th>
			                                                            <th>Plan</th>
			                                                            <th>Currency</th>
			                                                            <th>Method</th>
			                                                            <th>T-id</th>
			                                                            <th>Desc</th>
			                                                            <th>Status</th>
			                                                            <th>...</th>
			                                                        </tr>
			                                                    </thead>
			                                                    <tbody>
	                        										<?php foreach ($core->all_deposits_records_waiting as $depositItem) { ?>
				                                                        <tr>
				                                                            <td id="use-<?php echo $depositItem->id; ?>"><?php echo $depositItem->user; ?></td>
				                                                            <td id="tim-<?php echo $depositItem->id; ?>"><?php echo $depositItem->time; ?></td>
				                                                            <td id="iamt-<?php echo $depositItem->id; ?>"><?php echo number_format((int)$depositItem->init_amount,2); ?></td>
				                                                            <td id="amt-<?php echo $depositItem->id; ?>"><?php echo number_format((int)$depositItem->amount,2); ?></td>
				                                                            <td id="pla-<?php echo $depositItem->id; ?>"><?php echo $depositItem->plan_id; ?></td>
				                                                            <td id="cur-<?php echo $depositItem->id; ?>"><?php echo $depositItem->currency; ?></td>
				                                                            <td id="met-<?php echo $depositItem->id; ?>"><?php echo $depositItem->reference; ?></td>
				                                                            <td id="tid-<?php echo $depositItem->id; ?>"><?php echo $depositItem->txn_id; ?></td>
				                                                            <td id="des-<?php echo $depositItem->id; ?>"><?php echo $depositItem->description; ?></td>
				                                                            <td id="sta-<?php echo $depositItem->id; ?>"><?php echo $depositItem->status; ?></td>
				                                                            <td class="nk-tb-col nk-tb-col-tools">
						                                                        <ul class="nk-tb-actions gx-1" style="justify-content: unset;">
				                                                                    <li>
				                                                                        <div class="drodow">
				                                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
				                                                                            <div class="dropdown-menu dropdown-menu-right">
				                                                                                <ul class="link-list-opt no-bdr">
				                                                                                    <li><a onclick="editor('<?php echo $depositItem->id; ?>')" class="editComp"><em class="icon ni ni-edit-alt tb-status text-warning"></em><span>Edit</span></a></li>
				                                                                                    <li><a href="../includes/form.php?dact=withdrawals&did=<?php echo $depositItem->id; ?>" class="editComp"><em class="icon ni ni-trash tb-status text-danger"></em><span>Delete</span></a></li>
				                                                                                </ul>
				                                                                            </div>
				                                                                        </div>
				                                                                    </li>
				                                                                </ul>
		                                                                    </td>
				                                                        </tr>
						                                            <?php } ?>
			                                                    </tbody>
			                                                </table>
		                                            	</div>
                                                    </div>
                                                    <div class="tab-pane" id="tabItem11">
                                                    	<div class="table-responsive">
			                                                <table class="datatable-init table nk-tb-list responsive">
			                                                    <thead>
			                                                        <tr>
			                                                            <th>Username</th>
			                                                            <th>Time</th>
			                                                            <th>Expected-Amt <?php echo $core->site_currency; ?></th>
			                                                            <th>Actual-Amt <?php echo $core->site_currency; ?></th>
			                                                            <th>Plan</th>
			                                                            <th>Currency</th>
			                                                            <th>Method</th>
			                                                            <th>T-id</th>
			                                                            <th>Desc</th>
			                                                            <th>Status</th>
			                                                            <th>...</th>
			                                                        </tr>
			                                                    </thead>
			                                                    <tbody>
	                        										<?php foreach ($core->all_deposits_records_pending as $depositItem) { ?>
				                                                        <tr>
				                                                            <td id="use-<?php echo $depositItem->id; ?>"><?php echo $depositItem->user; ?></td>
				                                                            <td id="tim-<?php echo $depositItem->id; ?>"><?php echo $depositItem->time; ?></td>
				                                                            <td id="iamt-<?php echo $depositItem->id; ?>"><?php echo number_format((int)$depositItem->init_amount,2); ?></td>
				                                                            <td id="amt-<?php echo $depositItem->id; ?>"><?php echo number_format((int)$depositItem->amount,2); ?></td>
				                                                            <td id="pla-<?php echo $depositItem->id; ?>"><?php echo $depositItem->plan_id; ?></td>
				                                                            <td id="cur-<?php echo $depositItem->id; ?>"><?php echo $depositItem->currency; ?></td>
				                                                            <td id="met-<?php echo $depositItem->id; ?>"><?php echo $depositItem->reference; ?></td>
				                                                            <td id="tid-<?php echo $depositItem->id; ?>"><?php echo $depositItem->txn_id; ?></td>
				                                                            <td id="des-<?php echo $depositItem->id; ?>"><?php echo $depositItem->description; ?></td>
				                                                            <td id="sta-<?php echo $depositItem->id; ?>"><?php echo $depositItem->status; ?></td>
				                                                            <td class="nk-tb-col nk-tb-col-tools">
						                                                        <ul class="nk-tb-actions gx-1" style="justify-content: unset;">
				                                                                    <li>
				                                                                        <div class="drodow">
				                                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
				                                                                            <div class="dropdown-menu dropdown-menu-right">
				                                                                                <ul class="link-list-opt no-bdr">
				                                                                                    <li><a onclick="editor('<?php echo $depositItem->id; ?>')" class="editComp"><em class="icon ni ni-edit-alt tb-status text-warning"></em><span>Edit</span></a></li>
				                                                                                    <li><a href="../includes/form.php?dact=withdrawals&did=<?php echo $depositItem->id; ?>" class="editComp"><em class="icon ni ni-trash tb-status text-danger"></em><span>Delete</span></a></li>
				                                                                                </ul>
				                                                                            </div>
				                                                                        </div>
				                                                                    </li>
				                                                                </ul>
		                                                                    </td>
				                                                        </tr>
						                                            <?php } ?>
			                                                    </tbody>
			                                                </table>
		                                            	</div>
                                                    </div>
                                                    <div class="tab-pane" id="tabItem12">
                                                    	<div class="table-responsive">
			                                                <table class="datatable-init table nk-tb-list responsive">
			                                                    <thead>
			                                                        <tr>
			                                                            <th>Username</th>
			                                                            <th>Time</th>
			                                                            <th>Expected-Amt <?php echo $core->site_currency; ?></th>
			                                                            <th>Actual-Amt <?php echo $core->site_currency; ?></th>
			                                                            <th>Plan</th>
			                                                            <th>Currency</th>
			                                                            <th>Method</th>
			                                                            <th>T-id</th>
			                                                            <th>Desc</th>
			                                                            <th>Status</th>
			                                                            <th>...</th>
			                                                        </tr>
			                                                    </thead>
			                                                    <tbody>
	                        										<?php foreach ($core->all_deposits_records_processed as $depositItem) { ?>
				                                                        <tr>
				                                                            <td id="use-<?php echo $depositItem->id; ?>"><?php echo $depositItem->user; ?></td>
				                                                            <td id="tim-<?php echo $depositItem->id; ?>"><?php echo $depositItem->time; ?></td>
				                                                            <td id="iamt-<?php echo $depositItem->id; ?>"><?php echo number_format((int)$depositItem->init_amount,2); ?></td>
				                                                            <td id="amt-<?php echo $depositItem->id; ?>"><?php echo number_format((int)$depositItem->amount,2); ?></td>
				                                                            <td id="pla-<?php echo $depositItem->id; ?>"><?php echo $depositItem->plan_id; ?></td>
				                                                            <td id="cur-<?php echo $depositItem->id; ?>"><?php echo $depositItem->currency; ?></td>
				                                                            <td id="met-<?php echo $depositItem->id; ?>"><?php echo $depositItem->reference; ?></td>
				                                                            <td id="tid-<?php echo $depositItem->id; ?>"><?php echo $depositItem->txn_id; ?></td>
				                                                            <td id="des-<?php echo $depositItem->id; ?>"><?php echo $depositItem->description; ?></td>
				                                                            <td id="sta-<?php echo $depositItem->id; ?>"><?php echo $depositItem->status; ?></td>
				                                                            <td class="nk-tb-col nk-tb-col-tools">
						                                                        <ul class="nk-tb-actions gx-1" style="justify-content: unset;">
				                                                                    <li>
				                                                                        <div class="drodow">
				                                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
				                                                                            <div class="dropdown-menu dropdown-menu-right">
				                                                                                <ul class="link-list-opt no-bdr">
				                                                                                    <li><a onclick="editor('<?php echo $depositItem->id; ?>')" class="editComp"><em class="icon ni ni-edit-alt tb-status text-warning"></em><span>Edit</span></a></li>
				                                                                                    <li><a href="../includes/form.php?dact=withdrawals&did=<?php echo $depositItem->id; ?>" class="editComp"><em class="icon ni ni-trash tb-status text-danger"></em><span>Delete</span></a></li>
				                                                                                </ul>
				                                                                            </div>
				                                                                        </div>
				                                                                    </li>
				                                                                </ul>
		                                                                    </td>
				                                                        </tr>
						                                            <?php } ?>
			                                                    </tbody>
			                                                </table>
		                                            	</div>
                                                    </div>
                                                    <div class="tab-pane" id="tabItem13">
                                                    	<div class="table-responsive">
			                                                <table class="datatable-init table nk-tb-list responsive">
			                                                    <thead>
			                                                        <tr>
			                                                            <th>Username</th>
			                                                            <th>Time</th>
			                                                            <th>Expected-Amt <?php echo $core->site_currency; ?></th>
			                                                            <th>Actual-Amt <?php echo $core->site_currency; ?></th>
			                                                            <th>Plan</th>
			                                                            <th>Currency</th>
			                                                            <th>Method</th>
			                                                            <th>T-id</th>
			                                                            <th>Desc</th>
			                                                            <th>Status</th>
			                                                            <th>...</th>
			                                                        </tr>
			                                                    </thead>
			                                                    <tbody>
	                        										<?php foreach ($core->all_deposits_records_insufficient as $depositItem) { ?>
				                                                        <tr>
				                                                            <td id="use-<?php echo $depositItem->id; ?>"><?php echo $depositItem->user; ?></td>
				                                                            <td id="tim-<?php echo $depositItem->id; ?>"><?php echo $depositItem->time; ?></td>
				                                                            <td id="iamt-<?php echo $depositItem->id; ?>"><?php echo number_format((int)$depositItem->init_amount,2); ?></td>
				                                                            <td id="amt-<?php echo $depositItem->id; ?>"><?php echo number_format((int)$depositItem->amount,2); ?></td>
				                                                            <td id="pla-<?php echo $depositItem->id; ?>"><?php echo $depositItem->plan_id; ?></td>
				                                                            <td id="cur-<?php echo $depositItem->id; ?>"><?php echo $depositItem->currency; ?></td>
				                                                            <td id="met-<?php echo $depositItem->id; ?>"><?php echo $depositItem->reference; ?></td>
				                                                            <td id="tid-<?php echo $depositItem->id; ?>"><?php echo $depositItem->txn_id; ?></td>
				                                                            <td id="des-<?php echo $depositItem->id; ?>"><?php echo $depositItem->description; ?></td>
				                                                            <td id="sta-<?php echo $depositItem->id; ?>"><?php echo $depositItem->status; ?></td>
				                                                            <td class="nk-tb-col nk-tb-col-tools">
						                                                        <ul class="nk-tb-actions gx-1" style="justify-content: unset;">
				                                                                    <li>
				                                                                        <div class="drodow">
				                                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
				                                                                            <div class="dropdown-menu dropdown-menu-right">
				                                                                                <ul class="link-list-opt no-bdr">
				                                                                                    <li><a onclick="editor('<?php echo $depositItem->id; ?>')" class="editComp"><em class="icon ni ni-edit-alt tb-status text-warning"></em><span>Edit</span></a></li>
				                                                                                    <li><a href="../includes/form.php?dact=withdrawals&did=<?php echo $depositItem->id; ?>" class="editComp"><em class="icon ni ni-trash tb-status text-danger"></em><span>Delete</span></a></li>
				                                                                                </ul>
				                                                                            </div>
				                                                                        </div>
				                                                                    </li>
				                                                                </ul>
		                                                                    </td>
				                                                        </tr>
						                                            <?php } ?>
			                                                    </tbody>
			                                                </table>
		                                            	</div>
                                                    </div>
                                                    <div class="tab-pane" id="tabItem14">
                                                    	<div class="table-responsive">
			                                                <table class="datatable-init table nk-tb-list responsive">
			                                                    <thead>
			                                                        <tr>
			                                                            <th>Username</th>
			                                                            <th>Time</th>
			                                                            <th>Expected-Amt <?php echo $core->site_currency; ?></th>
			                                                            <th>Actual-Amt <?php echo $core->site_currency; ?></th>
			                                                            <th>Plan</th>
			                                                            <th>Currency</th>
			                                                            <th>Method</th>
			                                                            <th>T-id</th>
			                                                            <th>Desc</th>
			                                                            <th>Status</th>
			                                                            <th>...</th>
			                                                        </tr>
			                                                    </thead>
			                                                    <tbody>
	                        										<?php foreach ($core->all_deposits_records_cancelled as $depositItem) { ?>
				                                                        <tr>
				                                                            <td id="use-<?php echo $depositItem->id; ?>"><?php echo $depositItem->user; ?></td>
				                                                            <td id="tim-<?php echo $depositItem->id; ?>"><?php echo $depositItem->time; ?></td>
				                                                            <td id="iamt-<?php echo $depositItem->id; ?>"><?php echo number_format((int)$depositItem->init_amount,2); ?></td>
				                                                            <td id="amt-<?php echo $depositItem->id; ?>"><?php echo number_format((int)$depositItem->amount,2); ?></td>
				                                                            <td id="pla-<?php echo $depositItem->id; ?>"><?php echo $depositItem->plan_id; ?></td>
				                                                            <td id="cur-<?php echo $depositItem->id; ?>"><?php echo $depositItem->currency; ?></td>
				                                                            <td id="met-<?php echo $depositItem->id; ?>"><?php echo $depositItem->reference; ?></td>
				                                                            <td id="tid-<?php echo $depositItem->id; ?>"><?php echo $depositItem->txn_id; ?></td>
				                                                            <td id="des-<?php echo $depositItem->id; ?>"><?php echo $depositItem->description; ?></td>
				                                                            <td id="sta-<?php echo $depositItem->id; ?>"><?php echo $depositItem->status; ?></td>
				                                                            <td class="nk-tb-col nk-tb-col-tools">
						                                                        <ul class="nk-tb-actions gx-1" style="justify-content: unset;">
				                                                                    <li>
				                                                                        <div class="drodow">
				                                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
				                                                                            <div class="dropdown-menu dropdown-menu-right">
				                                                                                <ul class="link-list-opt no-bdr">
				                                                                                    <li><a onclick="editor('<?php echo $depositItem->id; ?>')" class="editComp"><em class="icon ni ni-edit-alt tb-status text-warning"></em><span>Edit</span></a></li>
				                                                                                    <li><a href="../includes/form.php?dact=withdrawals&did=<?php echo $depositItem->id; ?>" class="editComp"><em class="icon ni ni-trash tb-status text-danger"></em><span>Delete</span></a></li>
				                                                                                </ul>
				                                                                            </div>
				                                                                        </div>
				                                                                    </li>
				                                                                </ul>
		                                                                    </td>
				                                                        </tr>
						                                            <?php } ?>
			                                                    </tbody>
			                                                </table>
		                                            	</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card-preview -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
			    <!-- @@ Review Edit Modal @e -->
			    <div class="modal fade zoom" tabindex="-1" role="dialog" id="deposit-edit">
			        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
			            <form method="post" action="../includes/form.php" class="form-validate">
			                <?php $csrf->echoInputField(); ?>
			                <div class="modal-content">
			                    <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
			                    <div class="modal-body modal-body-sm">
			                        <div class="modal-header">
			                            <h6 class="modal-title" id="rev-title">Deposit Status</h6>
			                        </div>
			                                <div class="row gy-4">
			                                    <div class="col-md-12">
			                                        <div class="form-group">
			                                            <label class="form-label" for="full-name">status</label>
			                                            <div class="form-control-wrap">
			                                                <select id="item1" class="form-select form-control form-control-lg select2-hidden-accessible" name="status" tabindex="-1" aria-hidden="true" required="">
			                                                        <option value="0">Waiting</option>
			                                                        <option value="2">Pending</option>
			                                                        <option value="1">Processed</option>
			                                                        <option value="3">Insufficient</option>
			                                                        <option value="4">Cancelled</option>
			                                                </select>
			                                            </div>
			                                        </div>
			                                    </div>
			                                    <div class="col-12">
			                                        <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
			                                            <li>
			                                                <input type="hidden" id="rev-idz" name="item2">
			                                                <input type="submit" id="submit" class="btn btn-lg btn-primary" value="Update" name="update-deposits">
			                                            </li>
			                                            <li>
			                                                <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
			                                            </li>
			                                        </ul>
			                                    </div>
			                                </div>
			                    </div><!-- .modal-body -->
			                </div><!-- .modal-content -->
			            </form>
			        </div><!-- .modal-dialog -->
			    </div><!-- .modal -->
<script>
	function editor(did){
		$('#deposit-edit').modal('show');
		if(document.querySelector('#sta-'+did+' span').classList.contains('badge-warning')) $('#item1').val('2').change();
		else if(document.querySelector('#sta-'+did+' span').classList.contains('badge-success')) $('#item1').val('1').change();
		else if(document.querySelector('#sta-'+did+' span').classList.contains('badge-danger')) $('#item1').val('3').change();
		else if(document.querySelector('#sta-'+did+' span').classList.contains('badge-primary')) $('#item1').val('4').change();
		else $('#item1').val('0').change();

		document.querySelector('#deposit-edit #rev-idz').value = did;
	}
</script>
<?php require_once('footer.php'); ?>