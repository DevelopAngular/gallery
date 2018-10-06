<?php
if(!isset($_SESSION['radmin']))
{
  exit('Только администратор может заходить на эту страницу!'); 
}
?>
<div class="forms">
  <div class="form-album">
    <h2>Форма добавления альбома</h2>
  	<form action="index.php?page=2" method="post" enctype="multipart/form-data">
  		<input type="text" name="albumname" placeholder="Имя альбома">
          <br>
      <textarea name="info" cols="30" rows="10" placeholder="Подробная информация"></textarea>
      <br>
      <input type="submit" name="addalbum" class="addalbum" value="Добавить альбом">
    </form>
  </div>

  <div class="form-foto">
    <h2>Форма добавления фотографий в альбом</h2>
    <form action="index.php?page=2" method="post" enctype="multipart/form-data">
      <input type="file" name="imagepath[]" multiple accert="images/*">
      <br>     
      <input type="submit" name="addfoto" class="addfoto" value="Добавить фото">
      <br>
      <select name="albumid">
    </form>
  </div>
</div>
        <?php
          $pdo=Tools::connect();
          $ps=$pdo->prepare('select * from Albums');
          $ps->execute();
          while($row=$ps->fetch())
          {
            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
          }
        ?>
        </select>
	</form>
	
<?php
 if(isset($_POST['addalbum']))
  {
      if(Tools::albums($_POST['albumname'],$_POST['info']))
      {
        echo '<div class="success">Новый альбом создан!</div>';
      }
      
  }
 if(isset($_POST['addfoto']))
  {
    foreach ($_FILES['imagepath']['name'] as $key => $value) 
    {
     if($_FILES['imagepath']['error'][$key] !=0)
      {
       continue;
      }
     if(move_uploaded_file($_FILES['imagepath']['tmp_name'][$key],'images/'.$value));
      $albumid=$_POST['albumid'];
      $path="images/".$value;
      $images=new Images($albumid,$path);
      $images->imagedb();
    }
       echo '<div class="success">Изображения успешно добавлены в альбом!</div>';
    
  }
 
?>