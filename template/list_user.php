<?php
session_start();
if(!$_SESSION['usergroup']=="admin"){
    header('Location: ../noauth.html');
}

?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <?php
    require_once('../src/DAL.php');
    $d = new DAL();
    $users = $d->query_for_all_users();
    ?>
    <h2 class="sub-header">Users</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Email</th>
                <th>Name</th>
                <th>User Group</th>
                <th>Create Time</th>
                <th>Last Login</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            <?php
                foreach ($users as $user){
                    if ($user->usergroup == "admin"){
                        $del='<td></td>';
                    }
                    else{
                        $del = '<td><!-- Trigger the modal with a button -->
                <div class="row">
                 <div class="col-md-5" data-toggle="modal" data-target="#delete'.$user->name.'">
                 <a>DELETE</a>
                 </div>
                </div>
                    <!-- Modal -->
                    <div class="modal fade" id="delete'.$user->name.'" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">WARNING</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Do you really want to delete this user?</p>
                                </div>
                                <div class="modal-footer">
                                    <a type="button" href="delete_user.php?email='.$user->email.'" class="btn btn-default">Yes</a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    </td>';
                    }
                    echo '            <tr>
                <td>'.$user->email.'</td>
                <td>'.$user->name.'</td>
                <td>'.$user->usergroup.'</td>
                <td>'.$user->createtime.'</td>
                <td>'.$user->lastlogin.'</td>
                '.$del.'
            </tr>';
                }
            ?>
            </tbody>
        </table>
    </div>
</div>';