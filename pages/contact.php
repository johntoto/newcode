<?php
	global $conn;

	$con_name = $con_email = $con_message = $name_Err = $email_Err = $com_Err = "";

	if(isset($_POST['submit']) && $_POST['submit'] == "Send")
	{
		if(empty($_POST['cont_name']))
		{
			$name_Err = "Enter your name";
		}
		else
		{
			$name_Err = "";
			$con_name = $_POST['cont_name'];
		}

		if(empty($_POST['cont_email']))
		{
			$email_Err = "Enter your Email";
		}
		else
		{
			$email_Err = "";
			$con_email = $_POST['cont_email'];
		}

		if(empty($_POST['cont_message']))
		{
			$com_Err = "Enter your Message";
		}
		else
		{
			$com_Err = "";
			$con_message = $_POST['cont_message'];
		}

		if(!empty($con_name && $con_email && $con_message))
		{
			$to = "johntoto67@gmail.com";
			$subject = "Contact message from ";
			$message = " Name :$con_name, \n \n  Email : $con_email . \n \n  .... The message sent is : $con_message";

			if(mail($to, $subject, $message,'From:johntoto67@gmail.com'))
			{
				echo "<script>alert('Successfully sent email')</script>";
				echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=home','_self')</script>";
			}
			else
			{
				//echo "<script>alert('Failed to send email')</script>";
				echo "<script>alert('Failed to send email. Check your internet connection.')</script>";
			}
		}
	}
?>

<div class="container">
	<h2>Send us a message</h2>
	<div class="row">
		<div class="col-md-10">
			<div class="contact">
				<p class="text-center">We thank you for being part of us and we would love to hear from you. You can write to us your feedback through email address. In case of complains or additional content to be added, feel free to write to us your comments.</p>
					<form class="form-horizontal" method="post">
						<div class="form-group">
							<span style="color: red;padding-left: 20px;"><?php echo $name_Err ; ?></span>
							<label class="control-label col-sm-3">Name : </label>
							<div class="col-lg-9 col-sm-9">
								<input type="text" class="form-control" name="cont_name" placeholder="Enter your name">
							</div>
						</div>
						<div class="form-group">
							<span style="color: red;padding-left: 20px;"><?php echo $email_Err ; ?></span>
							<label class="control-label col-sm-3">Email : </label>
							<div class="col-lg-9 col-sm-9">
								<input type="text" class="form-control" name="cont_email" placeholder="Enter your name">
							</div>
						</div>
						<div class="form-group">
							<span style="color: red;padding-left: 20px;"><?php echo $com_Err ; ?></span>
							<label class="control-label col-sm-3">Message : </label>
							<div class="col-lg-9 col-sm-9">
								<textarea class="form-control" rows="5" name="cont_message" cols="10" placeholder="Write your comments here"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
								<input type="submit" class="btn btn-info bt-lg" name="submit" value="Send">
							</div>
						</div>
					</form>
				</div>
		</div>
	</div>
</div>