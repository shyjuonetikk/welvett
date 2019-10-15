<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="panel-head-info">
    <a href="<?php echo $this->request->webroot ?>eventsubcategories/index/<?php echo $category['id']; ?>" style="font-size:14px;" class="btn btn-primary btn-blue-custom pull-right text-info"><i class="fa fa-angle-left"></i> Go Back</a>
    <div class="clearfix"></div>

</div>
<div class="container content-container">
    <div class="users form">
        <?php echo $this->Form->create($eventsubcategory, array('class' => 'form-horizontal', 'id' => '', 'type' => 'file')); ?>

        <div class="form-group required">
            <label for="Title" class="col-md-2 control-label">Title</label>
            <div class="col-md-4">
                <?php echo $this->Form->control('title', array('div' => false, 'label' => false, 'class' => 'form-control', 'required')); ?>


            </div>


        </div>

        <?php
        $userid = $this->request->session()->read('Auth.User.id');
        echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => $userid]);
        ?>

        <div class="form-group">
            <div class="col-md-12 text-center">
                <?php
                echo $this->Form->control('Add Eventsubcategory', array('type' => 'submit', 'div' => false, 'label' => false, 'class' => 'btn btn-default btn-blue-custom btn-lg'));
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


