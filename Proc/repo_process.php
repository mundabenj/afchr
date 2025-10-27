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
        $FileName = $SQL->escape_values($_POST['FileName']);
        $Title = $SQL->escape_values($_POST['Title']);
        $Author = $SQL->escape_values($_POST['Author']);
        $CreationDate = $SQL->escape_values($_POST['CreationDate']);
        $ModDate = $SQL->escape_values($_POST['ModDate']);

        $item_data = array(
            'FileName' => $this->clean_string($FileName),
            'Title' => $this->clean_string($Title),
            'Author' => $this->clean_string($Author),
            'CreationDate' => $this->clean_string($CreationDate),
            'ModDate' => $this->clean_string($ModDate)
        );
        
        $where = array(
            'Id' => $repoId
        );
        $update = $SQL->update('repository', $item_data, $where);
        if($update){
          header("Location: edit_file_meta.php?id=" . $repoId . "&status=success");
        } else {
          header("Location: repository.php?id=" . $repoId . "&status=error");
        }

      }
    }
    }