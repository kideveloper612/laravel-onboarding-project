@include('./dashboard/header')
<?php
    $recordCount = 0;
    $maxColumn = 0;
    foreach ((json_decode($data['content'])) as $key => $value) {
        $labels = json_decode(json_decode($value->formContent)->label);

        foreach ($labels as $key=>$label) {
            $recordCount++;
        }

        if($maxColumn < $recordCount){
            $maxColumn = $recordCount;
        }
        $labels =[];
        $recordCount = 0;
    }
?>

<section class="content">
    <div class="container-fluid">

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box text-center"> 
                    <div class="content">
                        <div class="text count first"><?php echo(get_object_vars(json_decode($data['title']))['first']->num*10); ?></div>
                    </div>
                    <div class="bottom-rect text-center bg-red">
                        <h4><?php echo(get_object_vars(json_decode($data['title']))['first']->title); ?></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box text-center">
                    <div class="content">
                        <div class="text count second"><?php echo(get_object_vars(json_decode($data['title']))['second']->num*10); ?></div>
                    </div>
                    <div class="bottom-rect text-center bg-blue">
                        <h4><?php echo(get_object_vars(json_decode($data['title']))['second']->title); ?></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box text-center">
                    <div class="content">
                        <div class="text count third"><?php echo(get_object_vars(json_decode($data['title']))['third']->num*10); ?></div>
                    </div>
                    <div class="bottom-rect text-center bg-green">
                        <h4><?php echo(get_object_vars(json_decode($data['title']))['third']->title); ?></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box text-center">
                    <div class="content">
                        <div class="text count forth"><?php echo(get_object_vars(json_decode($data['title']))['forth']->num*10); ?></div>
                    </div>
                    <div class="bottom-rect text-center bg-black">
                        <h4><?php echo(get_object_vars(json_decode($data['title']))['forth']->title); ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->
        <!-- Table Page -->
        <div class="row clearfix tableGroup">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">                
                <?php
                $records = json_decode($data['content']);
                    foreach ($records as $key => $value) {
                        $labels = json_decode(json_decode($value->formContent)->label);
                        $contents = json_decode(json_decode($value->formContent)->answer);
                        $timestamp = $value->timestamp;
                        $username = $value->username;
                ?>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable card">
                                <tbody>
                                    <tr>
                                        <td><strong>Timestamp</strong></td>
                                        <td><strong>Event</strong></td>
                                        <?php 
                                            foreach ($labels as $key => $label) {
                                        ?>
                                        <td><strong><?php echo $label;?></strong></td>        
                                        <?php 
                                            } 
                                        ?>
                                        <td><strong>Submitted by</strong></td>
                                        <td class="removeLabel">Remove</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $timestamp; ?></td>
                                        <?php
                                            foreach ($contents as $key => $content) {
                                        ?>
                                        <td>
                                            <?php
                                                $ext = pathinfo($content, PATHINFO_EXTENSION); 
                                                if(!empty($ext)){
                                            ?>
                                            <a href="<?php echo URL::asset('storage/'.$content)?>" target="_blank"><?php echo $content;?></a>
                                            <?php } else echo $content; ?>
                                        </td>
                                        <?php
                                            }
                                        ?>
                                        <td><?php echo $username; ?></td>  
                                        <td class="removeButton">
                                            <button class="btn bg-red waves-effect" onclick="subDelete(<?php echo $value->id; ?>)">remove</button>
                                        </td>
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                    </div>  
                <?php } ?> 
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <nav>
                        <ul class="pager">
                            <?php if ($data['prev_page'] == 0) { ?>
                                <li class="previous disabled">
                                    <a href="javascript:void(0);">
                                        <span aria-hidden="true">←</span> Older
                                    </a>
                                </li>
                            <?php } else { ?>
                                <li class="previous">
                                    <a href="?page=<?php echo($data['prev_page'])?>">
                                        <span aria-hidden="true">←</span> Older
                                    </a>
                                </li>
                            <?php } ?>

                            <?php if ($data['next_page'] == 0) { ?>
                                <li class="next disabled">
                                    <a href="javascript:void(0);">
                                        Newer
                                        <span aria-hidden="true">→</span>
                                    </a>
                                </li>
                            <?php } else { ?>
                                <li class="next">
                                    <a class="waves-effect" href="?page=<?php echo($data['next_page']);?>">
                                        Newer
                                        <span aria-hidden="true">→</span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
            </div>
            
        </div>        
        <!-- #END# -->        
    </div>
</section>

<!-- Submission Delete Modal -->
<div class="modal fade" id="submissionDelete" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-center" id="Label">Confirm removing</h2>
            </div>
            <div class="modal-body">
                Will you really remove this submission?
            </div>
            <div class="modal-footer">
                <button class="deleteProduct btn bg-blue waves-effect" id="subRemoveId" data-id="" data-token="{{ csrf_token() }}">Yes</button>
                <button class="btn btn-green waves-effect" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<!-- #END# -->

@include('./dashboard/footer')

