<div class="col-6" style="max-height: 550px; overflow: auto">
    <h6 class="mb-3">CR Comments</h6>

    <br />
    

        <?php if ($comments) {
            foreach ($comments as $com) : ?>
                <?php echo '[' . $com['INSERT_DATE'] . '][' . $com['UNAME'] . ']' . $com['TEXT'] . '<hr/>' ?>
        <?php endforeach;
        } ?>
  
    <br />

   




</div>