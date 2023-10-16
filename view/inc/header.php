<?php
if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header('location: ../../view/logins/login.php');
}
?>
<div class = "header">
    <div class= "header-wrapper">
    <?php if(!empty($_SESSION)) {?>   
       <a href="<?php echo "../../".$_SESSION['role']."/view/".$_SESSION['role']."Index.php" ?>" style = "color: green; text-decoration:none;">
        <img class= "icon" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTKL0A9XLow6qDBInh6cg1MnYv-fbT0euSyRhH7EBrJu0u3rA218uylWE-03aGRnEgjV2w&usqp=CAU" alt="classroom icon">
        <h1 class = "heading">Classroom</h1>
       </a>
    <?php }else{?>
        <img class= "icon" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTKL0A9XLow6qDBInh6cg1MnYv-fbT0euSyRhH7EBrJu0u3rA218uylWE-03aGRnEgjV2w&usqp=CAU" alt="classroom icon">
        <h1 class = "heading">Classroom</h1>
    <?php }?>
    </div>
    <div class= "header-wrapper">
    </div>
    
    <div class= "header-wrapper">
    <?php if(!empty($_SESSION)) {?>   
        <a href="../../view/logins/profile.php">Profile</a> <br>
        <form action="" method="post">
        <input type="submit" name="logout" value="Log Out">
        </form>
    <?php } ?>
    </div>
    
</div>

    
