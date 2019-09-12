@include('./user/header')
<section class="content">
    <div class="container-fluid">
        <!-- Submitted count ranking -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box text-center"> 
                    <div class="content">
                        <div class="text count first"><?php if(gettype(get_object_vars(json_decode($data['title']))['first']) === 'object') echo(get_object_vars(json_decode($data['title']))['first']->num); ?></div>
                    </div>
                    <div class="bottom-rect text-center bg-red">
                        <h4><?php if(gettype(get_object_vars(json_decode($data['title']))['first']) === 'object') echo(get_object_vars(json_decode($data['title']))['first']->title); ?></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box text-center">
                    <div class="content">
                        <div class="text count second"><?php if(gettype(get_object_vars(json_decode($data['title']))['second']) == 'object') echo(get_object_vars(json_decode($data['title']))['second']->num); ?></div>
                    </div>
                    <div class="bottom-rect text-center bg-blue">
                        <h4><?php if(gettype(get_object_vars(json_decode($data['title']))['second']) == 'object') echo(get_object_vars(json_decode($data['title']))['second']->title); ?></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box text-center">
                    <div class="content">
                        <div class="text count third"><?php if(gettype(get_object_vars(json_decode($data['title']))['third']) == 'object') echo(get_object_vars(json_decode($data['title']))['third']->num); ?></div>
                    </div>
                    <div class="bottom-rect text-center bg-green">
                        <h4><?php if(gettype(get_object_vars(json_decode($data['title']))['third']) == 'object') echo(get_object_vars(json_decode($data['title']))['third']->title); ?></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box text-center">
                    <div class="content">
                        <div class="text count forth"><?php if(gettype(get_object_vars(json_decode($data['title']))['forth']) == 'object') echo(get_object_vars(json_decode($data['title']))['forth']->num); ?></div>
                    </div>
                    <div class="bottom-rect text-center bg-black">
                        <h4><?php if(gettype(get_object_vars(json_decode($data['title']))['forth']) == 'object') echo(get_object_vars(json_decode($data['title']))['forth']->title); ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# -->
        <!-- Submitted list -->
        <div class="row clearfix tableGroup">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">                
                <?php 
                    foreach (json_decode($data['content']) as $key => $value) {
                        $labels = json_decode(json_decode($value->formContent)->label);

                        $contents = json_decode(json_decode($value->formContent)->answer);
                        $timestamp = $value->timestamp;
                        $username = $value->username;
                ?>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable card">
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
                                    <td class="submittedUser"><strong>Submitted by</strong></td>
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
                                    <td class="submittedUserName"><?php echo $username; ?></td>
                                </tr>
                            </table>
                        </div>
                        
                    </div>                    
                        
                <?php } ?>              
                
            </div>

            <!-- pagination -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <nav>
                        <ul class="pager">
                            <?php if($data['prev_page'] == 0){ ?>
                                <li class="previous disabled">
                                    <a href="javascript:void(0);"><span aria-hidden="true">←</span> Newer</a>
                                </li>
                            <?php } else { ?>
                                <li class="previous">
                                    <a href="?page=<?php echo $data['prev_page']; ?>" class="waves-effect"><span aria-hidden="true">←</span> Newer</a>
                                </li>
                            <?php } ?>

                            <?php if($data['next_page'] == 0){ ?>
                                <li class="next disabled">
                                    <a href="javascript:void(0);">Older <span aria-hidden="true">→</span></a>
                                </li>
                            <?php } else { ?>
                                <li class="next">
                                    <a href="?page=<?php echo $data['next_page']; ?>" class="waves-effect">Older <span aria-hidden="true">→</span></a>
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

@include('./user/footer')

