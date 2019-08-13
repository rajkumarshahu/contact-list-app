<?php
include_once("includes/global_variables.php");
include_once("includes/functions.php");
include('includes/header.php');?>

<section class="container">
        <div class="page-header">
            <div class="jumbotron" >
            <h2>Contact List</h2>
        </div>

    </div>
    <p><a href="index.php" class="btn btn-primary btn-lg" ><span class="glyphicon glyphicon-home" aria-hidden="true">  Home</a></p>
        <div class="">
            <form name="frmSearch" class="input-group input-group-lg" method="get" action="">
                <input type="text" class="form-control" name="search" value="<?php echo (isset($_GET['search']))?$_GET['search']:''?>" />
                <span class="input-group-btn">
                     <button type="submit" class="btn btn-primary" value="Search">
                         <span class="glyphicon glyphicon-search" aria-hidden="true">  Search</span>
                    </button>
                </span>
            </form>
        </div>

    <br/>

        <div class="input-group input-group-ig" data-spy="affix">
            <a href="add.php" class="btn btn-primary btn-lg">Add new contact   <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </a>
        </div><br/><br/><br/>

    <div class="table table-responsive">
        <table class="table  table-bordered table-striped table-hover ">
            <tr>
                <th class="text-center">Picture</th>
                <th class="text-center">Title</th>
                <th class="text-center">Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Actions</th>
            </tr>
        <?php
        if(isset($_GET['search']) && $_GET['search']!=''){
            $contact_list = getSearchResult($_GET['search']);
        }else{
            $contact_list = getSearchResult();
        }
        if(count($contact_list)>0) {
            foreach ($contact_list as $user) {
                ?>
                <tr>
                    <td align="center">
                        <?php if(isset($user['picture']) && $user['picture']!='' && file_exists("images/pictures/".$user['picture'])){
                            ?><img width="50" src="images/pictures/<?php echo $user['picture']; ?>" />
                            <?php
                        }else{
                            ?>
                            <img width="50" src="images/pictures/default.png" />
                            <?php
                        }
                        ?>
                    </td>
                    <td><?php echo $user['title']; ?></td>
                    <td><?php echo $user['fname'] . ' ' . $user['lname']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td class="text-center"><a href="view.php?id=<?php echo $user['id']; ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>  View  </a>   |
                        <a href="edit.php?id=<?php echo $user['id']; ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil" aria-hidden="true">  </span>    Edit</a>   |   <a
                                href="delete.php?id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this?')">Delete  <span class="glyphicon         glyphicon-remove" aria-hidden="true">  </span></a></td>
                </tr>
                <?php
            }
        }else{
            ?>
            <tr><td colspan="4">No results</td></tr>
`   `            <?php
        }

        ?>
        </table>
    </div>
    <?php include('includes/footer.php');?>

</section>

<h3 style="text-align: center">
    <a href="folder_view/vs.php?s=<?php echo __FILE__?>&pagename=index.php" target="_blank">View Source</a>
</h3>
