<footer>
	<div>
		<div class="footer_grid33">
			<h3 style="text-align: center;">Pay Dues Online</h3>
			<p class="grid100">
				<a href="https://squareup.com/market/bsa-pack-97/pack-dues" target="_blank">
					<img src="http://www.cubscoutpack97.org/images/square_logo.jpg" border="0" width="100" height="100" class="img_center">
				</a>
			</p>					
		</div>
		<div class="footer_grid33">
			<div class="m_top50">
  				<h3>Quick Links</h3>
				<ul>
					<li class="m10 font15">
						<a href="http://scouting.org" target="_blank">Boy Scouts of America</a>
					</li>
					<li class="m10 font15">
						<a href="http://cubscouts.org/" target="_blank">The Cub Hub</a>
					</li>
					<li class="m10 font15">
						<a href="http://www.mccscouting.org/" target="_blank">Mecklenburg County Council</a>
					</li>
					<li class="m10 font15">
						<a href="http://www.mccscouting.org/Districts/HornetsNest.aspx" target="_blank">Hornets Nest District</a>
					</li>
					<li class="m10 font15">
						<a href="http://www.stmarknc.org/" target="_blank">St. Mark Catholic Church</a>
					</li>
					<li class="m10 font15">
						<a href="http://www.cdccos.info/" target="_blank">Charlotte Diocese Catholic Committee on Scouting</a>
					</li>
					<?php 
						$urlPath = $_SERVER['REQUEST_URI']; 
						$urlArray = explode("/", $urlPath);
						if(strcmp($urlArray[1],"hike") == 0){
						 	echo "<li class='m10 font15'><a href='http://www.cubscoutpack97.org/hike/admin_home.php'>Admin</a></li>";
						}else if(strcmp($urlArray[1],"events") == 0){
							echo "<li class='m10 font15'><a href='http://www.cubscoutpack97.org/events/admin_home.php'>Admin</a></li>";
						}else{
							echo strcmp($urlArray[1],"events");
							echo $urlArray[1];
						}
					?>		
				</ul>					
			</div>
		</div>
		<div class="footer_grid33">
			<div class="mb20">
				<a href="https://www.facebook.com/pages/Cub-Scout-Pack-97/181620618695104" target="blank_">
					<img src="http://www.cubscoutpack97.org/images/Facebook_Badge_Transparent.png" border="0" width="200">
				</a>
			</div>		
		</div>
		<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script type="text/javascript" src="/slick/slick.min.js"></script>
		<script type="text/javascript" src="/js/headerLib.js"></script>
		<script type="text/javascript" src="/js/JoomblaLib.js"></script>
	</div>
</footer>
</body>
</html>