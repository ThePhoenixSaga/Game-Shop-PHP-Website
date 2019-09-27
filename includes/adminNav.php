  <div id="nav">
    <ul class="topnav">
      <li><a href="/assignment1_website/pages/admin/addProduct/">Add Product</a></li>
      <?php 
      if(isset($_SESSION['Username']))
      {
      if($_SESSION['AccessLevel'] == 1)
      {
      ?>
      <li><a href="/assignment1_website/pages/admin/createStaffUser/">Create staff user</a></li>
      <li><a href="/assignment1_website/pages/admin/staffListing/">Staff user listing</a></li>
      <?php
      }
      }
      ?>
    </ul> 
  </div>