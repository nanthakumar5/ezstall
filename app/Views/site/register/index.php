<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content') ?>

<section class="signInFlex">
<div class="signInLeft">
    <img class="signInImage" src="<?php echo base_url()?>/assets/site/img/signup_img.jpg" alt="Horse Image">
</div>
<div class="signInRight">
    <div class="signInFormPanel">
        <h1>Let's Sign Up</h1><p>Enter details to sign up</p>
        <form class="signInForm" method="post" action="" id="form">
            <div class="wrapper">
                <input type="radio" name="type" id="option-1" value="3" checked="">
                <input type="radio" name="type" id="option-2" value="5">
                <label for="option-1" class="option option-1">
                    <div class="dot"></div>
                    <span>Horse Owner</span>
                </label>
                <label for="option-2" class="option option-2">
                    <div class="dot"></div>
                    <span>Facility</span>
                </label>
            </div>
            <span>
                <input type="text" class="signInText" placeholder="Enter username" name="name" value="">
            </span>
            <span>
                <input type="email" class="signInEmail" placeholder="Enter email" name="email" value="" autocomplete="off" >
            </span>
            <span>
                <input type="password" class="signInPassword" placeholder="Create password" name="password" value="">
            </span>
                <button class="signInSubmitBtn" type="submit">Sign Up</button><p>Already have an account ?
                <a href="<?php echo base_url()?>/login" class="signUpLink"> Sign In</a></p>
        </form>
    </div>
</div>
</section>
<?php $this->endSection(); ?>
<?php $this->section('js') ?>
    <script>
        $(function(){
            validation(
                '#form',
                {
                    name        : {
                        required  : true
                    },
                    email       : {
                        required  : true,
                        email     : true,
                        remote            :   {
                                    url   :   "<?php echo base_url().'/validation/emailvalidation'; ?>",
                                    type  :   "post",
                                    async :   false,
                                    data:{ 
                                            email: function(){ return $(".signInEmail").val();}
                                       }
                            }
      
                    },
                    password    : {
                        required  : true
                    }
                },
                {   
                    name        : {
                        required  : "Name field is required."
                    },
                    email       : {
                        required  : "Email field is required.",
                        email     : "Enter valid email address.",
                        remote    :  "Email Already Token"
                    },
                    password    : {
                        required  : "Password field is required."
                    }
                }
            );
        });
    </script>
<?php echo $this->endSection() ?>