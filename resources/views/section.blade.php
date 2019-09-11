@include('./user/header')

<div class="container cardPosition">
    <!-- Advanced Form Example With Validation -->
   <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="card" style="margin-bottom: 150px;">
            <div class="body">
               <div class="form-step col-sm-12 text-center">
                  <div class="preloader" style="display: none;">
                     <div class="spinner-layer pl-black">
                        <div class="circle-clipper left">
                           <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                           <div class="circle"></div>
                        </div>
                     </div>
                  </div>
               </div>
               <form id="form_validation" method="POST" class="form wizard clearfix" action="{{route('sectionStore')}}" enctype='multipart/form-data' novalidate="novalidate">
                  <div class="steps clearfix">
                     <ul role="tablist">
                        <li role="tab" class="disabled last" aria-disabled="true" style="width: 50%;">
                           <a>
                              <span class="number">1.</span> Section
                           </a>
                        </li>
                        <li role="tab" class="first current" aria-disabled="false" aria-selected="true" style="width: 50%;">
                           <a>
                              <span class="number">2.</span> Question
                           </a>
                        </li>                      
                     </ul>
                  </div>

                  <div class="content clearfix">
                     <h2 class="text-center">Dispatch Log</h2>                     

                     <h3 class="title current">Question</h3>
                        
                     <fieldset class="body current">
                        <div class="col-sm-6">
                           <div class="form-group validation_label">
                              <div id="hideInput">
                                 <input type="hidden" name="section" value="<?php echo $data['section']?>" />
                              </div>
                              <div id="addedForm">                                 
                              </div>
                           </div>   
                        </div>
                     </fieldset>

                  </div>
                  <div class="actions clearfix">
                     <ul>
                        <li>
                           <a href="{{route('formselect')}}" class="btn bg-indigo waves-effect" id="previousButton">Previous</a>
                        </li>
                        <li>
                           <button type="submit" class="btn bg-indigo waves-effect" id="finishButton">Result</button>
                        </li>
                     </ul>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
    <!-- #END# Advanced Form Example With Validation -->
</div>
<!-- Form add -->

<script type="text/javascript">

   var formdata;
   (function(){
      formdata = <?php echo $data['formdata']; ?>;
   })();
</script>

@include('./user/footer')


    









