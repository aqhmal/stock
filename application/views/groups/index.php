<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Manage Groups</h1>
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
                        <table id="groupTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Group Name</th>
                                    <?php if(in_array('updateGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                                        <th>Action</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($groups_data): ?>
                                    <?php foreach($groups_data as $k => $v): ?>
                                        <tr>
                                            <td><?php echo $v['group_name']; ?></td>
                                            <?php if(in_array('updateGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                                                <td>
                                                    <?php if(in_array('updateGroup', $user_permission)): ?>
                                                        <a href="<?=base_url('groups/edit/'.$v['id']);?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
                                                    <?php endif; ?>
                                                    <?php if(in_array('deleteGroup', $user_permission)): ?>
                                                        <a href="<?=base_url('groups/delete/'.$v['id']);?>" class="btn btn-default"><i class="fa fa-trash"></i></a>
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
        $('#groupTable').DataTable();
        $("#mainGroupNav").addClass('active');
        $("#manageGroupNav").addClass('active');
    });
</script>