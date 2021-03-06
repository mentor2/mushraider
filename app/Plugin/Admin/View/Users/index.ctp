<div class="box dark">
    <header>
        <div class="icons"><i class="icon-list icon-white"></i></div>
        <h5><?php echo __('Users list');?></h5>
    </header>
    <div class="accordion-body body in collapse">
        <table class="table table-bordered table-striped responsive">
            <thead>
                <tr>
                    <th class="span2"><?php echo __('Username');?></th>                    
                    <th class="span3"><?php echo __('Email');?></th>                    
                    <th class="span1"><?php echo __('Status');?></th>                    
                    <th class="span3"><?php echo __('Registration date');?></th>                    
                    <th class="span1"><?php echo __('Characters');?></th>
                    <th class="span1"><?php echo __('Role');?></th>
                    <th class="actions span1"><?php echo __('Actions');?></th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($users)):?>
                    <?php foreach($users as $user):?>
                        <tr>
                            <td><?php echo $user['User']['username'];?></td>
                            <td><?php echo $user['User']['email'];?></td>
                            <td>
                                <?php if($user['User']['status']):?>
                                    <i class="text-success icon-ok"></i>
                                <?php else:?>
                                    <i class="text-warning icon-warning-sign"></i>
                                <?php endif;?>
                            </td>
                            <td><?php echo $this->Former->date($user['User']['created']);?></td>
                            <td><?php echo count($user['Character']);?></td>
                            <td><?php echo $user['Role']['title'];?></td>
                            <td class="actions">
                                <?php echo $this->Html->link('<i class="icon-edit"></i>', '/admin/users/edit/'.$user['User']['id'], array('class' => 'btn btn-info btn-mini tt', 'title' => __('Edit'), 'escape' => false))?>
                                <?php if(!$user['User']['status']):?>
                                    <?php echo $this->Html->link('<i class="icon-check"></i>', '/admin/users/enable/'.$user['User']['id'], array('class' => 'btn btn-success btn-mini tt', 'title' => __('Enable'), 'escape' => false))?>
                                    <?php echo $this->Html->link('<i class="icon-trash"></i>', '/admin/users/delete/'.$user['User']['id'], array('class' => 'btn btn-danger btn-mini tt delete', 'title' => __('Delete'), 'data-confirm' => __('Are you sure you want to completely delete the user %s ?', $user['User']['username']), 'escape' => false))?>
                                <?php else:?>
                                    <?php echo $this->Html->link('<i class="icon-collapse-alt"></i>', '/admin/users/disable/'.$user['User']['id'], array('class' => 'btn btn-warning btn-mini tt delete', 'title' => __('Disable'), 'data-confirm' => __('Are you sure you want to disable the user %s ?', $user['User']['username']), 'escape' => false))?>
                                <?php endif;?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                <?php endif;?>
            </tbody>
        </table>
        <?php echo $this->Tools->pagination('User');?>
    </div>
</div>