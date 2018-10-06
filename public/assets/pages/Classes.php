<?php
class Tools{
	static function connect($host="localhost",
		$user="root",
		$pass="",
		$dbname="My Gallery")
	{
		$cs='mysql:host='.$host.';dbname='.$dbname.';charset=utf8;';
		$options=array(
			PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
			PDO::MYSQL_ATTR_INIT_COMMAND=>'set names utf8');
		try{
			$pdo=new PDO($cs,$user,$pass,$options);
			return $pdo;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
			return false;

		}
	}
	static function register($login,$pass1,$pass2,$email)
	{
		$login=trim(htmlspecialchars($login));
		$pass1=trim(htmlspecialchars($pass1));
		$pass2=trim(htmlspecialchars($pass2));
		$email=trim(htmlspecialchars($email));
	

	if($login == "" || $pass1 == "" || $pass2 == "" || $email == "")
	{
		echo '<div class="errors">Поля не должны быть пустыми</div>';
		return false;
	}

	if(strlen($login) < 3 || strlen($login) > 50 || strlen($pass1) < 3 || strlen($pass1) > 50)
	{
	    echo '<div class="errors">Имя и пароль не должны быть меньше 3 или больше 50 символов </div>';
		return false;
	}
	if($pass1 != $pass2)
	{
		echo '<div class="errors">Пароли не совпадают!</div>';
		return false;
	}
	if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		echo '<div class="errors">Не корректный email</div>';
		return false;
	}
	Tools::connect();
	$customer=new Customer($login,$pass1,$email);
	$user=$customer->fromDb();
	$err=$customer->intoDb();
	if ($err)
	{
		if($err==1062)
			echo '<div class="errors">Такой имя уже существует!</div>';
		else
			echo "<div class='errors'>Код ошибки:".$err."!</div>";
		return false;
	}
	return true;
	}
static function login($name,$pass)
    {
	$name=trim(htmlspecialchars($name));
	$pass=trim(htmlspecialchars($pass));

	if($name == "" || $pass == "")
	    {
	    	echo 'Введите имя или пароль';
	    	return false;
	    }
	    $pdo=Tools::connect();
	    $ps=$pdo->prepare('select login,pass,roleid from Customers');
	    $ps->execute();
	    $row=$ps->fetch();
	    echo $row['login'];
	    if($pass == md5($row['pass']) || $name == $row['login'])
	    {
	       			$_SESSION['ruser']=$name;
		       if($row['roleid'] == 1)
		       {
		       		$_SESSION['radmin']=$name;
		       }
	    }
	    else
	    {
	    	echo '<div class="errors">Неверное имя или пароль!</div>';
	    	return false;
	    }
	    return true;
    }
 	
static function albums($albumname,$info)
{
	$albumname=trim(htmlspecialchars($albumname));
    $info=trim(htmlspecialchars($info));
    if($albumname == "")
    {
    	echo '<div class="errors">Альбом не может быть без имени!</div>';
    	return false;
    }
    Tools::connect();
    $album=new Album($info,$albumname);
    $album->intoDb();
    	return true;

}
}
/////////////////////Customer///////////////////
class Customer{
	protected $id;
	protected $login;
	protected $pass;
	protected $roleid;
	protected $email;
	function __construct($login,$pass,$email,$id=0){
		$this->login=$login;
		$this->pass=md5($pass);
		$this->id=$id;
		$this->roleid=2;
		$this->email=$email;

}
 function intoDb()
 {
 	try
 	{
 		$pdo = Tools::connect();
		$ps = $pdo->prepare('insert into Customers (login, pass, roleid, email) 
		values (:login, :pass, :roleid, :email)');
		$a = array('login'=>$this->login, 'pass'=>$this->pass, 'roleid'=>$this->roleid,'email'=>$this->email);
		$ps->execute($a);

 	}
 	catch(PDOException $e)
 	{
 		$err=$e->getMessage();
 	}
 }
 function fromDb()
 {
 	$cast=null;
  try
 	{
 	 $pdo=Tools::connect();
 	 $ps=$pdo->prepare('select * from Customers where id=?');
 	 $ps->execute(array($id));
 	 $row=$ps->fetch();
 	 $customer=new Customer($row['login'],
 	 $row['pass'],$row['id'],$row['email']);
 	   return $customer;
 	}
  catch(PDOException $e)
 	{
 		$err=$e->getMessage();
 		return false;
 	}
 }


}

/////////Album/////////
class Album{
   public $name,$info;
	   function __construct($info,$name,$id=0)
	   {
	   	$this->id=$id;
	   	$this->name=$name;
	   	$this->info=$info;

	   }
   	function intoDb()
   	{

   	try{
   		$pdo=Tools::connect();
   		$ps=$pdo->prepare('insert into Albums (name, info) 
   				          values (:name, :info)');
   		$ar=array('name'=>$this->name,'info'=>$this->info);
            $ps->execute($ar);
   		}
   	catch(PDOException $e)
 	{
 		$err=$e->getMessage();
 		return false;
 	}
   	}
   	   	static function fromDb()
   	{
   		try
   		{
   			$pdo=Tools::connect();
   			$ps=$pdo->prepare('select * from Albums');
   			$ps->execute();
   			$row=$ps->fetch();
   		    $album = new Album($row['name'],$row['info'],$row['datetame']);
   		       return $album;
   			
   		}
   		catch(PDOException $e)
	 	{
	 		$err=$e->getMessage();
	 		return false;

	   	}


   }

   }
   class Images{
   	public $albumid,$imagepath;
   		function __construct($albumid,$imagepath)
   		{
   			$this->albumid=$albumid;
	   	    $this->imagepath=$imagepath;
   		}


   	    function imagedb()
   	{
   	try{
   		$pdo=Tools::connect();
   		$ps=$pdo->prepare('insert into Images (albumid,imagepath) 
   				          values (:albumid, :imagepath)');
   		$ar=array('albumid'=>$this->albumid,'imagepath'=>$this->imagepath);
            $ps->execute($ar);
   		}
   	catch(PDOException $e)
 	{
 		$err=$e->getMessage();
 		return false;
   	}
    }
   }