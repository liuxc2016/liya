<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Documents</title>
</head>
<body>
	hahah its html5{{$name}};
	from pindex;

	@foreach ($users as $user)
		<p>{{$user->name}}</p>
	@endforeach
</body>
</html>