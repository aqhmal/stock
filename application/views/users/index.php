<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Manage Users</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <?php if($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?=$this->session->flashdata('success');?>
                    </div>
                <?php elseif($this->session->flashdata('error')): ?>
                    <div class="alert alert-error alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?=$this->session->flashdata('error');?>
                    </div>
                <?php endif; ?>

                <div class="box">
                    <div class="box-body">
                        <table id="userTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Group</th>

                                    <?php if(in_array('updateUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                                        <th>Action</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($user_data): ?>
                                    <?php foreach($user_data as $k => $v): ?>
                                        <tr>
                                            <td><?=$v['user_info']['username'];?></td>
                                            <td><?=$v['user_info']['email'];?></td>
                                            <td><?=$v['user_info']['firstname'] .' '. $v['user_info']['lastname'];?></td>
                                            <td><?=$v['user_info']['phone'];?></td>
                                            <td><?=$v['user_group']['group_name'];?></td>
                                            <?php if(in_array('updateUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                                                <td>
                                                <?php if(in_array('updateUser', $user_permission)): ?>
                                                    <a href="<?=base_url('users/edit/'.$v['user_info']['id']);?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
                                                <?php endif; ?>

                                                <?php if(in_array('deleteUser', $user_permission)): ?>
                                                    <a href="<?=base_url('users/delete/'.$v['user_info']['id']) ?>" class="btn btn-default"><i class="fa fa-trash"></i></a>
                                                <?php endif; ?>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#userTable').DataTable();
        $("#mainUserNav").addClass('active');
        $("#manageUserNav").addClass('active');
    });
</script>