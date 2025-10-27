<?php
class tables{
   public function users_table(){
      global $conf, $ObjFncs, $SQL;
      $users = $SQL->select_while("SELECT * FROM roles WHERE roleId > 1 ORDER BY roleId ASC");
      $spot_init = $SQL->select("SELECT MIN(roleId) AS minRoleId FROM roles WHERE roleId > 1");

      $min_row = $spot_init['minRoleId'];
?>
      <ul class="nav nav-tabs" role="tablist">
         <?php
         if($users) {
            foreach($users as $index => $role) {
               $active_class = ($role['roleId'] == $min_row) ? 'active' : '';
         ?>
               <li class="nav-item" role="presentation"><button class="nav-link <?php echo $active_class; ?>" href="#tab-table<?php echo $role['roleId']; ?>" data-bs-toggle="tab" data-bs-target="#tab-table<?php echo $role['roleId']; ?>"><?php echo ucwords($role['roleName']); ?></button></li>
         <?php
            }
         }
         ?>
      </ul>
      <div class="tab-content pt-2">
   <?php
   // Dynamic tabs for each role
         if($users){
            foreach($users as $index => $role) {
               $activeClass = ($role['roleId'] == $min_row) ? 'active' : '';
               ?>
               <div class="tab-pane <?php echo $activeClass; ?>" id="tab-table<?php echo $role['roleId']; ?>">
                  <table id="myTable<?php echo $role['roleId']; ?>" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%">
                     <thead>
                           <tr>
                              <th>ID</th>
                              <th>Full Name</th>
                              <th>Email</th>
                              <th>Role</th>
                           </tr>
                     </thead>
                  </table>
               </div>
            <?php
            }
         }
   ?>
      </div>
   <?php
    }

    public function people_table(){
      global $conf, $ObjFncs, $SQL;
      $people = $SQL->select_while("SELECT * FROM users left JOIN roles using(roleId) WHERE users.roleId > 1 ORDER BY users.fullname ASC");
?>
    <table id="people" class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Full Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if($people) {
         $sn = 0;
          foreach($people as $index => $person) {
            $sn++;
?>
                <tr>
                <td><?php echo htmlspecialchars($sn); ?></td>
                <td><?php echo htmlspecialchars($person['fullname']); ?></td>
                <td><?php echo htmlspecialchars($person['email']); ?></td>
                <td><?php echo htmlspecialchars($person['roleName']); ?></td>
                <td>
                  <button class="btn btn-sm btn-primary">Edit</button>
                  <button class="btn btn-sm btn-danger">Del</button>
                </td>
                </tr>
<?php
          }
        }
        ?>
      </tbody>
    </table>
<?php
    }

    public function repository_table(){
      global $conf, $ObjFncs, $SQL;
?>
    <table id="repository" class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Uploaded</th>
          <th>Title</th>
          <th>Author</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $repository = $SQL->select_while("SELECT * FROM repository ORDER BY updated_at DESC");
        if($repository) {
          foreach($repository as $index => $item) {
?>
            <tr>
              <td><?php echo $item['Id']; ?></td>
              <td><?php echo date('Y-m-d', strtotime($item['updated_at'])); ?></td>
              <td><?php 
              // short string for title
              if(!empty($item['Title'])) {
                 if(strlen($item['Title']) > 50){
                    echo substr($item['Title'], 0, 50) . '...';
                 } else {
                    echo $item['Title'];
                 }
              } else {
                  echo 'Untitled';
                }
              ?></td> 
              <td><?php 
              // short string for author

             if(!empty($item['Author'])) {
               if( strlen($item['Author']) > 50){
                  echo substr($item['Author'], 0, 50) . '...';
               } else {
                  echo $item['Author'];
               }
             } else {
                 echo 'Unknown';
               }
              ?></td>
              <td>
                <a href="edit_file_meta.php?id=<?php echo $item['Id']; ?>" class="btn btn-sm btn-primary">Edit</a>
              </td>
            </tr>
<?php
          }
        }
?>
      </tbody>
    </table>
<?php
    }
}