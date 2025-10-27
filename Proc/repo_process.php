<?php
class repo_process {

    private function clean_string($string) {

// Step 1: Replace line breaks (\r, \n), tabs (\t), and multiple spaces with a single space
$cleaned = preg_replace('/[\r\n\t]+/', ' ', $string);       // Replace line breaks and tabs with space
$cleaned = preg_replace('/\s{2,}/', ' ', $cleaned);       // Collapse multiple spaces into one

// Step 2: Trim leading and trailing whitespace
$cleaned = trim($cleaned);

      // Remove special characters and spaces
    //   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
      return $cleaned;
    }

    public function update_file_meta(){
      global $SQL, $ObjFncs;

      if(isset($_POST['update_file_meta'])){
        $repoId = $SQL->escape_values($_POST['repoId']);
        $Title = $SQL->escape_values(ucwords(strtolower($_POST['Title'])));
        $Author = $SQL->escape_values(ucwords(strtolower($_POST['Author'])));
        $Abstract = $SQL->escape_values($_POST['Abstract']);
        $Publisher = $SQL->escape_values(ucwords(strtolower($_POST['Publisher'])));
        $Folder = $SQL->escape_values($_POST['Folder']);
        $Year_of_pub = $SQL->escape_values($_POST['Year_of_pub']);

        $item_data = array(
            'Title' => $this->clean_string($Title),
            'Author' => $this->clean_string($Author),
            'Abstract' => $this->clean_string($Abstract),
            'Publisher' => $this->clean_string($Publisher),
            'Folder' => $this->clean_string($Folder),
            'Year_of_pub' => $this->clean_string($Year_of_pub)
        );
        
        $where = array(
            'Id' => $repoId
        );
        $update = $SQL->update('repository', $item_data, $where);
        if($update){
          header("Location: edit_file_meta.php?id=" . $repoId . "&status=success");
        } else {
          header("Location: edit_file_meta.php?id=" . $repoId . "&status=error");
        }

      }
    }

    public function edit_folder() {
      global $SQL, $ObjFncs;

      if(isset($_POST['update_folder'])){
        if(!empty($_SESSION['RepoId']) && is_array($_SESSION['RepoId'])) {
            $folderName = $SQL->escape_values($_POST['folderName']);
            $cleaned_folder_name = $this->clean_string($folderName);

            foreach($_SESSION['RepoId'] as $repoId) {
                $repoId = $SQL->escape_values($repoId);
                $item_data = array(
                    'Folder' => $cleaned_folder_name
                );
                
                $where = array(
                    'Id' => $repoId
                );
                $update = $SQL->update('repository', $item_data, $where);
            }
            // die($update);
            header("Location: repository.php?status=success");
        } else {
            header("Location: repository.php?status=error");
        }
      }

    }
}