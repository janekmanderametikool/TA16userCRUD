<?php
/**
 * Created by PhpStorm.
 * User: janek.mander
 * Date: 22.05.2017
 * Time: 11:31
 */
?>
<ul class="nav nav-pills flex-column">
    <li class="nav-item">
        <a class="nav-link <?php echo $page['menu'] == 'admin' ? 'active' : ''; ?>"
           href="<?php echo ADMIN_URL; ?>">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo in_array($page['menu'], ['car-list', 'car', 'car-delete']) ? 'active' : ''; ?>"
           href="<?php echo ADMIN_URL . "car-list"; ?>">Cars</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo in_array($page['menu'], ['user-list', 'user', 'user-delete']) ? 'active' : ''; ?>"
           href="<?php echo ADMIN_URL . "user-list"; ?>">Users</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo in_array($page['menu'], ['category-list', 'category', 'category-delete']) ? 'active' : ''; ?>"
           href="<?php echo ADMIN_URL . "category-list"; ?>">Categories</a>
    </li>
</ul>
