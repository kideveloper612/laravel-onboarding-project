<footer class="footer">
    <div class="copyright">
        &copy; 2019 - 2020 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#">Ventube</a>.
    </div>
    <div class="version">
        <b>Version: </b> 1.0.0
    </div>
</footer>
<!-- Jquery Core Js -->
    <script src="./plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="./plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="./plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="./plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="./plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="./plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <!-- <script src="./plugins/raphael/raphael.min.js"></script> -->
    <script src="./plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script src="./plugins/chartjs/Chart.bundle.js"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="./plugins/flot-charts/jquery.flot.js"></script>
    <script src="./plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="./plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="./plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="./plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="./plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <!-- Password Reset jquery validate -->
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
   
    <!-- Custom Js -->
    <script src="./plugin/js/admin.js"></script>
    <script src="./plugin/js/pages/index.js"></script>
    <script type="text/javascript" src="./js/custom.js"></script>
    <script src="./plugin/js/pages/forms/form-validation.js"></script>

    <!-- Demo Js -->
    <script src="./plugin/js/demo.js"></script>

    <!-- Form Build -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="http://formbuilder.online/assets/js/form-builder.min.js"></script>
    <script type="text/javascript" src="https://formbuilder.online/assets/js/form-render.min.js"></script>
    
    <!-- Bootstrap Notify Plugin Js -->
    <script src="./plugins/bootstrap-notify/bootstrap-notify.js"></script>
</body>

</html>

    
    <script type="text/javascript">
        $(document).ready(function(){
            setTimeout(function () { $('.page-loader-wrapper').fadeOut(); }, 300); 
        });
    </script>

    <!-- Remove submission -->
    <script type="text/javascript">
        $(".deleteProduct").click(function(){

            var id = $(this).data("id");
            var token = $(this).data("token");
            $.ajax(
            {
                url: "home/delete/"+id,
                type: 'DELETE',
                dataType: "JSON",
                data: {
                    "id": id,
                    "_method": 'DELETE',
                    "_token": token,
                },
                success: function ()
                {
                    window.location.reload();
                }
            });

            console.log("It failed");
        });

        // Record Edit
        async function onEdit(id){            
            var res = await Ajax_request('/userEditData', 'GET', id);
            var array = JSON.parse(res)[0]
            
            document.getElementById('editName').value = array['name'];
            document.getElementById('editEmail').value = array['email'];
            document.getElementById('editPhone').value = array['phoneNumber'];
            $('#formEditModal').attr('action', '/formUpdate/'+array['id']);
            $('#editModal').modal('show');
        } 

        // Record Password Reset
        async function onPassword(id){
            $('#passwordSet').attr('action', '/user/'+id);
            $('#passwordReset').modal('show');
        } 

        // Record Remove
        $(".deleteUser").click(function(){

            var id = $(this).data("id");
            var token = $(this).data("token");
            $.ajax(
            {
                url: "user/delete/"+id,
                type: 'DELETE',
                dataType: "JSON",
                data: {
                    "id": id,
                    "_method": 'DELETE',
                    "_token": token,
                },
                success: function ()
                {
                    window.location.reload();
                }
            });

            console.log("It failed");
        });

        // Form Remove
        async function onRemove(id){
            $('#userRemoveModal').modal('show');
            $('#userRemoveId').attr('data-id', id);
        }

        //Submission Delete
        async function subDelete(id){
            $('#submissionDelete').modal('show');
            $('#subRemoveId').attr('data-id', id);
        }

              
    </script>   
    <script>  
        var form = '<?php echo isset($formData) ? $formData : ""; ?>';       
        jQuery(function($) {
            var fields = [{
                label: "Time Field",
                type: "text",
                subtype: "time",
                icon: "⏰" 
            }];
            var fbOptions = {
                fields: fields,
                subtypes: {
                    text: ['time']
                }
            }

               

            var fbEditor = document.getElementById('build-wrap');
            var formBuilder =$(fbEditor).formBuilder(fbOptions);

            if(form){
                setTimeout(function(){ formBuilder.actions.setData(form); }, 500);
            }

            var json = document.getElementById('getJSON');
            if(json){
                json.addEventListener('click', async function() {

                var formdata = formBuilder.actions.getData('json');
                var req = await Ajax_request('/formSave', 'POST', formdata);
                await alert(req);
                window.location.href = "{{ route('formBuild')}}";
            });
            }
        });
    </script> 

    <script type="text/javascript">
        $("#passwordSet").validate({
            rules: {
                newPassword: { 
                    required: true,
                    minlength: 8,
                    maxlength: 15,
                } , 

                password_confirmation: { 
                    equalTo: "#newPassword",
                    minlength: 8,
                    maxlength: 15
                }
            },

            messages:{
                password: { 
                    required:"the password is required"
                }
            }
        });
    </script>

</body>

</html>