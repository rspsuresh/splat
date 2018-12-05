<?php
if(count($model) >0) {?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        <?php  foreach($model as $val) { ?>
            <tr class="remove_<?=$val['userid']?>">
                <td><?php echo ucfirst($val['first_name'])?></td>
                <td><?php echo ucfirst($val['last_name'])?></td>
                <td><a onclick="unlock(<?=$val['userid']?>,<?=$val['group_id']?>,<?=$val['project_id']?>)" href="#">
                        <span title="Remove the user from the group" class="glyphicon glyphicon-remove"></span>
                    </a></td>
            </tr>

        <?php }?>
        </tbody>
    </table>
<?php }
else { ?>
    <h3>No users in the group</h3>
<?php } ?>
