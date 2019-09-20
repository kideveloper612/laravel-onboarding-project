@include('./dashboard/header')
    
<section class="content">
    <div class="container-fluid">
        
        <!-- User Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 width">
                <div class="card">
                    <div class="header" style="background: white;">
                        <h2>
                            USER/FORM ARRANGE
                        </h2>
                    </div>
                    <div class="body">                        
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr role="row">
                                            <?php
                                                $header = $data[0];
                                                foreach ($header as $key => $value) {
                                            ?>
                                            <th class="text-center"><?php echo $value ?></th>
                                            <?php
                                                } 
                                            ?>
                                        </tr>
                                    </thead>                                          
                                    <tbody class="text-center">
                                        <?php
                                            foreach ($data as $usrekey => $userrecord) {
                                                if($usrekey !== 0){
                                        ?>
                                        <tr role="row">
                                            <?php
                                                foreach ($userrecord as $key => $value) {
                                            ?>
                                            <td><?php echo $value;?></td>
                                            <?php        
                                                }
                                            ?>
                                        </tr>                                
                                        <?php }} ?>
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

@include('./dashboard/footer')
	