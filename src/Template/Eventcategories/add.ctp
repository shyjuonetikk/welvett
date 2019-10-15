<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="panel-head-info">
    <a href="<?php echo $this->request->webroot ?>eventcategories/index" style="font-size:14px;" class="btn btn-primary btn-blue-custom pull-right text-info"><i class="fa fa-angle-left"></i> Go Back</a>
    <div class="clearfix"></div>

</div>
<div class="container content-container">
    <div class="users form">
        <?php echo $this->Form->create($eventcategory, array('class' => 'form-horizontal', 'id' => '', 'type' => 'file')); ?>

        <div class="form-group required">
            <label for="role_id" class="col-md-2 control-label">Title</label>
            <div class="col-md-4">
                <?php echo $this->Form->control('title', array('div' => false, 'label' => false, 'class' => 'form-control', 'required')); ?>


            </div>
            <label for="image_icon" class="col-md-2 control-label not-requried">Image Icon <br>
                <small class="text-danger">[Best size: 200px * 200px]</small></label>
            <div class="col-md-4" > 
                <span class="btn btn-default btn-file">
                    Browse <input type="file" name="image_icon" class="section-image" id="sectionImage" onchange="readURL(this)">
                </span>
                <br>
                <img id="show_section_uploaded_image" width="200" src="#"  class="section-up-image" alt=""/>
                <?php //echo $this->Form->control('photo',array('type'=>'file','div'=>false,'label'=>false,'class'=>'form-control')); ?>
            </div>

        </div>

        <?php
        $userid = $this->request->session()->read('Auth.User.id');
        echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => $userid]);
        ?>

        <div class="form-group">
            <div class="col-md-12 text-center">
                <?php
                echo $this->Form->control('Add Service category', array('type' => 'submit', 'div' => false, 'label' => false, 'class' => 'btn btn-default btn-blue-custom btn-lg'));
                echo $this->Form->end();
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    function readURL(input, showId = null) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            //alert(input.files[0]);   
            reader.onload = function (e) {

                if (showId)
                {
                    if (input.id == "sliderImage") {
                        $('#show_uploaded_image' + showId)
                                .attr('src', e.target.result);
                    }
                    if (input.id == "sectionImage") {
                        $('#show_section_uploaded_image' + showId)
                                .attr('src', e.target.result);
                    }
                } else {
                    if (input.id == "sliderImage") {
                        $('#show_uploaded_image')
                                .attr('src', e.target.result);
                    }
                    if (input.id == "sectionImage") {
                        $('#show_section_uploaded_image')
                                .attr('src', e.target.result);
                    }
                }
            };

            reader.readAsDataURL(input.files[0]);
    }
    }
</script>
