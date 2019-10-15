<?php

/**
  * @var \App\View\AppView $this
  */
?>
<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="panel-head-info">
    <p class="pull-left info-text">Edit Slider</p>
    <a href="<?php echo $this->request->webroot ?>sliders/sliderlist" style="font-size:14px;" class="btn btn-primary btn-blue-custom pull-right text-info"><i class="fa fa-angle-left"></i> Go Back</a>
    <div class="clearfix"></div>

</div>
<div class="container content-container">
    <div class="users form">
        <?php echo $this->Form->create($slider,array('type'=>'file','class'=>'form-horizontal','id'=>'UserAddForm', 'enctype'=>'multipart/form-data')); ?>
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
                <label for="status" class="col-md-2 control-label">Status</label>
                <div class="col-md-4">
                    <?php 
                    $status_option = array('0' => 'Deactive' , '1' =>'Active');
                    echo $this->Form->select("status", $status_option,["default"=>$slider->status,"empty"=>"Select Status","class" => "form-control required","id"=>"section-status"]); ?>
                </div>

            </div>

            <div class="form-group required">
               <label for="image" class="col-md-3 control-label">Image <br /><small class="text-danger">[Best size: 1340px * 620px]</small></label>
                <span class="btn btn-default btn-file">
                    Browse <input type="file" name="image" class="section-image" id="sectionImage" onchange="readURL(this)">
                </span>
                <br /><img width="150" id="show_section_uploaded_image"  src="<?php echo $this->request->webroot;?>img/slider/thumbnail/<?php echo $slider->image;?>"  class="section-up-image" alt=""/>

            </div>


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