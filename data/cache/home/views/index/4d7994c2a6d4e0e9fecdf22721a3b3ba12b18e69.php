<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Documents</title>
</head>
<body>
	hahah its html5<?php echo e($name); ?>;
	from pindex;

	<?php foreach($users as $user): ?>
		<p><?php echo e($user->name); ?></p>
	<?php endforeach; ?>
</body>
</html>