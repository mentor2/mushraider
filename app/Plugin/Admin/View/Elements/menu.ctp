<div id="left">
    <div class="media user-media hidden-phone">
        <div class="media-body hidden-tablet">
            <h5 class="media-heading"><i class="icon-user icon-white"></i> <?php echo $user['User']['username'];?></h5>
            <ul class="unstyled user-info">
                <li><?php echo __($user['Role']['title']);?></li>
            </ul>
        </div>
    </div>

    <ul id="menu" class="unstyled accordion collapse in">
        <li class="<?php echo strtolower($this->name) == 'dashboard'?'active':'';?>">
            <?php echo $this->Html->link('<i class="icon-home icon-white"></i> '.__('Dashboard'), '/admin/dashboard', array('escape' => false));?>
        </li>

        <?php if($user['User']['can']['full_permissions']):?>
            <li class="accordion-group <?php echo strtolower($this->name) == 'settings'?'active':'';?>">
                <a data-parent="#menu" data-toggle="collapse" class="accordion-toggle <?php echo strtolower($this->name) == 'settings'?'':'collapsed';?>" data-target="#settings-nav">
                    <i class="icon-cog icon-white"></i> <?php echo __('Settings');?> <i class="icon-chevron-down icon-white pull-right"></i>
                </a>
                <ul class="collapse <?php echo strtolower($this->name) == 'settings'?'in':'';?>" id="settings-nav">
                    <li><?php echo $this->Html->link('<i class="icon-chevron-right"></i> '.__('General'), '/admin/settings', array('escape' => false));?></li>
                    <li><?php echo $this->Html->link('<i class="icon-chevron-right"></i> '.__('Apparence'), '/admin/settings/display', array('escape' => false));?></li>
                    <li><?php echo $this->Html->link('<i class="icon-chevron-right"></i> '.__('Calendar'), '/admin/settings/calendar', array('escape' => false));?></li>
                    <li><?php echo $this->Html->link('<i class="icon-chevron-right"></i> '.__('API & Bridge'), '/admin/settings/api', array('escape' => false));?></li>
                </ul>
            </li>
        <?php endif;?>

        <?php if($user['User']['can']['full_permissions']):?>
            <li class="accordion-group <?php echo strtolower($this->name) == 'roles'?'active':'';?>">
                <a data-parent="#menu" data-toggle="collapse" class="accordion-toggle <?php echo strtolower($this->name) == 'roles'?'':'collapsed';?>" data-target="#roles-nav">
                    <i class="icon-eye-open icon-white"></i> <?php echo __('Groups & permissions');?> <i class="icon-chevron-down icon-white pull-right"></i>
                </a>
                <ul class="collapse <?php echo strtolower($this->name) == 'roles'?'in':'';?>" id="roles-nav">
                    <li><?php echo $this->Html->link('<i class="icon-chevron-right"></i> '.__('Manage groups & permissions'), '/admin/roles', array('escape' => false));?></li>
                    <li><?php echo $this->Html->link('<i class="icon-chevron-right"></i> '.__('Add group'), '/admin/roles/add', array('escape' => false));?></li>
                </ul>
            </li>
        <?php endif;?>

        <li class="accordion-group <?php echo strtolower($this->name) == 'users'?'active':'';?>">
            <a data-parent="#menu" data-toggle="collapse" class="accordion-toggle <?php echo strtolower($this->name) == 'users'?'':'collapsed';?>" data-target="#users-nav">
                <i class="icon-user icon-white"></i> <?php echo __('Users');?> <i class="icon-chevron-down icon-white pull-right"></i>
            </a>
            <ul class="collapse <?php echo strtolower($this->name) == 'users'?'in':'';?>" id="users-nav">
                <li><?php echo $this->Html->link('<i class="icon-chevron-right"></i> '.__('Manage users'), '/admin/users', array('escape' => false));?></li>
                <li><?php echo $this->Html->link('<i class="icon-chevron-right"></i> '.__('Waiting users'), '/admin/users/waiting', array('escape' => false));?></li>
            </ul>
        </li>

        <li class="<?php echo strtolower($this->name) == 'stats'?'active':'';?>">
            <?php echo $this->Html->link('<i class="icon-bar-chart icon-white"></i> '.__('Stats'), '/admin/stats', array('escape' => false));?>
        </li>

        <li class="<?php echo strtolower($this->name) == 'rosters'?'active':'';?>">
            <?php echo $this->Html->link('<i class="icon-shield icon-white"></i> '.__('Roster'), '/admin/rosters', array('escape' => false));?>
        </li>

        <li class="accordion-group <?php echo strtolower($this->name) == 'events'?'active':'';?>">
            <a data-parent="#menu" data-toggle="collapse" class="accordion-toggle <?php echo strtolower($this->name) == 'events'?'':'collapsed';?>" data-target="#events-nav">
                <i class="icon-calendar icon-white"></i> <?php echo __('Events');?> <i class="icon-chevron-down icon-white pull-right"></i>
            </a>
            <ul class="collapse <?php echo strtolower($this->name) == 'events'?'in':'';?>" id="events-nav">
                <li><?php echo $this->Html->link('<i class="icon-chevron-right"></i> '.__('Manage templates'), '/admin/events/templates', array('escape' => false));?></li>
            </ul>
        </li>
        
        <?php if($user['User']['can']['full_permissions']):?>
            <?php $toggleControllers = array('games', 'dungeons', 'races', 'classes');?>
            <li class="accordion-group <?php echo in_array(strtolower($this->name), $toggleControllers)?'active':'';?>">
                <a data-parent="#menu" data-toggle="collapse" class="accordion-toggle <?php echo in_array(strtolower($this->name), $toggleControllers)?'':'collapsed';?>" data-target="#games-nav">
                    <i class="icon-gamepad icon-white"></i> <?php echo __('Games');?> <i class="icon-chevron-down icon-white pull-right"></i>
                </a>
                <ul class="collapse <?php echo in_array(strtolower($this->name), $toggleControllers)?'in':'';?>" id="games-nav">
                    <li><?php echo $this->Html->link('<i class="icon-chevron-right"></i> '.__('Manage games'), '/admin/games', array('escape' => false));?></li>
                    <li><?php echo $this->Html->link('<i class="icon-chevron-right"></i> '.__('Add game'), '/admin/games/add', array('escape' => false));?></li>
                    <li class="divider"></li>
                    <li><?php echo $this->Html->link('<i class="icon-chevron-right"></i> '.__('Manage dungeons'), '/admin/dungeons', array('escape' => false));?></li>
                    <li><?php echo $this->Html->link('<i class="icon-chevron-right"></i> '.__('Add dungeon'), '/admin/dungeons/add', array('escape' => false));?></li>
                    <li><?php echo $this->Html->link('<i class="icon-chevron-right"></i> '.__('Disabled dungeons'), '/admin/dungeons/disabled', array('escape' => false));?></li>
                    <li class="divider"></li>
                    <li><?php echo $this->Html->link('<i class="icon-chevron-right"></i> '.__('Manage classes'), '/admin/classes', array('escape' => false));?></li>
                    <li><?php echo $this->Html->link('<i class="icon-chevron-right"></i> '.__('Add class'), '/admin/classes/add', array('escape' => false));?></li>
                    <li class="divider"></li>
                    <li><?php echo $this->Html->link('<i class="icon-chevron-right"></i> '.__('Manage races'), '/admin/races', array('escape' => false));?></li>
                    <li><?php echo $this->Html->link('<i class="icon-chevron-right"></i> '.__('Add race'), '/admin/races/add', array('escape' => false));?></li>
                </ul>
            </li>
        <?php endif;?>

        <?php if($user['User']['can']['full_permissions']):?>
            <li class="accordion-group <?php echo strtolower($this->name) == 'raidroles'?'active':'';?>">
                <a data-parent="#menu" data-toggle="collapse" class="accordion-toggle <?php echo strtolower($this->name) == 'raidroles'?'':'collapsed';?>" data-target="#raidroles-nav">
                    <i class="icon-group icon-white"></i> <?php echo __('Player roles');?> <i class="icon-chevron-down icon-white pull-right"></i>
                </a>
                <ul class="collapse <?php echo strtolower($this->name) == 'raidroles'?'in':'';?>" id="raidroles-nav">
                    <li><?php echo $this->Html->link('<i class="icon-chevron-right"></i> '.__('Manage roles'), '/admin/raidroles', array('escape' => false));?></li>
                    <li><?php echo $this->Html->link('<i class="icon-chevron-right"></i> '.__('Add role'), '/admin/raidroles/add', array('escape' => false));?></li>
                </ul>
            </li>
        <?php endif;?>

        <li class="accordion-group <?php echo strtolower($this->name) == 'widgets'?'active':'';?>">
            <a data-parent="#menu" data-toggle="collapse" class="accordion-toggle <?php echo strtolower($this->name) == 'widgets'?'':'collapsed';?>" data-target="#widgets-nav">
                <i class="icon-puzzle-piece icon-white"></i> <?php echo __('Widgets');?> <i class="icon-chevron-down icon-white pull-right"></i>
            </a>
            <ul class="collapse <?php echo strtolower($this->name) == 'widgets'?'in':'';?>" id="widgets-nav">
                <li><?php echo $this->Html->link('<i class="icon-chevron-right"></i> '.__('Manage widgets'), '/admin/widgets', array('escape' => false));?></li>
                <li><?php echo $this->Html->link('<i class="icon-chevron-right"></i> '.__('Add widget'), '/admin/widgets/add', array('escape' => false));?></li>
            </ul>
        </li>
    </ul>
</div>