<h3 style="color: lightgreen;"><?php
    if(isset($success['success'])):?>
        <i><?= $success['success'] ?></i>
    <?php endif; ?></h3>
<form method="POST">
    <label for="fullname">Fullname</label><br/>
    <input type="text" name="fullname" id="fullname" value="<?= htmlspecialchars($fullname) ?? ''; ?>"><br/>
    <?php if (isset($errors['fullname'])): ?>
        <i style="color: red; font-size:small"><?= $errors['fullname'] ?></i><br/>
    <?php endif; ?>
   <label for="">Email</label><br/>
   <input type="email" name="email" id="email"><br/>
   <?php if(isset($errors['email'])):?>
        <i style="font-size: small; color:red"><?= $errors['email'] ?></i>
    <?php endif ?><br/>
    <label for="">Phone</label><br/>
    <input type="number" name="phone" id=""><br/>
    <?php if(isset($errors['phone'])):?>
        <i style="font-size: small; color:red"><?= $errors['phone'] ?></i> 
    <?php  endif; ?><br/>
    <button type="submit">Add</button>
</form>