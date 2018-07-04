<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Profile</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-bordered table-condensed table-hovered">
                            <tr>
                                <th>Username</th>
                                <td><?=$user_data['username'];?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?=$user_data['email'];?></td>
                            </tr>
                            <tr>
                                <th>First Name</th>
                                <td><?=$user_data['firstname'];?></td>
                            </tr>
                            <tr>
                                <th>Last Name</th>
                                <td><?=$user_data['lastname'];?></td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td><?=($user_data['gender'] == 1) ? 'Male' : 'Female';?></td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td><?=$user_data['phone'];?></td>
                            </tr>
                            <tr>
                                <th>Group</th>
                                <td><span class="label label-info"><?=$user_group['group_name'];?></span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>