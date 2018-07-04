<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit User</h1>
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
                    <form role="form" action="" method="post">
                        <div class="box-body">
                            <?=validation_errors();?>
                            <div class="form-group">
                                <label for="groups">Groups</label>
                                <select class="form-control" id="groups" name="groups">
                                    <option value="">Select Groups</option>
                                    <?php foreach ($group_data as $k => $v): ?>
                                        <option value="<?php echo $v['id'] ?>" <?php if($user_group['id'] == $v['id']) { echo 'selected'; } ?> ><?php echo $v['group_name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off" value="<?=$user_data['username'];?>">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" autocomplete="off" value="<?=$user_data['email'];?>">
                            </div>

                            <div class="form-group">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" autocomplete="off" value="<?=$user_data['firstname'];?>">
                            </div>

                            <div class="form-group">
                                <label for="lname">Last name</label>
                                <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" autocomplete="off" value="<?=$user_data['lastname'];?>">
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" autocomplete="off" value="<?=$user_data['phone'];?>">
                            </div>

                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" id="male" value="1" <?php if($user_data['gender'] == 1) {
                                            echo "checked";
                                        } ?>>
                                        Male
                                    </label>
                                    <label>
                                        <input type="radio" name="gender" id="female" value="2" <?php if($user_data['gender'] == 2) {
                                            echo "checked";
                                        } ?>>
                                        Female
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="alert alert-info alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    Leave the password field empty if you don't want to change.
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password"  autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="cpassword">Confirm password</label>
                                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" autocomplete="off">
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="<?=base_url('users/');?>" class="btn btn-warning">Back</a>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#groups").select2();
        $("#mainUserNav").addClass('active');
    });
</script>