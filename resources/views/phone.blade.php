@include('./dashboard/header')

<section class="content">
    <div class="container-fluid">
        
        <!-- User Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card" style="min-width: 600px;">
                    <div class="header" style="background: white;">
                        <h2>
                            SMS Phone Manage
                        </h2>
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr role="row">                                           
                                            <th class="text-center">Form</th>
                                            <th class="text-center">Phone</th>
                                            <th class="text-center">Add&nbsp;|&nbsp;Update</th>
                                        </tr>
                                    </thead>                                          
                                    <tbody class="text-center">
                                        <?php
                                            foreach ($forms as $key => $form) {
                                        ?>
                                        <tr role="row">
                                            <td><?php echo $form->section; ?></td>
                                            <td><?php echo $form->phone; ?></td>
                                            <td>
                                                <button type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float addMore" title="Add" class="editButton" value="<?php echo $form->section; ?>" onclick="phoneAdd(<?php echo $form->id; ?>)">
                                                    <i class="material-icons">add</i>
                                                </button>
                                                <button type="button" class="btn bg-green btn-circle waves-effect waves-circle waves-float addMore" title="Update" class="passwordButton" value="<?php echo $form->section; ?>" onclick="phoneUpdate(<?php echo $form->id;?>)">
                                                    <i class="material-icons">edit</i>
                                                </button>
                                               <!--  <button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float addMore" title="Remove" class="removeButton" value="<?php $form->section; ?>" onclick="phoneRemove(<?php echo $form->id;?>)">
                                                    <i class="material-icons">remove</i>
                                                </button> -->
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# -->
    </div>
</section>

<!-- Create User -->
<div class="modal fade" id="add-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-center" id="Label"></h2>
            </div>
            <form id="addphone-form">
                {{ csrf_field() }}
                <div class="modal-body">
                	<input type="number" id="addId" name="addId" hidden>
                    <label for="editName">Phone Number:</label>
                    <div class="form-group eidtInput">
                        <div class="form-line">
                            <input type="text" id="addphone" class="form-control" name="addphone" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="add_button" class="btn bg-blue waves-effect">Add</button>
                    <button class="btn waves-effect" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="update-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-center" id="Label"></h2>
            </div>
            <form id="updatehone-form">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="modal-body">
                	<input type="number" id="updateId" name="updateId" value="" hidden>
                    <label for="updatephone">Phone Number:</label>
                    <div class="form-group eidtInput">
                        <div class="form-line">
                            <input type="text" id="updatephone" class="form-control" name="updatephone" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="update-button" class="btn bg-blue waves-effect">Update</button>
                    <button class="btn waves-effect" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Remove Modal -->
<div class="modal fade" id="remove-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-center" id="Label">Confirm removing</h2>
            </div>
            <form id="deletephone-form">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <input type="number" name="deleteId" id="deleteId" value="" hidden>
                <div class="modal-body">
                    <div class="del-message">
                        Will you really remove this user infomation?
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="remove-button" class="deletePhone btn bg-blue waves-effect" data-id="" data-token="{{ csrf_token() }}">Remove</button>
                    <button class="btn btn-green waves-effect" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('./dashboard/footer')
