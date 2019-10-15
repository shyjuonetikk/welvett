<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="panel-head-info">
    <p class="pull-left info-text">Step 1. Add Slider</p>
    <a href="<?php echo $this->request->webroot ?>sliders/sliderlist" style="font-size:14px;" class="btn btn-primary btn-blue-custom pull-right text-info"><i class="fa fa-angle-left"></i> Go Back</a>
    <div class="clearfix"></div>

</div>
<div class="container content-container">
    <div class="users form">
        <?php echo $this->Form->create('Slider',array('type'=>'file','class'=>'form-horizontal','id'=>'UserAddForm', 'enctype'=>'multipart/form-data')); ?>
        <fieldset>
            <div class="form-group required">
                <label for="title" class="col-md-2 control-label">Title</label>
                <div class="col-md-4">
                    <?php echo $this->Form->control('title', ['label'=>false,'class'=>'form-control', 'required'=>'required']);
                    ?>
                </div>

                <label for="image_alt" class="col-md-2">Sub Title</label>
                <div class="col-md-4">
                    <?php echo $this->Form->control('image_alt', ['label'=>false,'class'=>'form-control']);
                    ?>
                </div>
            </div>

            <div class="form-group required">
                <label for="link" class="col-md-2 control-label">Link</label>
                <div class="col-md-4">
                    <?php echo $this->Form->control('link', ['label'=>false,'class'=>'form-control', 'required'=>'required']);
                    ?>
                </div>

                <label for="image" class="col-md-3 control-label">Image <br /><small class="text-danger">[Best size: 1340px * 620px]</small></label>
                <span class="btn btn-default btn-file">
                    Browse <input type="file" name="image" class="section-image" id="sectionImage" onchange="readURL(this)">
                </span>
                <br /><img width="150" id="show_section_uploaded_image"  src="#"  class="section-up-image" alt=""/>
            </div>

            <?php	echo $this->Form->control('status',array('type'=>'hidden','div'=>false,'label'=>false,'class'=>'form-control','value'=>'1')); ?>

        </fieldset>
        <div class="form-group">
            <div class="col-md-12 text-center">
                <?php 
                echo $this->Form->control('Add Slider',array('type'=>'submit','div'=>false,'label'=>false,'class'=>'btn btn-default btn-blue-custom btn-lg', 'id'=> 'register'));
                echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>

<script>
    function readURL(input , showId = null) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            //alert(input.files[0]);   
            reader.onload = function (e) {

                if(showId)
                {
                    if(input.id == "sliderImage") {
                        $('#show_uploaded_image'+showId)
                            .attr('src', e.target.result);
                    }
                    if(input.id == "sectionImage") {
                        $('#show_section_uploaded_image'+showId)
                            .attr('src', e.target.result);
                    }
                }
                else {
                    if(input.id == "sliderImage") {
                        $('#show_uploaded_image')
                            .attr('src', e.target.result);
                    }
                    if(input.id == "sectionImage") {
                        $('#show_section_uploaded_image')
                            .attr('src', e.target.result);
                    }
                }
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>