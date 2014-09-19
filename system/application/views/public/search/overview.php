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

      $(document).ready(function() { 
        
        if ( $(".addButtonTop").length > 0 ) {
          $("#scroller").css("margin-top","43px");
        }

        $( ".searchcriterion" ).click(function() {
          if($(this).val() == '0') {
            $('.cat').attr('disabled','disabled');
            $('.label').attr('disabled','disabled');
            $('.branch').attr('disabled','disabled');
          } else if($(this).val() == '1') {
            $('.cat').removeAttr('disabled');
            $('.label').attr('disabled','disabled');
            $('.branch').attr('disabled','disabled');
          } else if($(this).val() == '2') {
            $('.label').removeAttr('disabled');
            $('.cat').attr('disabled','disabled');
            $('.branch').attr('disabled','disabled');
          } else if($(this).val() = '3') {
            $('.branch').removeAttr('disabled');
            $('.label').attr('disabled','disabled');
            $('.cat').attr('disabled','disabled');
          } 
        });

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
          <form class="data" action="<?=base_url();?>search/result/" method="post">
            
            <label class="user" for="company">Unternehmen:</label>
            <input type="text" id="companyname" name="companyname" value="" />
            <div class="clear"></div> 

            <label class="user" for="person">Person:</label>
            <input type="text" id="person" name="person" value="" />
            <div class="clear"></div> 

            <label class="user" for="criterion"><input type="radio" class="searchcriterion" name="searchcriterion" value="0" checked> &nbsp; kein Filter</label>
            <div class="clear"></div>

            <label class="user" for="products"><input type="radio" class="searchcriterion" name="searchcriterion" value="1"> &nbsp; Projektkat.:</label>
            <select disabled="disabled" class="shortlist cat" name="categories[]" size="5" multiple="multiple">
              <option value="none" selected></option>
              <?php foreach ($categories as $category): ?>
                <option value="<?=$category->id;?>"><?=$category->name;?></option>
              <?php endforeach; ?>
            </select>
            <div class="clear"></div>

            <label class="user" for="groups"><input type="radio" class="searchcriterion" name="searchcriterion" value="2"> &nbsp; Etikett:</label>
            <input disabled="disabled" class="label extracheck" type="radio" name="gs" class="check" value="gno" checked /> keine Angabe
            <input disabled="disabled" class="label extracheck" type="radio" name="gs" class="check" value="gc" /> Unternehmen
            <input disabled="disabled" class="label extracheck" type="radio" name="gs" class="check" value="gp" /> Personen
            <div class="clear"></div>

            <select disabled="disabled" class="shortlist label tagsearch" name="groups[]" size="5" multiple="multiple">
                <option value="none" selected></option>
              <?php foreach ($groups as $result): ?>
                <option value="<?=$result->id;?>"><?=$result->name;?></option>
              <?php endforeach; ?>
            </select>
            <div class="clear"></div>
           
            <label class="user" for="branchs"><input type="radio" class="searchcriterion" name="searchcriterion" value="3"> &nbsp; Branche:</label>
            <select disabled="disabled" class="shortlist branch" name="branchs[]" size="5" multiple="multiple">
                <option value="none" selected></option>
              <?php foreach ($branchs as $result): ?>
                <option value="<?=$result->id;?>"><?=$result->name;?></option>
              <?php endforeach; ?>
            </select>
            <div class="clear"></div>

            <label class="user" for="zipcode">PLZ:</label>
            <input type="text" id="zipcode" name="zipcode" value="" />
            <div class="clear"></div> 
            
            <label class="user" for="location">Ort:</label>
            <input type="text" id="location" name="location" value="" />
            <div class="clear"></div> 

            <label class="user" for="year">Gründungsjahr:</label>
            <input type="text" id="year" name="year" value="" />
            <div class="clear"></div> 

            <input type="submit" value="Suchen" id="saveButton" />
                        
          </form>
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