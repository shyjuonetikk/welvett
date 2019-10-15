<div class="panel-head-info">
    <div class="clearfix"></div>
    <?php
    if($permission== 2){
    ?>
    <a href="<?php echo $this->request->webroot ?>sliders/add" class="btn btn-default btn-blue-custom btn-lg"><i class="fa fa-plus"></i> Add Slider</a>
    <?php } ?>
</div>
<div class="container content-container">

    <div class="row">
        <div id="no-more-tables">
            <form method="post" id="myForm" action="<?php echo $this->request->webroot; ?>sliders/udapteorder">
                <table class="col-md-12 table-bordered table-striped table-condensed cf">

                    <thead class="cf">
                        <tr>
                            <th><?php echo $this->Paginator->sort('title'); ?></th>
                            <th><?php echo $this->Paginator->sort('photo'); ?></th>
                            <th><?php echo $this->Paginator->sort('status'); ?></th>
                            <th><?php echo $this->Paginator->sort('order'); ?></th>
                            <th><?php echo $this->Paginator->sort('modified'); ?></th>
                            <!--<th><?php // echo $this->Paginator->sort('modified'); ?></th>-->
                            <th class="actions"><?php echo __('Actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sliders as $slider): ?>
                        <tr>
                            <td data-title="Title"><?php echo h($slider->title); ?>&nbsp;</td>
                            <td data-title="Photo"><img src="<?php echo $this->request->webroot; ?>img/slider/thumbnail/<?php echo h($slider->image); ?>" width='150'/></td>
                            <td data-title="Status"><?php 
                                if($slider->status == 0) {
                                    $status = "Deactive";
                                }
                                else {
                                    $status = "Active";
                                }
                                echo $status; ?>&nbsp</td>
                            <td data-title="Order">
                                <?php echo $this->Form->control('slider_order',array('type'=>'number','value'=>$slider->ordinal,'name'=>'data[ordinal][]','div'=>false,'label'=>false,'class'=>'form-control','required'=>'required')); ?>
                                <?php echo $this->Form->control('slider_id',array('type'=>'hidden','value'=>$slider->id,'name'=>'data[slider_id][]','div'=>false,'label'=>false,'class'=>'form-control')); ?>
                            </td>
                            <td data-title="Created"><?php echo h(date('m/d/Y H:i:s',strtotime($slider->modified))); ?>&nbsp;</td>
                            
                            <!--<td data-title="Modified"><?php // echo h($Silder['Slider['modified); ?>&nbsp;</td>-->
                            <td  data-title="Actions" class="actions">
                                <?php echo $this->Html->link(__('Edit'), array('controller' => 'sliders', 'action' => 'edit',$slider->id),array('class'=>'btn btn-success')); ?>
                                <?php 
                                echo $this->Html->link(__('<i class="fa fa-trash-o"></i> Delete'), ['action' => 'delete', $slider->id], ['escape'=>false,'class'=>'btn btn-danger','confirm' => __('Are you sure you want to delete # {0}?', $slider->title)]); ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </form>
            <button class="btn btn-default btn-blue-custom btn-lg col-xs-offset-6 col-md-offset-6" style="margin-top:10px;margin-bottom:10px;" id="orderupdate_btn" >Update Order</button>
        </div>
    </div>
    <br />


    <div class="paginator">
        <ul class="pagination">
            <?php
            echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
            echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
            echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
            ?>
        </ul>

        <p class="small"><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#orderupdate_btn").click(function() {
            $("#myForm").submit();
        });
    });
</script>