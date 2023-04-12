<?php
session_start();
if (!$_SESSION['status']) {
	header("Location: login.php");
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Eatables</title>
	<link rel="stylesheet" href="styles/input.css">
	<link rel="stylesheet" href="styles/style.css">
	<script src="https://cdn.tailwindcss.com"></script>
	<script src="https://kit.fontawesome.com/08ae7c27bc.js" crossorigin="anonymous"></script>
	<link rel="shortcut icon" href="public/eatables.png" type="image/x-icon">
</head>

<body>
	<?php
	$con = new mysqli("localhost", "root", "", "eatables");
	if (mysqli_connect_error()) {
		die("Not connected");
	}
	$hotel_id = $_GET['hotel_id'];
	$hotel_name = $_GET['hotel_name'];
	$rating = $_GET['rating'];

	$sql = "select * from item where hotel_id='$hotel_id'";
	$res = $con->query($sql);
	$sql = "select links from hotel where hotel_id='$hotel_id'";
	$row = $con->query($sql);

	while ($rowTwo = $row->fetch_assoc()) {
		$links = $rowTwo['links'];
	}
	?>
	<div class="bg-brand bg-img min-h-screen flex flex-col items-center p-4 md:px-16">
		<div class="flex items-center w-full justify-between md:pt-4">
			<a href="index.php" class="text-3xl md:text-4xl font-colvet">
				eatables.
			</a>
			<a href="index.php">
				<i class="fa-solid fa-xmark text-2xl"></i>
			</a>
		</div>
		<div class="flex justify-between w-full py-7 md:py-6 md:flex-row flex-col space-y-2 md:space-y-0">
			<div class='w-full md:w-3/6'>
				<div class="flex flex-col">
					<h1 class='font-poppy text-2xl md:text-3xl font-bold'><?php echo $hotel_name ?></h1>
					<h1 class="text-xl"><?php
									if ($rating == '5') {
										echo "⭐⭐⭐⭐⭐";
									} else if ($rating == '4') {
										echo "⭐⭐⭐⭐";
									} else if ($rating == '3') {
										echo "⭐⭐⭐";
									} else if ($rating == '2') {
										echo "⭐⭐";
									} else if ($rating == '1') {
										echo "⭐";
									} else {
										echo "";
									}
									?>
					</h1>
				</div>
				<p class='font-poppy text-xl pt-2 text-justify'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente, incidunt deserunt optio pariatur dolorem natus est quod eos error, rem porro ut amet praesentium voluptas possimus quidem, laborum accusamus vero!</p>
				<div class="flex space-x-5 mt-4">
					<a href='<?php echo $links; ?>'><img class="w-21 h-9 cursor-pointer" src='media/images/zomato.png' /></a>
					<a href='<?php echo $links; ?>'><img class="w-21 h-9 cursor-pointer" src='media/images/swiggy.png' /></a>
				</div>
			</div>
			<div class='w-full md:w-2/6'>
				<h1 class='font-poppy text-lg md:text-xl font-bold'><i class="fa-sharp fa-solid fa-location-dot mr-1 mb-2"></i>locate on map</h1>
				<iframe class="w-full h-full" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d23378.894207711317!2d74.86595042076911!3d12.866829795923548!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba35bca6d4053c9%3A0xd7b6f183ab4d2466!2sMithamuger%20Rd%2C%20Attavar%2C%20Mangaluru%2C%20Karnataka%20575002!5e0!3m2!1sen!2sin!4v1681250490146!5m2!1sen!2sin" style="border:0;" allowfullscreen="false" loading="lazy"></iframe>
			</div>
		</div>
		<?php
		echo "<div class='flex w-full items-center justify-between'>
				<div class='flex space-x-2 border-b-2 pb-2 border-black'>
					<i class='fa-sharp fa-solid fa-magnifying-glass text-xl md:text-2xl'></i>		
					<h3 class='font-poppy text-md md:text-xl'>top dishes for you at <span class='font-bold text-xl md:text-2xl capitalize'> $hotel_name</span></h3>
				</div>		
			</div>";
		?>

		<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-8 w-full ">

			<?php
			$i = 0;
			if ($res->num_rows > 0) {
				while (($row = $res->fetch_assoc()) && $i < 16) {
					$i++;
			?>
					<a class="text-white bg-black hover:scale-[1.01] rounded-lg shadow-lg px-4 py-24 hover:shadow-xl transition-all font-poppy font-semibold text-center bg-img-food duration-500" href="itempage.php?item_id=<?php echo $row['item_id']; ?>">
						<p class="text-white-700"><?php echo $row['item_name']; ?></p>
					</a>

				<?php
				}
			} else {
				?>
		</div>
		<div class="flex items-center justify-center h-[60vh] flex-col">
			<i class="fa-regular fa-face-sad-tear text-3xl mb-1"></i>
			<p class=" md:grid-cols-1 text-center font-poppy text-xl">Looks like this town is so small, the hotels are playing hide-and-seek!</p>
		</div>
	</div>
<?php
			}

?>
</body>

</html>