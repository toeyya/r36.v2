

 <?php 
 
                            foreach ($query->result() as $row)
                            {
                                echo "<option value='".$row->title."'>".$row->detail."</option>";
                            }
 
 
 ?>

<tr>

<?php //echo $pagination; ?>