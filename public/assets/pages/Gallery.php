
	<h2>Галерея</h2>
	<div class="my-albums">
		<div class="album">
		<?php	
		$pdo=Tools::connect();
	    $ps=$pdo->prepare('select * from Albums order by datetame desc');
	    $ps->execute();
	    while($row=$ps->fetch())
	    {	
			$jsalbum=json_encode($row);
			// echo $jsalbum;
	    }
		?>
		<script type="text/javascript">
		var jsalbum =<? echo $jsalbum; ?>;
		jsalbum.name.getElementsByTagName('.my-albums .album').value = jsalbum.name;
		 </script>	    
		</div>
	</div>
