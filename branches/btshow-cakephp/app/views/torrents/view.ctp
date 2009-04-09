<div class="torrents view">
<h2><?php  __('Torrent');?></h2>
<table class="infobox">
	<tr>
		<td><?php __('Title')?></td>
		<td><?php echo $torrent['Torrent']['title']; ?></td>
	</tr>
	<tr>
		<td><?php __('Cv Type')?></td>
		<td><?php echo $html->link($torrent['CvType']['name'], array('controller'=> 'cv_types', 'action'=>'view', $torrent['CvType']['id'])); ?>&nbsp;</td>
	</tr>
	<tr>
		<td><?php __('Team')?></td>
		<td><?php echo $html->link($torrent['Team']['name'], array('controller'=> 'teams', 'action'=>'view', $torrent['Team']['id'])); ?>&nbsp;</td>
	</tr>
	<tr>
		<td><?php __('Publisher')?></td>
		<td><?php echo $torrent['Torrent']['publisher']; ?></td>
	</tr>
	<tr>
		<td><?php __('Modified'); ?></td>
		<td><?php echo $torrent['Torrent']['modified']; ?>&nbsp;</td>
	</tr>
	<tr>
		<td><?php __('Created'); ?></td>
		<td><?php echo $torrent['Torrent']['created']; ?>&nbsp;</td>
	</tr>
	<tr>
		<td><?php __('Download'); ?></td>
		<td><?php 
		$hash = unpack('H*',$torrent['Torrent']['info_hash']);
		echo $html->link(__('Download',true),'/files/'.$hash[1].'.torrent') ?>&nbsp;</td>
	</tr>
	<tr>
		<td><?php __('Ip')?></td>
		<td><?php echo $torrent['Torrent']['ip']; ?></td>
	</tr>
	<tr>
		<td><?php __('Torrent Filelist')?></td>
		<td><?php $filelist = unserialize($torrent['TorrentDetail']['torrent_filelist']);?>
			<pre>
				<?php foreach ($filelist as $file) cho $file['path'],"\n"; ?>
			</pre>
		</td>
	</tr>
</table>



<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Torrent', true), array('action'=>'edit', $torrent['Torrent']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Torrent', true), array('action'=>'delete', $torrent['Torrent']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $torrent['Torrent']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Torrents', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Torrent', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Teams', true), array('controller'=> 'teams', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Team', true), array('controller'=> 'teams', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Cv Types', true), array('controller'=> 'cv_types', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Cv Type', true), array('controller'=> 'cv_types', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Torrent Details', true), array('controller'=> 'torrent_details', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Torrent Detail', true), array('controller'=> 'torrent_details', 'action'=>'add')); ?> </li>
	</ul>
</div>
	