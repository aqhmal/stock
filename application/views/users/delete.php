<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Delete User</h1>
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
                
                <h1>Do you really want to remove ?</h1>

                <form action="<?=base_url('users/delete/'.$id);?>" method="post">
                    <input type="submit" class="btn btn-primary" name="confirm" value="Confirm">
                    <a href="<?=base_url('users');?>" class="btn btn-warning">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#mainUserNav").addClass('active');
    });
</script>