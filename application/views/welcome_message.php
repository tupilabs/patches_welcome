<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Patches welcome</title>
	<link rel="stylesheet" href="<?php echo site_url('css/bootstrap.css'); ?>" />
	<link rel="stylesheet" href="<?php echo site_url('css/bootstrap-responsive.css'); ?>" />
	<link rel="stylesheet" href="<?php echo site_url('css/docs.css'); ?>" />
</head>
<body>

<div class="container-fluid">
	<div class='row-fluid'>
		<div class='span12'>
			<h1>Patches Welcome</h1>
		</div>
	</div>

	<div class="row-fluid">
		<div class='span12'>
			<p>This is a <strong>POC</strong> application that retrieves issues that <strong>welcome patches</strong> 
		in OSS projects, like <a href='http://apache.org'>Apache</a> and <a href='http://jenkins-ci.org'>Jenkins</a>.</p>
		
			<p>This page is updated every day at 3AM (America/Sao_Paulo). Source code: <a href='http://github.com/tupilabs/patches_welcome'>GitHub</a></p>
		</div>
	</div>
	
	<div class='row-fluid'>
		<div class='span12'>
		<?php foreach ($results as $project => $results): ?>
		<h3><?php echo $project; ?> (<?php echo count($results)?> issues)</h3>
		
		<div style=''>
		<table class='table table-striped table-bordered'>
			<thead>
				<tr>
					<th>Project</th>
					<th>ID</th>
					<th>Title</th>
					<th>Description</th>
					<th>Created</th>
					<th>Status</th>
					<th>Type</th>
				</tr>
			</thead>
			<tbody>
		<?php foreach ($results as $result): ?>
				<tr>
					<td><?php echo $result->getProject(); ?></td>
					<td><a href='<?php echo $result->getUrl(); ?>'><?php echo $result->getId(); ?></a></td>
					<td><?php echo $result->getTitle(); ?></td>
					<td><?php echo str_replace("\n", "<br/>", $result->getDescription()); ?></td>
					<td><?php echo $result->getCreated(); ?></td>
					<td><?php echo $result->getStatus(); ?></td>
					<td><?php echo $result->getType(); ?></td>
				</tr>
		<?php endforeach; ?>
			</tbody>
		</table>
		</div>
		
		<?php endforeach; ?>
		</div>
	</div>

</div>
<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</body>
</html>