<?= $this->load->view('_template/public_header.html'); ?>

	<script type="text/javascript">
	    
      function editForm() {
        $('input').removeAttr("disabled");
        $('select').removeAttr("disabled");
        $('#editForm').css("display","none");
        $('#saveForm').css("display","block");
        
        $("#saveForm").click(function() {
          alert("Daten geändert.");
        });
        
      }   

      function setDelete(product_id) {
        var bestaetigung = window.confirm('Wollen Sie das Produkt wirklich löschen?');
        if(bestaetigung) {
          document.location.href = '<?=base_url();?>product/setDelete/'+product_id;
        }
      } 

      $(document).ready(function() { 
        
        if ( $(".addButtonTop").length > 0 ) {
          $("#scroller").css("margin-top","43px");
        }

      }); 
      
	</script>
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
        <h1>Erweiterte Suche</h1>
        <div class="logout"><a href="<?=base_url();?>login/logout">&raquo; Logout</a></div>
        <div class="clear"></div>
      </div>

      <div id="content">
        <div class="grey">
          
          <h1 <? if($data!=0){ echo 'class="flLeft"';}?> >Suchergebnis:</h1>

          <?php 
            if ($data != 0) { 

              echo '<a class="csvexport" target="_blank" href="'.base_url().'csv/'.$filename.'">Download als .csv Datei</a><br /><br />';
              echo '<div class="clear"></div>';
              $i=0;

              foreach ($data as $record) {

                $record = (object)$record;

                echo '<ul class="searchresult">';
                if(isset($record->azipcode)) {
                  echo '<li '.$linkAttendant[$i].'>'.$record->firstname.' '.$record->lastname.'</li>'; 
                } 

                if(isset($record->pid)) {
                  echo '<li '.$linkProduct[$i].'>'.$record->name.'</li>'; 
                } 

                if (isset($record->czipcode)) {
                  echo '<li '.$linkCustomer[$i].'>'.$record->name.'</li>'; 
                } elseif (isset($record->branchname)) {
                  echo '<li '.$linkCustomer[$i].'>'.$record->name.'</li>';
                  echo '<li><strong>Branche:</strong> '.$record->branchname.'</li>';
                } elseif(!empty($record->firstname) && !empty($record->name)) { 
                  echo '<li '.$linkAttendant[$i].'>'.$record->firstname.' '.$record->lastname.'</li>'; 
                  echo '<li '.$linkCustomer[$i].'>'.$record->name.'</li>'; 
                } elseif(!empty($record->firstname) && isset($record->productname)) { 
                  echo '<li '.$linkAttendant[$i].'>'.$record->firstname.' '.$record->lastname.'</li><br/>'; 
                  echo '<li><strong>Produkt:</strong> '.$record->productname.'</li>';
                } elseif(!empty($record->firstname) && isset($record->groupname)) { 
                  echo '<li '.$linkAttendant[$i].'>'.$record->firstname.' '.$record->lastname.'</li><br/>'; 
                  echo '<li><strong>Gruppe:</strong> '.$record->groupname.'</li>';
                } elseif(!empty($record->name) && isset($record->groupname) && isset($record->productname)) { 
                  echo '<li '.$linkCustomer[$i].'>'.$record->name.'</li><br/>'; 
                  echo '<li><strong>Gruppe:</strong> '.$record->groupname.'</li><br/>'; 
                  echo '<li><strong>Produkt:</strong> '.$record->productname.'</li>'; 
                } elseif(!empty($record->name) && isset($record->groupname)) { 
                  echo '<li '.$linkCustomer[$i].'>'.$record->name.'</li><br/>'; 
                  echo '<li><strong>Gruppe:</strong> '.$record->groupname.'</li>'; 
                } elseif(isset($record->firstname)) { 
                  echo '<li '.$linkAttendant[$i].'>'.$record->firstname.' '.$record->lastname.'</li>'; 
                } elseif(isset($record->name) && isset($record->cid)) {
                  echo '<li '.$linkCustomer[$i].'>'.$record->name.'</li>'; 
                } 
                echo '<div class="clear"></div></ul>';

                $i++;
              }

            } else {
              echo 'keine Treffer';
            } 
          ?>
        </div>

        <div class="clear"></div>

      </div>
      
    </div>
    <div class="clear"></div>
    </div>
    
    </div>
  </div>
  
</body>
</html>