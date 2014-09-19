<!DOCTYPE html>
<?= $this->load->view('_template/public_header.html'); ?>

</head>
<body>
  
  <div id="wrapper">
   <div id="greyTop">
    <div id="innerWrapper">
    <div id="leftBox">
      <?$this->load->view('public/navigation',$navstate);?>
      
    </div>
    <div id="rightBox">
      <div id="headTop">
        <h1>Alle Wiedervorlagen</h1>
        <div class="logout"><a href="<?=base_url();?>login/logout">&raquo; Logout</a></div>
        <div class="clear"></div>
      </div>     
      
      <div id="content">
        
        <div id="left">
          <form class="data" action="<?=base_url();?>reminder/remove/" method="post">
          	<div class="reminder">
          	  <ul class="reminderTop">
          	  	<li>Name</li>
          	  	<li class="small">Datum</li>
                <li>Priorität</li>
          	  	<li class="small">Löschen?</li>
                <div class="clear"></div>
          	  </ul>
              <?if(!empty($reminder)) { ?>
              <?php foreach ($reminder as $reminder) :?>
                <? $reminderdate = date('d.m.Y', strtotime($reminder->date)); ?>
                <ul>
              	  <li><a href="<?=base_url();?>attendant/show/<?= $reminder->aid; ?>"><?=$reminder->firstname.' '.$reminder->lastname;?></a></li>
              	  <li class="small"><?=$reminderdate;?></li>
                  <li><?=$reminder->priority;?></li>
                  <li class="small"><input name="reminderRemove[]" type="checkbox" value="<?=$reminder->id;?>" /></li>
                  <div class="clear"></div>
                </ul>
                <input type="hidden" value="<?= $reminder->aid; ?>" />

              <?php endforeach; ?>
              <? } else { echo 'keine Wiedervorlage vorhanden.'; }?>
            </div>

            <input type="submit" value="Auswahl löschen" id="saveButton" name="save" />

          </form>
        </div>
        
      </div>

    </div>
    

        <div class="clear"></div>
   </div>
    
   </div>
    
  </div>
  
</body>
</html>


