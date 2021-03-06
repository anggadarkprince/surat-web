<div class="header">
    <h2>User <strong>Account</strong></h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li><a href="<?= site_url() ?>dashboard.html">Dashboard</a></li>
            <li class="active">Account</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12 portlets">
        <div class="panel">
            <div class="panel-header panel-controls">
                <h3><i class="fa fa-user"></i> Account <strong>Form</strong></h3>
            </div>
            <div class="panel-content">

                <!-- alert -->
                <?php if(isset($operation)){ ?>
                    <div class="alert alert-<?=$operation?>" role="alert">
                        <p class="text-center"><?php echo $message; ?></p>
                    </div>
                <?php } ?>
                <!-- end of alert -->

                <!-- alert -->
                <?php if($this->session->flashdata('operation') != NULL){ ?>
                    <div class="alert alert-<?=$this->session->flashdata('operation')?>" role="alert">
                        <p><?=$this->session->flashdata('message'); ?></p>
                    </div>
                <?php } ?>
                <!-- end of alert -->

                <form action="<?=site_url()?>user/update.html" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Email</label>
                                <div class="col-sm-8">
                                    <label class="form-control-static"><?=$account['email']?></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Username</label>
                                <div class="col-sm-8">
                                    <label class="form-control-static"><?=$account['username']?></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="firstname">First Name</label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?=set_value("firstname", explode(" ", $account['name'])[0])?>" name="firstname" id="firstname" class="form-control form-white" placeholder="Enter your first name here..." required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="lastname">Last Name</label>
                                <div class="col-sm-8">
                                    <?php
                                    $name = explode(" ", $account['name']);
                                    array_shift($name);
                                    ?>
                                    <input type="text" value="<?=set_value("lastname", implode(" ", $name))?>" name="lastname" id="lastname" class="form-control form-white" placeholder="Enter your last name here..." required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="about">About</label>
                                <div class="col-sm-8">
                                    <textarea rows="5" name="about" id="about" class="form-control form-white" placeholder="Story about you shortly here..." required><?=set_value("about", $account['about'])?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="male">Gender</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                            <?php
                                            $male = false;
                                            $female = false;
                                            if($account["gender"] == "MALE"){
                                                $male = true;
                                            }
                                            else{
                                                $female = true;
                                            }
                                            ?>
                                            <label><input type="radio" name="gender" id="male" value="MALE" data-radio="iradio_square-blue" <?=set_radio('gender', "MALE", $male);?> class="required"> Male</label>
                                            <label><input type="radio" name="gender" id="female" value="FEMALE" data-radio="iradio_square-blue" <?=set_radio('gender', "FEMALE", $female);?>> Female</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="about">Avatar</label>
                                <div class="col-sm-8">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img data-src="" src="<?=base_url()?>assets/global/images/avatars/<?=$account['avatar']?>" class="img-responsive" style="max-width: 130px" alt="gallery 3">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                        <span class="btn btn-default btn-file">
                                            <span class="fileinput-new">Select image...</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="avatar" id="avatar">
                                        </span>
                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="password">Current Password</label>
                                <div class="col-sm-8">
                                    <input type="password" name="password" id="password" class="form-control form-white" placeholder="Enter current password to update..." required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="new_password">New Password</label>
                                <div class="col-sm-8">
                                    <input type="password" name="new_password" id="new_password" class="form-control form-white" placeholder="Fill if you want to change password...">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="confirm_password">Confirm Password</label>
                                <div class="col-sm-8">
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control form-white" placeholder="Confirm your new password...">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Account</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>