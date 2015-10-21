<div class="pag3">
	<section class="app">
		<canvas width="380" height="440" id="cnvs" style="background-image: url(uploads/<?php echo $mostRecent['file_name'] ?>)">
			<p>No canvas support</p>
		</canvas>
	</section>
<p class="info hidden"> <?php echo "Je schoen is toegevoegd!"; ?> </p>
	<section class="intro">
		<article class="in">


			<div class="left">
				<h1>
					<span>Een creatieve collab!</span>
				</h1>

				<div>
					<div class="line"></div>
					<p>Zoek op <strong>schoenmaat</strong>, vind een <strong>kick-ass</strong> artiest en wissel je rechterschoen uit! <strong>Interesse?</strong>
						<strong>Upload snel je eigen design.</strong>
					</p>
					<a href="index.php?page=home#promotional" class="videonavsprite" title="home"><span>home</span></a>
				</div>

			</div>

			<div class="right">
				<form action="" enctype="multipart/form-data" method="post" class="uploadform" id="uploadform">

					<img src="assets/styling/gallery/check.png"  class="maat hidden" width="37" height="21" alt="correct"/>

					<div class="form-group<?php if(!empty($errors['maat'])) echo ' has-error'; ?>">

						<label minlength="6"  class="st" for="maat">Schoenmaat:</label>
						<div class="col">
							<div class="bgimg one"></div>
										<p class="up">
										37
										</p>
							<select name="maat" id="maat">
								<option value="37">37</option>
								<option value="38">38</option>
								<option value="39">39</option>
								<option value="40">40</option>
								<option value="41">41</option>
								<option value="42">42</option>
								<option value="43">43</option>
								<option value="44">44</option>
								<option value="45">45</option>
								<option value="46">46</option>
								<option value="47">47</option>

							</select>
							<?php if(!empty($errors['maat'])) echo '<span class="error-message">' . $errors['maat'] . '</span>';
							else{
                	// echo '<span class="instruction">37 - 47.</span>';
							}

							?>
						</div>
					</div>
					<input type="hidden" name="upload" value="submit" />
					<img src="assets/styling/gallery/check.png" class="email hidden"  width="37" height="21" alt="correct"/>

					<div class="form-group<?php if(!empty($errors['email'])) echo ' has-error'; ?>">
						<label minlength="6" class="st" for="email">Email adres:</label>

						<div class="col">
							<input type="text" name="email" id="email" class="form-control" value="<?php if(!empty($_POST['email'])) echo $_POST['email'];?>" autocomplete="off"  />
							<?php if(!empty($errors['email'])) echo '<span class="error-message two">' . $errors['email'] . '</span>';
							else{
								echo '<p class="error-message two hidden">Geen geldig adres.</p>';
							}

							?>
						</div>
					</div>

					<img src="assets/styling/gallery/check.png" class="image hidden"  width="37" height="21" alt="correct"/>

					<div class="form-group<?php if(!empty($errors['image'])) echo ' has-error'; ?>">
						<label minlength="6" class="st" for="image">Foto schoen:</label>

						<input type="file" name="image" id="addimage" class="form-control file" value="<?php if(!empty($_POST['image'])) echo $_POST['image'];?>" />
						<div class="bgimg f"></div>
						<?php if(!empty($errors['image'])) echo '<span class="error-message">' . $errors['image'] . '</span>';
						else{
							echo '<p class="error-message hidden">Upload afbeelding.</p>';
						}

						?>
					</div>

					<div class="form-group">
						<div class="addimg ab"><input type="submit" value="" class="btn btn-default"></div>
					</div>

				</form>
			</div>
		</article>
	</section>

	<div class="divider"></div>

	<form action="" enctype="multipart/form-data" method="post" class="searchform">

		<div class="form-group">
			<label  class="st" for="">Schoenmaat:</label>
			<div class="col">
				<div class="bgimg one"></div>

				<p class="up sec">
				<?php if(!empty($_GET['size'])){ ?>
					<?php echo $_GET['size'] ?>
										<?php }else{ ?>
										<?php echo "37";?>
										<?php } ?>
										</p>
				<select name="schoen" id="schoen">
					<option	<?php if(!empty($_GET['size'])){if($_GET['size'] === "37"){echo "selected";}} ?> value="37">37</option>
					<option <?php if(!empty($_GET['size'])){if($_GET['size'] === "38"){echo "selected";}} ?> value="38">38</option>
					<option <?php if(!empty($_GET['size'])){if($_GET['size'] === "39"){echo "selected";}} ?> value="39">39</option>
					<option <?php if(!empty($_GET['size'])){if($_GET['size'] === "34"){echo "selected";}} ?> value="40">40</option>
					<option <?php if(!empty($_GET['size'])){if($_GET['size'] === "41"){echo "selected";}} ?> value="41">41</option>
					<option <?php if(!empty($_GET['size'])){if($_GET['size'] === "42"){echo "selected";}} ?> value="42">42</option>
					<option <?php if(!empty($_GET['size'])){if($_GET['size'] === "43"){echo "selected";}} ?> value="43">43</option>
					<option <?php if(!empty($_GET['size'])){if($_GET['size'] === "44"){echo "selected";}} ?> value="44">44</option>
					<option <?php if(!empty($_GET['size'])){if($_GET['size'] === "45"){echo "selected";}} ?> value="45">45</option>
					<option <?php if(!empty($_GET['size'])){if($_GET['size'] === "46"){echo "selected";}} ?> value="46">46</option>
					<option <?php if(!empty($_GET['size'])){if($_GET['size'] === "47"){echo "selected";}} ?> value="47">47</option>
				</select>


			</div>
		</div>
		<input type="hidden" name="search" value="Go" />

		<!-- <div class="form-group"> -->
		<div class="gobtn"><input type="submit" value="Go" class="btn btn-default"></div>
		<!-- </div> -->
	</form>

	<div id="ajaxSpinner"><img src="assets/spinner/ajax-loader.gif" alt="loading" width="16" height="16" /></div>
	<section class="gallery">
		<span class="getall">
			<?php if(!empty($posts)){
			foreach($posts as $post) {  ?>

			<div class="con">
				<div class="border"><a href="mailto:<?php echo $post['email'] ?>" target="_top">Verstuur verzoek</a></div>
				<div class="item" style="background-image:url('gallery/<?php echo $post['file_name'] ?>')"></div>

			</div>

			<?php } }else{?>
			<p>Voeg je schoen toe.</p>
			<?php } ?>

		</span>

		<span class="numbers">

			<?php $lastPageNr = ceil($count / 6); ?>
			<ul class="pagination">

				<?php for($i = 1; $i <= $lastPageNr; $i++) { ?>


				<li class=><a class="pag <?php if((!empty($_GET['p'])) & (($_GET['p']== $i))) {echo "navActive";} ?>" href="index.php?page=gallery&size=<?php if(!empty($_GET['size']))echo $_GET['size'] ?>&p=<?php echo $i?>"><?php echo $i?></a></li>
				<?php } ?>
			</ul>


		</span>
	</section>

	<div class="divider"></div>
	<div class="div2"></div>

</div>


