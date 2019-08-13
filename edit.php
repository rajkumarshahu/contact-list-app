<?php
    include_once ("includes/global_variables.php");
    include_once ("includes/functions.php");

/*start post code*/
if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['title']) && isset($_POST['id'])){
    $user_info['id'] = $_POST['id'];
    $user_info['title'] = $_POST['title'];
    $user_info['fname'] = $_POST['fname'];
    $user_info['lname'] = $_POST['lname'];
    $user_info['email'] = $_POST['email'];
    $user_info['tel'] = $_POST['tel'];
    $user_info['homeTel'] = $_POST['homeTel'];
    $user_info['officeTel'] = $_POST['officeTel'];
    $user_info['site'] = $_POST['site'];
    $user_info['twitUrl'] = $_POST['twitUrl'];
    $user_info['fbUrl'] = $_POST['fbUrl'];
    $user_info['message'] = $_POST['message'];

    //print_r($_FILES);

    /*Picture upload starts*/
    $check = false;
    if(isset($_FILES["photo_upload"]["tmp_name"]) && $_FILES["photo_upload"]["tmp_name"]!=''){
        $check = getimagesize($_FILES["photo_upload"]["tmp_name"]);
        $extension = pathinfo($_FILES["photo_upload"]["name"],PATHINFO_EXTENSION);
        $target_location = $upload_dir.$user_info['id'].".".$extension;
    }

    if($check !== false) {
        move_uploaded_file($_FILES["photo_upload"]["tmp_name"], $target_location);
        $user_info['picture'] = $user_info['id'].".".$extension;
    }else{
        $user_info['picture'] = $_POST['picture'];
    }
    /*Picture upload ends*/

    editUser($user_info);
    header("location:index.php");
}
/*end post code */

include('includes/header.php');

if(isset($_GET['id']) && $_GET['id']>0) {
    $user_info = getUserInfo($_GET['id']);
    ?>
    <section class="container" >
            <div class="page-header">
                <div class="jumbotron">
                <h2>Edit Contact</h2>
            </div>
        </div>
        <p><a href="index.php" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home" aria-hidden="true">  Home</a></p>
        <form name="frmcontact" action="edit.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
                <select name="title" class="form-control">
                    <option value="Mr.">Mr.</option>
                    <option value="Miss.">Miss.</option>
                    <option value="Ms.">Ms.</option>
                    <option value="Dr.">Dr.</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fname">First Name:</label>
                <input type="text" class="form-control" name="fname" value="<?php echo $user_info['fname'];?>" required /><br/>
            </div>
            <div class="form-group" >
                <label for="lname">Last Name:</label>
                <input type="text" class="form-control" name="lname" value="<?php echo $user_info['lname'];?>" required />
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" value="<?php echo $user_info['email'];?>" />
            </div>
            <div class="form-group">
                <label for="cell">Cell Number:</label>
                <input type="tel" class="form-control" name="tel" value="<?php echo $user_info['tel'];?>">
            </div>
            <div class="form-group">
                <label for="tel">Home Number:</label>
                <input type="tel" class="form-control" name="homeTel" value="<?php echo $user_info['homeTel'];?>">
            </div>
            <div class="form-group">
                <label for="tel">Office Number:</label>
                <input type="tel" class="form-control" name="officeTel" value="<?php echo $user_info['officeTel'];?>">
            </div>
            <div class="form-group">
                <label for="twitter">Site:</label>
                <input type="text" class="form-control" name="site" value="<?php echo $user_info['site'];?>">
            </div>
            <div class="form-group">
                <label for="twitter">Twitter URL:</label>
                <input type="text" class="form-control" name="twitUrl" value="<?php echo $user_info['twitUrl'];?>">
            </div>
            <div class="form-group">
                <label for="facebook">Facebook URL:</label>
                <input type="text" class="form-control" name="fbUrl" value="<?php echo $user_info['fbUrl'];?>">
            </div>
            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea name="message" rows="5" class="form-control" placeholder="comment....." ><?php echo $user_info['message'];?></textarea>
            </div>
            <div class="form-group">
                <table class="table table-responsive">
                    <tr>
                        <td>
                            <label for="picture">Picture:</label>
                            <input type="file" class="" name="photo_upload" />
                            <input type="hidden" name="picture" value="<?php echo $user_info['picture'];?>" />
                            <img src="images/pictures/<?php echo $user_info['picture'];?>" width="300" />
                        </td>
                    </tr>
                </table>

            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
        <?php include('includes/footer.php');?>
    </section>
    <?php
}else{
    echo "invalid request";
}
    ?>

<h3 style="text-align: center">
    <a href="folder_view/vs.php?s=<?php echo __FILE__?>&pagename=edit.php" target="_blank">View Source</a>
</h3>