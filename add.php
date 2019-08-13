<?php
include_once ("includes/global_variables.php");
include_once ("includes/functions.php");

if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['title'])) {

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

        /*Picture upload starts*/
        if(isset($_FILES["photo_upload"]["tmp_name"]) && $_FILES["photo_upload"]["tmp_name"]!=''){
            $check = getimagesize($_FILES["photo_upload"]["tmp_name"]);
            $max_id = getMaxId() + 1;
            $extension = pathinfo($_FILES["photo_upload"]["name"], PATHINFO_EXTENSION);
            $target_location = $upload_dir . $max_id . "." . $extension;
        }

        if ($check !== false) {
            move_uploaded_file($_FILES["photo_upload"]["tmp_name"], $target_location);
            $user_info['picture'] = $max_id . "." . $extension;
        } else {
            $user_info['picture'] = "";
        }
        /*Picture upload ends*/

        addUser($user_info);
        header("location:index.php");
    }

include('includes/header.php');

?>
    <section class="container">
            <div class="page-header">
                <div class="jumbotron">
                <h2>Add Contact</h2>
            </div>
            <h5>Fields marked with <strong>*</strong> are mandatory</h5>
        </div>

        <p><a href="index.php" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home" aria-hidden="true">  Home</a></p>

        <form name="frmcontact" action="add.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">*Title:</label>
                <select name="title" class="form-control" required>
                    <option value="Mr.">Mr.</option>
                    <option value="Miss.">Miss.</option>
                    <option value="Ms.">Ms.</option>
                    <option value="Dr.">Dr.</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fname">*First Name:</label>
                <input type="text" class="form-control" name="fname" value="" required />

            </div>
            <div class="form-group" >
                <label for="lname">*Last Name:</label>
                <input type="text" class="form-control" name="lname" value="" required />
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" value="">
            </div>

            <div class="form-group">
                <label for="cell">Cell Number:</label>
                <input type="tel" class="form-control" name="tel" value="">
            </div>
            <div class="form-group">
                <label for="homeTel">Home Number:</label>
                <input type="tel" class="form-control" name="homeTel" value="">
            </div>
            <div class="form-group">
                <label for="officeTel">Office Number:</label>
                <input type="tel" class="form-control" name="officeTel" value="">
            </div>
            <div class="form-group">
                <label for="twitter">Site:</label>
                <input type="text" class="form-control" name="site" value="">
            </div>
            <div class="form-group">
                <label for="twitter">Twitter URL:</label>
                <input type="text" class="form-control" name="twitUrl" value="">
            </div>
            <div class="form-group">
                <label for="facebook">Facebook URL:</label>
                <input type="text" class="form-control" name="fbUrl" value="">
            </div>
            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea name="message" rows="5" class="form-control" placeholder="comment....."></textarea>
            </div>
            <div class="form-group">
                <label for="picture">Picture:</label>
                <input type="file" name="photo_upload" />
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
        </form>
        <?php include('includes/footer.php');?>
    </section>


<h3 style="text-align: center">
    <a href="folder_view/vs.php?s=<?php echo __FILE__?>&pagename=add.php" target="_blank">View Source</a>
</h3>
