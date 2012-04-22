<?php
/*
 * /index.php
 * Author: Sudaraka Wijesinghe <sudaraka.wijesinghe@gmail.com>
 * Created: 04/23/12
 */

// Create the database connection
$connection = mysql_connect('localhost', 'root', 'hanthana') or die(mysql_error());

// Select the database to get the data from
mysql_select_db('lamp_demo', $connection) or die(mysql_error());

// Execute the SQL to fetch the data from database
$sql = 'select * from friends';
if(false == ($query_result = mysql_query($sql, $connection)))
	die('SQL: ' . $sql . '<br />' . mysql_error());

// Load each record into an array
$friends_list = array();
while($row = mysql_fetch_assoc($query_result)) {
	$friends_list[] = $row;
}

// Release the memory and resources allocated for query result
mysql_free_result($query_result);

// Close the database connection
mysql_close($connection);

?>
<!DOCTYPE html>
<html>
<head>
	<title>LAMP Demo</title>
	<meta name="charset" content="utf-8" />
</head>
<body>
	<h1>LAMP Demo</h1>
	<hr />

	<?php if(empty($friends_list)): ?>
	<p>Your friends list is empty</p>
	<?php else: ?>
	<table border="1">
		<caption>Friends List</caption>
		<thead>
			<tr>
				<th>Name</th>
				<th>Birthday</th>
				<th>Address</th>
			</tr>
		</thead>

		<tbody>
		<?php foreach($friends_list as $friend): ?>
		<tr>
			<td><?php echo $friend['name']; ?></td>
			<td><?php echo $friend['dob']; ?></td>
			<td><?php echo $friend['address']; ?></td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<?php endif; ?>
</body>
</html>
