@include('./dashboard/header')

<!-- #Side Bar -->
<section class="content">
    <div class="container-fluid formBuild">        
        <div class="setDataWrap">
            <button id="formEdit" type="button"  class="btn btn-primary waves-effect" onclick="onFormEdit()"><i class="material-icons">edit</i>&nbsp;Edit</button>
            <button id="getJSON" type="button" class="btn btn-success waves-effect"><i class="material-icons">save</i>&nbsp;Save</button>
            <a id="formRemove" type="button" class="btn btn-danger waves-effect" onclick="onFormRemove()"><i class="material-icons">remove_shopping_cart</i>&nbsp;Remove</a>
        </div>
        <div id="build-wrap"></div>
    </div>
</section>

<!-- Form Delete List -->
<div class="modal fade" id="formDeleteList" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-center" id="Label">Please Select a Form For Deleting</h2>
            </div>
            <form method="POST" action="build/{sectionName}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <div class="modal-body">
                        <label for="MLmodal">Event:</label>
                        <div class="form-group" id="MLmodal">
                            <div class="form-line">
                                <select name="section" class="form-control show-tick" id="formList" required>
                                </select>
                            </div>
                        </div>                       
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-blue waves-effect">Delete</button>
                    <button class="btn waves-effect" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Form Edit List -->
<div class="modal fade" id="formEditList" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-center" id="Label">Please Select a Form For Editing</h2>
            </div>
            <form method="GET" action="build/{id}/edit">
                {{ csrf_field() }}
                <div class="modal-body">
                    <label for="editFormName">Event:</label>
                    <div class="form-group" id="editFormName">
                        <div class="form-line">
                            <select name="section" class="form-control show-tick" id="formEditOption" required>
                            </select>
                        </div>
                    </div>                       
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-blue waves-effect">Edit</button>
                    <button class="btn waves-effect" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('./dashboard/footer')
