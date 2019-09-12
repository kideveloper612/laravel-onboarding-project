@include('./dashboard/header')
    
<section class="content">
    <div class="container-fluid">
        
        <!-- User Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header" style="background: white;">
                        <h2>
                            Users Registered
                        </h2>
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-sm-12" style="text-align: right;">
                                <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#newUser"><i class="material-icons addMore" title="Add User">add</i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr role="row">                                           
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Phone Number</th>
                                            <th class="text-center">Created_at</th>
                                            <th class="text-center">Updated_at</th>
                                            <th class="text-center">Edit&nbsp;|&nbsp;Password&nbsp;|&nbsp;Remove</th>
                                        </tr>
                                    </thead>                                          
                                    <tbody class="text-center">
                                        <?php
                                            foreach ($user as $key => $record) {
                                        ?>
                                        <tr role="row">
                                            <td><?php echo $record->name; ?></td>
                                            <td><?php echo $record->email; ?></td>
                                            <td><?php echo $record->phoneNumber; ?></td>
                                            <td><?php echo $record->created_at; ?></td>
                                            <td><?php echo $record->updated_at; ?></td>
                                            <td>
                                                <button type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float addMore" title="Edit" class="editButton" value="<?php echo $record->id; ?>" onclick="onEdit(<?php echo $record->id; ?>)">
                                                    <i class="material-icons">edit</i>
                                                </button>
                                                <button type="button" class="btn bg-green btn-circle waves-effect waves-circle waves-float addMore" title="Password Reset" class="passwordButton" value="<?php echo $record->id; ?>" onclick="onPassword(<?php echo $record->id;?>)">
                                                    <i class="material-icons">security</i>
                                                </button>
                                                <button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float addMore" title="Remove" class="removeButton" value="<?php echo $record->id; ?>" onclick="onRemove(<?php echo $record->id;?>)">
                                                    <i class="material-icons">remove</i>
                                                </button>
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
<div class="modal fade" id="newUser" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-center" id="Label">New User Information</h2>
            </div>
            <form method="post" action="/user">
                {{ csrf_field() }}
                <div class="modal-body">
                        <label for="editName">Name:</label>
                        <div class="form-group eidtInput">
                            <div class="form-line">
                                <input type="text" id="newUserName" class="form-control" name="newUserName" required>
                            </div>
                        </div>
                        <label for="editEmail">Email Address:</label>
                        <div class="form-group eidtInput">
                            <div class="form-line">
                                <input type="text" id="newUserEmail" class="form-control" name="newUserEmail" required>
                            </div>
                        </div>
                        <label for="editPhone">Phone Number:</label>
                        <div class="form-group eidtInput">
                            <div class="form-line">
                                <input type="text" id="newUserPhone" class="form-control" name="newUserPhone" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-blue waves-effect">Save</button>
                    <button class="btn waves-effect" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-center" id="Label">User Information Reset</h2>
            </div>
            <form method="post" id="formEditModal" action="">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="modal-body">
                        <label for="editName">Name:</label>
                        <div class="form-group eidtInput">
                            <div class="form-line">
                                <input type="text" id="editName" class="form-control" name="editName" required>
                            </div>
                        </div>
                        <label for="editEmail">Email Address:</label>
                        <div class="form-group eidtInput">
                            <div class="form-line">
                                <input type="text" id="editEmail" class="form-control" name="editEmail" required>
                            </div>
                        </div>
                        <label for="editPhone">Phone Number:</label>
                        <div class="form-group eidtInput">
                            <div class="form-line">
                                <input type="text" id="editPhone" class="form-control" name="editPhone" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-blue waves-effect">Save</button>
                    <button class="btn waves-effect" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Password Reset Modal -->
<div class="modal fade" id="passwordReset" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-center" id="Label">Password Reset</h2>
            </div>
            <form method="post" id="passwordSet" action="">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="modal-body">
                        <label for="editName">New Password:</label>
                        <div class="form-group eidtInput">
                            <div class="form-line">
                                <input type="password" id="newPassword" class="form-control" name="newPassword" required>
                            </div>
                        </div>
                        <label for="editEmail">Confirm Password:</label>
                        <div class="form-group eidtInput">
                            <div class="form-line">
                                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-blue waves-effect">Save</button>
                    <button class="btn waves-effect" data-dismiss="modal">Cancel</button>
                </div>
            </form>            
        </div>
    </div>
</div>

<!-- Remove Modal -->
<div class="modal fade" id="userRemoveModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-center" id="Label">Confirm removing</h2>
            </div>
            <div class="modal-body">
                Will you really remove this user infomation?
            </div>
            <div class="modal-footer">
                <button id="userRemoveId" class="deleteUser btn bg-blue waves-effect" data-id="" data-token="{{ csrf_token() }}">Remove</button>
                <button class="btn btn-green waves-effect" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@include('./dashboard/footer')
	