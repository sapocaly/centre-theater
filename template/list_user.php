<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <?php
    require_once('../src/ye_DAL.php');
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
                <th>Wrong Count</th>
                <th>User Group</th>
                <th>Create Time</th>
                <th>Last Login</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            <?php
                foreach ($users as $user){
                    echo '            <tr>
                <td>'.$user->email.'</td>
                <td>'.$user->name.'</td>
                <td>'.$user->wrongcount.'</td>
                <td>'.$user->usergroup.'</td>
                <td>'.$user->createtime.'</td>
                <td>'.$user->lastlogin.'</td>
                <td><!-- Trigger the modal with a button -->
                <div class="row">
                 <div class="col-md-5" data-toggle="modal" data-target="#delete">
                 <a>DELETE</a>
                 </div>
                 <div class="col-md-7" data-toggle="modal" data-target="#reset">
                 <a>RESET</a>
                 </div>
                </div>
                    <!-- Modal -->
                    <div class="modal fade" id="delete" role="dialog">
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
                                    <button type="button" onclick="location.href = '."admin.php?section=user'".'" class="btn btn-default" data-dismiss="modal">Yes</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="reset" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">WARNING</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Do you really want to reset this user?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="location.href = '."admin.php?section=user'".'" class="btn btn-default" data-dismiss="modal">Yes</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    </td>
            </tr>';
                }
            ?>
            </tbody>
        </table>
    </div>
</div>';