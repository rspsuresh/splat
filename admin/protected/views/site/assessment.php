<section id="wrapper" style="height:auto !important">
    <div class="container">
        <div class="admin-home user-ass">
            <p>You are here: <a href="<?php echo Yii::app()->createUrl('site/index');?>">Home</a> /
                <a href="javascritp:void(0);">Assessment Feedback</a></p>
        </div>
    </div>
    <div class="container-fluid user-assessment">
        <p>Feedback</p>
    </div>
    <div class="container">
        <form method="POST">
            <?php 
			$groupusers = GroupUsers::model()->findAll('group_id='.$_GET['g']);
			if(count($questions)>0):                
				$i=0;                
				foreach($questions as $question):                    
				$i++;                    
			?>
			<div class="user-form">
				<p>
					<?php echo $i;?>.<?php echo $question->question; ?>
				</p>
				<?php
					if(count($groupusers)>0):
						foreach($groupusers as $groupuser):
							$assess = Assess::model()->find('question=:q and project=:p and from_user=:f and to_user=:t',array(':q'=>$question->id,':p'=>$projects->id,':f'=>$_GET['u'],':t'=>$groupuser->user_id));
				?>
				<p class="selp-pad">
					<label>
						<?php if($_GET['u'] == $groupuser->user_id) 
							echo 'Self'; 
						else 
							echo 'To '.ucfirst($groupuser->user->first_name);
						?>
					</label>
					: <?php echo ($assess->value!="")?$assess->value:'-'; ?>
				</p>
				<?php endforeach; else: ?>
					<p class="selp-pad">
						<label>No users assigned to project.</label>
					</p>
				<?php endif; ?>
			</div>
			<?php endforeach; else:?>
			<div class="user-form">
				<p>No questions assigned yet.</p>
			</div>
			<?php endif;?>
			<div class="comments">
				<label>Comments</label>
				<br/>
				<?php
				if(count($groupusers)>0):                    
					foreach($groupusers as $groupuser):                        
						$comments = AssessComments::model()->find('project=:p and from_user=:f and to_user=:t',array(':p'=>$projects->id,':f'=>$_GET['u'],':t'=>$groupuser->user_id));                        
				?>
					<label class="text-label" style="margin-top:20px;">About
						<?php if($_GET['u'] == $groupuser->user_id) 
							echo 'me'; 
						else 
							echo ucfirst($groupuser->user->first_name); 
						?>
					</label>
					<br/><?php if(count($comments)>0) echo trim($comments->comments); else echo '-';?><br/>
				<?php endforeach;
				else: 
				?>
				<label class="text-label">No users assigned to project.</label>
				<?php endif;?>
				<div style="clear:both;"></div><br/>
			</div>
        </form>
    </div>
</section>