<div class="pag2">
	<section class="app">
		<canvas width="380" height="440" id="cnvs" hidpi="off" style="background-image: url(uploads/<?php echo $mostRecent['file_name'] ?>)">
			<p>Teken!</p>
		</canvas>
	</section>

	<div class="intro applicatie">
		<div class="line"></div>


		<section class="practice">
			<canvas width="640" height="360" hidpi="off" id="canvas">
				<p>Oefen alvast virtueel</p>
			</canvas>
		</section>

		<section class="settings">
			<ul class="stroke">
				<li class="3 select"><span>Dun</span></li>
				<li class="10"><span>Dik</span></li>
			</ul>

			<ul class="color">
				<li class="#d8de3d"><span>Geel</span></li>
				<li class="#974141"><span>Rood</span></li>
				<li class="#01acb4"><span>Blauw</span></li>
				<li class="#000000 colorActive std"><span>Zwart</span></li>
			</ul>

			<button class="save" type="button"><span>save</span></button>
			<button class="clear" type="button"><span>clear</span></button>
		</section>

	</div>
	<div class="divider"></div>

	<section class="gal" id="inhoud">
		<?php foreach ($three as $one) { ?>
		<div>
			<img id="scrollTo" src="uploadsgallery/<?php echo $one['file_name'] ?>" alt="shoe" width="233" height="130">
			<p><?php echo $one['creation_date'] ?></p>
		</div>
		<?php } ?>
	</section>


</div>
<div class="divider last"></div>
<div class="div2"></div>
