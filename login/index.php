<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login / Sign up</title>
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">
  <?php
      // Ambil timestamp file CSS agar selalu ter-refresh
      $css_version = filemtime('style.css'); 
  ?>
  <link rel="stylesheet" href="style.css?v=<?php echo $css_version; ?>">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form action="create_process.php" method="POST">
					<label for="chk" aria-hidden="true">Sign up</label>
					<input type="text" name="nama" placeholder="Name" required="">
					<input type="text" name="username" placeholder="Username" required="">
					<input type="password" name="password" placeholder="Password" required="">
					<button type="submit">Sign up</button>
				</form>
			</div>

			<div class="login">
                <form method="POST" action="login_process.php">
                    <label for="chk">Login</label>
                    <input type="text" name="username" placeholder="Username" required="">
                    <input type="password" name="password" placeholder="Password" required="">
                    <button type="submit">Login</button>
                </form>
			</div>
	</div>
</body>
</html>
