<?php 
   require "header.php"
?>

<main>
  <div class="wrapper-main">
     <section class="section-default">
        <h1>Reset your password</h1>
        <p>e-mail will be sent to you with instructions on how to reset your password.</p>
        <form class="form-resetpwd" action="includes/logout.inc.php" method="post">
         <input type="text" name="email" placeholder="Enter your email...">
         <button type="submit" name="reset-request-submit"> Recieve new password by e-mail.</button>
    </form>
        </section>
  </div>
</main>

<?php 
   require "footer.php"
?>