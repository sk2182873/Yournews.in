<?php include('include/header2.php'); ?>

<div class="d-flex flex-column justify-content-center align-items-center bg-dark w-100">
    <div class="errors">
        <p id="msg" class="text-center text-success"></p>
        <p id="dbErr" class="text-center text-danger"></p>
    </div>
    <form id="formAuthentication" class="mb-3">
        <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
            </div>
            <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
        </div>
        <p id="pass" class="text-danger"></p>

        <div class="mb-1 form-password-toggle">
            <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Confirm Password</label>
            </div>
            <div class="input-group input-group-merge">
                <input type="password" id="cnf-password" class="form-control" name="cnf-password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
        </div>
        <p id="cnfPass" class="text-danger"></p>

        <button class="btn btn-primary d-grid w-100">Update</button>
    </form>

    <div class="text-center">
        <a href="<?php echo base_url() . 'admin/login' ?>" class="d-flex align-items-center justify-content-center">
            <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
            Back to login
        </a>
    </div>
</div>

<?php include('include/footer.php') ?>;

<script>
    $(document).ready(function() {

        $('#formAuthentication').submit(function(event) {
            event.preventDefault();

            $("#cnfPass").html('');
            $("#msg").html('');
            $("#dbErr").html('');
            $("#pass").html('');

            $.ajax({
                url: "<?php echo base_url('authenticate/update_pass') ?>",
                type: 'Post',
                data: $(this).serializeArray(),
                success: function(response) {
                    var res = JSON.parse(response);

                    $("#dbErr").html(res['notMatched']);
                    $("#msg").html(res['success']);
                    $("#dbErr").html(res['dbErr']);
                    $("#cnfPass").html(res['cnfpass']);
                    $("#pass").html(res['pass']);

                }
            });
        })

    });
</script>