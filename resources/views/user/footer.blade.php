
<!-- Footer -->
<footer>
    <div class="copyright">
        &copy; 2019 - 2020 &nbsp;<a href="#"><strong>VENTURA</strong></a>
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

    <!-- Jquery Validation Plugin Css -->
    <script src="./plugins/jquery-validation/jquery.validate.js"></script>

    <!-- JQuery Steps Plugin Js -->
    <script src="./plugins/jquery-steps/jquery.steps.js"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="./plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Moment Plugin Js -->
    <script src="./plugins/momentjs/moment.js"></script>
    
    <!-- Autosize Plugin Js -->
    <script src="./plugins/autosize/autosize.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="./plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="./plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="./plugins/node-waves/waves.js"></script>

    
    <!-- Custom Js -->
    <script src="./plugin/js/admin.js"></script>
    <script src="./plugin/js/pages/forms/form-validation.js"></script>
    <script type="text/javascript" src="./js/custom.js"></script>
    
    <!-- <script src="./plugin/js/pages/forms/form-wizard.js"></script> -->
    <!-- Demo Js -->
    <script src="./plugin/js/demo.js"></script> 

    <script src="https://formbuilder.online/assets/js/form-render.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            // Selects
            $("select.form-control").change(function(){
                var selectedValue = $(this).children("option:selected").html();
                $(this).children("option:selected").val(selectedValue);
            });
                    
            $('select').selectpicker();

            // dashborad proload
            setTimeout(function () { $('.page-loader-wrapper').fadeOut(); }, 300);
        });

    </script>

    <script type="text/javascript">
        // Form Render function
        $(document).ready(function() {
            if (typeof formdata !== 'undefined'){

                // Give file name for uploading file
                for(i=0; i<formdata.length; i++){
                    if(formdata[i]['type'] === 'file')
                        formdata[i]['name'] = 'fileName';
                }
                
                const formRenderOptions = {
                    formData: formdata
                };
                var renderedForm = $('<div>');
                renderedForm.formRender(formRenderOptions);
                //Convert from json data to html data
                requestData = renderedForm.html();
                document.getElementById('addedForm').innerHTML = requestData;

                $('#addedForm').html(requestData);
                $('input[type=time]').bootstrapMaterialDatePicker({
                    format: 'HH:mm',
                    clearButton: true,
                    date: false
                });


                var eles = $('input[type=date]');
                for ( var i = 0 ; i < eles.length ; i++){
                    eles[i].type = "text";
                    eles[i].className = "form-control form-date";
                }

                $('.form-date').bootstrapMaterialDatePicker({
                    format: 'DD/MM/YYYY',
                    clearButton: true,
                    weekStart: 1,
                    time: false
                });
            }
        });
    </script> 
</body>
</html>
